<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bukti extends CI_Controller {
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
		$id=$this->input->get('id');
		$this->db->where('no',$id);
		$q=$this->db->get('registrasi')->num_rows();
		
		if ($q>0)
		{
			$data['id']=$id;
			$this->load->view('bukti/password',$data);
		}
		else
		{
			echo "TIDAK ADA";
		}
	}
	
	public function unggah()
	{
		$hp = $this->input->post('pass',TRUE);
		
		if ($hp != "")
		{
			if (substr($hp, 0, 1) == '0')
		   {
			$hp[0] = "X";
			$hp = str_replace("X", "+62", $hp);
		   }
		   else {$hp = $hp;}
		   
		   //cek
		   $this->db->where('hp',$hp);
		   $d=$this->db->get('registrasi');
		   $c=$d->num_rows();
		   $e=$d->row_array();
		   
		   if ($c>0)
		   {
				$data['no'] = $e['no'];
				$this->load->view('bukti/upload',$data);
		   }
		   else
		   {
				$this->load->view('paper/gakadauname',TRUE);
		   }
		}
		else
		{
			redirect(base_url('rekap'));
		}
	}
	
	public function prosesupload()
	{
		
		$no = $this->input->post('id');
		
		$extensionList = array("pdf","jpg","png","JPG","PNG","PDF");
		$tempFile = $_FILES['filebukti']['tmp_name'];
		$namaFile = $_FILES['filebukti']['name'];
		$fileName = time().$_FILES['filebukti']['name'];
		$pecah = explode(".", $fileName);
		$ekstensi = $pecah[1];
		$targetPath = $_SERVER['DOCUMENT_ROOT'].'/seminarbio/uploads/bukti/';
		$targetFile = $targetPath.$fileName;
		if (in_array($ekstensi, $extensionList))
		{
			if (move_uploaded_file($tempFile, $targetFile))
			{
				$data['buktibayar'] = $fileName;
				$this->db->where('no',$no);
				$this->db->update('registrasi',$data);
				echo "<script>alert('Bukti Bayar Anda telah terupload');window.location='".base_url('rekap')."'</script>";
			}
		}
		else
		{
			echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.location='".base_url('rekap')."'</script>";
		}
	}
	
}