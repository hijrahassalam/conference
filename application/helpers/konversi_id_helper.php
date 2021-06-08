<?php


// any_in_array() is not in the Array Helper, so it defines a new function
function any_in_array($needle, $haystack)
{
    $needle = (is_array($needle)) ? $needle : array($needle);

    foreach ($needle as $item)
    {
        if (in_array($item, $haystack))
        {
            return TRUE;
        }
        }

    return FALSE;
}

// random_element() is included in Array Helper, so it overrides the native function
function random_element($array)
{
    shuffle($array);
    return array_pop($array);
}

function strToHex($string){
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }
    return strToUpper($hex);
}

function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

function ubah_huruf_awal($pemisah, $paragrap) {  
//pisahkan $paragraf berdasarkan $pemisah dengan fungsi explode  
	$pisahkalimat=explode($pemisah, $paragrap);  
	$kalimatbaru = array();  
  
	//looping dalam array  
	foreach ($pisahkalimat as $kalimat) {  
	//jadikan awal huruf masing2 array menjadi huruf besar dengan fungsi ucfirst  
		$kalimatawalhurufbesar=ucfirst(strtolower($kalimat));  
		$kalimatbaru[] = $kalimatawalhurufbesar;  
	}  
  
	//kalo udah gabungin lagi dengan fungsi implode  
	$textgood = implode($pemisah, $kalimatbaru);  
	return $textgood;  
}  

function nama_toko($toko_id)
	{
$koneksi = mysqli_connect("localhost","root","","web_umkm");
	$query=mysqli_query($koneksi,"
	SELECT
		toko_nama
	FROM
		umkm_toko
	WHERE
		toko_id = '$toko_id'
	");
	$dat=mysqli_fetch_array($query);

	return $nama = $dat['toko_nama'] ;
	
	}

//angka ke teks
function terbilang($x){
    $arr = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    if ($x < 12)
    return " " . $arr[$x];
    elseif ($x < 20)
    return terbilang($x - 10) . " Belas";
    elseif ($x < 100)
    return terbilang($x / 10) . " Puluh" . terbilang($x % 10);
    elseif ($x < 200)
    return " Seratus" . terbilang($x - 100);
    elseif ($x < 1000)
    return terbilang($x / 100) . " Ratus" . terbilang($x % 100);
    elseif ($x < 2000)
    return " Seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
    return terbilang($x / 1000) . " Ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " Juta" . terbilang($x % 1000000);
}

function kategori_toko($id)
	{
$koneksi = mysqli_connect("localhost","root","","web_umkm");
	$query=mysqli_query($koneksi,"
	SELECT
		kat_toko_nama
	FROM
		umkm_toko_kategori
	WHERE
		kat_toko_id = '$id'
	");
	$dat=mysqli_fetch_array($query);

	return $nama = $dat['kat_toko_nama'] ;
	
	}

function nama_pemilik($id)
	{
$koneksi = mysqli_connect("localhost","root","","web_umkm");
	$query=mysqli_query($koneksi,"
	SELECT
		akun_nama
	FROM
		umkm_akun
	WHERE
		akun_id = '$id'
	");
	$dat=mysqli_fetch_array($query);

	return $nama = $dat['akun_nama'] ;
	
	}
	
?>