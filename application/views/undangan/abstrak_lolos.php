<?php
$payway=$this->db->where('id',$data['id_payway'])->get('status_payway')->row_array();
$buktipayway=$this->account_model->status_payway($payway['id_payway']);

if (($data['status_bukti']=="2" || $buktipayway==1) && $data['status_fullpaper']=="3")
{
	?>
<page orientation="portrait" format="A4" backtop="7mm" backbottom="0mm" backleft="20mm" backright="15mm">
<table style="width:100%">
<tr>
<td style="width:15%"><img src="http://mawa.uns.ac.id/wp-content/uploads/2013/05/UNS-biru-300x300.png" width="100" height="95"/></td>
<td style="width:75%;text-align:center"><p style="font-size:11pt;line-height:130%"><b>KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br/>UNIVERSITAS SEBELAS MARET SURAKARTA<br/>FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN<br/>PROGRAM STUDI PENDIDIKAN BIOLOGI<br/>PANITIA SEMINAR NASIONAL XIII PENDIDIKAN BIOLOGI</b></p>
	<p style="font-size:8pt;line-height:130%;padding-top:-20px">Jl. Ir. Sutami 36 A Gedung D Lt.III FKIP Kentingan Surakarta Telp.(0271) 646994 psw.376<br/>
	Website: http://sembio.fkip.uns.ac.id/ email:sembio@fkip.uns.ac.id</p></td>
</tr>
</table>
<hr style="border-top: 3px double #8c8b8b">
<div style="text-align:right;padding-right:10px;font-size:11pt">Surakarta, <?php echo date_to_id($this->account_model->setting('tgl_surat'))?></div>
<table style="width:50%;font-size:11pt">
<tr>
	<td style="width:10%">No</td>
	<td style="width:2%">:</td>
	<td style="width:85%"><?php echo $this->account_model->setting('no_surat')?></td>
</tr>
<tr>
	<td>Lamp.</td>
	<td>:</td>
	<td>ID Card Peserta Semnas</td>
</tr>
<tr>
	<td>Hal</td>
	<td>:</td>
	<td>Undangan Pemakalah Seminar Nasional</td>
</tr>
</table>
<p style="line-height:130%;font-size:11pt">Kepada<br/>Yth. <?php echo $this->account_model->nama_peserta_gelar($data['no'])?><br/>Di <?php echo $data['institusi']?></p>
<p style="line-height:130%;margin-bottom:0px;font-size:11pt">Dengan hormat,</p>
<p style="line-height:130%;margin-top:0px;text-align:justify;font-size:11pt">Kami beritahukan bahwa berdasarkan hasil <i>review</i> terhadap abstrak yang Bapak/Ibu/Sdr kirimkan, dengan judul:</p>
<div style="line-height:130%;text-align:center;font-size:11pt"><h4><?php echo $data['judul']?></h4></div>
<p style="line-height:130%;text-align:justify;font-size:11pt;margin-bottom:0px">telah <strong>lolos seleksi</strong> untuk dipresentasikan pada Seminar Nasional XV yang bertema "<?php echo ubah_huruf_awal(' ',$this->account_model->setting('tema'))?>". Bersama ini pula kami mohon kehadiran Bapak/Ibu/Sdr untuk mempresentasikan makalah tersebut, yang akan diselenggarakan pada : </p>
<div style="padding-left:40px">
	<table style="width:70%">
		<tr>
			<td style="width:18%;font-size:11pt">Hari</td>
			<td style="width:3%;font-size:11pt">:</td>
			<td style="width:82%;font-size:11pt">Sabtu</td>
		</tr>
		<tr>
			<td style="font-size:11pt">Tanggal</td>
			<td style="font-size:11pt">:</td>
			<td style="font-size:11pt"><?php echo date_to_id($this->account_model->setting('waktu'))?></td>
		</tr>
		<tr>
			<td style="font-size:11pt">Jam</td>
			<td style="font-size:11pt">:</td>
			<td style="font-size:11pt">08.00 - Selesai</td>
		</tr>
		<tr>
			<td style="font-size:11pt">Tempat</td>
			<td style="font-size:11pt">:</td>
			<td style="font-size:11pt;line-height:130%">Gedung F (Gedung Ungu) FKIP Universitas Sebelas Maret<br/>Jl. Ir.Sutami 36A Kentingan Surakarta</td>
		</tr>
	</table>
</div>
<p style="font-size:11pt;text-align:justify">Apabila Bapak/Ibu yang belum mengunggah artikel/<i>Fullpaper</i>, mohon segera unggah di sistem pendaftaran (http://sembio.fkip.uns.ac.id/sembio), maksimal tanggal 23 Agustus 2019.</p>
<p style="font-size:11pt;text-align:justify">Demikian pemberitahuan dan sekaligus undangan kami. Terima kasih atas perhatian Bapak/Ibu/Sdr.</p>
<div style="padding-left:340px"><img src="uploads/ttd.PNG" style="width:66%" /></div>
<div style="padding-left:0px;padding-top:-121px;margin-top:-100px"><img src="uploads/kaprodi.PNG" style="width:43.5%" /></div>
</page>
<page orientation="portrait" format="A4" backtop="7mm" backbottom="0mm" backleft="0mm" backright="0mm">
<style>
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-style:solid;border-width:1px;overflow:hidden;font-size: 13px; padding-left:5px;padding-right: 5px}
.tg th{border-style:solid;border-width:1px;overflow:hidden;}

.verticalText
            {
                text-align: center;
                vertical-align: middle;
                width: 20px;
                margin: 0px;
                padding: 0px;
                padding-left: 3px;
                padding-right: 3px;
                padding-top: 10px;
                white-space: nowrap;
                -webkit-transform: rotate(-90deg); 
                -moz-transform: rotate(-90deg);                 
            }
</style>
<table style="width:100%">
    	<?php $noo=$data['jenis_artikel'].$bidil.$data['nourut']; ?>
	<tr>
		<td style="width:45%;border:2px solid #000; text-align:center;height:200px;font-size:14px">SEMINAR NASIONAL XVI<br/>PENDIDIKAN BIOLOGI<br/>FKIP UNIVERSITAS SEBELAS MARET<br/><hr><br/><i>Peningkatan Kapasitas Pembelajaran dan Penelitian Biologi di Era Revolusi Industri 4.0</i><br/><br/><br/><i>Surakarta, <?php echo date_to_id($this->account_model->setting('waktu'))?></i><br/><br/><br/><u><font style="font-size:16px"><b><?php echo $this->account_model->nama_peserta_gelar($data['no'])?></b></font></u><br/><b>
			<?php
    if ($data['is_pemakalah']=="1")
    	{
    		echo "PEMAKALAH";
    	}
    	else
    		{
    			echo "NON-PEMAKALAH";
    		}
    	if (strlen($data['bidang_ilmu'])==1)
    	{
    		$bidil="0".$data['bidang_ilmu'];
    	}
    	else
    	{
    		$bidil=$data['bidang_ilmu'];
    	}

    		?></b><br/><br/>
    	<div style='align:right;display:inline;padding-right:120px'><br/>&nbsp;<br/><img src="uploads/stempel.png" style="width:110px;height:110px;margin-right:60px" /></div><br/>
    	<div style='text-align:left;display:inline;margin-left:-150px;width:80px;height:100px;border:1px;border-collapse:collapse;margin-top:-110px'><?php echo ($data['photo']!='user.jpg') ? "<img src='".base_url('uploads/photo/'.str_replace(' ','%20',$data['photo']).'')."' width='100%;height:100%'>" : ""?></div><br/><br/></td>
		<td style="width:10%;vertical-align:middle;text-align:center;font-size:20px">L<br>I<br>P<br>A<br>T<br>&nbsp;<br>D<br>I<br>&nbsp;<br>S<br>I<br>N<br>I</td>
		<td style="width:45%;border:2px solid #000;padding:8px"><div style='text-align:center;font-size:14px'>SEMINAR NASIONAL XVI<br/>PENDIDIKAN BIOLOGI<br/>FKIP UNIVERSITAS SEBELAS MARET</div><br/><br/>
		<table style="width:100%;" class="tg">
			<tr>
				<td style="text-align:center;width:45%">Waktu</td>
				<td style="text-align:center;width:55%">Acara</td>
			</tr>
			<tr>
				<td style="text-align:left">07.00 - 07.30</td>
				<td style="text-align:left">Registrasi</td>
			</tr>
			<tr>
				<td>07.30 - 07.45</td>
				<td>Coffe Break</td>
			</tr>
			<tr>
				<td>07.45 - 08.00</td>
				<td>Perform (Tentatif)</td>
			</tr>
			<tr>
				<td>08.00 - 08.15</td>
				<td>Pembukaan</td>
			</tr>
			<tr>
				<td>09.00 - 09.15</td>
				<td>Sambutan-sambutan</td>
			</tr>
			<tr>
				<td>09.15 - 10.15</td>
				<td>Sesi 1, <b>Pembicara Kunci</b></td>
			</tr>
			<tr>
				<td>10.15 - 10.50</td>
				<td>Sesi 2, <b>Pembicara 2</b></td>
			</tr>
			<tr>
				<td>10.50 - 11.20</td>
				<td>Sesi 2, <b>Pembicara 3</b></td>
			</tr>
			<tr>
				<td>11.20 - 11.50</td>
				<td>Diskusi dan Tanya Jawab</td>
			</tr>
			<tr>
				<td>11.50 - 13.00</td>
				<td>Ishoma</td>
			</tr>
			<tr>
				<td>13.00 - 15.00</td>
				<td>Presentasi Makalah Paralel</td>
			</tr>
			<tr>
				<td>15.00 - Selesai</td>
				<td>Penutupan dan<br/> Penyerahan Sertifikat</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<?php
if ($data['cowriter_hadir']!='')
{
$pecah=explode(',',$data['cowriter_hadir']);
$jum=count($pecah);

if ($jum>0)
{
	for($i=0;$i<$jum;$i++)
	{
		?>
		<br/><br/><br/>
		<table style="width:100%">
		<tr>
			<td style="width:45%;border:2px solid #000; text-align:center;height:200px;font-size:14px">SEMINAR NASIONAL XVI<br/>PENDIDIKAN BIOLOGI<br/>FKIP UNIVERSITAS SEBELAS MARET<br/><hr><br/><i>Peningkatan Kapasitas Pembelajaran dan Penelitian Biologi di Era Revolusi Industri 4.0</i><br/><br/><br/><i>Surakarta, <?php echo date_to_id($this->account_model->setting('waktu'))?></i><br/><br/><br/><u><font style="font-size:16px"><b>
	    <?php
	    $gelar1="";
	    $gelar2="";
	    if ($data['fn_writer'.$pecah[$i].'']!="")
	    {
	    	$gelar1=$data['fn_writer'.$pecah[$i].'']." ";
	    } 
	    if ($data['ln_writer'.$pecah[$i].'']!="")
	    {
	    	$gelar2=', '.$data['ln_writer'.$pecah[$i].''];
	    } 

	    echo $gelar1.$data['co_writer'.$pecah[$i].''].$gelar2?></b></font></u><br/><b>
	    <?php
    if ($data['is_pemakalah']=="1")
    	{
    		echo "PEMAKALAH";
    	}
    	else
    		{
    			echo "NON-PEMAKALAH";
    		}
    	if (strlen($data['bidang_ilmu'])==1)
    	{
    		$bidil="0".$data['bidang_ilmu'];
    	}
    	else
    	{
    		$bidil=$data['bidang_ilmu'];
    	}

    		?></b><br/><br/>
    	<div style='align:right;display:inline;padding-right:120px'><br/>&nbsp;<br/><img src="uploads/stempel.png" style="width:110px;height:110px;margin-right:60px" /></div><br/>
    	<div style='text-align:left;display:inline;margin-left:-150px;width:80px;height:100px;border:1px;border-collapse:collapse;margin-top:-110px'><?php echo ($data['photo']!='user.jpg') ? "<img src='".base_url('uploads/photo/'.str_replace(' ','%20',$data['photo']).'')."' width='100%;height:100%'>" : ""?></div><br/><br/></td>
		<td style="width:10%;vertical-align:middle;text-align:center;font-size:20px">L<br>I<br>P<br>A<br>T<br>&nbsp;<br>D<br>I<br>&nbsp;<br>S<br>I<br>N<br>I</td>
		<td style="width:45%;border:2px solid #000;padding:8px"><div style='text-align:center;font-size:14px'>SEMINAR NASIONAL XVI<br/>PENDIDIKAN BIOLOGI<br/>FKIP UNIVERSITAS SEBELAS MARET</div><br/><br/>
		<table style="width:100%;" class="tg">
			<tr>
				<td style="text-align:center;width:45%">Waktu</td>
				<td style="text-align:center;width:55%">Acara</td>
			</tr>
			<tr>
				<td style="text-align:left">07.00 - 07.30</td>
				<td style="text-align:left">Registrasi</td>
			</tr>
			<tr>
				<td>07.30 - 07.45</td>
				<td>Coffe Break</td>
			</tr>
			<tr>
				<td>07.45 - 08.00</td>
				<td>Perform (Tentatif)</td>
			</tr>
			<tr>
				<td>08.00 - 08.15</td>
				<td>Pembukaan</td>
			</tr>
			<tr>
				<td>09.00 - 09.15</td>
				<td>Sambutan-sambutan</td>
			</tr>
			<tr>
				<td>09.15 - 10.15</td>
				<td>Sesi 1, <b>Pembicara Kunci</b></td>
			</tr>
			<tr>
				<td>10.15 - 10.50</td>
				<td>Sesi 2, <b>Pembicara 2</b></td>
			</tr>
			<tr>
				<td>10.50 - 11.20</td>
				<td>Sesi 2, <b>Pembicara 3</b></td>
			</tr>
			<tr>
				<td>11.20 - 11.50</td>
				<td>Diskusi dan Tanya Jawab</td>
			</tr>
			<tr>
				<td>11.50 - 13.00</td>
				<td>Ishoma</td>
			</tr>
			<tr>
				<td>13.00 - 15.00</td>
				<td>Presentasi Makalah Paralel</td>
			</tr>
			<tr>
				<td>15.00 - Selesai</td>
				<td>Penutupan dan<br/> Penyerahan Sertifikat</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
		<?php
	}
}
}
?>
<br/><br/>
<div style="font-size:16px;color:#fff;background-color: #1f8ff1;padding:5px"><b>NB:</b> Mohon dicetak di kertas sampul warna putih kemudian dipotong dan dilipat serta dibawa saat registrasi seminar</div>
</page>
<?php
}
else
	echo "<page>Fullpaper belum diupload atau Bukti bayar belum terverifikasi</page>";
?>