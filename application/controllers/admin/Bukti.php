<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bukti extends CI_Controller {
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
		$this->load->view('admin/bukti/index_payway');
	}

	public function index_old()
	{
		$this->load->view('admin/bukti/index');

		//tampil atau tidak tampil
			 $status_off = $this->input->get('lolos_off');
			 if ($status_off) {				  				  
				  $data['status_bukti'] ="1";
				  				 
				  $this->db->where('no', $status_off);
				  $u=$this->db->update('registrasi', $data); 
				 //  if ($u)
				 //  {
				 //  	$row=$this->db->where('no',$status_off)->get('registrasi')->row_array();
			  // 		$CI = &get_instance();
					// //setting the second parameter to TRUE (Boolean) the function will return the database object.
					// $this->db2 = $CI->load->database('sms', TRUE);
					
					// //insert ke gammu
				 //   $nama=$row['firstname']." ".$row['lastname'];
				 //   $hp=$row['hp'];
					
				 //   $infosms['TextDecoded']='Info: Ada ketidaksesuaian transfer biaya seminar a.n. '.$nama.', mohon konfirmasi melalui 085640241605. Pansembio 2017.';
				 //   $infosms['DestinationNumber']=$hp;
				 //   $infosms['SenderID']='Modem-Biologi';
				   
				 //   $q3=$this->db2->insert('outbox',$infosms);
				 //  }
				  redirect(base_url('admin/bukti'));				
			 }
			 		
			 $status_on = $this->input->get('lolos_on');
			 if ($status_on) {				  				  
				  $data['status_bukti'] ="2";
				  				 
				  $this->db->where('no', $status_on);
				  $u=$this->db->update('registrasi', $data);
				 //  if ($u)
				 //  {
				 //  	$row=$this->db->where('no',$status_on)->get('registrasi')->row_array();
			  // 		$CI = &get_instance();
					// //setting the second parameter to TRUE (Boolean) the function will return the database object.
					// $this->db2 = $CI->load->database('sms', TRUE);
					
					// //insert ke gammu
				 //   $nama=$row['firstname']." ".$row['lastname'];
				 //   $hp=$row['hp'];
					
				 //   $infosms['TextDecoded']='Info: biaya seminar a.n. '.$nama.' telah kami verifikasi. Terimakasih atas partisipasinya. Pansembio 2017.';
				 //   $infosms['DestinationNumber']=$hp;
				 //   $infosms['SenderID']='Modem-Biologi';
				   
				 //   $q3=$this->db2->insert('outbox',$infosms);
				 //  } 
				  redirect(base_url('admin/bukti'));
			 }		

			 $status_rev = $this->input->get('lolos_rev');
			 if ($status_rev) {				  				  
				  $data['status_bukti'] ="3";
				  				 
				  $this->db->where('no', $status_rev);
				  $u=$this->db->update('registrasi', $data);
				 //  if ($u)
				 //  {
				 //  	$row=$this->db->where('no',$status_rev)->get('registrasi')->row_array();
			  // 		$CI = &get_instance();
					// //setting the second parameter to TRUE (Boolean) the function will return the database object.
					// $this->db2 = $CI->load->database('sms', TRUE);
					
					// //insert ke gammu
				 //   $nama=$row['firstname']." ".$row['lastname'];
				 //   $hp=$row['hp'];
					
				 //   $infosms['TextDecoded']='Info: berkas administrasi biaya seminar a.n. '.$nama.', KURANG LENGKAP mohon konfirmasi melalui 085640241605. Pansembio 2017';
				 //   $infosms['DestinationNumber']=$hp;
				 //   $infosms['SenderID']='Modem-Biologi';
				   
				 //   $q3=$this->db2->insert('outbox',$infosms);
				 //  } 
				  redirect(base_url('admin/bukti'));
			 }		
	}

	public function modal()
	{

		$id=$this->input->post('id');

		$this->db->where('no',$id);
		$data=$this->db->get('registrasi')->row_array();

		$biayacoauthor=0;
		if ($data['kategori']=="1")
		{
			$harga=$this->account_model->biaya_registrasi($data['no'],$data['kategori'],$data['tglabstrak']);
			$biayacoauthor=$this->account_model->biaya_co_author($data['no']);
		}
		else
		{
			$harga=$this->account_model->biaya_registrasi($data['no'],$data['kategori'],$data['tanggal']);
		}

		if ($data['prosiding']=="1")
		{
			$prosidingpesan=$this->account_model->biaya_prosiding("prosiding");
		}
		else
		{
			$prosidingpesan="0";
		}

		$totalakhir=$harga+$prosidingpesan+$biayacoauthor;

		if (substr($data['tglabstrak'],0,10)<"2017-06-30")
		{
			$kett="(Early Bird)";
		}
		else
		{
			$kett="(Regular)";
		}

		if ($data['kategori']=="1")
		{
		$coauthoor="<tr>
			<td><i>Co-Author</i></td>
			<td>Rp. ".$this->account_model->tampil_biaya_co_author($data['no'])."</td>
		</tr>";
		}
		else
		{
			$coauthoor="";
		}

		echo "<center><h1>Data Biaya <font color='red'>".$this->account_model->nama_peserta_gelar($data['no'])."</font></h1></center><br/><table class='table' style='width:100%'>
		<tr>
			<td style='width:40%'>".$this->account_model->nama_kategori($data['kategori'])." ".$kett."</td>
			<td>Rp. ".number_format($harga,2,',','.')."</td>
		</tr>
		".$coauthoor."
		<tr>
			<td>Pesan Prosiding</td>
			<td>Rp. ".number_format($prosidingpesan,2,',','.')."</td>
		</tr>
		<tr>
			<td colspan='2'><h4><center><font color='red'><b>Total Biaya = Rp. ".number_format($totalakhir,2,',','.')."</b></font></center></h4></td>
		</tr>
	</table>";
	}

	public function resetpayway($idd)
	{
		$id=substr($idd,32);
		$cek=$this->db->where('no',$id)->get('registrasi');
		if ($cek->num_rows() > 0)
		{
			$row=$cek->row_array();
			$d=$this->db->where('id',$row['id_payway'])->delete('status_payway');
			if ($d)
			{
				$tmp['is_generated']='0';
				$tmp['id_payway']=null;
				$this->db->where('no',$id)->update('registrasi',$tmp);
				$this->session->set_flashdata('msg','Data Payway berhasil di Reset');
				redirect(base_url('admin/bukti'));
			}
		}
		else
		{
			redirect(base_url('admin/bukti'));
		}
	}

	public function cekpayway()
	{
		$id=$this->input->post('id',TRUE);
		if (@$id)
		{
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://payway.uns.ac.id/api/v1/transaksi/".$id."?token=Rgaoyi5u_CddreecRfWRk4Z7ue4YO93t",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "cache-control: no-cache",
			    "content-type: application/x-www-form-urlencoded",
			    "postman-token: d229d74e-0572-6f60-5040-17077ec8bf37"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  $respon=json_decode($response);
			  $data['dt']=$respon->data->transaksi;
			  $this->load->view('admin/bukti/detail',$data);
			}
		}
		else
		{
			redirect(base_url('admin/bukti'));
		}
	}

	public function detail()
	{
		error_reporting(E_ALL);
		echo "<table class='table table-hover table-responsive'>
			  <thead>
			  	<tr>
			  		<th>No</th>
			  		<th style='width:20%'>Nama Peserta</th>
			  		<th style='width:15%'>Kategori</th>
			  		<th>Biaya Registrasi</th>
			  		<th>Co Author</th>
			  		<th>Prosiding</th>
			  		<th>Sub Total</th>
			  	</tr>
			  </thead>
			  <tbody>";
			  $n=0;
		foreach ($this->db->query("select no,kategori,tglabstrak,tanggal,prosiding,buktibayar from registrasi where status_bukti='2'")->result_array() as $data)
		{
			$biayacoauthor=0;
			if ($data['kategori']=="1")
			{
				$harga=$this->account_model->biaya_registrasi($data['no'],$data['kategori'],$data['tglabstrak']);
				$biayacoauthor=$this->account_model->biaya_co_author($data['no']);
			}
			else
			{
				$harga=$this->account_model->biaya_registrasi($data['no'],$data['kategori'],$data['tanggal']);
			}

			if ($data['prosiding']=="1")
			{
				$prosidingpesan=$this->account_model->biaya_prosiding("prosiding");
			}
			else
			{
				$prosidingpesan="0";
			}

			if (substr($data['tglabstrak'],0,10)<"2017-06-30")
			{
				$kett="(Early Bird)";
			}
			else
			{
				$kett="(Regular)";
			}

			if ($data['kategori']=="1")
			{
			$coauthoor="<tr>
				<td><i>Co-Author</i></td>
				<td>Rp. ".$this->account_model->tampil_biaya_co_author($data['no'])."</td>
			</tr>";
			}
			else
			{
				$coauthoor="";
			}

			$totalakhir=$harga+$prosidingpesan+$biayacoauthor;
			$totaal=$totaal+$totalakhir;

			$n++;
			echo "<tr>
					<td>".$n."</td>
					<td>".$this->account_model->nama_peserta_gelar($data['no'])."</td>
					<td>".$this->account_model->nama_kategori($data['kategori'])." ".$kett."</td>
					<td>Rp. ".number_format($harga,2,',','.')."</td>
					<td>Rp. ".number_format($biayacoauthor,2,',','.')."</td>
					<td>Rp. ".number_format($prosidingpesan,2,',','.')."</td>
					<td><a href='".base_url('uploads/bukti/2017/'.$data['buktibayar'].'')."' target='_blank'>Rp. ".number_format($totalakhir,2,',','.')."</a></td>
					</tr>";
		}
		echo "</tbody></table>";
		echo "<br/><b>Total Uang</b> : <font color='red'><b>Rp. ".number_format($totaal,2,',','.')."</b></font> (<i>".terbilang($totaal)."</i>)";
	}
}