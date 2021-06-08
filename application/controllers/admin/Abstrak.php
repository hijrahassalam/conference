<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abstrak extends CI_Controller {
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
		$this->load->view('admin/abstrak/index');

		//tampil atau tidak tampil
			 $status_off = $this->input->get('lolos_off');
			 $tahun=$this->account_model->setting('tahun');
			 if ($status_off) {				  				  
				  $data['status_abstrak'] ="1";
				  				 
				  $this->db->where('no', $status_off);
				  $u=$this->db->update('registrasi', $data); 
				  // if ($u)
				  // {
				  		$row=$this->db->where('no',$status_off)->get('registrasi')->row_array();
				  // 		$CI = &get_instance();
						// //setting the second parameter to TRUE (Boolean) the function will return the database object.
						// $this->db2 = $CI->load->database('sms', TRUE);
						
						// //insert ke gammu
					   $nama=$this->account_model->nama_peserta_gelar($status_off);
					   $hp=$row['hp'];
						
					   $pesan='Info: abstrak makalah a.n. '.$nama.' dinyatakan TIDAK LOLOS, silakan mendaftar lagi dg topik yg relevan dg tema seminar. Pansembio '.$tahun.'.';
					 //   $infosms['DestinationNumber']=$hp;
					 //   $infosms['SenderID']='Modem-Biologi';
					   
					 //   $q3=$this->db2->insert('outbox',$infosms);
				  // }
				  if ($this->account_model->setting('notif_sms')=='1')
				  {
				   		$this->account_model->kirimsms($hp,$pesan);
				  }
				  redirect(base_url('admin/abstrak'));				
			 }
			 		
			 $status_on = $this->input->get('lolos_on');
			 if ($status_on) {				  				  
				  $data['status_abstrak'] ="3";
				  				 
				  $this->db->where('no', $status_on);
				  $u=$this->db->update('registrasi', $data);

				  // if ($u)
				  // {
				  		$row=$this->db->where('no',$status_on)->get('registrasi')->row_array();
				  // 		$CI = &get_instance();
						// //setting the second parameter to TRUE (Boolean) the function will return the database object.
						// $this->db2 = $CI->load->database('sms', TRUE);
						
						// //insert ke gammu
					 $nama=$this->account_model->nama_peserta_gelar($status_on);
					 $hp=$row['hp'];
						
					 $pesan='Info: abstrak makalah a.n.'.$nama.' dinyatakan LOLOS. Silakan verifikasi pembayaran dan upload fullpaper. Pansembio '.$tahun.'.';
					 //   $infosms['DestinationNumber']=$hp;
					 //   $infosms['SenderID']='Modem-Biologi';
					   
					 //   $q3=$this->db2->insert('outbox',$infosms);
				  // } 
				  if ($this->account_model->setting('notif_sms')=='1')
				  {
				   		$this->account_model->kirimsms($hp,$pesan);
				  }
				  redirect(base_url('admin/abstrak'));
			 }		

			 $status_rev = $this->input->get('lolos_rev');
			 if ($status_rev) {				  				  
				  $data['status_abstrak'] ="2";
				  				 
				  $this->db->where('no', $status_rev);
				  $u=$this->db->update('registrasi', $data); 

				  // if ($u)
				  // {
				  		$row=$this->db->where('no',$status_rev)->get('registrasi')->row_array();
				  // 		$CI = &get_instance();
						// //setting the second parameter to TRUE (Boolean) the function will return the database object.
						// $this->db2 = $CI->load->database('sms', TRUE);
						
						// //insert ke gammu
					 $nama=$this->account_model->nama_peserta_gelar($status_rev);
					 $hp=$row['hp'];
						
					 $pesan='Info: abstrak makalah a.n. '.$nama.' diterima dengan REVISI. Silakan merevisi, verifikasi pembayaran & upload fulpaper. Pansembio '.$tahun.'.';
					 //   $infosms['DestinationNumber']=$hp;
					 //   $infosms['SenderID']='Modem-Biologi';
					   
					 //   $q3=$this->db2->insert('outbox',$infosms);
				  // }
				  if ($this->account_model->setting('notif_sms')=='1')
				  {
				   		$this->account_model->kirimsms($hp,$pesan);
				  }
				  redirect(base_url('admin/abstrak'));
			 }		
	}

	public function modal()
	{
		$id=$this->input->post('id');

		$this->db->where('no',$id);
		$row=$this->db->get('registrasi')->row_array();
		$tahun=$this->account_model->setting('tahun');

		if ($row['review_abstrak']!="")
		{
			$filereview="<font color='blue'><a href='".base_url('uploads/abstrak/'.$tahun.'/review/'.$row['review_abstrak'].'')."'>".$row['review_abstrak']."</a></font>";
		}
		else
		{
			$filereview="<font color='red'>Belum ada</font>";
		}

		echo "
		<h3><center>Abstrak</center></h3>
		<table class='table table-stripped table-responsive' width='70%' style='margin:0px auto'>
			<tr>
				<td width='30%'>Nama</td>
				<td width='2%'>:</td>
				<td width='68%'>".$this->account_model->nama_peserta_gelar($row['no'])."</td>
			</tr>
			<tr>
				<td>Asal</td>
				<td>:</td>
				<td>".$row['institusi']."</td>
			</tr>
			<tr>
				<td>Judul Artikel</td>
				<td>:</td>
				<td>".$row['judul']."</td>
			</tr>
			<tr>
				<td>Jenis Artikel</td>
				<td>:</td>
				<td>".$row['jenis_artikel']."</td>
			</tr>
			<tr>
				<td>Kata Kunci</td>
				<td>:</td>
				<td>".$row['kata_kunci']."</td>
			</tr>
		</table>
		<br/>
		<br/>
		<b>Review Abstrak : ".$filereview."</b><br/><br/>
		<form method='post' action='".base_url('admin/abstrak/review')."' class='smart-form client-form' enctype='multipart/form-data'>
			<center><input type='file' name='reviewfile' class='form-control'><div class='note'><b>Hanya file <font color='red'>.doc atau .docx</font> yang bisa diupload</b></div><br/>
			<input type='hidden' name='id' value='".$row['no']."'>
			<input type='submit' name='upload' class='btn btn-sm btn-primary' value='Upload Review'></center>
		</form>
		";
	}

	public function review()
	{
		$update=$this->input->post('upload',TRUE);
		$tahun=$this->account_model->setting('tahun');
		if ($update)
		{
			$no = $this->input->post('id');
		
			$extensionList = array("doc","docx","DOC","DOCX");
			$tempFile = $_FILES['reviewfile']['tmp_name'];
			$namaFile = $_FILES['reviewfile']['name'];
			$fileName = time().$_FILES['reviewfile']['name'];
			$pecah = explode(".", $fileName);
			$ekstensi = $pecah[1];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/sembio/uploads/abstrak/'.$tahun.'/review/';
			$targetFile = $targetPath.$fileName;
			if (in_array($ekstensi, $extensionList))
			{
				if (move_uploaded_file($tempFile, $targetFile))
				{
					$data['review_abstrak'] = $fileName;
					$this->db->where('no',$no);
					$u=$this->db->update('registrasi',$data);
					if ($u)
					{
						$this->session->set_flashdata('msg','Review Abstrak diupdate');
						redirect(base_url('admin/abstrak'));
					}
				}
			}
			else
			{
				echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.history.back()</script>";
			}
		}
		else
		{
			redirect(base_url('panel'));
		}
	}
}