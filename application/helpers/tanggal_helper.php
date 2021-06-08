<?php

//
function tanggal_indonesia($tanggal)
	{
	//merubah format 2015-01-13
	$tanggal=substr($tanggal,0,10);
	$tanggal=explode("-",$tanggal);
	$taketgl = $tanggal[2];
	$tahun = $tanggal[0];
	$bulan = $tanggal[1];

		switch ($bulan) {
		case "01":
			$bulan = "Januari";
			break;
		case "02":
		   $bulan = "Februari";
			break;
		case "03":
			$bulan = "Maret";
			break;
		case "04":
			$bulan = "April";
			break;
		case "05":
			$bulan = "Mei";
			break;
		case "06":
			$bulan = "Juni";
			break;
		case "07":
			 $bulan = "Juli";
			break;
		case "08":
			$bulan = "Agustus";
			break;
		case "09":
			$bulan = "September";
			break;
		case "10":
			$bulan = "Oktober";
			break;
		case "11":
			$bulan = "November";
			break;
		case "12":
			$bulan = "Desember";
			break;
		default:			
		}
	$tgl = $taketgl." ".$bulan." ".$tahun;

	return $tgl;
	}


function bulan($input)
	{
	$tanggal=substr($input,0,10);
	
	$tanggal=explode("-",$tanggal);

	$bulan = $tanggal[1];

	switch ($bulan) {
		case "01":
			$bulan = "Januari";
			break;
		case "02":
		   $bulan = "Februari";
			break;
		case "03":
			$bulan = "Maret";
			break;
		case "04":
			$bulan = "April";
			break;
		case "05":
			$bulan = "Mei";
			break;
		case "06":
			$bulan = "Juni";
			break;
		case "07":
			 $bulan = "Juli";
			break;
		case "08":
			$bulan = "Agustus";
			break;
		case "09":
			$bulan = "September";
			break;
		case "10":
			$bulan = "Oktober";
			break;
		case "11":
			$bulan = "November";
			break;
		case "12":
			$bulan = "Desember";
			break;
		default:
			
		}

	$bln =$bulan;

	return $bln;
	}

function tanggalindo($tanggal)
	{
	$tanggal=explode(" ",$tanggal);
	$taketgl = $tanggal[0];
	$tahun = $tanggal[2];
	$bulan = $tanggal[1];

		switch ($bulan) {
		case "January":
			$bulan = "Januari";
			break;
		case "February":
		   $bulan = "Februari";
			break;
		case "March":
			$bulan = "Maret";
			break;
		case "April":
			$bulan = "April";
			break;
		case "May":
			$bulan = "Mei";
			break;
		case "June":
			$bulan = "Juni";
			break;
		case "July":
			 $bulan = "Juli";
			break;
		case "August":
			$bulan = "Agustus";
			break;
		case "September":
			$bulan = "September";
			break;
		case "October":
			$bulan = "Oktober";
			break;
		case "November":
			$bulan = "November";
			break;
		case "December":
			$bulan = "Desember";
			break;
		default:
			
		}
	$tgl = $taketgl." ".$bulan." ".$tahun;

	return $tgl;
	}
	
	function ubah_dari_tanggal_id($tanggal)
	{
	
	$taketgl = substr($tanggal,0,2);
	$bulan = substr($tanggal,2,2);
	$tahun = substr($tanggal,4,2);

		switch ($bulan) {
		case "01":
			$bulan = "Januari";
			break;
		case "02":
		   $bulan = "Februari";
			break;
		case "03":
			$bulan = "Maret";
			break;
		case "04":
			$bulan = "April";
			break;
		case "05":
			$bulan = "Mei";
			break;
		case "06":
			$bulan = "Juni";
			break;
		case "07":
			 $bulan = "Juli";
			break;
		case "08":
			$bulan = "Agustus";
			break;
		case "09":
			$bulan = "September";
			break;
		case "10":
			$bulan = "Oktober";
			break;
		case "11":
			$bulan = "November";
			break;
		case "12":
			$bulan = "Desember";
			break;
		default:			
		}
		
	$tgl = $taketgl." ".$bulan." 20".$tahun;

	return $tgl;
	}
	
	function tanggal_ke_id($tanggal)
	{
	
	$tanggal=explode("-",$tanggal);
	$tahun = $tanggal[0];
	$bulan = $tanggal[1];
	$taketgl = $tanggal[2];

		
	$tgl = $taketgl."".$bulan."".$tahun;

	return $tgl;
	}
	
	function dateRange($s, $e)
	{
        $s = strtotime($s);
        $e = strtotime($e);
 
        return ($e - $s)/ (24 *3600);
	}

	function Hari($tgl,$bln,$thn){
		$hari = date("N",mktime(0,0,0,$bln,$tgl,$thn));
		return($hari);
	}
	function NamaHari($id){
		switch($id){
		case 1: $hari = "Senin";break;
		case 2: $hari = "Selasa";break;
		case 3: $hari = "Rabu";break;
		case 4: $hari = "Kamis";break;
		case 5: $hari = "Jumat";break;
		case 6: $hari = "Sabtu";break;
		case 7: $hari = "Minggu";break;
		}
	return($hari);
	}
 

	
?>