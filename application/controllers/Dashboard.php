<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// $this->load->library('session');
		// var_dump($this->session->userdata('logged_in'));
		// exit();
		if (!$this->session->userdata('logged_in')) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		//var_dump($this->session->userdata('logged_in'));
		redirect('monitor/users');
		//	$this->load->view('dashboard');
	}
}
