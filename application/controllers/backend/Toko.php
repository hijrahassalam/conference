<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

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
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper('konversi_id_helper');
		$this->load->model('toko_model');
		//error_reporting(0);
		if (!$this->session->userdata('logged_in')) {
			  redirect(base_url('login'));
			}
	}

	public function index()
	{
		$do=$this->input->get('do',TRUE);
		$get=$this->input->get();

		if (!$get)
		{
			if ($this->session->userdata('user_role')=="ADMIN")
			{
				$query=$this->db->get('umkm_toko');
			}
			else if ($this->session->userdata('user_role')=="TOKO")
			{
				$this->db->where('user_id',$this->session->userdata('user_name'));
				$query=$this->db->get('umkm_toko');
			}
			$data['query']=$query;
			$this->load->view('backend/toko/index',$data);
		}
		else if ($do)
		{
			if ($do=="add")
			{
				if ($this->session->userdata('user_role')!="ADMIN")
				{
					redirect(base_url('backend/toko'));
				}
				$this->load->view('backend/toko/toko_tambah');
			}
			else if ($do=="del")
			{
				$id=$this->input->get('id');
				if ($id)
				{
					if ($this->session->userdata('user_role')!="ADMIN")
					{
						redirect(base_url('backend/toko'));
					}
					$this->db->where('toko_id',$id);
					$q=$this->db->get('umkm_toko');
					$j=$q->num_rows();

					if ($j>0)
					{
						//ambil user_name
						$hsl = $q->row_array();
						$uname = $hsl['user_id'];

						//hapus toko
						$this->db->where('user_id',$uname);
						$d1 = $this->db->delete('umkm_toko');

						//hapus akun
						$this->db->where('user_id',$uname);
						$d2 = $this->db->delete('umkm_akun');

						//hapus user
						$this->db->where('user_name',$uname);
						$d3 = $this->db->delete('umkm_user');

						if ($d1 && $d2 && $d3)
						{
							echo "<script>alert('Data Berhasil dihapus');window.location='".base_url('backend/toko')."'</script>";
						}
						else
						{
							echo "ada yang salah";
						}
					}
					else
					{
						redirect(base_url('backend/toko'));
					}
				}
				else
				{
					redirect(base_url('backend/toko'));
				}
			}
			else if ($do=="edit")
			{
				$id=$this->input->get('id');
				if ($id)
				{
					$this->db->where('toko_id',$id);
					$q=$this->db->get('umkm_toko');
					$j=$q->num_rows();

					if ($j>0)
					{
						$submit = $this->input->post('ubah',TRUE);
						if ($submit)
						{
							$username = $this->input->post('userid', TRUE);
							//update akun
							$akun['akun_nama']=$this->input->post('nama_akun',TRUE);
							$akun['akun_alamat']=$this->input->post('alamat_akun',TRUE);
							$akun['akun_ktp']=$this->input->post('no_ktp',TRUE);
							$akun['akun_email']=$this->input->post('email_akun',TRUE);
							$akun['akun_hp']=$this->input->post('nohp_akun',TRUE);
							$akun['akun_bb']=$this->input->post('bb_akun',TRUE);
							$akun['akun_wa']=$this->input->post('wa_akun',TRUE);
							$akun['akun_line']=$this->input->post('line_akun',TRUE);

							$this->db->where('user_id',$username);
							$q2 = $this->db->update('umkm_akun',$akun);

							//update toko
							$dtoko['toko_nama']=$this->input->post('nama_toko',TRUE);
							$dtoko['toko_alamat']=$this->input->post('alamat_toko',TRUE);
							$dtoko['toko_kecamatan']=$this->input->post('kecamatan',TRUE);
							$dtoko['toko_kategori']=$this->input->post('kategori',TRUE);
							$dtoko['toko_deskripsi']=$this->input->post('deskripsi_toko',TRUE);
							$dtoko['kode_prod']=strtoupper($this->input->post('kode_toko',TRUE));
							
							$extensionList = array("bmp", "jpg", "gif", "png", "jpeg", "BMP", "JPG", "GIF", "PNG", "JPEG");
							$tempFile = $_FILES['gambar_toko']['tmp_name'];
							$fileName = time().$_FILES['gambar_toko']['name'];
							$pecah = explode(".", $fileName);
							$ekstensi = $pecah[1];
							$targetPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/toko/';
							$targetFile = $targetPath.$fileName;
							if (in_array($ekstensi, $extensionList))
							{
								if (move_uploaded_file($tempFile, $targetFile))
								{
									$dtoko['toko_gambar'] = $fileName;
								}
							}
							
							$this->db->where('user_id',$username);
							$q3 = $this->db->update('umkm_toko',$dtoko);

							if ($q2 && $q3)
							{
								echo "<script>alert('Data Toko berhasil diupdate !');window.location='".base_url('backend/toko')."'</script>";
							}
							else
							{
								echo "ADA YANG GAGAL";
							}
						}
						else
						{
							$hasil = $q->row_array();
							$data['toko']=$hasil;

							$this->db->where('akun_id',$hasil['toko_pemilik']);
							$data['akun']=$this->db->get('umkm_akun')->row_array();
							$this->load->view('backend/toko/toko_edit',$data);
						}
					}
					else
					{
						redirect(base_url('backend/toko'));
					}
				}
				else
				{
					redirect(base_url('backend/toko'));
				}
			}
			else if ($do=="submit")
			{
				//insert user
				$username = $this->input->post('username',TRUE);
				$pass1 = $this->input->post('password',TRUE);
				$pass2 = $this->input->post('password2',TRUE);
				$kate = $this->input->post('kategori',TRUE);
				$keca = $this->input->post('kecamatan',TRUE);

				$this->db->where('user_name',$username);
				$j=$this->db->get('umkm_user')->num_rows();

				if ($j>0)
				{
					echo "<script>alert('Username sudah digunakan !');window.history.back()</script>";
				}
				else
				{

					if ($pass1 != $pass2)
					{
						echo "<script>alert('Kombinasi Password tidak Tepat !');window.history.back()</script>";
					}
					
					else if ($keca == "0")
					{
						echo "<script>alert('Pilih Kecamatan Terlebih Dahulu !');window.history.back()</script>";
					}

					else if ($kate == "0")
					{
						echo "<script>alert('Pilih Kategori Terlebih Dahulu !');window.history.back()</script>";
					}
					else
					{
						$password = md5($pass1);
						$user['user_name']=strtolower($username);
						$user['user_pass']=md5($password);
						$user['user_role']="2";

						$q1 = $this->db->insert('umkm_user',$user);

						//insert akun
						$this->db->where('user_name',$username);
						$q = $this->db->get('umkm_user')->row_array();

						$akun['akun_nama']=$this->input->post('nama_akun',TRUE);
						$akun['akun_alamat']=$this->input->post('alamat_akun',TRUE);
						$akun['akun_email']=$this->input->post('email_akun',TRUE);
						$akun['akun_hp']="+62".$this->input->post('nohp_akun',TRUE);
						$akun['akun_bb']=$this->input->post('bb_akun',TRUE);
						$akun['akun_wa']=$this->input->post('wa_akun',TRUE);
						$akun['akun_line']=$this->input->post('line_akun',TRUE);
						$akun['user_id'] = $q['user_name'];

						$q2 = $this->db->insert('umkm_akun',$akun);

						//insert toko
						$this->db->where('user_id',$q['user_name']);
						$qq = $this->db->get('umkm_akun')->row_array();

						$dtoko['toko_pemilik']=$qq['akun_id'];
						$dtoko['toko_nama']=$this->input->post('nama_toko',TRUE);
						$dtoko['toko_alamat']=$this->input->post('alamat_toko',TRUE);
						$dtoko['toko_kecamatan']=$this->input->post('kecamatan',TRUE);
						$dtoko['toko_kategori']=$this->input->post('kategori',TRUE);
						$dtoko['toko_deskripsi']=$this->input->post('deskripsi_toko',TRUE);
						$dtoko['kode_prod']=strtoupper($this->input->post('kode_toko',TRUE));
						$dtoko['user_id'] = $q['user_name'];
						
						$extensionList = array("bmp", "jpg", "gif", "png", "jpeg", "BMP", "JPG", "GIF", "PNG", "JPEG");
						$tempFile = $_FILES['gambar_toko']['tmp_name'];
						$fileName = time().$_FILES['gambar_toko']['name'];
						$pecah = explode(".", $fileName);
						$ekstensi = $pecah[1];
						$targetPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/toko/';
						$targetFile = $targetPath.$fileName;
						if (in_array($ekstensi, $extensionList))
						{
							if (move_uploaded_file($tempFile, $targetFile))
							{
								$dtoko['toko_gambar'] = $fileName;
							}
						}

						$q3 = $this->db->insert('umkm_toko',$dtoko);

						if ($q1 && $q2 && $q3)
						{
							echo "<script>alert('Data Toko berhasil dibuat !');window.location='".base_url('backend/toko')."'</script>";
						}
						else
						{
							echo "ADA YANG GAGAL";
						}
					}
				}
			}
		}
	}

	public function update()
	{
		$id=$this->input->get('id');
		if ($id)
		{
			$this->db->where('toko_id',$id);
			$q=$this->db->get('umkm_toko');
			$j=$q->num_rows();

			if ($j>0)
			{
				$submit = $this->input->post('ubah',TRUE);
				if ($submit)
				{
					$username = $this->input->post('userid', TRUE);
					//update toko
					$dtoko['toko_nama']=$this->input->post('nama_toko',TRUE);
					$dtoko['toko_alamat']=$this->input->post('alamat_toko',TRUE);
					$dtoko['toko_kecamatan']=$this->input->post('kecamatan',TRUE);
					$dtoko['toko_kategori']=$this->input->post('kategori',TRUE);
					$dtoko['toko_deskripsi']=$this->input->post('deskripsi_toko',TRUE);
					$dtoko['kode_prod']=strtoupper($this->input->post('kode_toko',TRUE));
					
					$extensionList = array("bmp", "jpg", "gif", "png", "jpeg", "BMP", "JPG", "GIF", "PNG", "JPEG");
					$tempFile = $_FILES['gambar_toko']['tmp_name'];
					$fileName = time().$_FILES['gambar_toko']['name'];
					$pecah = explode(".", $fileName);
					$ekstensi = $pecah[1];
					$targetPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/toko/';
					$targetFile = $targetPath.$fileName;
					if (in_array($ekstensi, $extensionList))
					{
						if (move_uploaded_file($tempFile, $targetFile))
						{
							$dtoko['toko_gambar'] = $fileName;
						}
					}
					
					$this->db->where('user_id',$username);
					$q3 = $this->db->update('umkm_toko',$dtoko);

					if ($q3)
					{
						echo "<script>alert('Data Toko berhasil diupdate !');window.location='".base_url('backend/toko')."'</script>";
					}
					else
					{
						echo "ADA YANG GAGAL";
					}
				}
				else
				{
					$hasil = $q->row_array();
					$data['toko']=$hasil;

					$this->db->where('akun_id',$hasil['toko_pemilik']);
					$data['akun']=$this->db->get('umkm_akun')->row_array();
					$this->load->view('backend/toko/toko_edit',$data);
				}
			}
			else
			{
				redirect(base_url('backend/toko'));
			}
		}
		else
		{
			redirect(base_url('backend/toko'));
		}
	}

	public function toko1()
	{
		echo "This Is FAQ Settings";
	}

	public function kategori()
	{
		$get = $this->input->get();
		$del = $this->input->get('del',TRUE);
		if ($del)
		{
			$this->db->where('kat_toko_id',$del);
			$this->db->delete('umkm_toko_kategori');
			$this->session->set_flashdata('msg', "Data kategori toko telah dihapus");
			redirect(base_url('backend/toko/kategori'));
		}
		else if (!$get)
		{
			$this->form_validation->set_message('required', 'Kolom %s harus diisi');
			$this->form_validation->set_rules('kat_nama', 'Nama Kategori', 'required');
			if ($this->form_validation->run() == FALSE) 
			 {
				$this->load->view('backend/kategori/index');
			} 
			else 
			{
				var_dump($this->input->post());
				$kattoko = array(
				   'kat_toko_nama' => $this->input->post('kat_nama',TRUE)
				);
				$this->db->insert('umkm_toko_kategori', $kattoko); 
				//$this->output->enable_profiler(TRUE);
				
				$this->session->set_flashdata('msg', "Data kategori toko berhasil ditambahkan");
				redirect(base_url('backend/toko/kategori'));
			}
		}
		else
		{
			redirect(base_url('backend/toko/kategori'));
		}

	}

	public function get_username()
	{
		if (isset($_POST['username']))
	    {
	        $username = $_POST['username'];
	        $results = $this->toko_model->get_user($username);
	        if ($results === TRUE)
	            {
	                echo '<span style="color:red;">Username sudah digunakan</span>';
	            }
	            else
	                {
	                    echo '<span style="color:green;">Username tersedia</span>';
	                }
	     } 
	     else {
	            echo '<span style="color:red;">Username harus diisi</span>';
	          }
		}

	public function get_kode()
	{
		if (isset($_POST['kode_toko']))
	    {
	        $kode = $_POST['kode_toko'];
	        $results = $this->toko_model->get_kode($kode);
	        if ($results === TRUE)
	            {
	                echo '<span style="color:red;">Kode Toko sudah digunakan</span>';
	            }
	            else
	                {
	                    echo '<span style="color:green;">Kode Toko tersedia</span>';
	                }
	     } 
	     else {
	            echo '<span style="color:red;">Kode Toko harus diisi</span>';
	          }
		}

	public function pemilik()
	{
		$id=$this->input->get('id');
		if ($id)
		{
			$this->db->where('toko_id',$id);
			$q=$this->db->get('umkm_toko');
			$j=$q->num_rows();

			if ($j>0)
			{
				$submit = $this->input->post('ubah',TRUE);
				if ($submit)
				{
					$username = $this->input->post('userid', TRUE);
					//update akun
					$akun['akun_nama']=$this->input->post('nama_akun',TRUE);
					$akun['akun_alamat']=$this->input->post('alamat_akun',TRUE);
					$akun['akun_ktp']=$this->input->post('no_ktp',TRUE);
					$akun['akun_email']=$this->input->post('email_akun',TRUE);
					$akun['akun_hp']=$this->input->post('nohp_akun',TRUE);
					$akun['akun_bb']=$this->input->post('bb_akun',TRUE);
					$akun['akun_wa']=$this->input->post('wa_akun',TRUE);
					$akun['akun_line']=$this->input->post('line_akun',TRUE);

					$this->db->where('user_id',$username);
					$q2 = $this->db->update('umkm_akun',$akun);

					if ($q2)
					{
						echo "<script>alert('Data Toko berhasil diupdate !');window.location='".base_url('backend/toko')."'</script>";
					}
					else
					{
						echo "ADA YANG GAGAL";
					}
				}
				else
				{
					$hasil = $q->row_array();
					$data['toko']=$hasil;

					$this->db->where('akun_id',$hasil['toko_pemilik']);
					$data['akun']=$this->db->get('umkm_akun')->row_array();
					$this->load->view('backend/akun/akun_edit',$data);
				}
			}
			else
			{
				redirect(base_url('backend/dashboard'));
			}
		}
		else
		{
			redirect(base_url('backend/dashboard'));
		}
	}
}
