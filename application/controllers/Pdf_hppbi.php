<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
			  //       include (FCPATH.'/vendor/autoload.php');
			  //       use Spipu\Html2Pdf\Html2Pdf;
					// use Spipu\Html2Pdf\Exception\Html2PdfException;
					// use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Pdf_hppbi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	    //Load the library
	    //$this->load->library('html2pdf');
	    // $this->load->model('account_model');

	}
	public function index()
    {
    	echo '<a href="'.base_url('pdf_hppbi/hppbi').'" target="_blank">Pdf hppbi (done)</a><br>';
	    
    } 

    public function test()
    {
    	echo phpinfo();
    }
    public function hppbi($id=null,$no=null,$ins=null,$aktif=null,$photo=null)
    {
    	if ($id)
    	{
    		$ar=$id;
    		$query=1;
    		// $query = $this->db->where(array('id'=>$id,'status_keanggotaan'=>'1'))->get('registrasi');
    		if ($query>0)
    		{

			    	// $path = 'files/';
			    	// $filename = 'hppbi.pdf';
			    	// $path_filename = $path.$filename;
				    
				    // //Set folder to save PDF to
				    // $this->html2pdf->folder('./'.$path);
				    
				    // //Set the filename to save/download as
				    // $this->html2pdf->filename($filename);
				    
				    // //Set the paper defaults
				    // $this->html2pdf->paper(array(86,54), 'portrait');
				    
				    // $data = array(
				    // 	'title' => 'hppbi',
				    // 	'message' => 'Hello World!'
				    // );
				    
				    // //Load html view
				    // $this->html2pdf->html($this->load->view('pdf/hppbi', $data, true));
				    
				    // if($this->html2pdf->create('save')) {
				    // 	//PDF was successfully saved or downloaded
				    // 	echo 'Pdf hppbi dibuat <a href="'.base_url($path_filename).'" target="_blank">buka pdf</a>';;
				    // }
				    ob_start();
				    // $rowdata=$query->row_array();
			        include(APPPATH.'views/pdf/hppbi.php');
			        $content = ob_get_clean();

			        

			        // convert in PDF
			        //require_once(dirname(__FILE__).'/html2pdf.class.php');
			        include (APPPATH.'third_party/html2pdf/html2pdf.class.php');
			        try
			        {
			            $html2pdf = new HTML2PDF('L', array(86,54), 'en' , false, 'ISO-8859-15', array(0,0,0,0));
						//$html2pdf->setModeDebug();
			            $html2pdf->pdf->SetDisplayMode('fullpage');
			            $html2pdf->setDefaultFont('times');
			            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			            $html2pdf->Output('idcard.pdf');
			        }
			        catch(HTML2PDF_exception $e) {
			            echo $e;
			            exit;
			        }
			     }
			     else
			     {
			     		echo "<script>alert('Anda belum berhak mencetak ID Card');window.location='".base_url('panel')."'</script>";
			     }

    	}
    	else
    	{
    		redirect(base_url('panel'));
    	}
    }
    public function html()
    {
    	$this->load->view('pdf/hppbi');
    }
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */