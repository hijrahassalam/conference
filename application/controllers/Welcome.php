<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->helper('download');
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
		if ($this->session->userdata('bahasa')=="eng")
		{
			$this->load->view('home/indexeng');
		}
		else
		{
			$this->load->view('home/index-2021');
		}
		// $this->load->view('welcome_message');
	}

	public function index2()
	{
		if ($this->session->userdata('bahasa')=="eng")
		{
			$this->load->view('home/indexeng');
		}
		else
		{
			$this->load->view('home/index');
		}
		// $this->load->view('welcome_message');
	}

	public function cetak()
	{
		require_once APPPATH.'/third_party/PhpWord/Autoloader.php';
		\PhpOffice\PhpWord\Autoloader::register();
		
		require_once APPPATH.'third_party/html-docx-js/HTMLtoOpenXML.php';
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('uploads/hppbi.docx');
		$tahunSekarang = date('Y');
		$templateProcessor->setValue('namapeserta', htmlspecialchars('Adriyanto Prasetyo', ENT_COMPAT, 'UTF-8'));
		$templateProcessor->setValue('noanggota', htmlspecialchars('Adriyanto Prasetyo', ENT_COMPAT, 'UTF-8'));
		$templateProcessor->setValue('instansipeserta', htmlspecialchars('Adriyanto Prasetyo', ENT_COMPAT, 'UTF-8'));
		$templateProcessor->saveAs('uploads/hasilhppbi.docx');

		$data = file_get_contents("uploads/hasilhppbi.docx"); // Read the file's contents
		$name = 'FORM HPPBI.docx';
		force_download($name, $data);
	}

	public function test()
    {
    	$email=$this->input->post('email',TRUE);
		  $judul=$this->input->post('judul',TRUE);
	      $msg = $this->input->post('msg',TRUE);
	      
	      $this->load->library('email');
			$this->email->initialize(array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.sendgrid.net',
			  'smtp_user' => 'siharkaboy',
        'smtp_pass' => 'Boyolaliok3',
			  'smtp_port' => 587,
			  'crlf' => "\r\n",
			  'newline' => "\r\n",
			  'mailtype' => 'html', 
               'charset' => 'iso-8859-1'
			));


			$this->email->from('no_reply@siharka.boyolalikab.go.id', 'Sistem Informasi Pelaporan Harta Kekayaan Kab. Boyolali');
			$this->email->to($email);
			$this->email->subject($judul);
			$this->email->message($msg);
			$this->email->send();
    }

    public function test2()
    {
    	$email=$this->input->post('email',TRUE);
		  $judul=$this->input->post('judul',TRUE);
	      $msg = $this->input->post('msg',TRUE);
	      $jenis = $this->input->post('jenis',TRUE);

	      if ($jenis=="akunbaru")
	      {
	      	$msgg = "<html>Berikut adalah akun username dan password Anda di aplikasi SIHARKABOY Kabupaten Boyolali : <br/><br/>
                            <table>
                            <tr>
                              <td>Nama Lengkap</td>
                              <td>:</td>
                              <td>".$msg['nama']."</td>
                            </tr>
                            <tr>
                              <td>Username</td>
                              <td>:</td>
                              <td>".$msg['username']."</td>
                            </tr>
                            <tr>
                              <td>Password</td>
                              <td>:</td>
                              <td>".$msg['password']."</td>
                            </tr>
                            </table>
                            <br/><br/>
                            Untuk login silakan menuju Link : ".base_url('login')." <br/><br/>-- Admin SIHARKABOY Kabupaten Boyolali --</html>";
	      }
	      
	      $this->load->library('email');
			$this->email->initialize(array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.sendgrid.net',
			  'smtp_user' => 'siharkaboy',
        'smtp_pass' => 'Boyolaliok3',
			  'smtp_port' => 587,
			  'crlf' => "\r\n",
			  'newline' => "\r\n",
			  'mailtype' => 'html', 
               'charset' => 'iso-8859-1'
			));


			$this->email->from('no_reply@siharka.boyolalikab.go.id', 'Sistem Informasi Pelaporan Harta Kekayaan Kab. Boyolali');
			$this->email->to($email);
			$this->email->subject($judul);
			$this->email->message($msgg);
			$this->email->send();
    }

	public function resethppbi()
	{
		$email=urldecode($this->input->get('email',TRUE));
		$username=urldecode($this->input->get('username',TRUE));
		$password=urldecode($this->input->get('password',TRUE));

		$judul="Reset Password HPPBI";
		$this->load->library('email');
		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.sendgrid.net',
		  'smtp_user' => 'phicosdevteam',
			  'smtp_pass' => 'phicosdevteam2019',
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));


		$this->email->from('no_reply@hppbi.or.id', 'HPPBI');
		$this->email->to($email);
		$this->email->set_mailtype('html');
		$this->email->subject($judul);
		$msg = "<html>Berikut adalah akun username dan password untuk akun HPPBI Anda : <br/><br/>
							<table>
							<tr>
								<td>Username</td>
								<td>:</td>
								<td>".$username."</td>
							</tr>
							<tr>
								<td>Password</td>
								<td>:</td>
								<td>".$password."</td>
							</tr>
							</table>
							<br/><br/>
							Untuk login silakan menuju Link : http://hppbi.or.id/daftar <br/><br/>-- Admin HPPBI --</html>";
		$this->email->message($msg);
		if($this->email->send()){
		   //Success email Sent
		   echo "sukses";
		}else{
		   //Email Failed To Send
		   echo "gagal";
		}
	}

	public function email()
	{
		$this->load->library('email');
		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.sendgrid.net',
		  'smtp_user' => 'phicosdevteam',
		  'smtp_pass' => 'phicosdevteam2019',
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));


		$this->email->from('no_reply@sembio.fkip.uns.ac.id', 'AAA');
		$this->email->to('adriyantoprasetyo@gmail.com');
		$this->email->set_mailtype('html');
		$this->email->subject('Pembuatan Akun SEMBIO');
		$msg = "<html>Terima kasih telah mendaftar di Berikut adalah akun username dan password untuk <br/><br/>
			-- Panitia --</html>";
		$this->email->message($msg);
		if($this->email->send()){
			   //Success email Sent
			   echo $this->email->print_debugger();
			}else{
			   //Email Failed To Send
			   echo $this->email->print_debugger();
			}
	}

	public function blast($lpd)
	{
		$message = "Yth Bapak/Ibu Guru Peserta Diklat ".$lpd." 2020 \n\nSekretariat Ditjen GTK Kemdikbud melakukan perpanjangan waktu untuk pengisian survei tentang “Hasil Pelatihan Diklat GTK Tahun 2020”.  Berkenaan dengan hal tersebut, kami mohon Saudara dapat berpartisipasi dalam mengisi survei dimaksud yang dilakukan dengan metode daring (online) melalui aplikasi SIMPKB https://paspor-gtk.belajar.kemdikbud.go.id/ atau dengan menggunakan tautan sebagai berikut : https://s.id/PKBBhs \n\nAtas kerjasamanya, kami ucapkan terimakasih \n\nTim Survei Ditjen GTK \n\nKontak person\nEvi Susilowati (+6281357870649)\n\n Surat Resmi GTK : https://s.id/PKBGtk";

		$token = "Hb3eapmQrhBxCzmAzltTeR5G2hmyGxbPBN2zckiSAm2oIgAgP4XUx4agSiOFlCGb";
		foreach ($this->db->where('tgl_blast IS NULL',null)->where('upt',$lpd)->get('blasting_gtk',30)->result_array() as $p)
		{
		$curl = curl_init();
			$hp=$p['no_hp'];
			$data = [
			    'phone' => $hp,
			    // 'document' => 'https://sim.tendik.kemdikbud.go.id/opstendik/75234_1619331847.pdf',
			    'message' => $message,
			    'secret' => false, // or true
			    'priority' => false, // or true
			];

			curl_setopt($curl, CURLOPT_HTTPHEADER,
			    array(
			        "Authorization: $token",
			    )
			);
			curl_setopt($curl, CURLOPT_URL, "https://cepogo.wablas.com/api/send-message");
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			$result = curl_exec($curl);
			curl_close($curl);

			echo $hp."OK";
			echo "<hr>";

			$tmp=array(
				'tgl_blast'=>date("Y-m-d H:i:s"),
				'status_blast' => json_encode($result)
			);
			$this->db->where('id',$p['id'])->update('blasting_gtk',$tmp);
		}
	}

	public function report()
	{
		$curl = curl_init();
		$token = "Hb3eapmQrhBxCzmAzltTeR5G2hmyGxbPBN2zckiSAm2oIgAgP4XUx4agSiOFlCGb";

		curl_setopt($curl, CURLOPT_HTTPHEADER,
		    array(
		        "Authorization: $token",
		    )
		);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, "https://cepogo.wablas.com/api/report-realtime");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);

		echo "<pre>";
		print_r($result);
	}

}
