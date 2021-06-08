<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller {
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
		error_reporting(E_ALL);
		$kirim = $this->input->post('send',TRUE);
		if ($kirim)
		{
			$pesan = $this->input->post('pesan');
			$peserta = $this->input->post('peserta');

			// $CI = &get_instance();
			// //setting the second parameter to TRUE (Boolean) the function will return the database object.
			// $this->db2 = $CI->load->database('sms', TRUE);

			if ($peserta=="all")
			{
			   foreach ($this->db->get('registrasi')->result_array() as $row)
			   {
			   	 $info=array();
			   	 $q2=$this->account_model->kirimsms($row['hp'],$pesan);
			   }
			}
			else if ($peserta=="akun")
			{
				foreach ($this->db->where('kategori IS',null)->get('registrasi')->result_array() as $row)
			   {
			   	 $info=array();
			   	 $q2=$this->account_model->kirimsms($row['hp'],$pesan);
			   }
			}
			else if ($peserta=="pemakalah")
			{
				foreach ($this->db->query("SELECT a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where b.is_pemakalah='1'")->result_array() as $row)
			   {
			   	 $info=array();
			   	 $q2=$this->account_model->kirimsms($row['hp'],$pesan);
			   }
			}
			else if ($peserta=="non")
			{
				foreach ($this->db->query("SELECT a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where b.is_pemakalah='0'")->result_array() as $row)
			   {
			   	 $info=array();
			   	 $q2=$this->account_model->kirimsms($row['hp'],$pesan);
			   }
			}
			else
			{
			   // $info['TextDecoded']=$pesan;
			   // $info['DestinationNumber']=$peserta;
			   // $info['SenderID']='Modem-Biologi';
			   
			   // $q2=$this->db2->insert('outbox',$info);
				$q2=$this->account_model->kirimsms($peserta,$pesan);
			}
			if ($q2==1)
			{
				$this->session->set_flashdata('msg','Data SMS berhasil terkirim');
				redirect(base_url('sms'));
			}
		}
		else
		{
			$this->load->view('admin/sms');
		}
	}

	public function sms()
	{
		$pesan="Tes Sembio multi";
		$peserta=array('+6285799122045','+6285700555993');
		$q2=$this->account_model->kirimsms($peserta,$pesan);
	}
}