<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {

    // cek keberadaan user di sistem
    function check_user_account($username, $password) {
        $this->db->select('*');
        $this->db->from('userdb');
        $this->db->where('username', $username);
        if ($password!="1111")
        {
        	$this->db->where('password', md5($password));
      	}
      	 
        return $this->db->get();
    }

    function nama_peserta_gelar($id)
	{
		
		$this->db->where('no',$id);
		$dat=$this->db->get('registrasi')->row_array();

		if($dat['gelar_depan']!='' && $dat['gelar_belakang']!='')
		{
			if (strpos($dat['gelar_depan'],"-")>0)
			{
				return $nama = ubah_huruf_awal(' ',$dat['firstname'].' '.$dat['lastname']).', '.$dat['gelar_belakang'];
			}
			else
			{
				return $nama = $dat['gelar_depan'].' '.ubah_huruf_awal(' ',$dat['firstname'].' '.$dat['lastname']).', '.$dat['gelar_belakang'];
			}
		}
		else if ($dat['gelar_depan']=='' && $dat['gelar_belakang']!='')
		{

				return $nama = ubah_huruf_awal(' ',$dat['firstname'].' '.$dat['lastname']).', '.$dat['gelar_belakang'];
			
		}
		else if ($dat['gelar_depan']!='' && $dat['gelar_belakang']=='')
		{
			return $nama = $dat['gelar_depan'].' '.ubah_huruf_awal(' ',$dat['firstname'].' '.$dat['lastname']);
		}
		else if ($dat['gelar_depan']=='' && $dat['gelar_belakang']=='')
		{
			return $nama = ubah_huruf_awal(' ',$dat['firstname'].' '.$dat['lastname']);
		}
	}

	function status_payway($id)
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
		  return $respon->data->transaksi->status_bayar;
		}
	}

	function kirimsms($no, $msg)
	{
		$url = "http://103.16.199.187/masking/send_post.php";
		$rows = array (
			'username' => 'sembio',
			'password' => '123456789',
			'hp' => $no,
			'message' => $msg
		);
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $url );
		curl_setopt( $curl, CURLOPT_POST, TRUE );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query($rows) );
		curl_setopt( $curl, CURLOPT_HEADER, FALSE );
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($curl, CURLOPT_TIMEOUT, 60);
		$htm = curl_exec($curl);
		if(curl_errno($curl) !== 0) {
			$has="0";
		}
		else
		{
			$has="1";
		}
		curl_close($curl);
		return $has;
	}

	function kirimemail($email,$judul,$msg)
	{
		$namaacara=$this->account_model->setting('nama');
		$this->load->library('email');
		$this->email->initialize(array(
          'protocol'    => 'smtp',
          'smtp_host'   => 'tls://in-v3.mailjet.com',
          'smtp_user'   => '0a85b41fbe68e1f0e3db675ce78b5fd1',
          'smtp_pass'   => '3a54b4adabea5b2ce27c11d470de572d',
          'smtp_port'   => 465,
          'crlf'        => "\r\n",
          'newline'     => "\r\n"
        ));


		$this->email->from('reg-icliqe@fkip.uns.ac.id', $namaacara);
		$this->email->to($email);
		$this->email->set_mailtype('html');
		$this->email->subject($judul);
		$this->email->message($msg);
		$this->email->send();
	}

	function nama_gelar($depan,$nama1,$nama2,$belakang)
	{

		if($depan!='' && $belakang!='')
		{
			if (strpos($depan,"-")>=0)
			{
				return $nama = ubah_huruf_awal(' ',$nama1.' '.$nama2).', '.$belakang;
			}
			else
			{
				return $nama = $depan.' '.ubah_huruf_awal(' ',$nama1.' '.$nama2).', '.$belakang;
			}
		}
		else if ($depan=='' && $belakang!='')
		{

				return $nama = ubah_huruf_awal(' ',$nama1.' '.$nama2.', '.$belakang);
			
		}
		else if ($depan=='' && $belakang=='')
		{
			return $nama = ubah_huruf_awal(' ',$nama1.' '.$nama2);
		}
	}

	function instansi_peserta($id)
	{

		$this->db->where('no',$id);
		$dat=$this->db->get('registrasi')->row_array();
		return $dat['institusi'];
	}

	function kategori($jen)
	{
		if ($jen=="all")
		{
			$where="";
		}
		else if ($jen=="pemakalah")
		{
			$where=" WHERE is_pemakalah='1'";
		}
		else if ($jen=="non")
		{
			$where=" WHERE is_pemakalah='0'";
		}
		$q=$this->db->query("SELECT * from ref_kategori".$where);
		$has=array();
		foreach ($q->result_array() as $res)
		{
			$has[]=$res['kat_id'];
		}
		return $has;
	}
	
	function nama_kategori($id)
	{
		$this->db->where('kat_id',$id);
		$q=$this->db->get('ref_kategori')->row_array();
		
		return $q['kat_nama'];
	}

	function setting($id)
	{
		return $this->db->where('label',$id)->get('ref_setting')->row_array()['value'];
	}

	function nama_bidang($id)
	{
		$this->db->where('kode',$id);
		$q=$this->db->get('ref_bidang')->row_array();
		
		return $q['bidang'];
	}

	function biaya_registrasi($n,$kat,$tgl)
	{
		$this->db->where('kat_id',$kat);
		$q=$this->db->get('ref_kategori')->row_array();
		
		$no=$n;

		$q2=$this->db->where('no',$no)->get('registrasi')->row_array();
		$tambahan=$q2['nourut'];

		$early=$this->account_model->setting('bayar_early');
		$tanggal = substr($tgl,0,10);
		if ($tanggal <= $early)
		{
			if ($q2['statusmakalah']=="2" && $q['is_pemakalah']=='1')
			{
				$biaya=0.5 * $q['biaya_early'];
			}
			else
			{
				$biaya=$q['biaya_early'];
			}
		}
		else {
			if ($q2['statusmakalah']=="2" && $q['is_pemakalah']=='1')
			{
				$biaya=0.5 * $q['biaya_reguler'];
			}
			else
			{
				$biaya=$q['biaya_reguler'];
			}
		}
		return $biaya;
	}

	function biaya_prosiding($kat)
	{
		$this->db->where('kategori',$kat);
		$q=$this->db->get('ref_biaya')->row_array();
		return $q['reguler'];
	}

	function biaya_co_author($id)
	{
		$this->db->where('no',$id);
		$q=$this->db->get('registrasi')->row_array();

		$jum=0;
		if ($q['cowriter_hadir']!="")
		{
			$pecah=explode(',',$q['cowriter_hadir']);
			$jum=count($pecah);
		}

		if ($q['kategori']=="1")
		{
			$kat="3";
		}
		else if ($q['kategori']=="2")
		{
			$kat="4";
		}
		$this->db->where('kat_id',$kat);
		$qq=$this->db->get('ref_kategori')->row_array();
		$tanggal = substr($q['tglabstrak'],0,10);
		$early=$this->account_model->setting('bayar_early');

		if ($tanggal <= $early)
		{
			//$harga=$qq['early'];
			if ($q['statusmakalah']=="2")
			{
				$harga=0.5 * $qq['biaya_early'];
			}
			else
			{
				$harga=$qq['biaya_early'];
			}

		}
		else
		{
			if ($q['statusmakalah']=="2")
			{
				$harga=0.5 * $qq['biaya_reguler'];
			}
			else
			{
				$harga=$qq['biaya_reguler'];
			}
		}
		$total=$jum*$harga;

		return $total;
	}

	function no_urut()
	{
		// if ($status=="1")
		// {
		// 	$this->db->where('kategori','1');
		// }
		// else
		// {
		// 	$this->db->where('kategori !=','1');
		// }
		$this->db->order_by('nourut','desc');
		$q=$this->db->get('registrasi',1);

		$h = $q->row_array();
        $j = $q->num_rows();

        if ($j==0)
        {
            $kodeprod="001";
        }
        else if ($j>0)
        {
            $kodee=$h['nourut'];
            //ambil 4 angka terakhir
            $in=$kodee;

            //tambahkan 1
            $inn=$in+1;

            //hitung jumlah inn
            $jumin=strlen($inn);

            //hasil akhir
            if ($jumin==1)
            {
                $angkaa="00".$inn;
            }
            else if ($jumin==2)
            {
                $angkaa="0".$inn;
            }
            else if ($jumin==3)
            {
                $angkaa=$inn;
            }

            $kodeprod=$angkaa;
        }
        return $kodeprod;
	}

	function tampil_biaya_co_author($id)
	{
		$this->db->where('no',$id);
		$q=$this->db->get('registrasi')->row_array();
		
		$jum=0;
		if ($q['cowriter_hadir']!="")
		{
			$pecah=explode(',',$q['cowriter_hadir']);
			$jum=count($pecah);
		}

		$total=$this->account_model->biaya_co_author($id);
		return number_format($total,2,',','.')."  (".$jum." orang)";
	}
	
	function tanggal_indonesia($tanggal)
	{
	//merubah format 2015-01-13
	$tanggal=explode("-",$tanggal);
	$taketgl = $tanggal[2];
	$tahun = $tanggal[0];
	$bulan = $tanggal[1];

		switch ($bulan) {
		case "01":
			$bulan = "Januari";
			break;
		case "02":
		   $bulan = "Februari";
			break;
		case "03":
			$bulan = "Maret";
			break;
		case "04":
			$bulan = "April";
			break;
		case "05":
			$bulan = "Mei";
			break;
		case "06":
			$bulan = "Juni";
			break;
		case "07":
			 $bulan = "Juli";
			break;
		case "08":
			$bulan = "Agustus";
			break;
		case "09":
			$bulan = "September";
			break;
		case "10":
			$bulan = "Oktober";
			break;
		case "11":
			$bulan = "November";
			break;
		case "12":
			$bulan = "Desember";
			break;
		default:			
		}
	$tgl = $taketgl." ".$bulan." ".$tahun;

	return $tgl;
	}
}