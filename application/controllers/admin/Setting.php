<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			error_reporting(0);
			if (!$this->session->userdata('logged_in')) {
			  redirect(base_url('login'));
			}

			// if ($this->session->userdata('user_role')!="ADMIN")
			// {
			//   redirect(base_url('login'));
			// }
		}

	public function index()
	{
		redirect(base_url('login'));
	}

	public function web(){
		$go = $this->input->get('go');
		if (!$go){
			$this->load->view('admin/detail_website');
		}
		
		else {
			$this->form_validation->set_message('required', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Kolom %s harus diisi</div>');

			$this->form_validation->set_rules('judul', 'judul', 'required');
			$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/detail_website');
			}
			
			else {
				$detail_id = "22";
				$data['web_judul'] = strip_tags($this->input->post('judul', TRUE));
				$data['web_deskripsi'] = strip_tags($this->input->post('deskripsi', TRUE));
				
				// $tempFile = $_FILES['logo']['tmp_name'];
				// $fileName = time().$_FILES['logo']['name'];
				// $targetPath = $_SERVER['DOCUMENT_ROOT'].'/uploads';
				// $targetFile = $targetPath.$fileName ;
				// if (move_uploaded_file($tempFile, $targetFile))
				// {
				// 	$data['web_logo'] = $fileName;
				// }

				$this->db->where('idkhusus', $detail_id);
				$this->db->update('sembio_web', $data);
				redirect(base_url('admin/setting/web'));
			}
		}
	}

	public function visi(){
		$go = $this->input->get('go');
		if (!$go){
			$this->load->view('backend/konfigurasi_frontend/visi_misi');
		}
		
		else {
			$this->form_validation->set_message('required', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Kolom %s harus diisi</div>');

			$this->form_validation->set_rules('visi', 'visi', 'required');
			$this->form_validation->set_rules('misi', 'misi', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('backend/konfigurasi_frontend/visi');
			}
			
			else {
				$detail_id = "1";
				$data['visi'] = $this->input->post('visi', TRUE);
				$data['misi'] = $this->input->post('misi', TRUE);
				
				$this->db->where('id', $detail_id);
				$this->db->update('umkm_visimisi', $data);
				redirect(base_url('backend/setting/visi'));
			}
		}
	}

	public function alur(){
		$go = $this->input->get('go');
		if (!$go){
			$this->load->view('backend/konfigurasi_frontend/alur');
		}
		
		else {
			$this->form_validation->set_message('required', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Kolom %s harus diisi</div>');
			
			$detail_id = "1";
			$tempFile = $_FILES['alur']['tmp_name'];
			$fileName = time().$_FILES['alur']['name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/umkm/uploads/alur/';
			$targetFile = $targetPath.$fileName ;
			if (move_uploaded_file($tempFile, $targetFile))
			{
				$data['alur'] = $fileName;
			}

			$this->db->where('id', $detail_id);
			$this->db->update('umkm_alur', $data);
			redirect(base_url('backend/setting/alur'));
		}
	}
	
	public function faq(){
		$do = $this->input->get('do');
		$go = $this->input->get('go');
		
		if (!$do){
			$this->load->view('backend/konfigurasi_frontend/faq');
		}
		
		else if ($do == "add") {
			if (!$go){
				$this->load->view('backend/konfigurasi_frontend/faq_tambah');
			}
			else {
				$this->form_validation->set_message('required', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Kolom %s harus diisi</div>');
				
				$this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'required');
				$this->form_validation->set_rules('jawaban', 'jawaban', 'required');
				
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('backend/konfigurasi_frontend/faq_tambah');
				}
				else {
					$data['pertanyaan'] = $this->input->post('pertanyaan', TRUE);
					$data['jawaban'] = $this->input->post('jawaban', TRUE);
					$tampil_faq = $this->input->post('tampil_faq');
					
					if ($tampil_faq == '1'){
						$data['status'] = "1";
						$this->db->insert('umkm_faq', $data);
						redirect(base_url('backend/setting/faq'));
					}
					else {
						$data['status'] = "0";
						$this->db->insert('umkm_faq', $data);
						redirect(base_url('backend/setting/faq'));
					}
				}
			}
		}
		
		else if ($do == "edit"){
			$id = $this->input->get('id');
			if (!$go){
				$this->load->view('backend/konfigurasi_frontend/faq_tambah');
			}
			
			else if ($go == "process"){
				$id = $this->input->get('id');
				$this->form_validation->set_message('required', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Kolom %s harus diisi</div>');
				
				$this->form_validation->set_rules('pertanyaan1', 'pertanyaan1', 'required');
				$this->form_validation->set_rules('jawaban1', 'jawaban1', 'required');
				
				if ($this->form_validation->run() == FALSE) {
					$data['id'] = $id;
					$this->load->view('backend/konfigurasi_frontend/faq_tambah');
				}
				else {
					$data['pertanyaan'] = $this->input->post('pertanyaan1', TRUE);
					$data['jawaban'] = $this->input->post('jawaban1', TRUE);
					
					$this->db->where('id', $id);
					$this->db->update('umkm_faq', $data);
					redirect(base_url('backend/setting/faq'));
				}
			}
		}
		
		else if ($do == "delete"){
			$id = $this->input->get('id');
			
			$this->db->query("DELETE FROM umkm_faq WHERE id = '$id'");
			redirect(base_url('backend/setting/faq'));
		}
		
		$status_off = $this->input->get('status_off');
		if ($status_off) 
		{				  				  
			$data['status'] ="0";
				  				 
			$this->db->where('id', $status_off);
			$this->db->update('umkm_faq', $data); 
			redirect(base_url('backend/setting/faq'));				
		}
			 		
		$status_on = $this->input->get('status_on');
		if ($status_on) 
		{				  				  
			$data['status'] ="1";
				  				 
			$this->db->where('id', $status_on);
			$this->db->update('umkm_faq', $data); 
			redirect(base_url('backend/setting/faq'));
		}
	}
}