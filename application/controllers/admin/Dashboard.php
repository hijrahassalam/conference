<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			// if (!$this->session->userdata('logged_in')) {
			//  redirect(base_url('index.php/login'));
			// }
		}

	public function index()
	{
		//var_dump($this->session->userdata());
		$kelas_id = $this->input->get('kelas');
		$data['kelas_id']=$kelas_id;
		
		if($kelas_id)
		{
			$cek = $this->db->query("SELECT kelas_id FROM ppcks_kelas_akademik WHERE kelas_id='$kelas_id'")->row_array();
			$cek_ada = $cek['kelas_id'];
			
			if($cek_ada != NULL)
			{
				$this->load->view('kalender/index',$data);
			} else
			{
				redirect(base_url("dashboard"));
			}
			
			
		} else
		{
			$q=$this->db->query("select b.kat_nama, count(a.no) as jum from registrasi a, ref_kategori b where a.kategori=b.kat_id GROUP BY a.kategori")->result_array();
			$data['query']=$q;
			$jumpeserta=$this->db->get('registrasi')->num_rows();
			$data['jumabstrak']=$this->db->query("select * from registrasi where abstrak IS NOT NULL")->num_rows();
			$data['abstrak']=$this->db->query("select * from registrasi where status_abstrak='3'")->num_rows();
			$data['jumfullpaper']=$this->db->query("select * from registrasi where fullpaper IS NOT NULL")->num_rows();
			$data['fullpaper']=$this->db->query("select * from registrasi where status_fullpaper='3'")->num_rows();

			$data['persenjumabstrak']=($data['jumabstrak'] / $jumpeserta) * 100;
			$data['persenabstrak']=($data['abstrak'] / $data['jumabstrak']) * 100;
			$data['persenjumfull']=($data['jumfullpaper'] / $data['jumabstrak']) * 100;
			$data['persenfull']=($data['fullpaper'] / $data['jumfullpaper']) * 100;

			$data['buktiverif']=$this->db->query("select no from registrasi where status_bukti='2'")->num_rows();
			$data['buktinonverif']=$this->db->query("select no from registrasi where status_bukti!='2' AND buktibayar!=''")->num_rows();
			$data['blmbuktibayar']=$this->db->query("select no from registrasi where buktibayar IS NULL")->num_rows();

			//jumlah bukti
			$totaall=0;
			$katpem=$this->account_model->kategori('pemakalah');
			foreach ($this->db->query("select no,kategori,tglabstrak,tanggal,prosiding from registrasi where status_bukti='2'")->result_array() as $row)
			{
				$biayacoauthor=0;
				if (in_array($row['kategori'],$this->account_model->kategori('pemakalah')))
				{
					$harga=$this->account_model->biaya_registrasi($row['no'],$row['kategori'],$row['tglabstrak']);
					$biayacoauthor=$this->account_model->biaya_co_author($row['no']);
				}
				else
				{
					$harga=$this->account_model->biaya_registrasi($row['no'],$row['kategori'],$row['tanggal']);
				}

				if ($row['prosiding']=="1")
				{
					$prosidingpesan=$this->account_model->biaya_prosiding("prosiding");
				}
				else
				{
					$prosidingpesan="0";
				}

				$totalakhir=$harga+$prosidingpesan+$biayacoauthor;
				$totaall=$totaall+$totalakhir;
			}
			$data['totaluang']=$totaall;
			$data['data']=$this->db->query("select b.kat_id, count(*) AS jum from registrasi a left join ref_kategori b ON a.kategori=b.kat_id WHERE kategori IS NOT NULL GROUP BY a.kategori")->result_array();
			$data['bidang']=$this->db->query("select b.bidang, count(*) AS jum from registrasi a left join ref_bidang b ON a.bidang_ilmu=b.id WHERE a.bidang_ilmu IS NOT NULL AND bidang IS NOT NULL GROUP BY a.bidang_ilmu")->result_array();
			$this->load->view('backend/index',$data);
		}
		
		
		
	}
}