<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info_pasar extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			if (!$this->session->userdata('logged_in')) {
			  redirect(base_url('login'));
			}

			if ($this->session->userdata('user_role')!="ADMIN")
			{
			  redirect(base_url('login'));
			}
		}

	public function index()
	{
		$do = $this->input->get('do');
		$get = $this->input->get();

        if (!$get) 
		{
			$this->load->view('backend/konfigurasi_frontend/info_pasar');
        } 
		else if ($do == 'add') 
		{
			$go = $this->input->get('go');
			if (!$go) 
			{
				$this->load->view('backend/konfigurasi_frontend/info_pasar_tambah');
			} 
			else if ($go == 'process') 
			{
				$this->form_validation->set_message('required', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Kolom %s harus diisi</div>');

				$this->form_validation->set_rules('judul_berita', 'Judul', 'required');
				$this->form_validation->set_rules('isi_berita', 'Isi', 'required');
           

				if ($this->form_validation->run() == FALSE) 
				{
					$this->load->view('backend/konfigurasi_frontend/info_pasar_tambah');
				} 
				else 
				{
					$status = $this->input->post('tampil_berita', TRUE);
					if ($status=="ON")
					{
						$statuus="ON";
					}
					else
					{
						$statuus="OFF";
					}
					$data['judul'] = $this->input->post('judul_berita', TRUE);
					$data['isi'] = $this->input->post('isi_berita', TRUE);
					$data['status'] = $statuus;
					$data['tanggal'] = date('Y-m-d H:i:s');
              

					$this->db->insert('umkm_info_pasar', $data);
					redirect(base_url('backend/info_pasar'));
				}
			}
        }
		
		else if ($do == 'edit') 
		{
			$go = $this->input->get('go');
			$id = $this->input->get('id');
			if (!$go && $id) 
			{
				$data['id'] = $id;
				$this->load->view('konfigurasi_beranda/berita_edit', $data);
			} 
			else if ($go == 'process' && $id) 
			{
				$this->form_validation->set_message('required', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Kolom %s harus diisi</div>');

				$this->form_validation->set_rules('judul_berita', 'Judul', 'required');
				$this->form_validation->set_rules('isi_berita', 'Isi', 'required');
				
				if ($this->form_validation->run() == FALSE) 
				{
					$data['id'] = $id;
					$this->load->view('konfigurasi_beranda/berita_edit', $data);
				} 
				else 
				{
					$data['judul'] = $this->input->post('judul_berita', TRUE);
					$data['isi'] = $this->input->post('isi_berita', TRUE);
					$data['status'] = $this->input->post('tampil_berita', TRUE);
					$data['tanggal'] = date('Y-m-d H:i:s');
				 
					$this->db->where('berita_id', $id);
					$this->db->update('ppcks_berita_beranda', $data); 
					redirect(base_url('konfigurasi_beranda/berita'));
				}
			}
		}

			//tampil atau tidak tampil
			 $status_off = $this->input->get('status_off');
			 if ($status_off) {				  				  
				  $data['status'] ="0";
				  				 
				  $this->db->where('berita_id', $status_off);
				  $this->db->update('ppcks_berita_beranda', $data); 
				  redirect(base_url('konfigurasi_beranda/berita'));				
			 }
			 		
			 $status_on = $this->input->get('status_on');
			 if ($status_on) {				  				  
				  $data['status'] ="on";
				  				 
				  $this->db->where('berita_id', $status_on);
				  $this->db->update('ppcks_berita_beranda', $data); 
				  redirect(base_url('konfigurasi_beranda/berita'));
			 }		
	}
}