<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hppbi extends CI_Controller {
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
		$this->load->view('admin/hppbi/index');
		$tahun=$this->account_model->setting('tahun');

		//tampil atau tidak tampil
			 $status_off = $this->input->get('lolos_off');
			 if ($status_off) {				  				  
				  $data['is_hppbi'] ="1";
				  				 
				  $this->db->where('no', $status_off);
				  $u=$this->db->update('registrasi', $data); 
				 //  if ($u)
				 //  {
				  	$row=$this->db->where('no',$status_off)->get('registrasi')->row_array();
			  // 		$CI = &get_instance();
					// //setting the second parameter to TRUE (Boolean) the function will return the database object.
					// $this->db2 = $CI->load->database('sms', TRUE);
					
					// //insert ke gammu
				 $nama=$this->account_model->nama_peserta_gelar($row['no']);
				 $hp=$row['hp'];
					
				 $pesan='Info: KTA HPPBI a.n. '.$nama.' dinyatakan TIDAK VALID, silakan cek upload ulang data yang valid. Pansembio '.$tahun.'.';
				 //   $infosms['DestinationNumber']=$hp;
				 //   $infosms['SenderID']='Modem-Biologi';
				   
				 //   $q3=$this->db2->insert('outbox',$infosms);
				 //  }
				 if ($this->account_model->setting('notif_sms')=='1')
				  {
				   		$this->account_model->kirimsms($hp,$pesan);
				  }
				  redirect(base_url('admin/hppbi'));				
			 }
			 		
			 $status_on = $this->input->get('lolos_on');
			 if ($status_on) {				  				  
				  $data['is_hppbi'] ="3";
				  				 
				  $this->db->where('no', $status_on);
				  $u=$this->db->update('registrasi', $data); 
				 //  if ($u)
				 //  {
				  	$row=$this->db->where('no',$status_on)->get('registrasi')->row_array();
			  // 		$CI = &get_instance();
					// //setting the second parameter to TRUE (Boolean) the function will return the database object.
					// $this->db2 = $CI->load->database('sms', TRUE);
					
					// //insert ke gammu
				 $nama=$this->account_model->nama_peserta_gelar($row['no']);
				 $hp=$row['hp'];
					
				 $pesan='Info: KTA HPPBI a.n. '.$nama.' telah diperiksa dan dinyatakan Valid, Selamat Anda mendapatkan diskon sebesar Rp.'.number_format($this->account_model->setting('hppbi'),0,',','.').'. Pansembio '.$tahun.'.';
				 //   $infosms['DestinationNumber']=$hp;
				 //   $infosms['SenderID']='Modem-Biologi';
				   
				 //   $q3=$this->db2->insert('outbox',$infosms);
				 //  }

				 if ($this->account_model->setting('notif_sms')=='1')
				  {
				   		$this->account_model->kirimsms($hp,$pesan);
				  }
				  redirect(base_url('admin/hppbi'));
			 }		

			 $status_rev = $this->input->get('lolos_rev');
			 if ($status_rev) {				  				  
				  $data['is_hppbi'] ="2";
				  				 
				  $this->db->where('no', $status_rev);
				  $u=$this->db->update('registrasi', $data); 
				 //  if ($u)
				 //  {
				  	$row=$this->db->where('no',$status_rev)->get('registrasi')->row_array();
			  // 		$CI = &get_instance();
					// //setting the second parameter to TRUE (Boolean) the function will return the database object.
					// $this->db2 = $CI->load->database('sms', TRUE);
					
					// //insert ke gammu
				 $nama=$this->account_model->nama_peserta_gelar($row['no']);
				 $hp=$row['hp'];
					
				 $tahun='Info: KTA HPPBI a.n. '.$nama.' dinyatakan belum dapat divalidasi, silakan revisi dan upload lagi di sistem kami. Pansembio '.$tahun.'.';
				 //   $infosms['DestinationNumber']=$hp;
				 //   $infosms['SenderID']='Modem-Biologi';
				   
				 //   $q3=$this->db2->insert('outbox',$infosms);
				 //  }
				 if ($this->account_model->setting('notif_sms')=='1')
				  {
				   		$this->account_model->kirimsms($hp,$pesan);
				  }
				  redirect(base_url('admin/hppbi'));
			 }		
	}

	public function modal()
	{
		$id=$this->input->post('id');
		$tahun=$this->account_model->setting('tahun');

		$this->db->where('no',$id);
		$row=$this->db->get('registrasi')->row_array();

		if ($row['review_fullpaper']!="")
		{
			$filereview="<font color='blue'><a href='".base_url('uploads/fullpaper/'.$tahun.'/review/'.$row['review_fullpaper'].'')."'>".$row['review_fullpaper']."</a></font>";
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
		<form method='post' action='".base_url('admin/fullpaper/review')."' class='smart-form client-form' enctype='multipart/form-data'>
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
			$new_name = str_replace(',', '', str_replace('&', '', str_replace(' ','',$fileName)));
			$pecah = explode(".", $new_name);
			$ekstensi = $pecah[1];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/sembio/uploads/fullpaper/'.$tahun.'/review/';
			$targetFile = $targetPath.$new_name;
			if (in_array($ekstensi, $extensionList))
			{
				if (move_uploaded_file($tempFile, $targetFile))
				{
					$data['review_fullpaper'] = $new_name;
					$this->db->where('no',$no);
					$u=$this->db->update('registrasi',$data);
					if ($u)
					{
						$this->session->set_flashdata('msg','Review Fullpaper diupdate');
						redirect(base_url('admin/fullpaper'));
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