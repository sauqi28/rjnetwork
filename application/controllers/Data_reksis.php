<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once APPPATH . 'third_party/phpoffice/vendor/autoload.php';

// require_once(APPPATH . 'third_party/vendor/autoload.php'); // Jika menggunakan PhpSpreadsheet
require_once(APPPATH . '../vendor/autoload.php'); // Jika menggunakan PhpSpreadsheet


class Data_reksis extends CI_Controller
{
	private $title, $subtitle;


	public function __construct()
	{

		parent::__construct();

		$this->load->model('data/data_reksis_model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('Wa_api');
		$this->title = "Master Data Rekomendasi Sistem";
		$this->subtitle = "halaman untuk mengatur informasi, mengubah, maupun menambahkan reksis / Rekomendasi Sistem";


		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('data_reksis/index');
		$config['total_rows'] = $this->data_reksis_model->get_reksiss_count($search);
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



		$data['reksis'] = $this->data_reksis_model->get_reksiss($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_reksis";

		$this->load->view('data/reksis/index', $data);
	}


	public function material_category()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('data_reksis/material_category');
		$config['total_rows'] = $this->data_reksis_model->get_reksiss_count($search);
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



		$data['users'] = $this->data_reksis_model->get_category($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_category";

		$this->load->view('data/reksis/category', $data);
	}



	public function view($id = NULL)
	{
		$data['user'] = $this->data_reksis_model->get_reksis_view($id);
		// var_dump($data);

		// if (empty($data['user'])) {
		// 	show_404();
		// }

		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_user_add";
		$this->load->view('data/reksis/view', $data);
	}


	public function create()
	{
		$this->form_validation->set_rules('material_name', 'material_name', 'required');
		$this->form_validation->set_rules('telp', 'Telp');
		$this->form_validation->set_rules('material_address', 'material_address');
		$this->form_validation->set_rules('material_category', 'material_category');
		if ($this->form_validation->run() === FALSE) {
			$data['title'] = $this->title;
			$data['subtitle'] = $this->subtitle;
			$data['navbar'] = "data_reksis_add";
			$this->load->view('data/reksis/create', $data);
		} else {
			$this->data_reksis_model->create_material();
			$this->session->set_flashdata('message', 'Material berhasil ditambahkan');
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('data_reksis/index'));
		}
	}

	public function import_material()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$search = $this->input->get('search');

		$config['base_url'] = site_url('data_reksis/import_material');
		$config['total_rows'] = $this->data_reksis_model->get_reksiss_count_temp($search);
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

		$data['is_mst_material_temp_empty'] = $this->data_reksis_model->is_mst_reksiss_temp_empty();
		$data['reksiss'] = $this->data_reksis_model->get_reksiss_temp($config['per_page'], $page, $search);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = $this->title;
		$data['subtitle'] = $this->subtitle;
		$data['navbar'] = "data_reksis_import";
		$this->load->view('data/reksis/import', $data);
	}



	public function commit_data()
	{

		$this->data_reksis_model->copy_table();

		// Redirect ke halaman sebelumnya dengan pesan sukses
		$this->session->set_flashdata('message', 'Reksis berhasil ditambahkan');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url('data_reksis/index'));
	}


	public function reset_Data()
	{

		$this->data_reksis_model->reset_tabel_temp();

		// Redirect ke halaman sebelumnya dengan pesan sukses
		$this->session->set_flashdata('message', 'Berhasil di Reset');
		$this->session->set_flashdata('status', 'success');
		redirect(base_url('data_reksis/import_material'));
	}



	public function edit($id)
	{
		$data['user'] = $this->data_reksis_model->get_material_view($id);

		if (empty($data['user'])) {
			show_404();
		}
		$this->form_validation->set_rules('material_number', 'material_number');
		$this->form_validation->set_rules('material_description', 'material_description', 'required');
		$this->form_validation->set_rules('company_code', 'company_code');
		$this->form_validation->set_rules('plant', 'plant');
		$this->form_validation->set_rules('storage_location', 'storage_location');
		$this->form_validation->set_rules('material_type', 'material_type');
		$this->form_validation->set_rules('material_group', 'material_group');
		$this->form_validation->set_rules('base_unit_of_measure', 'base_unit_of_measure');
		$this->form_validation->set_rules('valuation_type', 'valuation_type');
		$this->form_validation->set_rules('valuation_class', 'valuation_class');
		$this->form_validation->set_rules('unrestricted_use_stock', 'unrestricted_use_stock');
		$this->form_validation->set_rules('quality_inspection_stock', 'quality_inspection_stock');
		$this->form_validation->set_rules('blocked_stock', 'blocked_stock');
		$this->form_validation->set_rules('in_transit_stock', 'in_transit_stock');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = $this->title;
			$data['subtitle'] = $this->subtitle;
			$data['navbar'] = "data_categori";
			$this->load->view('data/reksis/edit', $data);
		} else {
			$this->data_reksis_model->update_material($id);
			$this->session->set_flashdata('message', 'material berhasil di update');
			$this->session->set_flashdata('status', 'success');
			redirect(base_url('data_reksis/index'));
		}
	}

	public function import()
	{

		// Cek apakah request adalah POST
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->session->set_flashdata('message', 'Prohibited Access!!!');
			$this->session->set_flashdata('status', 'error');
			redirect(base_url() . 'data_reksis/index');
			return;
		}

		$file = $_FILES['file']['tmp_name'];
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file);
		$spreadsheet = $reader->load($file);
		$worksheet = $spreadsheet->getActiveSheet();
		$highestRow = $worksheet->getHighestDataRow();

		for ($row = 2; $row <= $highestRow; $row++) {
			$data[] = [
				'material_number' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
				'material_description' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
				'company_code' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
				'plant' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
				'storage_location' => $worksheet->getCellByColumnAndRow(5, $row)->getValue(),
				'material_type' => $worksheet->getCellByColumnAndRow(6, $row)->getValue(),
				'material_group' => $worksheet->getCellByColumnAndRow(7, $row)->getValue(),
				'base_unit_of_measure' => $worksheet->getCellByColumnAndRow(8, $row)->getValue(),
				'valuation_type' => $worksheet->getCellByColumnAndRow(9, $row)->getValue(),
				'valuation_class' => $worksheet->getCellByColumnAndRow(10, $row)->getValue(),
				'unrestricted_use_stock' => $worksheet->getCellByColumnAndRow(11, $row)->getValue(),
				'quality_inspection_stock' => $worksheet->getCellByColumnAndRow(12, $row)->getValue(),
				'blocked_stock' => $worksheet->getCellByColumnAndRow(13, $row)->getValue(),
				'in_transit_stock' => $worksheet->getCellByColumnAndRow(14, $row)->getValue(),
				'status' => 0,
				'users_id' => $this->session->userdata('user_id'),
				'time' => date('Y-m-d H:i:s'),
				// Tambahkan kolom lain jika diperlukan
			];
		}
		$this->data_reksis_model->insert($data);

		$this->session->set_flashdata('success', 'Data berhasil diimpor.');

		redirect(base_url() . 'data_reksis/import_material');
	}
}
