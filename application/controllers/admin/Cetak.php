<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session','phpexcel'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			if (!$this->session->userdata('logged_in')) {
			 redirect(base_url('login'));
			}
		}

	public function index()
	{
		$this->load->view('admin/cetak/index');
	}

	public function tes()
	{
		// require APPPATH.'third_party/phpexcel/PHPExcel.php';
		$excel = PHPExcel_IOFactory::createReader('Excel2007');
		$excel = $excel->load('./uploads/template/presensi_pemakalah.xlsx');

		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$objWriter->setPreCalculateFormulas(TRUE);
		//PHPExcel_Calculation::getInstance($objPHPExcel)->clearCalculationCache();
		$objWriter->save('php://output');
	}

	public function download()
	{
		$abstrak = $this->input->post('presabs');
		$presabsbuk = $this->input->post('presabsbuk');
		$presabsbukfull = $this->input->post('presabsbukfull');
		$non=$this->input->post('prenon');
		$semkit=$this->input->post('semkitpem');
		if ($abstrak || $presabsbuk || $presabsbukfull)
		{
			// error_reporting(E_ALL);
			// ini_set('display_errors', TRUE);
			// ini_set('display_startup_errors', TRUE);

			header("Content-type: application/vnd.ms-excel");
			//nama file
			header("Content-Disposition: attachment; filename=presensi_pemakalah.xlsx");
			header('Cache-Control: max-age=0');

			$excel = PHPExcel_IOFactory::createReader('Excel2007');
			$excel = $excel->load('./uploads/template/presensi_pemakalah.xlsx');

			$excel->setActiveSheetIndex(0);
			$excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			$border = array (
			'borders' => array (
								'allborders' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);

			$outline = array (
			'borders' => array (
								'outline' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);
			$JudulTable = array (
			'alignment' => array (
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
					),
			'font' => array(
					   'name'  => 'Arial',
					   'size' => 11,
					   'bold' => true
					),
			'fill' => array(
				          'type' => PHPExcel_Style_Fill::FILL_SOLID,
				          'color' => array('rgb' => 'BFBFBF')
				        ),
			'borders' => array (
								'outline' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);

			$excel->getActiveSheet()->setCellValue('A1','PRESENSI PEMAKALAH SEMINAR NASIONAL '.strtoupper($this->account_model->setting('nama')));
			$awal=5;
			$i=0;
			$b=0;
			$aktif=$excel->getActiveSheet();
			if ($abstrak)
			{
				$q1=$this->db->query("select bidang_ilmu, bidang from registrasi a LEFT JOIN ref_bidang b ON a.bidang_ilmu=b.id LEFT JOIN ref_kategori c ON a.kategori=c.kat_id where c.is_pemakalah='1' AND status_abstrak='3' GROUP BY bidang_ilmu ORDER BY CONVERT(SUBSTRING_INDEX(bidang_ilmu,'-',-1),UNSIGNED INTEGER) ASC");
				$jenis='abstrak';
			}	
			else if ($presabsbuk)
			{
				$q1=$this->db->query("select bidang_ilmu, bidang from registrasi a LEFT JOIN ref_bidang b ON a.bidang_ilmu=b.id LEFT JOIN ref_kategori c ON a.kategori=c.kat_id where c.is_pemakalah='1' AND status_abstrak='3' AND status_bukti='2' GROUP BY bidang_ilmu ORDER BY CONVERT(SUBSTRING_INDEX(bidang_ilmu,'-',-1),UNSIGNED INTEGER) ASC");
				$jenis='absbuk';
			}
			else if ($presabsbukfull)
			{
				$q1=$this->db->query("select bidang_ilmu, bidang from registrasi a LEFT JOIN ref_bidang b ON a.bidang_ilmu=b.id LEFT JOIN ref_kategori c ON a.kategori=c.kat_id where c.is_pemakalah='1' AND status_abstrak='3' AND status_bukti='2' AND status_fullpaper='3' GROUP BY bidang_ilmu ORDER BY CONVERT(SUBSTRING_INDEX(bidang_ilmu,'-',-1),UNSIGNED INTEGER) ASC");
				$jenis='presabsbukfull';
			}
			foreach ($q1->result_array() as $row)
			{
				$awal++;
				$a=0;
				
				$aktif->mergeCells('A'.$awal.':G'.$awal);
				$aktif->getStyle('A'.$awal)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$excel->getActiveSheet()->getRowDimension($awal)->setRowHeight(30);
				$aktif->setCellValue('A'.$awal,$row['bidang']);
				$excel->getActiveSheet()->getStyle('A'.$awal.':G'.$awal)->applyFromArray($JudulTable);
				//ambil peserta
				if ($jenis=="abstrak")
				{
					$q2=$this->db->query("select a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where b.is_pemakalah='1' AND status_abstrak='3' AND bidang_ilmu='".$row['bidang_ilmu']."' ORDER BY firstname, lastname ASC");
				}
				else if ($jenis=="absbuk")
				{
					$q2=$this->db->query("select a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where b.is_pemakalah='1' AND status_abstrak='3' AND bidang_ilmu='".$row['bidang_ilmu']."' AND status_bukti='2' ORDER BY firstname, lastname ASC");
				}
				else if ($jenis=="presabsbukfull")
				{
					$q2=$this->db->query("select a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where b.is_pemakalah='1' AND status_abstrak='3' AND bidang_ilmu='".$row['bidang_ilmu']."' AND status_bukti='2' AND status_fullpaper='3' ORDER BY firstname, lastname ASC");
				}

				foreach ($q2->result_array() as $pes)
				{
					$awal++;
					$i++;
					$b++;
					$excel->getActiveSheet()->setCellValue('A'.$awal,$i);
					$excel->getActiveSheet()->setCellValue('C'.$awal,$this->account_model->nama_peserta_gelar($pes['no']));
					$excel->getActiveSheet()->setCellValue('D'.$awal,$pes['institusi']);

					if (strlen($pes['bidang_ilmu'])==1)
			    	{
			    		$bidil="0".$pes['bidang_ilmu'];
			    	}
			    	else
			    	{
			    		$bidil=$pes['bidang_ilmu'];
			    	}

			    	$noo=$pes['jenis_artikel'].$bidil.$pes['nourut'];
					$excel->getActiveSheet()->setCellValue('B'.$awal,$noo);
					$excel->getActiveSheet()->setCellValue('E'.$awal,ubah_huruf_awal(' ',$pes['judul']));
					$excel->getActiveSheet()->getStyle('F'.$awal.':G'.$awal)->applyFromArray($outline);
					if ($b%2==1)
					{
						$excel->getActiveSheet()->setCellValue('F'.$awal,$b);
					}
					else
					{
						$excel->getActiveSheet()->setCellValue('G'.$awal,$b);
					}

					if ($pes['cowriter_hadir']!='' || $pes['cowriter_hadir']!=null)
					{
						$pecah=explode(',',$pes['cowriter_hadir']);
						$jum=count($pecah);
						if ($jum>0)
						{
							for($j=0;$j<$jum;$j++)
							{
								$gelar1="";
							    $gelar2="";
							    if ($pes['fn_writer'.$pecah[$j].'']!="")
							    {
							    	$gelar1=$pes['fn_writer'.$pecah[$j].'']." ";
							    } 
							    if ($pes['ln_writer'.$pecah[$j].'']!="")
							    {
							    	$gelar2=', '.$pes['ln_writer'.$pecah[$j].''];
							    } 

							    $namaa=$gelar1.$pes['co_writer'.$pecah[$j].''].$gelar2;
							    $awal++;
							    $b++;
							    $i++;
							    $excel->getActiveSheet()->setCellValue('A'.$awal,$i);
								$excel->getActiveSheet()->setCellValue('C'.$awal,$namaa);
								$excel->getActiveSheet()->setCellValue('D'.$awal,$pes['institusi_cowriter'.$pecah[$j].'']);
								if ($b%2==1)
								{
									$excel->getActiveSheet()->setCellValue('F'.$awal,$b);
								}
								else
								{
									$excel->getActiveSheet()->setCellValue('G'.$awal,$b);
								}
								$excel->getActiveSheet()->getStyle('F'.$awal.':G'.$awal)->applyFromArray($outline);
							}
						}
					}
				}
			}
			$excel->getActiveSheet()->getStyle('A6:E'.$awal)->applyFromArray($border);

			$no=0;
			foreach($aktif->getRowDimensions() as $rd) { 
				$no++;
				if ($no>4)
				{
			    	$rd->setRowHeight(30); 
				}
			}
			


			$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$objWriter->setPreCalculateFormulas(TRUE);
			//PHPExcel_Calculation::getInstance($objPHPExcel)->clearCalculationCache();
			$objWriter->save('php://output');
		}
		else if ($non)
		{
			error_reporting(E_ALL);
			ini_set('display_errors', TRUE);
			ini_set('display_startup_errors', TRUE);

			header("Content-type: application/vnd.ms-excel");
			//nama file
			header("Content-Disposition: attachment; filename=presensi_non_pemakalah.xlsx");
			header('Cache-Control: max-age=0');

			$excel = PHPExcel_IOFactory::createReader('Excel2007');
			$excel = $excel->load('./uploads/template/presensi_non_pemakalah.xlsx');

			$excel->setActiveSheetIndex(0);
			$excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			$border = array (
			'borders' => array (
								'allborders' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);

			$outline = array (
			'borders' => array (
								'outline' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);
			$JudulTable = array (
			'alignment' => array (
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
					),
			'font' => array(
					   'name'  => 'Arial',
					   'size' => 11,
					   'bold' => true
					),
			'fill' => array(
				          'type' => PHPExcel_Style_Fill::FILL_SOLID,
				          'color' => array('rgb' => 'BFBFBF')
				        ),
			'borders' => array (
								'outline' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);

			$awal=5;
			$i=0;
			$b=0;
			$aktif=$excel->getActiveSheet();
			$q2=$this->db->query("SELECT a.*, b.kat_nama FROM registrasi a LEFT JOIN ref_kategori b ON a.kategori = b.kat_id WHERE b.is_pemakalah='0' AND a.status_bukti='2' order by firstname, lastname ASC");
			foreach ($q2->result_array() as $pes)
			{
				$awal++;
				$i++;
				$excel->getActiveSheet()->setCellValue('A'.$awal,$i);
				$excel->getActiveSheet()->setCellValue('C'.$awal,$this->account_model->nama_peserta_gelar($pes['no']));
				$excel->getActiveSheet()->setCellValue('D'.$awal,$pes['institusi']);

				$excel->getActiveSheet()->setCellValue('B'.$awal,"'".$pes['nourut']);
				$excel->getActiveSheet()->setCellValue('E'.$awal,$pes['kat_nama']);
				$excel->getActiveSheet()->getStyle('F'.$awal.':G'.$awal)->applyFromArray($outline);
				if ($i%2==1)
				{
					$excel->getActiveSheet()->setCellValue('F'.$awal,$i);
				}
				else
				{
					$excel->getActiveSheet()->setCellValue('G'.$awal,$i);
				}
			}

			$excel->getActiveSheet()->getStyle('A6:E'.$awal)->applyFromArray($border);

			$no=0;
			foreach($aktif->getRowDimensions() as $rd) { 
				$no++;
				if ($no>4)
				{
			    	$rd->setRowHeight(30); 
				}
			}
			


			$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$objWriter->setPreCalculateFormulas(TRUE);
			//PHPExcel_Calculation::getInstance($objPHPExcel)->clearCalculationCache();
			$objWriter->save('php://output');
		}
		else if ($semkit)
		{
			error_reporting(E_ALL);
			ini_set('display_errors', TRUE);
			ini_set('display_startup_errors', TRUE);

			header("Content-type: application/vnd.ms-excel");
			//nama file
			header("Content-Disposition: attachment; filename=presensi_seminar_kit.xlsx");
			header('Cache-Control: max-age=0');

			$excel = PHPExcel_IOFactory::createReader('Excel2007');
			$excel = $excel->load('./uploads/template/presensi_semkit.xlsx');

			$excel->setActiveSheetIndex(0);
			$excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			$border = array (
			'borders' => array (
								'allborders' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);

			$outline = array (
			'borders' => array (
								'outline' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);
			$JudulTable = array (
			'alignment' => array (
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
					),
			'font' => array(
					   'name'  => 'Arial',
					   'size' => 11,
					   'bold' => true
					),
			'fill' => array(
				          'type' => PHPExcel_Style_Fill::FILL_SOLID,
				          'color' => array('rgb' => 'BFBFBF')
				        ),
			'borders' => array (
								'outline' => array (
										'style' =>
											PHPExcel_Style_Border::BORDER_THIN,
											),
								),
			);

			$awal=5;
			$i=0;
			$b=0;
			$aktif=$excel->getActiveSheet();
			$q2=$this->db->query("select a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where b.is_pemakalah='1' AND status_abstrak='3' AND status_bukti='2' ORDER BY firstname, lastname ASC");
			foreach ($q2->result_array() as $pes)
			{
				$awal++;
				$i++;
				$b++;
				$excel->getActiveSheet()->setCellValue('A'.$awal,$i);
				$excel->getActiveSheet()->setCellValue('C'.$awal,$this->account_model->nama_peserta_gelar($pes['no']));
				$excel->getActiveSheet()->setCellValue('D'.$awal,$pes['institusi']);

				if (strlen($pes['bidang_ilmu'])==1)
		    	{
		    		$bidil="0".$pes['bidang_ilmu'];
		    	}
		    	else
		    	{
		    		$bidil=$pes['bidang_ilmu'];
		    	}

		    	$noo=$pes['jenis_artikel'].$bidil.$pes['nourut'];
				$excel->getActiveSheet()->setCellValue('B'.$awal,$noo);
				$excel->getActiveSheet()->setCellValue('E'.$awal,'   Author');
				$excel->getActiveSheet()->getStyle('F'.$awal.':G'.$awal)->applyFromArray($outline);
				if ($b%2==1)
				{
					$excel->getActiveSheet()->setCellValue('F'.$awal,$b);
				}
				else
				{
					$excel->getActiveSheet()->setCellValue('G'.$awal,$b);
				}

				if ($pes['cowriter_hadir']!='')
				{
					$pecah=explode(',',$pes['cowriter_hadir']);
					$jum=count($pecah);
					if ($jum>0)
					{
						for($j=0;$j<$jum;$j++)
						{
							$gelar1="";
						    $gelar2="";
						    if ($pes['fn_writer'.$pecah[$j].'']!="")
						    {
						    	$gelar1=$pes['fn_writer'.$pecah[$j].'']." ";
						    } 
						    if ($pes['ln_writer'.$pecah[$j].'']!="")
						    {
						    	$gelar2=', '.$pes['ln_writer'.$pecah[$j].''];
						    } 

						    $namaa=$gelar1.$pes['co_writer'.$pecah[$j].''].$gelar2;
						    $awal++;
						    $b++;
						    $i++;
						    $excel->getActiveSheet()->setCellValue('A'.$awal,$i);
							$excel->getActiveSheet()->setCellValue('C'.$awal,$namaa);
							$excel->getActiveSheet()->setCellValue('E'.$awal,'   Co-Author');
							$excel->getActiveSheet()->setCellValue('D'.$awal,$pes['institusi_cowriter'.$pecah[$j].'']);
							if ($b%2==1)
							{
								$excel->getActiveSheet()->setCellValue('F'.$awal,$b);
							}
							else
							{
								$excel->getActiveSheet()->setCellValue('G'.$awal,$b);
							}
							$excel->getActiveSheet()->getStyle('F'.$awal.':G'.$awal)->applyFromArray($outline);
						}
					}
				}
			}
			$excel->getActiveSheet()->getStyle('A6:E'.$awal)->applyFromArray($border);

			$no=0;
			foreach($aktif->getRowDimensions() as $rd) { 
				$no++;
				if ($no>4)
				{
			    	$rd->setRowHeight(30); 
				}
			}
			
			$excel->setActiveSheetIndex(1);
			$excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			$awal=5;
			$i=0;
			$b=0;
			$aktif=$excel->getActiveSheet();
			$q2=$this->db->query("SELECT a.*, b.kat_nama FROM registrasi a LEFT JOIN ref_kategori b ON a.kategori = b.kat_id WHERE b.is_pemakalah='0' AND a.status_bukti='2' order by firstname, lastname ASC");
			foreach ($q2->result_array() as $pes)
			{
				$awal++;
				$i++;
				$excel->getActiveSheet()->setCellValue('A'.$awal,$i);
				$excel->getActiveSheet()->setCellValue('C'.$awal,$this->account_model->nama_peserta_gelar($pes['no']));
				$excel->getActiveSheet()->setCellValue('D'.$awal,$pes['institusi']);

				$excel->getActiveSheet()->setCellValue('B'.$awal,"'".$pes['nourut']);
				$excel->getActiveSheet()->setCellValue('E'.$awal,$pes['kat_nama']);
				$excel->getActiveSheet()->getStyle('F'.$awal.':G'.$awal)->applyFromArray($outline);
				if ($i%2==1)
				{
					$excel->getActiveSheet()->setCellValue('F'.$awal,$i);
				}
				else
				{
					$excel->getActiveSheet()->setCellValue('G'.$awal,$i);
				}
			}

			$excel->getActiveSheet()->getStyle('A6:E'.$awal)->applyFromArray($border);

			$no=0;
			foreach($aktif->getRowDimensions() as $rd) { 
				$no++;
				if ($no>4)
				{
			    	$rd->setRowHeight(30); 
				}
			}

			$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$objWriter->setPreCalculateFormulas(TRUE);
			//PHPExcel_Calculation::getInstance($objPHPExcel)->clearCalculationCache();
			$objWriter->save('php://output');
		}
	}

	public function sertif($jenis)
	{
		if ($jenis)
		{
			if ($jenis=="pemakalah")
			{
				ob_start();
			    include(APPPATH.'/views/admin/cetak/sertif_pemakalah.php');
			    $content = ob_get_clean();

			    // convert in PDF
			    // require_once(dirname(__FILE__).'/html2pdf.class.php');
			    include (APPPATH.'/third_party/html2pdf/html2pdf.class.php');
			    try
			    {
			        $html2pdf = new HTML2PDF('L', 'A4', 'en', true, 'UTF-8', array(20, 3, 10, 8));
			        $html2pdf->pdf->SetDisplayMode('fullpage');
			        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			        $html2pdf->Output('sertifikat_pemakalah.pdf');
			    }
			    catch(HTML2PDF_exception $e) {
			        echo $e;
			        exit;
			    }
			}
			else if ($jenis=="nonpemakalah")
			{

			}
			else
			{
				redirect(base_url('cetak'));
			}
		}
		else
		{
			redirect(base_url('cetak'));
		}
	}
}