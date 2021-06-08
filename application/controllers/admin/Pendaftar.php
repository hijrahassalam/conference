<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftar extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			if (!$this->session->userdata('logged_in')) {
			 redirect(base_url('login'));
			}
		}

	public function index()
	{
		$this->load->view('admin/pendaftar/index');

	}

	public function del()
	{
		$id=$this->input->get('id');
		$idoff=$this->input->get('id_off');

		if ($id)
		{
			$info['status_aktif']="1";
			$q=$this->db->where('no',$id)->update('registrasi',$info);
			if ($q)
			{
				redirect(base_url('admin/pendaftar'));
			}
		}
		
		if ($idoff)
		{
			$info['status_aktif']="0";
			$q=$this->db->where('no',$idoff)->update('registrasi',$info);
			if ($q)
			{
				redirect(base_url('admin/pendaftar'));
			}
		}
	}
}