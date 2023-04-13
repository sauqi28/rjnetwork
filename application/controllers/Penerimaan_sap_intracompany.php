<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penerimaan_sap_intracompany extends CI_Controller
{
	private $title, $subtitle;

	//ok
	public function __construct()
	{
		parent::__construct();

		$this->load->model('penerimaan/penerimaan_sap_intracompany_model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('Wa_api');
		$this->title = "Penerimaan SAP Intracompany";
		$this->subtitle = "halaman untuk informasi Penerimaan SAP TUG 4, TUG 3 Karantina & TUG 3 Persediaan";


		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	}

	// public function index()
	// {
	// 	$data['users'] = $this->penerimaan_sap_intracompany_model->get_penerimaan_sap_intracompany();
	// 	$this->load->view('data/user/index', $data);
	// }

	public function index()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('penerimaan_sap_intracompany/index');
		$config['total_rows'] = $this->penerimaan_sap_intracompany_model->get_penerimaan_sap_intracompany_count($search);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['reuse_query_string'] = TRUE;


		$config['full_tag_open'] = '<nav aria-label="..."><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = ' <span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);



		$data['users'] = $this->penerimaan_sap_intracompany_model->get_penerimaan_sap_intracompany($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "penerimaan_sap_intracompany";

		$this->load->view('data/penerimaan_sap_intracompany/index', $data);
	}

	public function non_aktif()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('penerimaan_sap_intracompany/index');
		$config['total_rows'] = $this->penerimaan_sap_intracompany_model->get_penerimaan_sap_intracompany_count_nonaktif($search);
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['reuse_query_string'] = TRUE;


		$config['full_tag_open'] = '<nav aria-label="..."><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = ' <span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);



		$data['users'] = $this->penerimaan_sap_intracompany_model->get_penerimaan_sap_intracompany_nonaktif($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "penerimaan_sap_intracompany_nonaktif";

		$this->load->view('data/user/user_nonaktif', $data);
	}

	public function view($id = NULL)
	{
		$data['user'] = $this->penerimaan_sap_intracompany_model->get_penerimaan_sap_intracompany_view($id);

		$data['get_sign_data_tug4'] = $this->penerimaan_sap_intracompany_model->get_sign_data($id, 10);
		$data['get_sign_data_tug3k'] = $this->penerimaan_sap_intracompany_model->get_sign_data($id, 11);
		$data['get_sign_data_tug3'] = $this->penerimaan_sap_intracompany_model->get_sign_data($id, 12);
		//data approval berdasarkan form signature dengan id 1
		$data['tug4'] = $this->penerimaan_sap_intracompany_model->get_form_approval(10);
		$data['tug3k'] = $this->penerimaan_sap_intracompany_model->get_form_approval(11);
		$data['tug3'] = $this->penerimaan_sap_intracompany_model->get_form_approval(12);
		// var_dump($data);

		if (empty($data['user'])) {
			show_404();
		}

		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "";
		$data['user_positions'] = $this->penerimaan_sap_intracompany_model->get_all_positions();
		$data['user_roles'] = $this->penerimaan_sap_intracompany_model->get_all_roles();
		$data['user_category'] = $this->penerimaan_sap_intracompany_model->get_all_category();
		$data['percentage'] = $this->penerimaan_sap_intracompany_model->get_percentage($id);
		$this->load->view('data/penerimaan_sap_intracompany/view', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('spk_number', 'spk_number', 'trim|required|is_unique[data_penerimaan_sap_intracompany.spk_number]');
		$this->form_validation->set_rules('pabrikan', 'pabrikan', 'trim|required');
		$this->form_validation->set_rules('material', 'material', 'trim|required');
		$this->form_validation->set_rules('tgl_penerimaan', 'tgl_penerimaan', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = $this->title;
			$data['subtitle'] = $this->subtitle;
			$data['navbar'] = "penerimaan_sap_intracompany_add";
			// $this->session->set_flashdata('message', 'Oooops!!! Something Wrong');
			// $this->session->set_flashdata('status', 'error');
			$this->load->view('data/penerimaan_sap_intracompany/create', $data);
		} else {
			$this->penerimaan_sap_intracompany_model->create_penerimaan();
			$this->session->set_flashdata('message', 'Penerimaan SAP berhasil ditambahkan');
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('penerimaan_sap_intracompany/index'));
		}
	}
	//ok

	public function merge_document()
	{
		$key = $this->uri->segment(3);
		$this->load->library('Pdf_merger');
		$data_penerimaan = $this->penerimaan_sap_intracompany_model->merge_document($key);

		if ($data_penerimaan) {
			$folder_name = $data_penerimaan->folder_name;
			$files_to_merge = [
				$folder_name . '/' . $data_penerimaan->tug4_unsigned_file,
				$folder_name . '/' . $data_penerimaan->tug3_karantina_unsigned_file,
				$folder_name . '/' . $data_penerimaan->tug3_unsigned_file
			];

			$output_filename = 'penerimaan_sap_intracompany_' . $data_penerimaan->spk_number . '.pdf';
			$this->pdf_merger->merge_pdfs($files_to_merge, $output_filename);
		} else {
			show_404();
		}
	}



	public function view_pdf($filename)
	{
		$pdf_file_tug4 = $this->penerimaan_sap_intracompany_model->get_pdf_file($filename, 'tug4');
		$pdf_file_tug3k = $this->penerimaan_sap_intracompany_model->get_pdf_file($filename, 'tug3k');
		$pdf_file_tug3 = $this->penerimaan_sap_intracompany_model->get_pdf_file($filename, 'tug3');

		if ($pdf_file_tug4 or $pdf_file_tug3k or $pdf_file_tug3) {


			if (file_exists($pdf_file_tug4) or file_exists($pdf_file_tug3k) or file_exists($pdf_file_tug3)) {
				$data['pdf_file_tug4'] = base_url($pdf_file_tug4);
				$data['pdf_file_tug3k'] = base_url($pdf_file_tug3k);
				$data['pdf_file_tug3'] = base_url($pdf_file_tug3);
				$data['title'] = $this->title;
				$data['subtitle'] = $this->subtitle;
				$data['navbar'] = "";
				$this->load->view('data/penerimaan_sap_intracompany/view_pdf', $data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function upload_tug4()
	{
		// Konfigurasi upload file
		$config['upload_path'] = './uploads/sapintracompany/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 5048; // 5 MB
		$id = $this->input->post('key');

		// Load library upload dan inisialisasi konfigurasi
		$this->load->library('upload', $config);

		// Cek apakah upload file berhasil
		if ($this->upload->do_upload('file')) {
			// Jika berhasil, ambil data file yang di-upload
			$file_data = $this->upload->data();

			// Rename file sesuai dengan timestamp saat ini
			$timestamp = time();
			// $new_name = $timestamp . '_' . $file_data['file_name'];
			$new_name = $file_data['file_name'];

			// Ambil nilai spk_number dari form
			$spk_number = $this->input->post('spk_number');

			// Validasi karakter yang tidak valid pada spk_number
			$invalid_chars = array(
				'|', '*', ':', '"', '<', '>', '?', '\\', '/'
			);
			$spk_number = str_replace($invalid_chars, '', $spk_number);

			// Buat direktori jika belum ada
			$folder_path = './uploads/sapintracompany/' . str_replace('/', '-', $spk_number);
			if (!is_dir($folder_path)) {
				mkdir($folder_path, 0777, true);
			}

			// Pindahkan file ke folder baru
			$old_path = $file_data['full_path'];
			$new_path = $folder_path . '/' . $new_name;
			rename($old_path, $new_path);

			// Simpan nama file ke database
			$this->penerimaan_sap_intracompany_model->save_file_tug4($id, $new_name, $folder_path);

			// Set pesan sukses sebagai flashdata
			$this->session->set_flashdata('message', 'TUG 4 SAP berhasil diupload');
			$this->session->set_flashdata('status', 'success');
			// Redirect ke halaman view
			redirect('penerimaan_sap_intracompany/view/' . $id);
		} else {
			// Jika gagal, tampilkan pesan error
			$this->session->set_flashdata('message', $this->upload->display_errors());


			$this->session->set_flashdata('status', 'error');

			// Redirect ke halaman view
			redirect('penerimaan_sap_intracompany/view/' . $id);
		}
	}

	public function upload_tug3k()
	{
		// Konfigurasi upload file
		$config['upload_path'] = './uploads/sapintracompany/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 5048; // 5 MB
		$id = $this->input->post('key');

		// Load library upload dan inisialisasi konfigurasi
		$this->load->library('upload', $config);

		// Cek apakah upload file berhasil
		if ($this->upload->do_upload('file')) {
			// Jika berhasil, ambil data file yang di-upload
			$file_data = $this->upload->data();

			// Rename file sesuai dengan timestamp saat ini
			$timestamp = time();
			// $new_name = $timestamp . '_' . $file_data['file_name'];
			$new_name = $file_data['file_name'];

			// Ambil nilai spk_number dari form
			$spk_number = $this->input->post('spk_number');

			// Validasi karakter yang tidak valid pada spk_number
			$invalid_chars = array(
				'|', '*', ':', '"', '<', '>', '?', '\\', '/'
			);
			$spk_number = str_replace($invalid_chars, '', $spk_number);

			// Buat direktori jika belum ada
			$folder_path = './uploads/sapintracompany/' . str_replace('/', '-', $spk_number);
			if (!is_dir($folder_path)) {
				mkdir($folder_path, 0777, true);
			}

			// Pindahkan file ke folder baru
			$old_path = $file_data['full_path'];
			$new_path = $folder_path . '/' . $new_name;
			rename($old_path, $new_path);

			// Simpan nama file ke database
			$this->penerimaan_sap_intracompany_model->save_file_tug3k($id, $new_name, $folder_path);

			// Set pesan sukses sebagai flashdata
			$this->session->set_flashdata('message', 'TUG 3 Karantina SAP berhasil diupload');
			$this->session->set_flashdata('status', 'success');
			// Redirect ke halaman view
			redirect('penerimaan_sap_intracompany/view/' . $id);
		} else {
			// Jika gagal, tampilkan pesan error
			$this->session->set_flashdata('message', $this->upload->display_errors());


			$this->session->set_flashdata('status', 'error');

			// Redirect ke halaman view
			redirect('penerimaan_sap_intracompany/view/' . $id);
		}
	}

	public function upload_tug3()
	{
		// Konfigurasi upload file
		$config['upload_path'] = './uploads/sapintracompany/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 5048; // 5 MB
		$id = $this->input->post('key');

		// Load library upload dan inisialisasi konfigurasi
		$this->load->library('upload', $config);

		// Cek apakah upload file berhasil
		if ($this->upload->do_upload('file')) {
			// Jika berhasil, ambil data file yang di-upload
			$file_data = $this->upload->data();

			// Rename file sesuai dengan timestamp saat ini
			$timestamp = time();
			// $new_name = $timestamp . '_' . $file_data['file_name'];
			$new_name = $file_data['file_name'];

			// Ambil nilai spk_number dari form
			$spk_number = $this->input->post('spk_number');

			// Validasi karakter yang tidak valid pada spk_number
			$invalid_chars = array(
				'|', '*', ':', '"', '<', '>', '?', '\\', '/'
			);
			$spk_number = str_replace($invalid_chars, '', $spk_number);

			// Buat direktori jika belum ada
			$folder_path = './uploads/sapintracompany/' . str_replace('/', '-', $spk_number);
			if (!is_dir($folder_path)) {
				mkdir($folder_path, 0777, true);
			}

			// Pindahkan file ke folder baru
			$old_path = $file_data['full_path'];
			$new_path = $folder_path . '/' . $new_name;
			rename($old_path, $new_path);

			// Simpan nama file ke database
			$this->penerimaan_sap_intracompany_model->save_file_tug3($id, $new_name, $folder_path);

			// Set pesan sukses sebagai flashdata
			$this->session->set_flashdata('message', 'TUG 3 Persediaan SAP berhasil diupload');
			$this->session->set_flashdata('status', 'success');
			// Redirect ke halaman view
			redirect('penerimaan_sap_intracompany/view/' . $id);
		} else {
			// Jika gagal, tampilkan pesan error
			$this->session->set_flashdata('message', $this->upload->display_errors());


			$this->session->set_flashdata('status', 'error');

			// Redirect ke halaman view
			redirect('penerimaan_sap_intracompany/view/' . $id);
		}
	}


	public function send_message()
	{
		$token = $this->input->post('token');
		$data = $this->penerimaan_sap_intracompany_model->get_data_queue_sign($token);
		if ($data) {
			$pesan = "*Yth. Bpk/Ibu " . $data->fullname . "* \n" . "Mohon untuk menandatangani dokumen: \n*" . $data->title . "*\n_" . $data->desc . "_\nPada link berikut ini:   \n\n" . base_url($data->uri . $data->token) . "\n\nLink Expired dalam 2x24 Jam";


			$res = $this->wa_api->send_message($data->no_wa, $pesan);

			if ($res == 'success') {
				$this->penerimaan_sap_intracompany_model->update_data_queue_sign($token);
				echo $res;
			} else {
				echo $res;
			}
			// tambahkan baris kode di atas sesuai dengan kolom-kolom yang ingin ditampilkan
		} else {
			echo "Data tidak ditemukan.";
		}
	}

	public function send_message_bulk($token)
	{
		$data = $this->penerimaan_sap_intracompany_model->get_data_queue_sign($token);
		if ($data) {
			// $pesan = "Yth. Bpk/Ibu " . $data->fullname . "\n" . "Mohon untuk menandatangani dokumen *" . $data->title . "* _" . $data->desc . "_ Pada link berikut ini:   " . $data->uri . $data->token;
			$pesan = "Hello,\nThis is a multi-line message.\nThank you.";

			$this->penerimaan_sap_intracompany_model->update_data_queue_sign($token);
			$res = $this->wa_api->send_message($data->no_wa, $pesan);
			$this->session->set_flashdata('message', 'Berhasil dikirim');
			$this->session->set_flashdata('status', 'success');
			// Redirect ke halaman view
			redirect('penerimaan_sap_intracompany/view/' . $token);

			// tambahkan baris kode di atas sesuai dengan kolom-kolom yang ingin ditampilkan
		} else {
			echo "Data tidak ditemukan.";
		}
	}


	public function edit($id)
	{
		$data['user'] = $this->penerimaan_sap_intracompany_model->get_penerimaan_sap_intracompany_view($id);

		if (empty($data['user'])) {
			show_404();
		}

		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('username', 'Username');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		$this->form_validation->set_rules('email', 'Email');
		$this->form_validation->set_rules('password', 'Password');
		$this->form_validation->set_rules('no_wa', 'No. WhatsApp', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = $this->title;
			$data['subtitle'] = $this->subtitle;
			$data['navbar'] = "penerimaan_sap_intracompany_add";
			$data['user_positions'] = $this->penerimaan_sap_intracompany_model->get_all_positions();
			$data['user_roles'] = $this->penerimaan_sap_intracompany_model->get_all_roles();
			$data['user_category'] = $this->penerimaan_sap_intracompany_model->get_all_category();
			$this->load->view('data/user/edit', $data);
		} else {
			$this->penerimaan_sap_intracompany_model->update_user($id);
			$this->session->set_flashdata('message', 'User berhasil di update');
			$this->session->set_flashdata('status', 'success');
			//$res = $this->wa_api->send_message($this->input->post('no_wa'), "user anda sudah diupdate");

			redirect(base_url('penerimaan_sap_intracompany/index'));
		}
	}

	public function verify()
	{
		$key = $this->uri->segment(3);
		$token = $this->generate_token(32);
		$this->penerimaan_sap_intracompany_model->verify_document($key, $token);
		$this->session->set_flashdata('message', 'Dokumen berhasil di verifikasi');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url('penerimaan_sap_intracompany/view/' . $key));
	}


	public function generate_token($length)
	{
		$this->load->library('encryption');
		$token = bin2hex($this->encryption->create_key($length));
		return $token;
	}


	public function sign_document()
	{
		$key = $this->uri->segment(3);
		$token = $this->generate_token(20);
		$this->penerimaan_sap_intracompany_model->sign_update($key);
		//process signature id 1 adalah id form nya statis
		$this->penerimaan_sap_intracompany_model->process_sign($key, $this->generate_token(20), 10, "TUG 4 (Berita Acara) Penerimaan SAP");
		$this->penerimaan_sap_intracompany_model->process_sign($key, $this->generate_token(20), 11, "TUG 3 (Karantina) Penerimaan SAP");
		$this->penerimaan_sap_intracompany_model->process_sign($key, $this->generate_token(20), 12, "TUG 3 (Persediaan) Penerimaan SAP");

		$this->session->set_flashdata('message', 'Berhasil mengajukan tandatangan');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url('penerimaan_sap_intracompany/view/' . $key));
	}

	public function update_status()
	{
		$status = $this->uri->segment(3);
		$id = $this->uri->segment(4);

		if ($status == 1) {
			$this->penerimaan_sap_intracompany_model->update_status($id, 'inactive');
			$message = 'Berhasil dinonaktifkan';

			$this->session->set_flashdata('message', $message);
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('penerimaan_sap_intracompany/index'), 'refresh');
		} elseif ($status == 2) {
			$this->penerimaan_sap_intracompany_model->update_status($id, 'active');
			$message = 'Berhasil diaktifkan';

			$this->session->set_flashdata('message', $message);
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('penerimaan_sap_intracompany/non_aktif'), 'refresh');
		} else {
			show_404();
		}
	}
}
