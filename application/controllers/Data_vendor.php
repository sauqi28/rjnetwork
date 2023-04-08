<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once APPPATH . 'third_party/phpoffice/vendor/autoload.php';

// require_once(APPPATH . 'third_party/vendor/autoload.php'); // Jika menggunakan PhpSpreadsheet
require_once(APPPATH . '../vendor/autoload.php'); // Jika menggunakan PhpSpreadsheet


class Data_vendor extends CI_Controller
{
	private $title, $subtitle;


	public function __construct()
	{

		parent::__construct();

		$this->load->model('data/Data_vendor_model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('Wa_api');
		$this->title = "Master Data Vendor";
		$this->subtitle = "halaman untuk mengatur informasi, mengubah, maupun menambahkan vendor";


		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('data_vendor/index');
		$config['total_rows'] = $this->Data_vendor_model->get_users_count($search);
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



		$data['users'] = $this->Data_vendor_model->get_users($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_vendor";

		$this->load->view('data/vendor/index', $data);
	}



	public function view($id = NULL)
	{
		$data['user'] = $this->Data_vendor_model->get_vendor_view($id);
		// var_dump($data);

		if (empty($data['user'])) {
			show_404();
		}

		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_user_add";
		$this->load->view('data/vendor/view', $data);
	}


	public function create()
	{
		$this->form_validation->set_rules('vendor_name', 'Vendor_name', 'required');
		$this->form_validation->set_rules('telp', 'Telp');
		$this->form_validation->set_rules('vendor_address', 'Vendor_Address');
		if ($this->form_validation->run() === FALSE) {
			$data['title'] = $this->title;
			$data['subtitle'] = $this->subtitle;
			$data['navbar'] = "data_vendor_add";
			$this->load->view('data/vendor/create', $data);
		} else {
			$this->Data_vendor_model->create_vendor();
			$this->session->set_flashdata('message', 'Vendor berhasil ditambahkan');
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('data_vendor/index'));
		}
	}


	public function import_vendor()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('data_vendor/import_vendor');
		$config['total_rows'] = $this->Data_vendor_model->get_users_count_temp($search);
		$config['per_page'] = 20;
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

		$data['is_mst_vendors_temp_empty'] = $this->Data_vendor_model->is_mst_vendors_temp_empty();
		$data['users'] = $this->Data_vendor_model->get_users_temp($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_vendor_import";
		$this->load->view('data/vendor/import', $data);
	}



	public function commit_data()
	{

		$this->Data_vendor_model->copy_table();

		// Redirect ke halaman sebelumnya dengan pesan sukses
		$this->session->set_flashdata('message', 'Vendor berhasil ditambahkan');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url('data_vendor/index'));
	}


	public function reset_Data()
	{

		$this->Data_vendor_model->reset_tabel_temp();

		// Redirect ke halaman sebelumnya dengan pesan sukses
		$this->session->set_flashdata('message', 'Berhasil di Reset');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url('data_vendor/import_vendor'));
	}



	public function edit($id)
	{
		$data['user'] = $this->Data_vendor_model->get_vendor_view($id);

		if (empty($data['user'])) {
			show_404();
		}

		$this->form_validation->set_rules('vendor_name', 'Vendor_name', 'required');
		$this->form_validation->set_rules('telp', 'telp');
		$this->form_validation->set_rules('vendor_address', 'vendor_address');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = $this->title;
			$data['subtitle'] = $this->subtitle;
			$data['navbar'] = "data_user_add";
			$this->load->view('data/vendor/edit', $data);
		} else {
			$this->Data_vendor_model->update_vendor($id);
			$this->session->set_flashdata('message', 'Vendor berhasil di update');
			$this->session->set_flashdata('status', 'success');
			//$res = $this->wa_api->send_message($this->input->post('no_wa'), "user anda sudah diupdate");

			redirect(base_url('data_vendor/index'));
		}
	}

	public function import()
	{

		// Cek apakah request adalah POST
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->session->set_flashdata('message', 'Prohibited Access!!!');
			$this->session->set_flashdata('status', 'error');
			redirect(base_url() . 'data_vendor/index');
			return;
		}

		$file = $_FILES['file']['tmp_name'];
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file);
		$spreadsheet = $reader->load($file);
		$worksheet = $spreadsheet->getActiveSheet();
		$highestRow = $worksheet->getHighestDataRow();

		for ($row = 2; $row <= $highestRow; $row++) {
			$data[] = [
				'vendor_name' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
				'vendor_address' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
				'telp' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
				'status' => 0,
				'users_id' => $this->session->userdata('user_id'),
				'time' => date('Y-m-d H:i:s'),
				// Tambahkan kolom lain jika diperlukan
			];
		}
		$this->Data_vendor_model->insert($data);

		$this->session->set_flashdata('success', 'Data berhasil diimpor.');

		redirect(base_url() . 'data_vendor/import_vendor');
	}
}
