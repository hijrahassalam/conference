<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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
			$query=$this->db->get('umkm_produk');
			$data['query']=$query;
			$this->load->view('backend/produk/index',$data);
		}
		else if ($do)
		{
			if ($do=="add")
			{
				$data['toko_id']=$this->toko_model->get_toko_id();
				$data['kode_prod']=$this->produk_model->get_kode_produk($data['toko_id']);
				$this->load->view('backend/produk/produk_tambah',$data);
			}
			else if ($do=="del")
			{
				$id=$this->input->get('id');
				if ($id)
				{
					$this->db->where('produk_kode',$id);
					$q=$this->db->get('umkm_produk');
					$j=$q->num_rows();

					if ($j>0)
					{
						$this->db->where('produk_kode',$id);
						$d3 = $this->db->delete('umkm_produk');

						echo "<script>window.location='".base_url('backend/produk')."'</script>";
					}
					else
					{
						redirect(base_url('backend/produk'));
					}
				}
				else
				{
					redirect(base_url('backend/produk'));
				}
			}
			else if ($do=="edit")
			{
				$id=$this->input->get('id');
				if ($id)
				{
					$this->db->where('produk_kode',$id);
					$q=$this->db->get('umkm_produk');
					$j=$q->num_rows();

					if ($j>0)
					{
						$hasil = $q->row_array();
						$data['produk']=$hasil;
						$this->load->view('backend/produk/produk_edit',$data);
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
				$kodeprod=$this->input->post('kodeprod',TRUE);
				$tokoid=$this->input->post('tokoid',TRUE);
				$warna=$this->input->post('warna',TRUE);
				$tag=$this->input->post('tag_produk',TRUE);
				$harga=$this->input->post('harga_produk',TRUE);
				$panjang=$this->input->post('panjang',TRUE);
				$lebar=$this->input->post('lebar',TRUE);
				$tinggi=$this->input->post('tinggi',TRUE);
				$berat=$this->input->post('berat',TRUE);
				$namaprod=$this->input->post('nama_produk',TRUE);
				$ket=$this->input->post('ket_produk',TRUE);

				$tanggal = date('Y-m-d');
				
				$data['produk_kode']=$kodeprod;
				$data['produk_nama']=$namaprod;
				if ($panjang=="")
				{
					$panjang="0";
				}
				if ($lebar=="")
				{
					$lebar="0";
				}
				if ($tinggi=="")
				{
					$tinggi="0";
				}
				if ($berat=="")
				{
					$berat="0";
				}
				if ($warna=="")
				{
					$warnaa="";
				}
				else
				{
					$warnaa=implode(',',$warna);
				}
				if ($tag=="")
				{
					$taag="";
				}
				else
				{
					$taag=implode(',',$tag);
				}
				$data['produk_ukuran']=$panjang." x ".$lebar." x ".$tinggi;
				$data['produk_warna']=$warnaa;
				$data['produk_harga']=$harga;
				$data['produk_berat']=$berat;
				$data['produk_deskripsi']=$ket;
				$data['produk_tag']=$taag;
				$data['id_toko']=$tokoid;
				$data['tgl_add']=$tanggal;

				$extensionList = array("bmp", "jpg", "gif", "png", "jpeg", "BMP", "JPG", "GIF", "PNG", "JPEG");
				$tempFile = $_FILES['gambar_produk']['tmp_name'];
				$fileName = $tokoid."_".time().$_FILES['gambar_produk']['name'];
				$pecah = explode(".", $fileName);
				$ekstensi = $pecah[1];
				$targetPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/produk/';
				$targetFile = $targetPath.$fileName;
				if (in_array($ekstensi, $extensionList))
				{
					if (move_uploaded_file($tempFile, $targetFile))
					{
						$data['produk_gambar'] = $fileName;
						$this->db->insert('umkm_produk',$data);
						echo "<script>alert('Data Produk Berhasil ditambahkan');window.location='".base_url('backend/produk')."'</script>";
					}
				}
				else
				{
					echo "<script>alert('File yang Anda upload bukan file gambar');window.history.back()</script>";
				}

				
				//echo $kodeprod."<br/>".$warnaa."<br/>".$harga."<br/>".$taag;
			}
			else if ($do=="update")
			{
				$kodeprod=$this->input->post('kodeprod',TRUE);
				$tokoid=$this->input->post('tokoid',TRUE);
				$warna=$this->input->post('warna',TRUE);
				$tag=$this->input->post('tag_produk',TRUE);
				$harga=$this->input->post('harga_produk',TRUE);
				$panjang=$this->input->post('panjang',TRUE);
				$lebar=$this->input->post('lebar',TRUE);
				$tinggi=$this->input->post('tinggi',TRUE);
				$berat=$this->input->post('berat',TRUE);
				$namaprod=$this->input->post('nama_produk',TRUE);
				$ket=$this->input->post('ket_produk',TRUE);
				
				$data['produk_nama']=$namaprod;
				if ($panjang=="")
				{
					$panjang="0";
				}
				if ($lebar=="")
				{
					$lebar="0";
				}
				if ($tinggi=="")
				{
					$tinggi="0";
				}
				if ($berat=="")
				{
					$berat="0";
				}
				if ($warna=="")
				{
					$warnaa="";
				}
				else
				{
					$warnaa=implode(',',$warna);
				}
				if ($tag=="")
				{
					$taag="";
				}
				else
				{
					$taag=implode(',',$tag);
				}
				$data['produk_ukuran']=$panjang." x ".$lebar." x ".$tinggi;
				$data['produk_warna']=$warnaa;
				$data['produk_harga']=$harga;
				$data['produk_berat']=$berat;
				$data['produk_deskripsi']=$ket;
				$data['produk_tag']=$taag;
				$data['id_toko']=$tokoid;

				$extensionList = array("bmp", "jpg", "gif", "png", "jpeg", "BMP", "JPG", "GIF", "PNG", "JPEG");
				$tempFile = $_FILES['gambar_produk']['tmp_name'];
				$fileName = $tokoid."_".time().$_FILES['gambar_produk']['name'];
				$pecah = explode(".", $fileName);
				$ekstensi = $pecah[1];
				$targetPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/produk/';
				$targetFile = $targetPath.$fileName;
				if (in_array($ekstensi, $extensionList))
				{
					if (move_uploaded_file($tempFile, $targetFile))
					{
						$data['produk_gambar'] = $fileName;
					}
				}

				$this->db->where('produk_kode',$kodeprod);
				$this->db->update('umkm_produk',$data);
				echo "<script>alert('Data Produk Berhasil diupdate');window.location='".base_url('backend/produk')."'</script>";

				
				//echo $kodeprod."<br/>".$warnaa."<br/>".$harga."<br/>".$taag;
			}
		}
	}

	public function modal()
	{
		$id=$this->input->post('id');

		$this->db->where('produk_kode',$id);
		$row=$this->db->get('umkm_produk')->row_array();

		echo "
		<table class='table table-bordered table-responsive' width='70%' style='margin:0px auto'>
		<tr>
			<td width='30%'><b>Kode Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>".$row['produk_kode']."</td>
		</tr>
		<tr>
			<td width='30%'><b>Nama Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>".$row['produk_nama']."</td>
		</tr>
		<tr>
			<td width='30%'><b>Ukuran Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>".$row['produk_ukuran']." cm</td>
		</tr>
		<tr>
			<td width='30%'><b>Warna Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>".$this->produk_model->get_warna($row['produk_warna'])."</td>
		</tr>
		<tr>
			<td width='30%'><b>Berat Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>".$row['produk_berat']." kg</td>
		</tr>
		<tr>
			<td width='30%'><b>Harga Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>Rp. ".$row['produk_harga']."</td>
		</tr>
		<tr>
			<td width='30%'><b>Gambar Produk</td>
			<td width='2%'>=</td>
			<td width='68%'><img src='".base_url('uploads/produk/'.$row['produk_gambar'].'')."' height='150px' width='150px'></td>
		</tr>
		<tr>
			<td width='30%'><b>Deskripsi Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>".$row['produk_deskripsi']."</td>
		</tr>
		<tr>
			<td width='30%'><b>Tag Produk</td>
			<td width='2%'>=</td>
			<td width='68%'>".$row['produk_tag']."</td>
		</tr>
		</table>";
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
}
