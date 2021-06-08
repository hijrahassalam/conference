<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpass extends CI_Controller {

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
		if ($this->session->userdata('logged_peserta'))
		{
			redirect(base_url('panel'));
		}

		if ($this->session->userdata('logged_in'))
		{
			redirect(base_url('admin/dashboard'));
		}
	}

	public function index()
	{
		if ($this->input->post('key')!="")
		{
			$key=$this->input->post('key',TRUE);

			if (substr($key, 0, 1) == '0')
			   {
				$key[0] = "X";
				$key = str_replace("X", "+62", $key);
			   }
			   else {$key = $key;}

			$cek = $this->db->query("SELECT * from registrasi where hp='".$key."' or email='".$key."'");
			$jum = $cek->num_rows();
			if ($jum>0)
			{
				$row=$cek->row_array();
				$peserta = $this->db->where('peserta_id',$row['no'])->get('pesertadb')->row_array();

				$newpass=$this->generateRandomString();
				$pass=md5($newpass);

				$info['password']=$pass;
				$u=$this->db->where('id',$peserta['id'])->update('pesertadb',$info);
				if ($u)
				{
					// $CI = &get_instance();
					// //setting the second parameter to TRUE (Boolean) the function will return the database object.
					// $this->db2 = $CI->load->database('sms', TRUE);
					
					// //insert ke gammu
					
				 //   $infosms['TextDecoded']='Password Anda adalah '.$newpass.'. Pansembio FKIP UNS';
				 //   $infosms['DestinationNumber']=$row['hp'];
				 //   $infosms['SenderID']='Modem-Biologi';
				   $email = $row['email'];
				   
				   // $q3=$this->db2->insert('outbox',$infosms);
				   // if ($q3)
				   // {
				   		$judul="Reset Password ICLIQE 2021";
				   		$namaacara=$this->account_model->setting('nama');
						$msg = "<html>The following is username and password to access the panel information system of ".$namaacara." : <br/><br/>
							<table>
							<tr>
								<td>Username</td>
								<td>:</td>
								<td>".$email."</td>
							</tr>
							<tr>
								<td>Password</td>
								<td>:</td>
								<td>".$newpass."</td>
							</tr>
							</table>
							<br/><br/>
							For login, you can access URL : https://icliqe.uns.ac.id/conference <br/><br/>-- ".$namaacara." --</html>";
						
						$this->account_model->kirimemail($email,$judul,$msg);
				   		echo "<script>alert('Username and Password will also be sent to your email. Check your email (inbox/spam/promotion) and add star/mark as important');window.location='".base_url()."'</script>";
				   // }
				}

			}
			else
			{
				echo "<script>alert('Email or Phone Number not registered, Please Try Again !');window.location='".base_url()."'</script>";
			}
		}
		else
		{
			$this->load->view('home/forgot');
		}
	}
	public function generateRandomString($length = 6) {
      $characters = 'QWERTYUIOPASDFGHJKLZXCVBNM0123456789poiuytrewqasdfghjklmnbvcxz';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

}
