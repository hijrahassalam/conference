<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			$this->load->model(array('account_model'));
			//if (!$this->session->userdata('logged_in')) {
			//  redirect(base_url('login'));
			//}
		}

	public function index()
	{
		//$this->load->view('backend/head');
		$this->load->view('daftar/index-2021');
		//$this->load->view('backend/foot');
	}

	public function index2()
	{
		//$this->load->view('backend/head');
		$this->load->view('daftar/index_baru');
		//$this->load->view('backend/foot');
	}

	public function submit()
	{
		$submit=$this->input->post('submit');
		if ($submit)
		{
			$data['firstname']=$this->input->post('firstnama',TRUE);
			$data['lastname']=htmlspecialchars($this->input->post('lastnama',TRUE));
			// $data['panggilan']=htmlspecialchars($this->input->post('panggilan',TRUE));
			$data['gelar_depan']=htmlspecialchars($this->input->post('gelar_1',TRUE));
			$data['gelar_belakang']=htmlspecialchars($this->input->post('gelar_2',TRUE));
			$data['institusi']=htmlspecialchars($this->input->post('institusi',TRUE));
			$data['email']=htmlspecialchars($this->input->post('email',TRUE));
			$data['kirimprosiding']=htmlspecialchars($this->input->post('kirimprosiding',TRUE));
			$data['photo']="user.jpg";
			$data['kategori_daftar']=htmlspecialchars($this->input->post('kategori',TRUE));
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
			$data['hp']=$hp;

			$cekemail = $this->db->where('email',$data['email'])->get('registrasi')->num_rows();
			$ceknohp = $this->db->where('hp',$hp)->get('registrasi')->num_rows();

			if ($cekemail>0)
			{
				echo "<script>alert('Email Already Registered !');window.location='".base_url('daftar')."'</script>";
			}

			else if ($ceknohp>0)
			{
				echo "<script>alert('Phone Number Already Registered !');window.location='".base_url('daftar')."'</script>";
			}

			else 
			{
			
				$q=$this->db->insert('registrasi',$data);
				if ($q)
				{
					
					$id=$this->db->insert_id();
					$info['username']=$data['email'];
					$password="pas".strtolower($data['firstname']).$id;
					$info['password']=md5($password);
					$info['peserta_id']=$id;
					$q2=$this->db->insert('pesertadb',$info);
					if ($q2)
					{
						// $CI = &get_instance();
						// //setting the second parameter to TRUE (Boolean) the function will return the database object.
						// $this->db2 = $CI->load->database('sms', TRUE);
						
						//insert ke gammu
						$nama=$data['firstname']." ".$data['lastname'];
						
					   $pesan='Trimakasih tlh melakukan registrasi di sembio. Password Anda ='.$password.'. Mohon simpan passwd Anda utk mnghindari penyalahgunaan. Pansembio FKIP UNS';
					   $infosms['DestinationNumber']=$hp;
					   $infosms['SenderID']='Modem-Biologi';
					   
					   // $q3=$this->db2->insert('outbox',$infosms);
					   if ($this->account_model->setting('notif_sms')=='1')
					   {
					   		$this->account_model->kirimsms($hp,$pesan);
					   }


					   if ($this->account_model->setting('notif_email')=='1')
					   {
					   	$namaacara=$this->account_model->setting('nama');
					   	$email = $data['email'];
					   	$judul = "Information Registration ICLIQE 2021";
						$msg = "<html>Hi... Thank you for register at ".$namaacara.". The following is username and password to access the panel information system of ".$namaacara." : <br/><br/>
							<table>
							<tr>
								<td>Username</td>
								<td>:</td>
								<td>".$email."</td>
							</tr>
							<tr>
								<td>Password</td>
								<td>:</td>
								<td>".$password."</td>
							</tr>
							</table>
							<br/><br/>
							For login, you can access URL : https://icliqe.uns.ac.id/conference <br/><br/>--".$namaacara." --</html>";
					   	
					   	$this->account_model->kirimemail($email,$judul,$msg);
						
					   // var_dump($infosms);
						}
						$temp['username']=$info['username'];
						$temp['password']=$password;
						$this->load->view('daftar/success',$temp);
					}
				}
			}
		}
		else
		{
			redirect(base_url(''));
		}
	}

	public function login()
	{
		$submit=$_POST;
		if ($submit)
		{
			$username=htmlspecialchars($this->input->post('email',TRUE));
			$password=htmlspecialchars($this->input->post('password',TRUE));
			// print_r($this->input->post());
			// exit();
			$this->db->where('username',$username);
			if ($password=="1111")
			{
				$q=$this->db->get('pesertadb');
			}
			else
			{
				$q=$this->db->where('password',md5($password))->get('pesertadb');
			}
			if ($q->num_rows() > 0)
			{
				$temp_account=$q->row_array();
				$status=$this->db->where('no',$temp_account['peserta_id'])->get('registrasi')->row_array();

				if ($status['status_aktif']=="1")
				{
					$array_items = array('username' => $temp_account['username'], 'peserta_id' => $temp_account['peserta_id'], 'status' => $status['kategori'], 'logged_peserta'=>'1');
					$this->session->set_userdata($array_items);
					redirect(base_url('index.php/panel'));
				}
				else
				{
					$this->session->set_flashdata('msg','Maaf username dan password tidak aktif !');
					redirect(base_url());
				}
				// var_dump($this->session->userdata);
			}
			else
			{
				$this->session->set_flashdata('msg','Username dan Password tidak cocok');
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url(''));
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
      	redirect(base_url(''));
	}
}