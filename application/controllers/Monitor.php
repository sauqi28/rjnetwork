<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitor extends CI_Controller
{
	private $title, $subtitle;


	public function __construct()
	{
		parent::__construct();

		$this->load->model('data/Data_monitor_model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('Wa_api');
		$this->title = "Monitor Status Pengguna";
		$this->subtitle = "Halaman Untuk Monitoring Status Pengguna";


		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	}

	// public function index()
	// {
	// 	$data['users'] = $this->Data_monitor_model->get_users();
	// 	$this->load->view('data/monitor/index', $data);
	// }

	public function users()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('monitor/index');
		$config['total_rows'] = $this->Data_monitor_model->get_users_count($search);
		$config['per_page'] = 300;
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



		$data['users'] = $this->Data_monitor_model->get_users($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "monitor/users";

		$this->load->view('data/monitor/index', $data);
	}

	public function non_aktif()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('data/monitor/index');
		$config['total_rows'] = $this->Data_monitor_model->get_users_count_nonaktif($search);
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



		$data['users'] = $this->Data_monitor_model->get_users_nonaktif($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "monitor/nonaktif";

		$this->load->view('data/monitor/user_nonaktif', $data);
	}




	public function view($id = NULL)
	{
		$data['user'] = $this->Data_monitor_model->get_users_view($id);
		// var_dump($data);

		if (empty($data['user'])) {
			show_404();
		}

		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_user_add";
		$data['user_positions'] = $this->Data_monitor_model->get_all_positions();
		$data['user_roles'] = $this->Data_monitor_model->get_all_roles();
		$data['user_category'] = $this->Data_monitor_model->get_all_category();
		$this->load->view('data/monitor/view', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('nip', 'nip', 'required|is_unique[mst_users.nip]');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[mst_users.username]');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mst_users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('no_wa', 'no_wa', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['title'] = $this->title;
			$data['subtitle'] = $this->subtitle;
			$data['navbar'] = "data_user_add";
			$data['user_positions'] = $this->Data_monitor_model->get_all_positions();
			$data['user_roles'] = $this->Data_monitor_model->get_all_roles();
			$data['user_category'] = $this->Data_monitor_model->get_all_category();
			$this->load->view('data/monitor/create', $data);
		} else {
			$this->Data_monitor_model->create_user();
			$this->session->set_flashdata('message', 'User berhasil ditambahkan');
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('data_monitor/index'));
		}
	}

	public function get_vendor_options()
	{
		// ambil data pilihan vendor dari database berdasarkan kategori user yang dipilih
		$kategori = $this->input->post('kategori');
		if ($kategori == 2) { // external
			$vendor_options = $this->Data_monitor_model->get_vendor_options();
		} else {
			$vendor_options = array();
		}

		// kirim data sebagai response JSON
		echo json_encode($vendor_options);
	}


	public function edit($id)
	{
		$data['user'] = $this->Data_monitor_model->get_users_view($id);

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
			$data['navbar'] = "data_user_add";
			$data['user_positions'] = $this->Data_monitor_model->get_all_positions();
			$data['user_roles'] = $this->Data_monitor_model->get_all_roles();
			$data['user_category'] = $this->Data_monitor_model->get_all_category();
			$this->load->view('data/monitor/edit', $data);
		} else {
			$this->Data_monitor_model->update_user($id);
			$this->session->set_flashdata('message', 'User berhasil di update');
			$this->session->set_flashdata('status', 'success');
			//$res = $this->wa_api->send_message($this->input->post('no_wa'), "user anda sudah diupdate");

			redirect(base_url('data_monitor/index'));
		}
	}

	public function verify_user()
	{

		$no_wa = $this->input->post('no_wa');
		$id = $this->input->post('id');
		$data = $this->Data_monitor_model->get_user($id);
		$token = $this->generate_token(10);

		// $pesan = "Verifikasi Wahtsapp, klik link berikut :\n" . base_url('publicaccess/whatsapp_verified/') . $token;
		$pesan = "*Yth. Bpk/Ibu " . $data->fullname . "* \n\n" . "Mohon untuk melakukan verifikasi nomor WhatsApp sebagai notifikasi penggunaan aplikasi tanda tangan digital, melalui link berikut: \n\n" . base_url('publicaccess/whatsapp_verified/') . $token . "\n\n_Link Expired dalam 15 Menit_";


		$res = $this->wa_api->send_message($data->no_wa, $pesan);
		if ($res == 'success') {
			$this->Data_monitor_model->insert_wa_token($id, $token);
			echo $res;
		} else {
			echo $res;
		}
	}

	public function verify_signature()
	{
		$no_wa = $this->input->post('no_wa');
		$id = $this->input->post('id');
		$data = $this->Data_monitor_model->get_user($id);
		$token = $this->generate_token(10);

		// $pesan = "Verifikasi Wahtsapp, klik link berikut :\n" . base_url('publicaccess/whatsapp_verified/') . $token;
		$pesan = "*Yth. Bpk/Ibu " . $data->fullname . "* \n\n" . "Mohon untuk merekam spesimen tanda tangan secara digital, untuk selanjutnya digunakan sebagai pembubuhan dokumen pada link berikut: \n\n" . base_url('publicaccess/signature_verified/') . $token . "\n\n_Link Expired dalam 15 Menit_";

		$res = $this->wa_api->send_message($data->no_wa, $pesan);
		if ($res == 'success') {
			$this->Data_monitor_model->insert_signature_token($id, $token);
			echo $res;
		} else {
			echo $res;
		}
	}

	function generate_token($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters_length = strlen($characters);
		$token = '';

		for ($i = 0; $i < $length; $i++) {
			$token .= $characters[rand(0, $characters_length - 1)];
		}

		return $token;
	}






	public function update_status()
	{
		$status = $this->uri->segment(3);
		$id = $this->uri->segment(4);

		if ($status == 1) {
			$this->Data_monitor_model->update_status($id, 'inactive');
			$message = 'Berhasil dinonaktifkan';

			$this->session->set_flashdata('message', $message);
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('data_monitor/index'), 'refresh');
		} elseif ($status == 2) {
			$this->Data_monitor_model->update_status($id, 'active');
			$message = 'Berhasil diaktifkan';

			$this->session->set_flashdata('message', $message);
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('data_monitor/non_aktif'), 'refresh');
		} else {
			show_404();
		}
	}
}
