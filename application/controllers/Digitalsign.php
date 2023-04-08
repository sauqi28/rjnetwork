<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digitalsign extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Digital_sign_model');
    $this->load->helper('url');
  }


  public function publicmp()
  {
    $token = $this->uri->segment(3);

    // Load model

    // Jika token kosong, langsung load view invalid
    if (empty($token)) {
      $this->load->view('public/whatsapp_verified_invalid');
      return;
    }

    // Ambil data dari model
    $user_data = $this->Digital_sign_model->get_data_by_token($token);

    // Cek apakah data ditemukan dan validasi token_wa_created
    if ($user_data && $this->_is_token_valid($user_data->request_at)) {
      // Kirim data ke view

      $this->load->view('digitalsign/publicmp', $user_data);
    } else {
      // Tampilkan pesan error atau redirect ke halaman lain
      $this->load->view('public/whatsapp_verified_invalid');
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
