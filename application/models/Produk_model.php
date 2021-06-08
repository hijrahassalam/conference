<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_model extends CI_Model {

    // cek keberadaan user di sistem
    public function get_kode_produk($toko_id)
    {
        //ambil kode
        $this->db->where('toko_id',$toko_id);
        $query = $this->db->get('umkm_toko')->row_array();

        $kode=$query['kode_prod'];

        //buat urut
        $q = $this->db->query("SELECT produk_kode from umkm_produk where produk_kode LIKE '".$kode."%' order by produk_kode desc");
        $h = $q->row_array();
        $j = $q->num_rows();

        if ($j==0)
        {
            $kodeprod=$kode."0001";
        }
        else if ($j>0)
        {
            $kodee=$h['produk_kode'];
            //ambil 4 angka terakhir
            $angka=substr($kodee,4,4);

            //pecah lagi untuk ambil yang bisa di tambahkan
            $in=substr($angka,3);

            //tambahkan 1
            $inn=$in+1;

            //hitung jumlah inn
            $jumin=strlen($inn);

            //hasil akhir
            if ($jumin==1)
            {
                $angkaa="000".$inn;
            }
            else if ($jumin==2)
            {
                $angkaa="00".$inn;
            }
            else if ($jumin==3)
            {
                $angkaa="0".$inn;
            }
            else if ($jumin==4)
            {
                $angkaa=$inn;
            }

            

            $kodeprod=$kode.$angkaa;
        }

        return $kodeprod;
    }

    public function get_warna($array)
    {
        $ar=explode(',', $array);
        $n=count($ar);

        if ($n==0)
        {
            $warna="";
        }
        else 
        {
            $ganti=array();
            $pecah=$ar;
            for($i=0;$i<$n;$i++)
            {
                $this->db->where('warna_kode',$pecah[$i]);
                $q=$this->db->get('ref_warna_produk')->row_array();
                $ganti[]=$q['warna_nama'];
            }
            $warna=implode(',',$ganti);
        }

        return $warna;
    }

    public function get_random()
    {
        $this->db->order_by('produk_kode', 'RANDOM');
        $this->db->limit(6);
        $query = $this->db->get('umkm_produk');
        return $query->result_array();
    }

    public function get_from_toko($toko, $num, $offset)
    {
        $this->db->where('id_toko',$toko);
        $this->db->order_by('produk_kode', 'asc');
        $query = $this->db->get('umkm_produk',$num,$offset);
        return $query->result_array();
    }

    public function jumlah_produk_toko($toko)
    {
        $this->db->where('id_toko',$toko);
        $query = $this->db->get('umkm_produk');
        return $query->num_rows();
    }
}