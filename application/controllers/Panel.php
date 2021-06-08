<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent:: __construct();
		//error_reporting(0);

		$this->load->library('pagination');
		if (!$this->session->userdata('logged_peserta'))
		{
			redirect(base_url(''));
		}
	}

	public function index()
	{
		$this->load->view('panel/index');
	}

	public function profil()
	{
		$update=$this->input->post('update',TRUE);
		if ($update)
		{
			$data['firstname']=$this->input->post('firstnama',TRUE);
			$data['lastname']=htmlspecialchars($this->input->post('lastnama',TRUE));
			// $data['panggilan']=htmlspecialchars($this->input->post('panggilan',TRUE));
			$data['gelar_depan']=htmlspecialchars($this->input->post('gelar_1',TRUE));
			$data['gelar_belakang']=htmlspecialchars($this->input->post('gelar_2',TRUE));
			$data['institusi']=htmlspecialchars($this->input->post('institusi',TRUE));
			$data['kategori_daftar']=htmlspecialchars($this->input->post('kategori',TRUE));
			// $data['kategori']=htmlspecialchars($this->input->post('kategori',TRUE));
			// $data['prosiding']=htmlspecialchars($this->input->post('prosiding',TRUE));
			// if ($data['prosiding']=='1')
			// {
			// 	$data['jumlahprosiding']=htmlspecialchars($this->input->post('jumlahprosiding',TRUE));
			// }
			$hp=$this->input->post('nohp',TRUE);
			
			$date = time();
			$thn = date("Y",$date);
			$day = date("d",$date);
			$month = date("m",$date);
			$today = date("Y-m-d",$date);
			   if (substr($hp, 0, 1) == '0')
			   {
				$hp[0] = "X";
				$hp = str_replace("X", "+62", $hp);
			   }
			   else {$hp = $hp;}
			$data['tanggal']=$today;

			$rowpes=$this->db->where('no',$this->input->post('idpes',TRUE))->get('registrasi')->row_array();
			if ($hp!=$rowpes)
			{
				$cekhp=$this->db->where('hp',$hp)->get('registrasi')->num_rows();
				if ($cekhp>0)
				{
					echo "<script>alert('Maaf No Handphone sudah Digunakan !');window.location='".base_url('panel')."'</script>";
				}
				else
				{
					$data['hp']=$hp;
				}
			}

			$extensionList = array("jpg","png","gif","jpeg","JPG","JPEG","PNG","GIF");
			$tempFile = $_FILES['photo']['tmp_name'];
			$namaFile = $_FILES['photo']['name'];
			$fileName = time().$_FILES['photo']['name'];
			$pecah = explode(".", $fileName);
			$ekstensi = $pecah[1];
			$maxsize = 1024 * 200;
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/conference/uploads/photo/';
			$targetFile = $targetPath.$fileName;
			if (in_array($ekstensi, $extensionList) && $_FILES['photo']['size']<=$maxsize)
			{
				if (move_uploaded_file($tempFile, $targetFile))
				{
					$data['photo'] = $fileName;
				}
			}

			$q=$this->db->where('no',$this->input->post('idpes',TRUE))->update('registrasi',$data);
			if ($q)
			{
				$this->session->set_flashdata('msg','Profile Has Been Successfully Updated');
				redirect(base_url('panel'));
			}

		}
		else
		{
			redirect(base_url('panel'));
		}
	}
  
  public function test()
    {
    echo $_SERVER['DOCUMENT_ROOT'];
  }

	public function genbayar()
	{
		$id=$this->input->post('id',TRUE);
		$data=$this->db->where('no',$id)->get('registrasi')->row_array();
		$co=$data['cowriter_hadir'];
		if ($data['cowriter_hadir']!="")
		{
			$coh=explode(',',$co);
			$cohadir=count($coh);
		}
		else
		{
			$cohadir=0;
		}
		// echo $cohadir;
		// exit();
		if ($data['kategori']=="5" && $data['is_hppbi']=='3')
		{
			$idpayway=3316;
		}
		else if ($data['kategori']=="5" && $data['is_hppbi']!="3")
		{
			$idpayway=3315;
		}
		else if ($data['kategori']=="1" && $data['is_hppbi']=="3" && $cohadir==0)
		{
			$idpayway=3353;
		}
		else if ($data['kategori']=="1" && $data['is_hppbi']=="3" && $cohadir==1)
		{
			$idpayway=3354;
		}
		else if ($data['kategori']=="1" && $data['is_hppbi']=="3" && $cohadir==2)
		{
			$idpayway=3355;
		}
		else if ($data['kategori']=="1" && $data['is_hppbi']=="3" && $cohadir==3)
		{
			$idpayway=3356;
		}
		else if ($data['kategori']=="3")
		{
			$idpayway=3357;
		}
		else if ($data['kategori']=="1" && $cohadir==0)
		{
			$idpayway=3313;
		}
		else if ($data['kategori']=="1" && $cohadir==1)
		{
			$idpayway=3317;
		}
		else if ($data['kategori']=="1" && $cohadir==2)
		{
			$idpayway=3318;
		}
		else if ($data['kategori']=="1" && $cohadir==3)
		{
			$idpayway=3352;
		}
		else if ($data['kategori']=="2")
		{
			$idpayway=3314;
		}

		// echo $idpayway;
		// exit();
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://payway.uns.ac.id/api/v1/transaksi?token=Rgaoyi5u_CddreecRfWRk4Z7ue4YO93t",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "id_paket=".$idpayway."&id_jenis_customer=1&nama=".rawurlencode($this->account_model->nama_peserta_gelar($data['no']))."&jumlah=1&email=".rawurlencode($data['email'])."&no_telp=".str_replace('+62','0',$data['hp'])."",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/x-www-form-urlencoded",
		    "postman-token: 491e270a-5dcb-af9e-e465-da889444c99e"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $respon=json_decode($response);
		  $dt=array();
		  $dt['id_payway']=$respon->data->transaksi->id;
		  $dt['virtual_account']=$respon->data->transaksi->virtual_account;
		  $dt['tagihan']=$respon->data->transaksi->tagihan;
		  $dt['mata_uang']=$respon->data->transaksi->mata_uang;
		  $dt['tgl_awal_bayar']=$respon->data->transaksi->tanggal_awal_bayar;
		  $dt['tgl_akhir_bayar']=$respon->data->transaksi->tanggal_akhir_bayar;
		  $dt['status_bayar']=$respon->data->transaksi->status_bayar;
		  $dt['tgl_bayar']=$respon->data->transaksi->tanggal_bayar;
		  $dt['tgl_buat']=$respon->data->transaksi->tanggal_dibuat;
		  $dt['id_pendaftar']=$data['no'];
		  $dt['id_paket']=$idpayway;
		  $dt['tahun']=$this->account_model->setting('tahun');
		  //cek
		  $cek=$this->db->where(array('id_pendaftar'=>$data['no'],'tahun'=>$dt['tahun']))->get('status_payway');
		  if ($cek->num_rows() > 0)
		  {
		  	$this->db->where(array('id_pendaftar'=>$idpayway,'tahun'=>$dt['tahun']))->update('status_payway',$dt);
			  	$dt2['is_generated']='1';
		  	$dt2['id_payway']=$cek->row_array()['id'];
		  	$idd=1;
		  }
		  else
		  {
		  	$this->db->insert('status_payway',$dt);
			  if ($this->db->affected_rows() > 0)
			  {
			  	$dt2['is_generated']='1';
			  	$dt2['id_payway']=$this->db->insert_id();
			  	$idd=1;
			  }
		  }
		  if ($idd==1)
		  {
		  	$this->db->where('no',$data['no'])->update('registrasi',$dt2);
		  	$this->session->set_flashdata('msg','Data Pembayaran berhasil dibuat, Silakan lakukan transfer ke Rekening yang tertera di tab Bukti Bayar');
		  	redirect(base_url('panel'));
		  }
		}
	}

	public function daftar()
	{
		$update=$this->input->post('daftar',TRUE);
		if ($update)
		{
			$info['prioritas']=$this->input->post('prioritas',TRUE);

			$kategori = $this->input->post('kategori',TRUE);
			$katpem=$this->account_model->kategori('pemakalah');
			if (in_array($kategori,$katpem))
			{
				// for ($i=2;$i<7;$i++)
				// {
				// 	$info['co_writer'.$i]=$this->input->post('nama'.$i,TRUE);
				// 	$info['institusi_cowriter'.$i]=$this->input->post('institusi'.$i,TRUE);
				// 	$info['fn_writer'.$i]=$this->input->post('fnama'.$i,TRUE);
				// 	$info['ln_writer'.$i]=$this->input->post('lnama'.$i,TRUE);
				// }
				$info['jenis_artikel']=$this->input->post('jenisartikel',TRUE);
				$info['bidang_ilmu']=$this->input->post('bidangilmu',TRUE);
				$info['kategori']=$kategori;
			}
			else
			{
				$info['kategori']=$kategori;
			}

			$cekno = $this->db->where('no',$this->input->post('idpes',TRUE))->get('registrasi')->row_array();
			if ($cekno['nourut']=="")
			{
				$info['nourut']=$this->account_model->no_urut();
			}

			$dataedua = $this->input->post('judulpertama');
			if ($dataedua!="")
			{
				$datakedua=$this->input->post('datapertama');
				if (substr($datakedua, 0, 1) == '0')
				   {
					$datakedua[0] = "X";
					$datakedua = str_replace("X", "+62", $datakedua);
				   }
				   else {$datakedua = $datakedua;}
				$info['statusmakalah']="2";
				$cekdata = $this->db->query("SELECT * from registrasi where kategori='1' AND email='".$datakedua."' OR hp='".$datakedua."'")->row_array();
				$info['makalah1']=$cekdata['no'];
			}
			else
			{
				$info['statusmakalah']="1";
			}

			$q=$this->db->where('no',$this->input->post('idpes',TRUE))->update('registrasi',$info);
			if ($q)
			{
				if (in_array($kategori,$katpem))
				{
					$this->db->where('id_registrasi',$this->input->post('idpes',TRUE))->delete('registrasi_author');
					$temp=array();
					$temp['gelar_depan']=$this->input->post('frontpresenter',TRUE);
					$temp['gelar_belakang']=$this->input->post('backpresenter',TRUE);
					$temp['nama_lengkap']=$this->input->post('namapresenter',TRUE);
					$temp['institusi']=$this->input->post('affiliationpresenter',TRUE);
					$temp['email']=$this->input->post('emailpresenter',TRUE);
					$temp['nohp']=$this->input->post('hppresenter',TRUE);
					$temp['id_registrasi']=$this->input->post('idpes',TRUE);
					$temp['jenis']="presenter";
					$temp['urut']=1;
					$this->db->insert('registrasi_author',$temp);

					for($uu=1;$uu<7;$uu++)
					{
						$fnama=$this->input->post('fnama'.$uu);
						$lnama=$this->input->post('lnama'.$uu);
						$institusi=$this->input->post('institusi'.$uu);
						$emailp=$this->input->post('email'.$uu);

						if ($fnama!="")
						{
							$temp=array();
							$temp['nama_depan']=$fnama;
							$temp['nama_belakang']=$lnama;
							$temp['institusi']=$institusi;
							$temp['email']=$emailp;
							$temp['urut']=$uu;					
							$temp['id_registrasi']=$this->input->post('idpes',TRUE);
							$temp['jenis']="author";
							$temp['nama_lengkap']=$fnama." ".$lnama;
							$this->db->insert('registrasi_author',$temp);
						}
					}
				}
				$this->session->set_flashdata('msg','Registry ICLIQE 2021 Has Been Successfully Updated');
				redirect(base_url('panel'));
			}
		}
		else
		{
			redirect(base_url('panel'));
		}
	}

	public function daftar_update()
	{
		$update=$this->input->post('update',TRUE);
		$hppbi=$this->input->post('kirim',TRUE);
		if ($update)
		{
			$idpes=$this->input->post('idpes',TRUE);
			$info['cowriter_hadir']=implode(',',$this->input->post('tempjum',TRUE));
			$q=$this->db->where('no',$idpes)->update('registrasi',$info);
			if ($q)
			{
				$this->session->set_flashdata('msg','Data Pembayaran berhasil di update');
				redirect(base_url('panel'));
			}
		}
		else if ($hppbi)
		{
			$idpes=$this->input->post('idpes',TRUE);
			$tahun=$this->account_model->setting('tahun');
			$extensionList = array("pdf","jpg","png","jpeg","PDF","JPG","PNG","JPEG");
			$tempFile = $_FILES['hppbi']['tmp_name'];
			$namaFile = $_FILES['hppbi']['name'];
			$fileName = time().$_FILES['hppbi']['name'];
			$pecah = explode(".", $fileName);
			$ekstensi = $pecah[1];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/sembio/uploads/hppbi/2018/';
			$targetFile = $targetPath.$fileName;
			if (in_array($ekstensi, $extensionList))
			{
				if (move_uploaded_file($tempFile, $targetFile))
				{
					$data['kta_hppbi']=$fileName;
					$this->db->where('no',$idpes);
					$u=$this->db->update('registrasi',$data);
					if ($u)
					{
						$this->session->set_flashdata('msg','Kartu Tanda Anggota HPPBI berhasil diupdate');
						redirect(base_url('panel'));
					}

				}
			}
			else
			{
				// echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.history.back()</script>";
				echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.location='".base_url('panel')."'</script>";
			}
		}
		else
		{
			redirect(base_url('panel'));
		}
	}

	public function abstrak()
	{
		$tahun=$this->account_model->setting('tahun');
		$update=$this->input->post('kirim');
		if ($update)
		{
			$no = $this->input->post('id');
			$data=array();
			$data['judul']=$this->input->post('judul_en');
			$data['abstrak']=$this->input->post('abstrak_en');
			$data['keywords']=$this->input->post('keyword');
			$data['id_registrasi']=$no;

			$cek=$this->db->where('id_registrasi',$no)->get('registrasi_abstrak')->row_array();
			if ($cek['id']=="")
			{
				$data['created_at']=date("Y-m-d H:m:s");
				$up="insert";
			}
			else
			{
				$up="update";
			}
			$data['updated_at']=date("Y-m-d H:i:s");

			if ($up=="update")
			{
				$this->db->where('id_registrasi',$no);
				$u=$this->db->update('registrasi_abstrak',$data);
			}
			else
			{
				$u=$this->db->insert('registrasi_abstrak',$data);
			}
			
			if ($u)
			{
				// $CI = &get_instance();
				// //setting the second parameter to TRUE (Boolean) the function will return the database object.
				// $this->db2 = $CI->load->database('sms', TRUE);
				
				$row=$this->db->where('no',$no)->get('registrasi')->row_array();
				$hp=$row['hp'];
				
			   $pesan='Trimakasih tlh mengupload abstrak Anda. Kami akan mereview, tunggu notifikasi berikutnya. Pansembio FKIP UNS';
			 //   $infoabstrak['DestinationNumber']=$hp;
			 //   $infoabstrak['SenderID']='Modem-Biologi';

			   $hp2=$this->account_model->setting('hp_review');
			 //   $hp3="+6281215669905";
			   $pesan2="telah upload abstrak a.n ".$row['firstname']." ".$row['lastname']." pada tgl ".substr($row['tglabstrak'],0,10)." jam ".substr($row['tglabstrak'],11)."";
			 //   $infoabstrak2['DestinationNumber']=$hp2;
			 //   $infoabstrak2['SenderID']='Modem-Biologi';

			 //   $infoabstrak3['TextDecoded']="telah upload abstrak a.n ".$row['firstname']." ".$row['lastname']." pada tgl ".substr($row['tglabstrak'],0,10)." jam ".substr($row['tglabstrak'],11)."";
			 //   $infoabstrak3['DestinationNumber']=$hp3;
			 //   $infoabstrak3['SenderID']='Modem-Biologi';
			   
			 //   $q2=$this->db2->insert('outbox',$infoabstrak);
			 //   $q3=$this->db2->insert('outbox',$infoabstrak2);
			 //   $q4=$this->db2->insert('outbox',$infoabstrak3);

			   if ($this->account_model->setting('notif_sms')=='10')
			   {
			   		$this->account_model->kirimsms($hp,$pesan);
			   		$this->account_model->kirimsms($hp2,$pesan2);
			   }
				$this->session->set_flashdata('msg','Abstract Has Been Successfully Updated');
				redirect(base_url('panel'));
			}
		}
		else
		{
			redirect(base_url('panel'));
		}
	}

	public function abstrak2()
	{
		$tahun=$this->account_model->setting('tahun');
		$update=$this->input->post('kirim');
		if ($update)
		{
			$no = $this->input->post('id');
		
			$extensionList = array("doc","docx","DOC","DOCX");
			$tempFile = $_FILES['abstrak']['tmp_name'];
			$namaFile = $_FILES['abstrak']['name'];
			$fileName = time().$_FILES['abstrak']['name'];
			$pecah = explode(".", $fileName);
			$ekstensi = $pecah[1];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/sembio/uploads/abstrak/'.$tahun.'/';
			$targetFile = $targetPath.$fileName;
			if (in_array($ekstensi, $extensionList))
			{
				if (move_uploaded_file($tempFile, $targetFile))
				{
					$data['abstrak'] = $fileName;
					$data['judulabstrak'] = $namaFile;
					$data['judul']=$this->input->post('judul_id');
					$data['kata_kunci']=$this->input->post('kata_kunci');
					$data['title']=$this->input->post('judul_en');
					$data['keyword']=$this->input->post('keyword');

					$cek=$this->db->where('no',$no)->get('registrasi')->row_array();
					if ($cek['tglabstrak']=="")
					{
						$data['tglabstrak']=date("Y-m-d H:m:s");
					}
					$this->db->where('no',$no);
					$u=$this->db->update('registrasi',$data);
					if ($u)
					{
						// $CI = &get_instance();
						// //setting the second parameter to TRUE (Boolean) the function will return the database object.
						// $this->db2 = $CI->load->database('sms', TRUE);
						
						$row=$this->db->where('no',$no)->get('registrasi')->row_array();
						$hp=$row['hp'];
						
					   $pesan='Trimakasih tlh mengupload abstrak Anda. Kami akan mereview, tunggu notifikasi berikutnya. Pansembio FKIP UNS';
					 //   $infoabstrak['DestinationNumber']=$hp;
					 //   $infoabstrak['SenderID']='Modem-Biologi';

					   $hp2=$this->account_model->setting('hp_review');
					 //   $hp3="+6281215669905";
					   $pesan2="telah upload abstrak a.n ".$row['firstname']." ".$row['lastname']." pada tgl ".substr($row['tglabstrak'],0,10)." jam ".substr($row['tglabstrak'],11)."";
					 //   $infoabstrak2['DestinationNumber']=$hp2;
					 //   $infoabstrak2['SenderID']='Modem-Biologi';

					 //   $infoabstrak3['TextDecoded']="telah upload abstrak a.n ".$row['firstname']." ".$row['lastname']." pada tgl ".substr($row['tglabstrak'],0,10)." jam ".substr($row['tglabstrak'],11)."";
					 //   $infoabstrak3['DestinationNumber']=$hp3;
					 //   $infoabstrak3['SenderID']='Modem-Biologi';
					   
					 //   $q2=$this->db2->insert('outbox',$infoabstrak);
					 //   $q3=$this->db2->insert('outbox',$infoabstrak2);
					 //   $q4=$this->db2->insert('outbox',$infoabstrak3);

					   if ($this->account_model->setting('notif_sms')=='1')
					   {
					   		$this->account_model->kirimsms($hp,$pesan);
					   		$this->account_model->kirimsms($hp2,$pesan2);
					   }
						$this->session->set_flashdata('msg','Abstrak berhasil diupdate');
						redirect(base_url('panel'));
					}

				}
			}
			else
			{
				// echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.history.back()</script>";
				echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.location='".base_url('panel')."'</script>";
			}
		}
		else
		{
			redirect(base_url('panel'));
		}
	}

	public function fullpaper()
	{
		$tahun=$this->account_model->setting('tahun');
		$update=$this->input->post('kirim',TRUE);
		if ($update)
		{
			$no = $this->input->post('id');
		
			$extensionList = array("doc","docx","pdf","DOC","DOCX","PDF");
			$tempFile = $_FILES['fullpaper']['tmp_name'];
			$namaFile = $_FILES['fullpaper']['name'];
			$fileName = time().$_FILES['fullpaper']['name'];
			$pecah = explode(".", $fileName);
			$ekstensi = $pecah[1];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/sembio/uploads/fullpaper/'.$tahun.'/';
			$targetFile = $targetPath.$fileName;
			if (in_array($ekstensi, $extensionList))
			{
				if (move_uploaded_file($tempFile, $targetFile))
				{
					$data['fullpaper'] = $fileName;
					$data['judulfile'] = $namaFile;
					$cek=$this->db->where('no',$no)->get('registrasi')->row_array();
					if ($cek['tglfullpaper']=="")
					{
						$data['tglfullpaper']=date("Y-m-d H:m:s");
					}
					$this->db->where('no',$no);
					$u=$this->db->update('registrasi',$data);
					if ($u)
					{
						// $CI = &get_instance();
						// //setting the second parameter to TRUE (Boolean) the function will return the database object.
						// $this->db2 = $CI->load->database('sms', TRUE);
						
						$row=$this->db->where('no',$no)->get('registrasi')->row_array();
						$hp=$row['hp'];
						
					   	$pesan='Trimakasih tlh mengupload Full Paper Anda. Kami akan mereview, tunggu notifikasi berikutnya. Pansembio FKIP UNS';
					 //   $infoabstrak['DestinationNumber']=$hp;
					 //   $infoabstrak['SenderID']='Modem-Biologi';

					 //   $hp2="+6285643580677";
					   	$hp2=$this->account_model->setting('hp_review');
					   $pesan2="telah upload fullpaper a.n ".$row['firstname']." ".$row['lastname']." pada tgl ".substr($row['tglfullpaper'],0,10)." jam ".substr($row['tglfullpaper'],11)."";
					 //   $infoabstrak2['DestinationNumber']=$hp2;
					 //   $infoabstrak2['SenderID']='Modem-Biologi';

					 //   $hp3="+6281215669905";
					 //   $infoabstrak3['TextDecoded']="telah upload fullpaper a.n ".$row['firstname']." ".$row['lastname']." pada tgl ".substr($row['tglfullpaper'],0,10)." jam ".substr($row['tglfullpaper'],11)."";
					 //   $infoabstrak3['DestinationNumber']=$hp3;
					 //   $infoabstrak3['SenderID']='Modem-Biologi';

					 //   $q2=$this->db2->insert('outbox',$infoabstrak);
					 //   $q3=$this->db2->insert('outbox',$infoabstrak2);
					 //   $q4=$this->db2->insert('outbox',$infoabstrak3);

					   	if ($this->account_model->setting('notif_sms')=='1')
					    {
					   		$this->account_model->kirimsms($hp,$pesan);
					   		$this->account_model->kirimsms($hp2,$pesan2);
					    }

						$this->session->set_flashdata('msg','Full Paper berhasil diupdate');
						redirect(base_url('panel'));
					}

				}
			}
			else
			{
				// echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.history.back()</script>";
				echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.location='".base_url('panel')."'</script>";
			}
		}
		else
		{
			redirect(base_url('panel'));
		}
	}

	public function bukti()
	{
		$tahun=$this->account_model->setting('tahun');
		$update=$this->input->post('kirim',TRUE);
		if ($update)
		{
			$no = $this->input->post('id');
		
			$extensionList = array("pdf","jpg","png","jpeg","PDF","JPG","PNG","JPEG");
			$tempFile = $_FILES['bukti']['tmp_name'];
			$namaFile = $_FILES['bukti']['name'];
			$fileName = time().$_FILES['bukti']['name'];
			$pecah = explode(".", $fileName);
			$ekstensi = $pecah[1];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/sembio/uploads/bukti/'.$tahun.'/';
			$targetFile = $targetPath.$fileName;
			if (in_array($ekstensi, $extensionList))
			{
				if (move_uploaded_file($tempFile, $targetFile))
				{
					$data['buktibayar'] = $fileName;
					$this->db->where('no',$no);
					$u=$this->db->update('registrasi',$data);
					if ($u)
					{
						// $CI = &get_instance();
						// //setting the second parameter to TRUE (Boolean) the function will return the database object.
						// $this->db2 = $CI->load->database('sms', TRUE);
						
						$row=$this->db->where('no',$no)->get('registrasi')->row_array();
						$hp=$row['hp'];
						
					 	$pesan='Trimakasih tlh memverifikasi pembayaran Anda. Pansembio FKIP UNS';
					 //   $infoabstrak['DestinationNumber']=$hp;
					 //   $infoabstrak['SenderID']='Modem-Biologi';

						$hp2=$this->account_model->setting('hp_bendahara');
						$tggggl=date("Y-m-d H:m:s");
					 	$pesan2="telah upload bukti pembayaran a.n ".$row['firstname']." ".$row['lastname']." pada tgl ".substr($tggggl,0,10)." jam ".substr($tggggl,11)."";
					 //   $infoabstrak2['DestinationNumber']=$hp2;
					 //   $infoabstrak2['SenderID']='Modem-Biologi';
					   
					 //   $q2=$this->db2->insert('outbox',$infoabstrak);
					 //   $q3=$this->db2->insert('outbox',$infoabstrak2);

					 	if ($this->account_model->setting('notif_sms')=='1')
					    {
					   		$this->account_model->kirimsms($hp,$pesan);
					   		$this->account_model->kirimsms($hp2,$pesan2);
					    }

						$this->session->set_flashdata('msg','Bukti Pembayaran berhasil diupdate');
						redirect(base_url('panel'));
					}

				}
			}
			else
			{
				// echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.history.back()</script>";
				echo "<script>alert('File yang Anda upload salah, silakan coba lagi');window.location='".base_url('panel')."'</script>";
			}
		}
		else
		{
			redirect(base_url('panel'));
		}
	}

	public function cekpertama() {
		$username = $this->input->post('username',TRUE);
		if ($username)
		{
			if (substr($username, 0, 1) == '0')
			   {
				$username[0] = "X";
				$username = str_replace("X", "+62", $username);
			   }
			   else {$username = $username;}
			
			$cek = $this->db->query("SELECT * from registrasi where kategori='1' AND email='".$username."' OR hp='".$username."'");

			if ($username=="")
			{
				echo "0";
			}
			else
			{
				if ($cek->num_rows() > 0)
				{
					$row=$cek->row_array();
					echo $row['judul']. " (".$this->account_model->nama_peserta_gelar($row['no']).")";
				}
				else
				{
					echo "0";
				}
			}

		}
		else
		{
			redirect(base_url('panel'));
		}
	}

}
