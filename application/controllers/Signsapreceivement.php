<?php
defined('BASEPATH') or exit('No direct script access allowed');
//this is for penerimaan material
class Signsapreceivement extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Sign_sapreceivement_procurement_model');
    $this->load->helper('url');
  }

  public function procurement()
  {
    $token = $this->uri->segment(3);

    // Load model
    // Jika token kosong, langsung load view invalid
    if (empty($token)) {
      $this->load->view('public/whatsapp_verified_invalid');
      return;
    }

    // Ambil data dari model
    $user_data = $this->Sign_sapreceivement_procurement_model->get_data_by_token($token);

    // Cek apakah data ditemukan dan validasi token_wa_created
    if ($user_data && $this->_is_token_valid($user_data->request_at)) {

      $this->load->model('Public_model');

      // Ambil data dari tabel data_queue_sign

      $user_data->data_queue_sign = $this->Public_model->get_queue_sign($token);

      foreach ($user_data->data_queue_sign as $queue) {
        $queue->details = $this->Public_model->get_queue_sign_by_users_id($queue->users_id);
      }

      // Kirim data ke view

      $this->load->view('digitalsign/publicsapprocurement', $user_data);
    } else {
      // Tampilkan pesan error atau redirect ke halaman lain
      $this->load->view('public/whatsapp_verified_invalid');
    }
  }

  public function single_approve()
  {
    $id = $this->input->post('id');
    $token = $this->input->post('token');

    $data = $this->Sign_sapreceivement_procurement_model->get_data_by_token($token);

    //formulir untuk tug 4 marketplace
    if ($data->form_id == 4) {
      // Melakukan update pada model Approval_single
      $result = $this->Sign_sapreceivement_procurement_model->approve_signature($id, $token, $data->form_id);
      $approval_sum = $this->Sign_sapreceivement_procurement_model->update_current_count_sign($token);

      //kirim pesan ke manajer
      //if ($approval_sum >= 5 && $approval_sum <= 7 && $approval_sum != 8) {
      if ($approval_sum == 7 && $approval_sum != 8) {
        $send_manager = $this->Sign_sapreceivement_procurement_model->send_manager($token);
      }
      $this->stamp_sign($token);

      // Menampilkan pesan berdasarkan hasil update
      if ($result == 'success') {
        echo $result;
      } else {
        echo $result;
      }
    } else if ($data->form_id == 5) {
      // Melakukan update pada model Approval_single
      $result = $this->Sign_sapreceivement_procurement_model->approve_signature($id, $token, $data->form_id);
      $approval_sum = $this->Sign_sapreceivement_procurement_model->update_current_count_sign($token);

      $this->stamp_sign_tug3_karantina($token);

      // Menampilkan pesan berdasarkan hasil update
      if ($result == 'success') {
        echo $result;
      } else {
        echo $result;
      }
    } else if ($data->form_id == 6) { // tug 3 persediaan
      // Melakukan update pada model Approval_single
      $result = $this->Sign_sapreceivement_procurement_model->approve_signature($id, $token, $data->form_id);
      $approval_sum = $this->Sign_sapreceivement_procurement_model->update_current_count_sign($token);

      $this->stamp_sign_tug3_persediaan($token);

      // Menampilkan pesan berdasarkan hasil update
      if ($result == 'success') {
        echo $result;
      } else {
        echo $result;
      }
    } else {
      echo "error";
    }
  }

  //backup
  // public function single_approve()
  // {
  //   $id = $this->input->post('id');
  //   $token = $this->input->post('token');

  //   $data = $this->Sign_sapreceivement_procurement_model->get_data_by_token($token);

  //   //formulir untuk tug 4 marketplace
  //   if ($data->form_id == 1) {
  //     // Melakukan update pada model Approval_single
  //     $result = $this->Sign_sapreceivement_procurement_model->approve_signature($id, $token);
  //     $approval_sum = $this->Sign_sapreceivement_procurement_model->update_current_count_sign($token);

  //     //kirim pesan ke manajer
  //     if ($approval_sum >= 5 && $approval_sum <= 7 && $approval_sum != 8) {
  //       $send_manager = $this->Sign_sapreceivement_procurement_model->send_manager($token);
  //     }
  //     $this->stamp_sign($token);

  //     // Menampilkan pesan berdasarkan hasil update
  //     if ($result == 'success') {
  //       echo $result;
  //     } else {
  //       echo $result;
  //     }
  //   } else if ($data->form_id == 2) {
  //     // Melakukan update pada model Approval_single
  //     $result = $this->Sign_sapreceivement_procurement_model->approve_signature($id, $token);
  //     $approval_sum = $this->Sign_sapreceivement_procurement_model->update_current_count_sign($token);

  //     $this->stamp_sign_tug3_karantina($token);

  //     // Menampilkan pesan berdasarkan hasil update
  //     if ($result == 'success') {
  //       echo $result;
  //     } else {
  //       echo $result;
  //     }
  //   } else if ($data->form_id == 3) { // tug 3 persediaan
  //     // Melakukan update pada model Approval_single
  //     $result = $this->Sign_sapreceivement_procurement_model->approve_signature($id, $token);
  //     $approval_sum = $this->Sign_sapreceivement_procurement_model->update_current_count_sign($token);

  //     $this->stamp_sign_tug3_persediaan($token);

  //     // Menampilkan pesan berdasarkan hasil update
  //     if ($result == 'success') {
  //       echo $result;
  //     } else {
  //       echo $result;
  //     }
  //   } else {
  //     echo "error";
  //   }
  // }


  //stamp sign untuk tug 4 penerimaan marketplace berita acara
  public function stamp_sign($token)
  {
    try {
      // $token = 'hiZZqQ4OBhn90KP';
      $data = $this->Sign_sapreceivement_procurement_model->get_data_by_token($token);
      require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');
      require_once('./vendor/setasign/fpdi/src/autoload.php');

      // File paths
      // $pdf_file = FCPATH . 'uploads/tes.pdf';
      // $image_file = FCPATH . 'assets/signatures/signature_1679506271.png';
      // $output_file = FCPATH . 'uploads/nama_file_stamp.pdf';

      // $pdf_file = FCPATH . $data->folder_name . $data->tug4_unsigned_file;
      $pdf_file = FCPATH . str_replace("./", "", $data->folder_name) . "/" . $data->tug4_unsigned_file;
      $image_file = FCPATH . 'assets/signatures/' . $data->signature;
      $stamp_file = FCPATH . 'assets/signatures/' . "stamping.png";
      $output_file = FCPATH . str_replace("./", "", $data->folder_name) . "/" . $data->tug4_unsigned_file;


      // Create new PDF document
      $pdf = new \setasign\Fpdi\TcpdfFpdi();

      // Set default settings
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetMargins(0, 0, 0, true);
      $pdf->SetAutoPageBreak(false);


      // Import the original PDF
      $page_count = $pdf->setSourceFile($pdf_file);

      // Iterate through all pages
      for ($i = 1; $i <= $page_count; $i++) {
        // Add a page
        $template_id = $pdf->importPage($i);
        $size = $pdf->getTemplateSize($template_id);
        $orientation = $size['width'] > $size['height'] ? 'L' : 'P';
        $pdf->AddPage($orientation, array($size['width'], $size['height']));

        // Use the imported page as a template
        $pdf->useTemplate($template_id);

        // // Set image size and position
        // $image_width = (5 * 3.5); // Width in points (1 point = 1/72 inches)
        // $image_height = (3 * 3.5); // Height in points
        // $position_x = 140; // X position in points
        // $position_y = 92; // Y position in points

        if ($data->form_id == 4 && $data->sequence < 8) {

          $image_width = (5 * 2); // Width in points (1 point = 1/72 inches)
          $image_height = (3 * 2); // Height in points
          $position_x = $data->x_sign; // X position in points
          $position_y = $data->y_sign; // Y position in points

          $signer_name = strtoupper($data->fullname);
          $signer_position_x = $position_x + 10;
          $signer_position_y = $position_y + 2.7;
          $signer_color = [128, 128, 128]; // RGB color code for gray

          $date = date('Y-m-d H:i:s');
          $timestamp = strtotime($date);
          $new_date_format = strftime('%e %B %Y %H:%M:%S WIB', $timestamp);

          $signed_at = strtoupper($new_date_format);
          $signed_position_x = $position_x + 10;
          $signed_position_y = $position_y + 4;
          $signed_color = [128, 128, 128]; // RGB color code for gray

        } else if ($data->form_id == 4 && $data->sequence == 8) { //manager
          $image_width = (5 * 12.4); // Width in points (1 point = 1/72 inches)
          $image_height = (3 * 12.4); // Height in points
          $position_x = $data->x_sign; // X position in points
          $position_y = $data->y_sign; // Y position in points
          // $position_x = 135; // X position in points
          // $position_y = 209; // Y position in points

          $signer_name = strtoupper($data->fullname);
          $signer_position_x = $position_x + 25;
          $signer_position_y = $position_y + (2.7 + 5);
          $signer_color = [128, 128, 128]; // RGB color code for gray

          $date = date('Y-m-d H:i:s');
          $timestamp = strtotime($date);
          $new_date_format = strftime('%e %B %Y %H:%M:%S WIB', $timestamp);

          $signed_at = strtoupper($new_date_format);
          $signed_position_x = $position_x + 25;
          $signed_position_y = $position_y + (4 + 5);
          $signed_color = [128, 128, 128]; // RGB color code for gray
        }



        // Add the image
        $pdf->Image($image_file, $position_x, $position_y, $image_width, $image_height);
        if ($data->form_id == 4 && $data->sequence == 8) {
          $pdf->Image($stamp_file, $position_x - 15, $position_y - 3, 34, 34);
        }
        // Set font
        $pdf->SetFont('helvetica', 'B', 3);

        // Add signer name text
        $pdf->SetTextColor($signer_color[0], $signer_color[1], $signer_color[2]);
        $pdf->SetXY($signer_position_x, $signer_position_y);
        $pdf->MultiCell(0, 0, 'Digitally Signed by: ' . $signer_name, 0, 'L', 0, 1);

        $pdf->SetFont('helvetica', '', 3);
        // Add signed at text
        $pdf->SetTextColor($signed_color[0], $signed_color[1], $signed_color[2]);
        $pdf->SetXY($signed_position_x, $signed_position_y);
        $pdf->MultiCell(0, 0, 'Signed At: ' . $signed_at, 0, 'L', 0, 1);
      }

      // Save the PDF to a file
      $pdf->Output($output_file, 'F');

      // If everything is successful, return 'success'
      return 'success';
    } catch (Exception $e) {
      // If an error occurs
      return 'error';
    }
  }

  //stamp sign untuk tug 3 penerimaan marketplace karantina
  public function stamp_sign_tug3_karantina($token)
  { //1 file ada 2 lembar, lembar 1 yang ttd kep gudang dan mengetahui, lembar 2 yng ttd hanay kepala gudang posisi agak beda saama lembar 1
    try {
      // $token = 'hiZZqQ4OBhn90KP';
      $data = $this->Sign_sapreceivement_procurement_model->get_data_by_token($token);
      require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');
      require_once('./vendor/setasign/fpdi/src/autoload.php');

      // File paths
      // $pdf_file = FCPATH . 'uploads/tes.pdf';
      // $image_file = FCPATH . 'assets/signatures/signature_1679506271.png';
      // $output_file = FCPATH . 'uploads/nama_file_stamp.pdf';

      // $pdf_file = FCPATH . $data->folder_name . $data->tug4_unsigned_file;
      $pdf_file = FCPATH . str_replace("./", "", $data->folder_name) . "/" . $data->tug3_karantina_unsigned_file;
      $image_file = FCPATH . 'assets/signatures/' . $data->signature;
      $output_file = FCPATH . str_replace("./", "", $data->folder_name) . "/" . $data->tug3_karantina_unsigned_file;


      // Create new PDF document
      $pdf = new \setasign\Fpdi\TcpdfFpdi();

      // Set default settings
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetMargins(0, 0, 0, true);
      $pdf->SetAutoPageBreak(false);



      // Import the original PDF
      $page_count = $pdf->setSourceFile($pdf_file);


      for ($i = 1; $i <= $page_count; $i++) {
        // Add a page
        $template_id = $pdf->importPage($i);
        $size = $pdf->getTemplateSize($template_id);
        $orientation = $size['width'] > $size['height'] ? 'L' : 'P';
        $pdf->AddPage($orientation, array($size['width'], $size['height']));

        // Use the imported page as a template
        $pdf->useTemplate($template_id);

        // // Set image size and position
        // $image_width = (5 * 3.5); // Width in points (1 point = 1/72 inches)
        // $image_height = (3 * 3.5); // Height in points
        // $position_x = 140; // X position in points
        // $position_y = 92; // Y position in points

        //jika formulir id 2 (tug 3 karantina) dan file lembar ke 1 untuk urutan ke 1
        if ($data->form_id == 5 && $i == 1 && $data->sequence == 1) {

          $image_width = (5 * 7); // Width in points (1 point = 1/72 inches)
          $image_height = (3 * 7); // Height in points
          $position_x = $data->x_sign; // X position in points
          $position_y = $data->y_sign; // Y position in points

          $signer_name = strtoupper($data->fullname);
          $signer_position_x = $position_x + 32;
          $signer_position_y = $position_y + (2.7 + 5);
          $signer_color = [128, 128, 128]; // RGB color code for gray

          $date = date('Y-m-d H:i:s');
          $timestamp = strtotime($date);
          $new_date_format = strftime('%e %B %Y %H:%M:%S WIB', $timestamp);

          $signed_at = strtoupper($new_date_format);
          $signed_position_x = $position_x + 32;
          $signed_position_y = $position_y + (4 + 5);
          $signed_color = [128, 128, 128]; // RGB color code for gray

          // Add the image
          $pdf->Image($image_file, $position_x, $position_y, $image_width, $image_height);
          // Set font
          $pdf->SetFont('helvetica', 'B', 3);

          // Add signer name text
          $pdf->SetTextColor($signer_color[0], $signer_color[1], $signer_color[2]);
          $pdf->SetXY($signer_position_x, $signer_position_y);
          $pdf->MultiCell(0, 0, 'Digitally Signed by: ' . $signer_name, 0, 'L', 0, 1);

          $pdf->SetFont('helvetica', '', 3);
          // Add signed at text
          $pdf->SetTextColor($signed_color[0], $signed_color[1], $signed_color[2]);
          $pdf->SetXY($signed_position_x, $signed_position_y);
          $pdf->MultiCell(0, 0, 'Signed At: ' . $signed_at, 0, 'L', 0, 1);

          //jika formulir id 2 (tug 3 karantina) dan file lembar ke 2 untuk urutan ke 1
        } else if ($data->form_id == 5 && $i == 2 && $data->sequence == 1) {
          $image_width = (5 * 9.4); // Width in points (1 point = 1/72 inches)
          $image_height = (3 * 9.4); // Height in points
          $position_x = $data->x_sign; // X position in points
          $position_y = $data->y_sign; // Y position in points
          // $position_x = 135; // X position in points
          // $position_y = 209; // Y position in points

          $signer_name = strtoupper($data->fullname);
          $signer_position_x = $position_x + 32;
          $signer_position_y = $position_y + (2.7 + 5);
          $signer_color = [128, 128, 128]; // RGB color code for gray

          $date = date('Y-m-d H:i:s');
          $timestamp = strtotime($date);
          $new_date_format = strftime('%e %B %Y %H:%M:%S WIB', $timestamp);

          $signed_at = strtoupper($new_date_format);
          $signed_position_x = $position_x + 32;
          $signed_position_y = $position_y + (4 + 5);
          $signed_color = [128, 128, 128]; // RGB color code for gray
          // Add the image
          $pdf->Image($image_file, $position_x, $position_y, $image_width, $image_height);
          // Set font
          $pdf->SetFont('helvetica', 'B', 3);

          // Add signer name text
          $pdf->SetTextColor($signer_color[0], $signer_color[1], $signer_color[2]);
          $pdf->SetXY($signer_position_x, $signer_position_y);
          $pdf->MultiCell(0, 0, 'Digitally Signed by: ' . $signer_name, 0, 'L', 0, 1);

          $pdf->SetFont('helvetica', '', 3);
          // Add signed at text
          $pdf->SetTextColor($signed_color[0], $signed_color[1], $signed_color[2]);
          $pdf->SetXY($signed_position_x, $signed_position_y);
          $pdf->MultiCell(0, 0, 'Signed At: ' . $signed_at, 0, 'L', 0, 1);

          //jika formulir id 2 (tug 3 karantina) dan file lembar ke 1 untuk urutan ke 2
        } else if ($data->form_id == 5 && $i == 1 && $data->sequence == 2) {

          $image_width = (5 * 7); // Width in points (1 point = 1/72 inches)
          $image_height = (3 * 7); // Height in points
          $position_x = $data->x_sign; // X position in points
          $position_y = $data->y_sign; // Y position in points

          $signer_name = strtoupper($data->fullname);
          $signer_position_x = $position_x + 32;
          $signer_position_y = $position_y + (2.7 + 5);
          $signer_color = [128, 128, 128]; // RGB color code for gray

          $date = date('Y-m-d H:i:s');
          $timestamp = strtotime($date);
          $new_date_format = strftime('%e %B %Y %H:%M:%S WIB', $timestamp);

          $signed_at = strtoupper($new_date_format);
          $signed_position_x = $position_x + 32;
          $signed_position_y = $position_y + (4 + 5);
          $signed_color = [128, 128, 128]; // RGB color code for gray

          // Add the image
          $pdf->Image($image_file, $position_x, $position_y, $image_width, $image_height);
          // Set font
          $pdf->SetFont('helvetica', 'B', 3);

          // Add signer name text
          $pdf->SetTextColor($signer_color[0], $signer_color[1], $signer_color[2]);
          $pdf->SetXY($signer_position_x, $signer_position_y);
          $pdf->MultiCell(0, 0, 'Digitally Signed by: ' . $signer_name, 0, 'L', 0, 1);

          $pdf->SetFont('helvetica', '', 3);
          // Add signed at text
          $pdf->SetTextColor($signed_color[0], $signed_color[1], $signed_color[2]);
          $pdf->SetXY($signed_position_x, $signed_position_y);
          $pdf->MultiCell(0, 0, 'Signed At: ' . $signed_at, 0, 'L', 0, 1);
        }
      }

      // Save the PDF to a file
      $pdf->Output($output_file, 'F');

      // If everything is successful, return 'success'
      return 'success';
    } catch (Exception $e) {
      // If an error occurs
      return 'error';
    }
  }

  public function stamp_sign_tug3_persediaan($token)
  {
    try {
      // $token = 'hiZZqQ4OBhn90KP';
      $data = $this->Sign_sapreceivement_procurement_model->get_data_by_token($token);
      require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');
      require_once('./vendor/setasign/fpdi/src/autoload.php');

      // File paths
      // $pdf_file = FCPATH . 'uploads/tes.pdf';
      // $image_file = FCPATH . 'assets/signatures/signature_1679506271.png';
      // $output_file = FCPATH . 'uploads/nama_file_stamp.pdf';

      // $pdf_file = FCPATH . $data->folder_name . $data->tug4_unsigned_file;
      $pdf_file = FCPATH . str_replace("./", "", $data->folder_name) . "/" . $data->tug3_unsigned_file;
      $image_file = FCPATH . 'assets/signatures/' . $data->signature;
      $output_file = FCPATH . str_replace("./", "", $data->folder_name) . "/" . $data->tug3_unsigned_file;


      // Create new PDF document
      $pdf = new \setasign\Fpdi\TcpdfFpdi();

      // Set default settings
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetMargins(0, 0, 0, true);
      $pdf->SetAutoPageBreak(false);


      // Import the original PDF
      $page_count = $pdf->setSourceFile($pdf_file);

      // Iterate through all pages
      for ($i = 1; $i <= $page_count; $i++) {
        // Add a page
        $template_id = $pdf->importPage($i);
        $size = $pdf->getTemplateSize($template_id);
        $orientation = $size['width'] > $size['height'] ? 'L' : 'P';
        $pdf->AddPage($orientation, array($size['width'], $size['height']));

        // Use the imported page as a template
        $pdf->useTemplate($template_id);

        // // Set image size and position
        // $image_width = (5 * 3.5); // Width in points (1 point = 1/72 inches)
        // $image_height = (3 * 3.5); // Height in points
        // $position_x = 140; // X position in points
        // $position_y = 92; // Y position in points

        if ($data->form_id == 6 && $data->sequence < 8) {

          $image_width = (5 * 7); // Width in points (1 point = 1/72 inches)
          $image_height = (3 * 7); // Height in points
          $position_x = $data->x_sign; // X position in points
          $position_y = $data->y_sign; // Y position in points

          $signer_name = strtoupper($data->fullname);
          $signer_position_x = $position_x + 32;
          $signer_position_y = $position_y + (2.7 + 5);
          $signer_color = [128, 128, 128]; // RGB color code for gray

          $date = date('Y-m-d H:i:s');
          $timestamp = strtotime($date);
          $new_date_format = strftime('%e %B %Y %H:%M:%S WIB', $timestamp);

          $signed_at = strtoupper($new_date_format);
          $signed_position_x = $position_x + 32;
          $signed_position_y = $position_y + (4 + 5);
          $signed_color = [128, 128, 128]; // RGB color code for gray


        }


        // Add the image
        $pdf->Image($image_file, $position_x, $position_y, $image_width, $image_height);
        // Set font
        $pdf->SetFont('helvetica', 'B', 3);

        // Add signer name text
        $pdf->SetTextColor($signer_color[0], $signer_color[1], $signer_color[2]);
        $pdf->SetXY($signer_position_x, $signer_position_y);
        $pdf->MultiCell(0, 0, 'Digitally Signed by: ' . $signer_name, 0, 'L', 0, 1);

        $pdf->SetFont('helvetica', '', 3);
        // Add signed at text
        $pdf->SetTextColor($signed_color[0], $signed_color[1], $signed_color[2]);
        $pdf->SetXY($signed_position_x, $signed_position_y);
        $pdf->MultiCell(0, 0, 'Signed At: ' . $signed_at, 0, 'L', 0, 1);
      }

      // Save the PDF to a file
      $pdf->Output($output_file, 'F');

      // If everything is successful, return 'success'
      return 'success';
    } catch (Exception $e) {
      // If an error occurs
      return 'error';
    }
  }


  public function whatsapp_verified()
  {
    $token = $this->uri->segment(3);

    // Load model

    // Jika token kosong, langsung load view invalid
    if (empty($token)) {
      $this->load->view('public/whatsapp_verified_invalid');
      return;
    }

    // Ambil data dari model
    $user_data = $this->Public_model->get_data_by_token($token);

    // Cek apakah data ditemukan dan validasi token_wa_created
    if ($user_data && $this->_is_token_valid($user_data->request_at)) {
      // Kirim data ke view
      $data['user'] = $user_data;
      $this->load->view('public/whatsapp_verified', $data);
    } else {
      // Tampilkan pesan error atau redirect ke halaman lain
      $this->load->view('public/whatsapp_verified_invalid');
    }
  }


  private function _is_token_valid($token_wa_created)
  {
    $datetime_created = new DateTime($token_wa_created);
    $datetime_now = new DateTime();

    // Hitung selisih waktu dalam menit
    $interval = $datetime_created->diff($datetime_now);
    $minutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;
    // Hitung selisih waktu dalam jam
    $hours = $interval->days * 24 + $interval->h;

    // Jika selisih waktu kurang dari atau sama dengan 48 jam, token valid
    return $hours <= 48;

    // Jika selisih waktu kurang dari atau sama dengan 15 menit, token valid
    // return $minutes <= 15;
  }

  private function _is_token_signature_valid($token_signature_created)
  {
    $datetime_created = new DateTime($token_signature_created);
    $datetime_now = new DateTime();

    // Hitung selisih waktu dalam menit
    $interval = $datetime_created->diff($datetime_now);
    $minutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;

    // Jika selisih waktu kurang dari atau sama dengan 15 menit, token valid
    return $minutes <= 15;
  }

  public function verify_wa()
  {
    $user_id = $this->input->post('id');

    // Load model
    $this->load->model('Public_model');

    // Verifikasi pengguna
    $is_verified = $this->Public_model->verify_user($user_id);

    // Set respons berdasarkan hasil verifikasi
    $response = $is_verified
      ? array("success" => true)
      : array("success" => false);

    // Kirim respons
    echo json_encode($response);
  }

  public function signature_verified()
  {
    $token = $this->uri->segment(3);
    if (empty($token)) {
      $this->load->view('public/whatsapp_verified_invalid');
      return;
    }

    // Load model

    // Ambil data dari model
    $user_data = $this->Public_model->get_data_signature_by_token($token);

    // Cek apakah data ditemukan dan validasi token_wa_created
    if ($user_data && $this->_is_token_signature_valid($user_data->token_signature_created)) {
      // Kirim data ke view
      $data['user'] = $user_data;
      $this->load->view('public/signature', $data);
    } else {
      // Tampilkan pesan error atau redirect ke halaman lain
      $this->load->view('public/whatsapp_verified_invalid');
    }
  }

  public function save_signature()
  {

    $id = $this->input->post('id');
    $data_uri = $this->input->post('signature', false);
    $encoded_image = substr($data_uri, strpos($data_uri, ",") + 1);
    $decoded_image = base64_decode($encoded_image);

    $file_name = 'signature_' . time() . '_' . $id . '.png';
    $file_path = 'assets/signatures/' . $file_name;

    file_put_contents($file_path, $decoded_image);

    // Save the signature filename to the database
    $this->Public_model->save_user_signature($id, $file_name);

    $response = ['status' => 'success', 'file_name' => $file_name];
    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
