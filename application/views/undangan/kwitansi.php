<page orientation="portrait" format="A4" backtop="7mm" backbottom="10mm" backleft="20mm" backright="15mm">
<div style="text-align:center"><font style="font-size:18px"><b>Rekapitulasi Biaya <?php echo $this->account_model->setting('nama')?> <br/>Pendidikan Biologi FKIP UNS</b></font></div>
<br/>
<br/>
<?php
$katpem=$this->account_model->kategori('pemakalah');
if (in_array($data['kategori'],$katpem))
{
	$kat="Pemakalah";
}
else
{
	$kat="Peserta";
}

$biayacoauthor=0;
if (in_array($data['kategori'],$katpem))
{
	$harga=$this->account_model->biaya_registrasi($data['no'],$data['kategori'],$data['tglabstrak']);
	$biayacoauthor=$this->account_model->biaya_co_author($data['no']);
}
else
{
	$harga=$this->account_model->biaya_registrasi($data['no'],$data['kategori'],$data['tanggal']);
}

if ($data['prosiding']=="1")
{
	$prosidingpesan=$this->account_model->biaya_prosiding("prosiding");
}
else
{
	$prosidingpesan="0";
}

$totalakhir=$harga+$prosidingpesan+$biayacoauthor;

if (substr($data['tglabstrak'],0,10)<="2016-06-30")
{
	$kett="Early Bird";
}
else
{
	$kett="Regular";
}
?>
<div style="font-size:16px">Dengan ini saya sebagai <b><?php echo $this->account_model->nama_kategori($data['kategori']) ?></b> menyetujui pembiayaan seminar dengan rincian :<br/><br/>
<table style="width:100%">
<?php
if (in_array($data['kategori'],$katpem))
{
	?>
	<tr>
		<td style="width:65%">Pemakalah (<i>author</i>) (<i><?php echo $kett ?></i>) <?php if ($data['statusmakalah']=='2') { echo "<b>- Off 50%</b>"; } ?></td>
		<td>:</td>
		<td>Rp <?php echo number_format($harga,2,',','.');?></td>
	</tr>
	<tr>
		<td>Pemakalah (<i>co-author</i>) <b><?php 
		if ($data['cowriter_hadir']!="") 
			{ 
				$pecah=explode(',',$data['cowriter_hadir']); 
				$jumm=count($pecah); 
			} else 
			{ 
				$jumm=0; 
			}; 

			echo $jumm?></b> Orang <?php if ($data['statusmakalah']=='2') { echo "<b>- Off 50%</b>"; } ?></td>
		<td>:</td>
		<td>Rp <?php echo number_format($biayacoauthor,2,',','.');?></td>
	</tr>
<?php
}
else
{
	?>
	<tr>
		<td>Peserta (<i><?php echo $kett ?></i>)</td>
		<td>:</td>
		<td>Rp <?php echo number_format($harga,2,',','.');?></td>
	</tr>
	<?php
}

if ($data['prosiding']=="1")
{
	?>
	<tr>
		<td>Prosiding</td>
		<td>:</td>
		<td>Rp <?php echo number_format($prosidingpesan,2,',','.');?></td>
	</tr>
<?php
}
$diskonhppbi=0;
if ($data['is_hppbi']=="3")
{
	$diskonhppbi=$this->account_model->setting('hppbi');
	?>
	<tr>
		<td>Diskon HPPBI</td>
		<td>:</td>
		<td> - Rp <?php echo number_format($diskonhppbi,2,',','.');?></td>
	</tr>
<?php
}
$totalakhir = $totalakhir - $diskonhppbi;
?>
	<tr>
		<td style="border-top:1px solid #000">Total</td>
		<td style="border-top:1px solid #000">:</td>
		<td style="border-top:1px solid #000">Rp <?php echo number_format($totalakhir,2,',','.');?></td>
	</tr>
	<tr>
		<td colspan="3">Terbilang <b><?php echo terbilang($totalakhir)?> Rupiah</b></td>
	</tr>
</table>
<br/><br/>
Pembayaran akan saya lakukan dengan transfer melalui Payment Gateway UNS di https://payway.uns.ac.id.
</div>
<div style="font-size:16px;padding-left:340px">

<br/><br/>Surakarta, <?php 
if (in_array($data['kategori'],$katpem))
{
	echo tanggal_indonesia($data['tglabstrak']);
}
else
{
	echo tanggal_indonesia($data['tanggal']);
}?><br/>Yang Menyatakan,<br/><?php echo $kat?><br/><br/><br/><br/><?php echo $this->account_model->nama_peserta_gelar($data['no'])?>
</div>
<div style="font-size:14px">
<br/><br/>
<b>NB</b>: Mohon ditandatangani dan discan (rekapitulasi biaya + bukti transfer) dalam 1 file lalu diupload di sistem pendaftaran sembio 2018 <i>http://sembio.fkip.uns.ac.id</i>
</div>
</page>