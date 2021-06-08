<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Undangan extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			//if (!$this->session->userdata('logged_in')) {
			//  redirect(base_url('login'));
			//}
		}

	public function index()
	{
		$idd=$this->input->get('id');
		$id=substr($idd,32);
		if ($id)
		{	
			if ($id==$this->session->userdata('peserta_id') OR $this->session->userdata('logged_in')!="")
			{
				ob_start();
				$data=$this->db->query("SELECT a.*,b.is_pemakalah from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id WHERE no='".$id."'")->row_array();
				// $data=$this->db->where('no',$id)->get('registrasi')->row_array();
				if ($data['is_pemakalah']=="1")
				{
					include(APPPATH.'/views/undangan/abstrak_lolos.php');
				}
				else
				{
					include(APPPATH.'/views/undangan/nonpemakalah.php');
				}
				$content = ob_get_clean();

				// convert in PDF
				//require_once(dirname(__FILE__).'/html2pdf.class.php');
				include (APPPATH.'/third_party/html2pdf/html2pdf.class.php');
				try
				{
					$html2pdf = new HTML2PDF('P', 'A4', 'fr');
			//      $html2pdf->setModeDebug();
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->setDefaultFont('times');
					$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
					$html2pdf->Output('undangan_sembioXVI.pdf');
				}
				catch(HTML2PDF_exception $e) {
					echo $e;
					exit;
				}
			}
			else
			{
				redirect(base_url(''));
			}
		}
		else
		{
			redirect(base_url(''));
		}
	}
	
}