<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toko_model extends CI_Model {

    // cek keberadaan user di sistem
    public function get_user($username)
    {
        $this->db->select('*');
        $this->db->from('umkm_user');
        $this->db->where('user_name',$username);
        $query = $this->db->get();
        $result = $query->row();
        if ($result)
        {
         return TRUE;
        }
        else 
         {
            return FALSE;
        }

    }

    public function get_kode($kode)
    {
        $this->db->select('*');
        $this->db->from('umkm_toko');
        $this->db->where('kode_prod',$kode);
        $query = $this->db->get();
        $result = $query->row();
        if ($result)
        {
         return TRUE;
        }
        else 
         {
            return FALSE;
        }

    }

    public function toko_kategori($kattoko)
    {
        $this->db->where('kat_toko_id',$kattoko);
        $query = $this->db->get('umkm_toko_kategori')->row_array();

        return $query['kat_toko_nama'];
    }

    public function toko_kecamatan($kec)
    {
        $this->db->where('kec_id',$kec);
        $query = $this->db->get('ref_kecamatan')->row_array();

        return $query['kec_nama'];
    }

    public function toko_pemilik($idpem)
    {
        $this->db->where('akun_id',$idpem);
        $query = $this->db->get('umkm_akun')->row_array();

        return $query['akun_nama'];
    }

    public function toko_nama($idtoko)
    {
        $this->db->where('toko_id',$idtoko);
        $query = $this->db->get('umkm_toko')->row_array();

        return $query['toko_nama'];
    }

    public function idtoko_to_kategori($idtoko)
    {
        $query = $this->db->query("select b.kat_toko_nama from umkm_toko a, umkm_toko_kategori b where a.toko_kategori=b.kat_toko_id AND a.toko_id='$idtoko'")->row_array();

        return $query['kat_toko_nama'];
    }

    public function idtoko_to_kategori_id($idtoko)
    {
        $query = $this->db->query("select b.kat_toko_id from umkm_toko a, umkm_toko_kategori b where a.toko_kategori=b.kat_toko_id AND a.toko_id='$idtoko'")->row_array();

        return $query['kat_toko_id'];
    }

    public function toko_milik_user()
    {
        $usname=$this->session->userdata('user_name');
        $this->db->where('user_id',$usname);
        $query = $this->db->get('umkm_toko')->row_array();

        return $query['toko_nama'];
    }

    public function get_toko_id()
    {
        $uname=$this->session->userdata('user_name');
        $this->db->where('user_id',$uname);
        $query = $this->db->get('umkm_toko')->row_array();

        return $query['toko_id'];
    }
	
	public function get_toko_from_kategori($cat, $num, $offset)
    {
        $this->db->where('toko_kategori',$cat);
        $this->db->order_by('toko_nama', 'random');
        $query = $this->db->get('umkm_toko',$num,$offset);
        return $query->result_array();
    }
	
	public function jumlah_toko_per_kategori($cat)
	{
		$this->db->where('toko_kategori',$cat);
		$query=$this->db->get('umkm_toko')->num_rows();
		
		return $query;
	}
}