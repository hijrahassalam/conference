<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftar extends CI_Controller {
	public function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation', 'session'));
			$this->load->helper(array('url', 'tgl_helper', 'konversi_id_helper'));
			if (!$this->session->userdata('logged_in')) {
			 redirect(base_url('login'));
			}
			// $this->load->library('Excel_reader');
			// $this->load->library('Phpexcel');
		}

	public function index()
	{
		$this->load->view('admin/pendaftar/index');

	}

	//untuk download
	public function exportPendaftar(){
        $q = $this->db->get('registrasi')->result_array();

        header("Content-type: application/vnd.ms-excel");
        //nama file
        header("Content-Disposition: attachment; filename=Export-Data-ICLIQE.xlsx");
        header('Cache-Control: max-age=0');

        $excel = PHPExcel_IOFactory::createReader('Excel2007');
        $excel = $excel->load('./assets/template_aktivitas_mahasiswa.xlsx');

        $border = array (
        'borders' => array (
                        'allborders' => array (
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            ),
                        ),
        );
        $sheet1=$excel->setActiveSheetIndex(0);
        $sheet1->setCellValueExplicit('A1','Data Aktivitas Akademik Mahasiswa ' . $semesters->nama_semester, PHPExcel_Cell_DataType::TYPE_STRING);
        $awal=4;
        foreach ($q as $r)
        {
            $sheet1->setCellValueExplicit('A'.$awal,$r->nimmhs, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet1->setCellValueExplicit('B'.$awal,$r->namamhs, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet1->setCellValueExplicit('C'.$awal,$r->semester_mulai, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet1->setCellValueExplicit('D'.$awal,$r->ip_sementara, PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $sheet1->setCellValueExplicit('E'.$awal,$r->sks_sementara, PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $sheet1->setCellValueExplicit('F'.$awal,$r->ip_kumulatif, PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $sheet1->setCellValueExplicit('G'.$awal,$r->sks_kumulatif, PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $sheet1->setCellValueExplicit('H'.$awal,$r->status_akademik, PHPExcel_Cell_DataType::TYPE_STRING);

            $awal++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->setIncludeCharts(TRUE);
        $objWriter->setPreCalculateFormulas(TRUE);
        PHPExcel_Calculation::getInstance($excel)->clearCalculationCache();
        $objWriter->save('php://output');
        exit();
	}

	public function del()
	{
		$id=$this->input->get('id');
		$idoff=$this->input->get('id_off');

		if ($id)
		{
			$info['status_aktif']="1";
			$q=$this->db->where('no',$id)->update('registrasi',$info);
			if ($q)
			{
				redirect(base_url('admin/pendaftar'));
			}
		}
		
		if ($idoff)
		{
			$info['status_aktif']="0";
			$q=$this->db->where('no',$idoff)->update('registrasi',$info);
			if ($q)
			{
				redirect(base_url('admin/pendaftar'));
			}
		}
	}
}