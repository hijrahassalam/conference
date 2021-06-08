<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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
		$kelas_id = $this->input->get('kelas');
		$data['kelas_id']=$kelas_id;
		
		if($kelas_id)
		{
			$cek = $this->db->query("SELECT kelas_id FROM ppcks_kelas_akademik WHERE kelas_id='$kelas_id'")->row_array();
			$cek_ada = $cek['kelas_id'];
			
			if($cek_ada != NULL)
			{
				$this->load->view('kalender/index',$data);
			} else
			{
				redirect(base_url("dashboard"));
			}
			
			
		} else
		{
			$this->load->view('backend/index');
		}
		
		
		
	}
}