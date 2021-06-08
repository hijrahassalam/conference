<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			//if (!$this->session->userdata('logged_in')) {
			//  redirect(base_url('login'));
			//}
		}

	public function index()
	{
		$this->load->view('rekap/index');
	}

	public function peserta()
	{
		$this->load->view('rekap/peserta');
	}
}