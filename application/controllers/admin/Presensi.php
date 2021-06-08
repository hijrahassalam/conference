<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi extends CI_Controller {
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
		$row=$this->db->get('presensi_pemakalah');
		foreach ($row->result_array() as $r)
		{
			$pes[]=$r['idpes'];
		}

		$row2=$this->db->get('presensi_pemakalah_co');
		foreach ($row2->result_array() as $r2)
		{
			$co[]=$r2['idpes']."-".$r2['idco'];
		}
		$info['hadir']=$pes;
		$info['cohadir']=$co;
		$this->load->view('admin/presensi/index',$info);
	}

	public function save()
	{
		$simpan=$this->input->post('simpan',TRUE);
		if ($simpan)
		{
			$author=$this->input->post('presensi');
			$co=$this->input->post('presensico');
			$cek = $this->db->get('presensi_pemakalah')->num_rows();
			$cek2 = $this->db->get('presensi_pemakalah_co')->num_rows();
			if ($cek>0)
			{
				$this->db->where('id !=','')->delete('presensi_pemakalah');
			}
			if ($cek2>0)
			{
				$this->db->where('id !=','')->delete('presensi_pemakalah_co');
			}
			for($j=0;$j<count($author);$j++)
			{
				$info['idpes']=$author[$j];
				$info['dateinput']=date('Y-m-d H:i:s');
				$this->db->insert('presensi_pemakalah',$info);
			}
			for ($j=0;$j<count($co);$j++)
			{
				$pecah=explode('-',$co[$j]);
				$info2['idpes']=$pecah[0];
				$info2['idco']=$pecah[1];
				$info2['dateinput']=date('Y-m-d H:i:s');
				$this->db->insert('presensi_pemakalah_co',$info2);
			}
			redirect(base_url('admin/presensi'));
		}
		else
		{
			redirect(base_url('admin/presensi'));
		}
	}

}