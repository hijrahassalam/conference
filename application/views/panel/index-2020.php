<?php
$this->load->view('header');
?>
<?php
		$query=$this->db->get_where('sembio_web', array('idkhusus =' => '22'))->row_array();
	?>

	</head>

	<body 
		id="login" class="animated fadeInDown" 	>
		<!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
			 You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
		<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->

<div id="main" role="main">
<?php
$data=$this->db->where('no',$this->session->userdata('peserta_id'))->get('registrasi')->row_array();
$thn=$this->account_model->setting('tahun');
$katpem=$this->account_model->kategori('pemakalah');
?>
	<!-- MAIN CONTENT -->
	<div id="content" class="container">
		<div class="row" style="margin-top:2%">
			<?php $this->load->view('logo');?>
			<div class="well bg-color-teal col-md-8 col-md-offset-2" style="margin-top:3%;color:#fff">
			<center><h3 style="margin-top:0px">Welcome <font color="lime"><?php echo $this->account_model->nama_peserta_gelar($this->session->userdata('peserta_id'))?></font></h3></center>
			<ul id="myTab1" class="nav nav-tabs bordered">
				<li  class="active">
						<a href="#home" data-toggle="tab"><i class="fa fa-fw fa-lg fa-home"></i>Home</a>
				</li>
				<li>
					<a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i>Profile</a>
				</li>
				<?php
				if ($data['kategori']!="")
				{	
					?>
				<li>
					<a href="#s22" data-toggle="tab"><i class="fa fa-fw fa-lg fa-cogs"></i>Register</a>
				</li>
				<?php
				}

				if ($data['kategori']=="")
				{
					?>
					<li>
					<a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-cogs"></i>Register</a>
					</li>
					<?php
				}
				else
				{
					if (in_array($data['kategori'],$this->account_model->kategori('pemakalah')))
					{
					?>
				<li>
					<a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-file-text"></i>Abstrak</a>
				</li>
				<li>
					<a href="#s4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-book"></i>Full Paper</a>
				</li>
				<?php
					}
				?>
				<li>
					<a href="#s5" data-toggle="tab"><i class="fa fa-fw fa-lg fa-camera"></i>Bukti Bayar</a>
				</li>
				<?php
				}
				?>
				<li>
					<a href="<?php echo base_url('daftar/logout')?>"><i class="fa fa-fw fa-lg fa-sign-out"></i>Logout</a>
				</li>
				
			</ul>
			<div id="myTabContent1" class="tab-content padding-10">
				<div class="tab-pane fade in active" id="home">
					<div class="well" style="color:#000">
					<?php
					if($this->session->flashdata('msg'))
								{
									echo "<div class='alert alert-block alert-success'><a class='close' data-dismiss='alert' href='#'>×</a><h4 class='alert-heading'><i class='fa fa-check-square-o'></i> ".$this->session->flashdata('msg')."</h4></div>";
								}
								?>
						<center>
						<marquee style="font-size:14px">Pastikan <font color="red"><b>nama</b></font> dan <font color="red"><b>gelar</b></font> sudah sesuai karena akan digunakan untuk sertifikat. Jika belum sesuai dapat diubah melalui tab <b>Profile</b> pada menu di atas</marquee>
						<h2 style="margin-top:10px">Ringkasan Akun</h2>
						<center><img src="<?php echo base_url('uploads/photo/'.$data['photo'].'')?>" width="100px" class="profile-pic"></center><br/>
						<?php
						$tahun=$thn;
						$kemarin=$tahun-1;
						$rowdata=$this->db->where('no',$this->session->userdata('peserta_id'))->get('registrasi_'.$kemarin.'')->row_array();
						?>
									
						<table class="table" style="width:75%">
						<?php
						if ($rowdata['prosiding']=="1" && $rowdata['status_bukti']=="2")
						{
							?>
							<tr>
								<td colspan="3"><a href="<?php echo base_url('uploads/cb29a2fe0e49fb43c5702922e933aff1.pdf')?>" target="_blank" class="btn btn-success btn-block">Download Prosiding Tahun <?php echo $kemarin?></a></td>
							</tr>
						<?php
						}
						?>
							<tr>
								<td>Nama Lengkap</td>
								<td>:</td>
								<td><?php echo $this->account_model->nama_peserta_gelar($this->session->userdata('peserta_id'))?></td>
							</tr>
							<tr>
								<td>Institusi</td>
								<td>:</td>
								<td><?php echo $this->account_model->instansi_peserta($this->session->userdata('peserta_id'))?></td>
							</tr>
							<tr>
								<td>Sebagai</td>
								<td>:</td>
								<td><?php echo $this->account_model->nama_kategori($data['kategori'])?></td>
							</tr>
						</table>
						<?php
						if ($data['kategori']!="")
						{
							?>
						<h2 style="margin-top:10px">Data Dokumen</h2>
						<table class="table table-bordered" style="width:75%">
							<thead>
								<tr>
									<th width="15%" style="text-align:center">Subjek</th>
									<th width="70%" style="text-align:center">Keterangan</th>
									<th width="15%" style="text-align:center">Status</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$klas="kategori3";
							if (in_array($data['kategori'],$katpem))
							{
								$klas="kategori2";
								?>
								<tr>
									<td>Abstrak</td>
									<td>
									<?php
									if ($data['judulabstrak']!="")
									{
										?>
										<a href='<?php echo base_url('uploads/abstrak/'.$thn.'/'.$data['abstrak'].'')?>'><?php echo $data['judul']?></a>
										<?php
									}
									else
									{
										echo "<font color='red'>Abstrak belum diupload</font>";
									}
									?>
									</td>
									<?php
									if ($data['status_abstrak']=="0")
									{
										$abstrakstts="<button class='btn btn-xs btn-default'>Belum dicek</button>";
									}
									else if ($data['status_abstrak']=="1")
									{
										$abstrakstts="<button class='btn btn-xs btn-danger'>Tidak lolos</button>";
									}
									else if ($data['status_abstrak']=="2")
									{
										if ($data['review_abstrak']!="")
										{
											$veriff="<a href='".base_url('uploads/abstrak/'.$thn.'/review/'.$data['review_abstrak'].'')."' style='color:white'>Revisi</a>";
										}
										else
										{
											$veriff="Revisi";
										}
										$abstrakstts="<button class='btn btn-xs btn-warning'>".$veriff."</button>";
									}
									else if ($data['status_abstrak']=="3")
									{
										$abstrakstts="<button class='btn btn-xs btn-success'>Diterima</button>";
									}
									?>
									<td><?php echo $abstrakstts?></td>
								</tr>
								<tr>
									<td>Full Paper</td>
									<td>
									<?php
									if ($data['judulfile']!="")
									{
										?>
										<a href='<?php echo base_url('uploads/fullpaper/'.$thn.'/'.$data['fullpaper'].'')?>' ><?php echo $data['judulfile']?></a>
										<?php
									}
									else
									{
										echo "<font color='red'>Full paper belum diupload</font>";
									}
									?>
									</td>
									<?php
									if ($data['status_fullpaper']=="0")
									{
										$fullstts="<button class='btn btn-xs btn-default'>Belum dicek</button>";
									}
									else if ($data['status_fullpaper']=="1")
									{
										$fullstts="<button class='btn btn-xs btn-danger'>Ditolak</button>";
									}
									else if ($data['status_fullpaper']=="2")
									{
										if ($data['review_fullpaper']!="")
										{
											$veriff="<a href='".base_url('uploads/fullpaper/'.$thn.'/review/'.$data['review_fullpaper'].'')."' style='color:white'>Revisi</a>";
										}
										else
										{
											$veriff="Revisi";
										}
										$fullstts="<button class='btn btn-xs btn-warning'>".$veriff."</button>";
									}
									else if ($data['status_fullpaper']=="3")
									{
										$fullstts="<button class='btn btn-xs btn-success'>Diterima</button>";
									}
									?>
									<td><?php echo $fullstts?></td>
								</tr>
							<?php
							}
								?>
								<tr>
									<td>Kwitansi</td>
									
									<?php
									if (in_array($data['kategori'],$katpem))
									{
										$tgll=$data['tglabstrak'];
									}
									else
									{
										$tgll=$data['tanggal'];
									}

									if ($tgll=="")
									{
									?>
									<td><font color="red">Abtsrak belum diupload</font></td>
									<td><button class="btn btn-xs btn-warning">Generate</button></td>
									<?php
									}
									else
									{
										?>
										<td>Kwitansi pembayaran (Total Biaya)</td>
									<td><a href='<?php echo base_url('kwitansi?id='.$data['no'].'')?>' target='_blank'><button class="btn btn-xs btn-primary">Generate</button></a></td>
									<?php
									}
									?>
								</tr>
								<tr>
									<td>Bukti Bayar</td>
									<?php
									$payway=$this->db->where('id',$data['id_payway'])->get('status_payway')->row_array();
									$buktipayway=$this->account_model->status_payway($payway['id_payway']);
									if ($data['buktibayar']!="")
									{
										?>
										<td><a href='<?php echo base_url('uploads/bukti/'.$thn.'/'.$data['buktibayar'].'')?>' target='_blank'><?php echo $data['buktibayar']?></a></td>
										<?php
										if ($data['status_bukti']=="0")
										{
											$buktistts="<button class='btn btn-xs btn-default'>Belum dicek</button>";
										}
										else if ($data['status_bukti']=="1")
										{
											$buktistts="<button class='btn btn-xs btn-danger'>Ditolak</button>";
										}
										else if ($data['status_bukti']=="2")
										{
											$buktistts="<button class='btn btn-xs btn-success'>Diterima</button>";
										}
										else if ($data['status_bukti']=="3")
										{
											$buktistts="<button class='btn btn-xs btn-warning'>Berkas Tidak Lengkap</button>";
										}
										?>
										<td><?php echo $buktistts?></td>
										<?php
									}
									else if ($buktipayway==1)
									{
										$buktistts="<button class='btn btn-xs btn-success'>Diterima</button>";
										?>
										<td><font color="">Payway sudah dibayar</font></td>
										<td><?php echo $buktistts?></td>
										<?php
									}
									else
									{
										?>
										<td><font color="red">Bukti bayar belum diupload</font></td>
										<td><button class="btn btn-xs btn-warning">Belum diupload</button></td>
										<?php
									}
									?>
								</tr>
								<tr>
									<td>Undangan + Kartu Peserta</td>
									<?php
									if (in_array($data['kategori'],$katpem))
									{
										if (($data['status_bukti']=="2" || $buktipayway==1) && $data['status_fullpaper']=="3")
										{
											?>
											<td>Cetak Undangan dan Kartu Peserta</td>
											<td><a href='<?php echo base_url('undangan?id='.md5(date("YmdHis")).$data['no'].'')?>' target='_blank'><button class="btn btn-xs btn-primary">Download</button></a></td>
											<?php
										}
										else
										{
											?>
											<td><font color="red">
												<?php
												if ($buktipayway==1)
												{
													echo "Payway Sudah dibayar";
													echo "<br/>";
												}
												else if ($data['status_bukti']!="2")
												{
													echo "Bukti Pembayaran belum terverifikasi";
													echo "<br/>";
												}
												if ($data['status_fullpaper']!="3")
												{
													echo "Full Paper belum terverifikasi";
												}
												?>
											</font></td>
											<td><button class="btn btn-xs btn-warning">Download</button></td>
											<?php
										}
									}
									else
									{
										if ($data['status_bukti']=="2" || $buktipayway==1)
										{
											?>
											<td>Cetak Undangan dan Kartu Peserta</td>
											<td><a href='<?php echo base_url('undangan?id='.md5(date("YmdHis")).$data['no'].'')?>' target='_blank'><button class="btn btn-xs btn-primary">Download</button></a></td>
											<?php
										}
										else
										{
											?>
											<td><font color="red">
												Bukti bayar belum diverifikasi
											</font></td>
											<td><button class="btn btn-xs btn-warning">Download</button></td>
											<?php
										}
									}
									?>
								</tr>
								
								<?php
								if ($data['prosiding']=="1")
								{
									?>
								<tr>
									<td>Prosiding</td>
									<?php
									if ($data['status_bukti']=="2")
									{
										?>
										<td>Prosiding SEMBIO XII 2017</td>
										<td><a href='<?php echo base_url('uploads/cb29a2fe0e49fb43c5702922e933aff1.pdf')?>' target='_blank'><button class="btn btn-xs btn-success">Download</button></a></td>
										<?php
									}
									else
									{
										?>
										<td><font color="red">Bukti bayar belum terverifikasi</font></td>
										<td><button class="btn btn-xs btn-warning">Download</button></td>
										<?php
									}
									?>
								</tr>
								<?php
								}
								else
								{
									?>
								<tr>
									<td>Prosiding</td>
									<td><font color='red'>Anda tidak memesan prosiding</font></td>
									<td><a href='#'><button class="btn btn-xs btn-warning" disabled>Download</button></a></td>
								</tr>
									<?php
								}
								?>
							</tbody>
						</table>
						<?php
						}
						?>
						</center>
					</div>
				</div>
				<div class="tab-pane fade in" id="s1">
					<form method="POST" action="<?php echo base_url('panel/profil')?>" id="frmreg" class="smart-form client-form" enctype="multipart/form-data">
						<header>
						<center><h3>Data Pribadi</h3></center>
						</header>
						<fieldset>
							<div class="row">
							<section class="col col-6">
								<label class="label">Nama Depan</label>
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="hidden" name="idpes" value="<?php echo $data['no']?>">
										<input type="text" id="firstnama" placeholder="Nama Depan" name="firstnama" value="<?php echo $data['firstname']?>">
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Masukkan Nama Depan Anda</b>
									</label>
							</section>
							<section class="col col-6">
								<label class="label">Nama Belakang</label>
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="text" id="lastnama" placeholder="Nama Belakang" name="lastnama" value="<?php echo $data['lastname']?>">
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Masukkan Nama Belakang Anda</b>
									</label>
							</section>
							</div>

							<section>
								<label class="label">Gelar Depan</label>
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="text" placeholder="Gelar Depan" name="gelar_1" value="<?php echo $data['gelar_depan']?>">
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Masukkan Gelar Depan Anda</b>
									</label>
							</section>
								
							<section>
									<label class="label">Gelar Belakang</label>
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="text" placeholder="Gelar Belakang" name="gelar_2" value="<?php echo $data['gelar_belakang']?>">
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Masukkan Gelar Belakang Anda</b>
									</label>
							</section>
								
							<section>
									<label class="label">Institusi</label>
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="text" placeholder="Nama Institusi" name="institusi" id="institusi" value="<?php echo $data['institusi']?>">
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Masukkan Nama Institusi Anda</b>
									</label>
							</section>
								
							<section>
									<label class="label">Email</label>
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="email" placeholder="Email" name="email" id="email" value="<?php echo $data['email']?>" readonly>
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Masukkan Email Anda</b>
									</label>
							</section>
								
							<section>
									<label class="label">Alamat Surat</label>
									<label class="textarea">
										<textarea rows="3" placeholder="Alamat Lengkap" name="kirimprosiding"><?php echo $data['kirimprosiding']?></textarea>
									</label>
							</section>
								
							<section>
									<label class="label">Nomor HP / Mobile Phone</label>
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="text" placeholder="Nomor HP Anda" name="nohp" onkeypress="return isNumberKey(event)" id="nohp" value="<?php echo $data['hp']?>" readonly>
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Masukkan Nomor HP Anda</b>
									</label>
									<div class="note">
										<font color="red">Hanya angka, tanpa tanda + ( ) dan /, contoh <strong>082335554320</strong></font>
									</div>
							</section>
							<section>
									<label class="label">Photo Profile</label>
									<img src="<?php echo base_url('uploads/photo/'.$data['photo'].'')?>" width="100px" class="profile-pic"><br/><br/>
									<div class="input input-file">
										<span class="button"><input type="file" id="file" name="photo" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
									</div>
									<div class="note"><font color="red">Ukuran Maksimal 200kb</font></div>
							</section>
							</fieldset>
							<footer>
							<input name="update" value="Update" type="submit" class="btn btn-success">
							</footer>
							</form>
				</div>
				<div class="tab-pane fade" id="s2">
					<form method="POST" action="<?php echo base_url('panel/daftar')?>" id="frmreg" class="smart-form client-form">
						<header>
							<center><h3>Daftar Sembio <?php echo $thn ?></h3></center>
						</header>
						<fieldset>
						<section>
						<input type="hidden" name="idpes" value="<?php echo $data['no']?>">
								<label class="label">Keikutsertaan</label>
								<div class="inline-group">
								<?php
								foreach ($this->db->get('ref_kategori')->result_array() as $kat)
								{
									echo '<label class="radio"><input name="kategori" value="'.$kat['kat_id'].'" type="radio" class="kategori1"><i></i>'.$kat['kat_nama'].'</label>';
								}
								//<label class="radio"><input name="kategori" value="2" class="kategori1" type="radio" checked><i></i>Non Pemakalah S1 atau S2</label>
								//<label class="radio"><input name="kategori" value="3" class="kategori1" type="radio"><i></i>Non Pemakalah S3 atau Umum</label>
								?>
						</section>
							
						<section>
								<label class="label">Pemesanan prosiding (Soft File)</label>
								<div class="inline-group">
								<label class="radio"><input name="prosiding" value="1" class="pesan1" type="radio" checked><i></i>Ya</label>
								<label class="radio"><input name="prosiding" value="0" class="pesan1" type="radio"><i></i>Tidak</label>
						</section>
				</fieldset>
				<div id="pemakalah">
				<fieldset>
						<section>
						<label class="label"><b>Untuk Pemakalah Silakan lengkapi data berikut:</b></label>
						</section>
						<section>
							<label class="label">Status Makalah</label>
								<select class="form-control statusmakalah" id="statusmakalah" name="statusmakalah">
									<option value="1">Makalah Pertama</option>
									<option value="2">Makalah Kedua</option>
								</select>
							</label>
						</section>
						<hr/>
						<div id="makalahkedua">
						<div class="row">
							<label class="label" style="padding-left:15px">Masukkan Email atau No Handphone Makalah Pertama</label>
							
							<section class="col col-10">
								<label class="input">
									<input type="text" name="datapertama" id="datapertama">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Email atau No Handphone Makalah Pertama</b>
								</label>
							</section>
							<section class="col col-2">
								<input type='button' id='check_availability' class="btn btn-sm btn-block btn-primary" value='Cek'>
							</section>
							
						</div>
						<div id='availability_result' style="color:red"></div>
						<br/>
						</div>
						<input type="hidden" value="" id="judupertama" name="judupertama">

						<div class="row">
						<section class="col col-12">
						<label class="label">Jenis Artikel</label>
							<select class="form-control" id="jenisartikel" name="jenisartikel">
								<?php
								foreach($this->db->get('ref_artikel')->result_array() as $row)
								{
									echo "<option value='".$row['id_artikel']."'>".$row['nama_artikel']."</option>";
								}
								?>
							</select>
						</label>
					</section>
					</div>
					
					<div class="row">
					<section class="col col-12">
						<label class="label">Bidang Ilmu</label>
							<select class="form-control" id="bidangilmu" name="bidangilmu" >
								<?php
								foreach($this->db->get('ref_bidang')->result_array() as $row)
								{
									echo "<option value='".$row['kode']."'>".$row['bidang']."</option>";
								}
								?>
							</select>
						</label>
					</section>
					</div>
					<marquee style="font-size:14px">Pastikan <font color="red"><b>nama</b></font> dan <font color="red"><b>gelar</b></font> Co-Author sudah sesuai karena akan digunakan untuk sertifikat.</marquee>
					<br><b>Co. Author (Jika Ada)</b>
						<div class="row">
							<label class="label" style="padding-left:15px"><br/>Penulis ke-2</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama2" id="fnama2">
									<input type="text" placeholder="Nama Penulis Ke-2" name="nama2" id="nama2" style="width:65%;display:inline">
									<input type="text" style="width:15%;display:inline" name="lnama2" id="lnama2">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-2</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-2" name="institusi2" id="institusi2">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-2</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-3</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama3" id="fnama3">
									<input type="text" placeholder="Nama Penulis Ke-3" name="nama3" style="width:65%;display:inline" id="nama3">
									<input type="text" style="width:15%;display:inline" name="lnama3" id="lnama3">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-3</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-3" name="institusi3" id="institusi3">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-3</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-4</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama4" id="fnama4">
									<input type="text" placeholder="Nama Penulis Ke-4" name="nama4" style="width:65%;display:inline" id="nama4">
									<input type="text" style="width:15%;display:inline" name="lnama4" id="lnama4">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-4</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-4" name="institusi4" id="institusi4">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-4</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-5</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama5" id="fnama5">
									<input type="text" placeholder="Nama Penulis Ke-5" name="nama5" style="width:65%;display:inline" id="nama5">
									<input type="text" style="width:15%;display:inline" name="lnama5" id="lnama5">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-5</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-5" name="institusi5" id="institusi5">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-5</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-6</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama6" id="fnama6">
									<input type="text" placeholder="Nama Penulis Ke-6" name="nama6" style="width:65%;display:inline" id="nama6">
									<input type="text" style="width:15%;display:inline" name="lnama6" id="lnama6">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-6</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-6" name="institusi6" id="institusi6">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-6</b>
								</label>
							</section>
						</div>
					</fieldset>
			</div>
				<footer>
				<?php
				if ($data['status_abstrak']=="3")
				{
					$diss="disabled";
				}
				else if ($data['id_payway']!="")
				{
					$diss="disabled";
				}
				else
				{
					$diss="";
				}
				?>
					<input name="daftar" value="Update" type="submit" id="uppdate" class="btn btn-success" <?php echo $diss?>>
				</footer>
				</form>
				</div>
				<div class="tab-pane fade" id="s22">
					<form method="POST" action="<?php echo base_url('panel/daftar')?>" id="frmreg" class="smart-form client-form">
						<header>
							<center><h3>Daftar Sembio <?php echo $thn ?></h3></center>
						</header>
						<fieldset>
						<section>
						<input type="hidden" name="idpes" value="<?php echo $data['no']?>">

								<label class="label">Keikutsertaan</label>
								<div class="inline-group">
								<?php
								foreach ($this->db->get('ref_kategori')->result_array() as $kat)
								{
									$select="";
									if ($data['kategori']==$kat['kat_id'])
									{
										$select="checked";
									}

									echo '<label class="radio"><input name="kategori" value="'.$kat['kat_id'].'" type="radio" class="'.$klas.'" '.$select.'><i></i>'.$kat['kat_nama'].'</label>';
								}
								?>
						</section>
							
						<section>
								<label class="label">Pemesanan prosiding (Soft File)</label>
								<div class="inline-group">
								<label class="radio"><input name="prosiding" value="1" class="pesan1" type="radio" <?php if ($data['prosiding']=="1") { echo "checked"; }?>><i></i>Ya</label>
								<label class="radio"><input name="prosiding" value="0" class="pesan1" type="radio" <?php if ($data['prosiding']=="0") { echo "checked"; }?>><i></i>Tidak</label>
						</section>
				</fieldset>
				<?php
				if (in_array($data['kategori'],$katpem))
				{
					?>
				<div id="pemakalah2">
				<fieldset>
						<section>
							<label class="label"><b>Untuk Pemakalah Silakan lengkapi data berikut:</b></label>
						</section>
						<?php
						if ($data['statusmakalah']!='')
						{
							?>
						<br/>
						<h3><center><b>Status Makalah : <font color="blue"> Makalah <?php if ($data['statusmakalah']=='1') { echo "Pertama"; } else if ($data['statusmakalah']=='2') { echo "Kedua"; };?></font></b></center>
						</h3>
						<br/>
						<?php
					}
					?>
						<div class="row">
						<section class="col col-12">
						<label class="label">Jenis Artikel</label>
							<select class="form-control" id="jenisartikel" name="jenisartikel">
								<?php
								foreach($this->db->get('ref_artikel')->result_array() as $row)
								{
									if ($row['id_artikel']==$data['jenis_artikel'])
									{
										$select="selected";
									}
									else
									{
										$select="";
									}
									echo "<option value='".$row['id_artikel']."' ".$select.">".$row['nama_artikel']."</option>";
								}
								?>
							</select>
						</label>
					</section>
					</div>
					
					<div class="row">
					<section class="col col-12">
						<label class="label">Bidang Ilmu</label>
							<select class="form-control" id="jenisartikel" name="bidangilmu" >
								<?php
								foreach($this->db->get('ref_bidang')->result_array() as $row)
								{
									if ($row['kode']==$data['bidang_ilmu'])
									{
										$select="selected";
									}
									else
									{
										$select="";
									}

									echo "<option value='".$row['kode']."' ".$select.">".$row['bidang']."</option>";
								}
								?>
							</select>
						</label>
					</section>
					</div><br>
					<marquee style="font-size:14px">Pastikan <font color="red"><b>nama</b></font> dan <font color="red"><b>gelar</b></font> Co-Author sudah sesuai karena akan digunakan untuk sertifikat.</marquee>
					<b>Co. Author (Jika Ada)</b>
						<div class="row">
							<label class="label" style="padding-left:15px"><br/>Penulis ke-2</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama2" value="<?php echo $data['fn_writer2']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-2" name="nama2" style="width:65%;display:inline" value="<?php echo $data['co_writer2']?>">
									<input type="text" style="width:15%;display:inline" name="lnama2" value="<?php echo $data['ln_writer2']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-2" name="institusi2" value="<?php echo $data['institusi_cowriter2']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-2</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-3</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama3" value="<?php echo $data['fn_writer3']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-3" name="nama3" style="width:65%;display:inline" value="<?php echo $data['co_writer3']?>">
									<input type="text" style="width:15%;display:inline" name="lnama3" value="<?php echo $data['ln_writer3']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-3" name="institusi3" value="<?php echo $data['institusi_cowriter3']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-3</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-4</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama4" value="<?php echo $data['fn_writer4']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-4" name="nama4" style="width:65%;display:inline" value="<?php echo $data['co_writer4']?>">
									<input type="text" style="width:15%;display:inline" name="lnama4" value="<?php echo $data['ln_writer4']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-4" name="institusi4" value="<?php echo $data['institusi_cowriter4']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-4</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-5</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama5" value="<?php echo $data['fn_writer5']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-5" name="nama5" style="width:65%;display:inline" value="<?php echo $data['co_writer5']?>">
									<input type="text" style="width:15%;display:inline" name="lnama5" value="<?php echo $data['ln_writer5']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-5" name="institusi5" value="<?php echo $data['institusi_cowriter5']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-5</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-6</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama6" value="<?php echo $data['fn_writer6']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-6" name="nama6" style="width:65%;display:inline" value="<?php echo $data['co_writer6']?>">
									<input type="text" style="width:15%;display:inline" name="lnama6" value="<?php echo $data['ln_writer6']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-6" name="institusi6" value="<?php echo $data['institusi_cowriter6']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-6</b>
								</label>
							</section>
						</div>
					</fieldset>
			</div>
			<?php
			}else {
			?>
			<div id="pemakalah3">
				<fieldset>
						<section>
							<label class="label"><b>Untuk Pemakalah Silakan lengkapi data berikut:</b></label>
						</section>
						<?php
						if ($data['statusmakalah']!='')
						{
							?>
							<br/>
							<h3><center><b>Status Makalah : <font color="blue"> Makalah <?php if ($data['statusmakalah']=='1') { echo "Pertama"; } else if ($data['statusmakalah']=='2') { echo "Kedua"; };?></font></b></center>
							</h3>
							<br/>
							<?php
						}
						else
						{
						?>
						<section>
							<label class="label">Status Makalah</label>
								<select class="form-control statusmakalah" id="statusmakalah" name="statusmakalah">
									<option value="1">Makalah Pertama</option>
									<option value="2">Makalah Kedua</option>
								</select>
							</label>
						</section>
						<hr/>
						<div id="makalahkedua">
						<div class="row">
							<label class="label" style="padding-left:15px">Masukkan Email atau No Handphone Makalah Pertama</label>
							
							<section class="col col-10">
								<label class="input">
									<input type="text" name="datapertama" id="datapertama">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Email atau No Handphone Makalah Pertama</b>
								</label>
							</section>
							<section class="col col-2">
								<input type='button' id='check_availability' class="btn btn-sm btn-block btn-primary" value='Cek'>
							</section>
							
						</div>
						<div id='availability_result' style="color:red"></div>
						<br/>
						</div>
						<input type="hidden" value="" id="judupertama" name="judupertama">
						<?php
						}
						?>
						<div class="row">
						<section class="col col-12">
						<label class="label">Jenis Artikel</label>
							<select class="form-control" id="jenisartikel" name="jenisartikel">
								<?php
								foreach($this->db->get('ref_artikel')->result_array() as $row)
								{
									if ($row['id_artikel']==$data['jenis_artikel'])
									{
										$select="selected";
									}
									else
									{
										$select="";
									}
									echo "<option value='".$row['id_artikel']."' ".$select.">".$row['nama_artikel']."</option>";
								}
								?>
							</select>
						</label>
					</section>
					</div>
					
					<div class="row">
					<section class="col col-12">
						<label class="label">Bidang Ilmu</label>
							<select class="form-control" id="jenisartikel" name="bidangilmu" >
								<?php
								foreach($this->db->get('ref_bidang')->result_array() as $row)
								{
									if ($row['kode']==$data['bidang_ilmu'])
									{
										$select="selected";
									}
									else
									{
										$select="";
									}

									echo "<option value='".$row['kode']."' ".$select.">".$row['bidang']."</option>";
								}
								?>
							</select>
						</label>
					</section>
					</div><br>
					<marquee style="font-size:14px">Pastikan <font color="red"><b>nama</b></font> dan <font color="red"><b>gelar</b></font> Co-Author sudah sesuai karena akan digunakan untuk sertifikat.</marquee>
					<b>Co. Author (Jika Ada)</b>
						<div class="row">
							<label class="label" style="padding-left:15px"><br/>Penulis ke-2</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama2" value="<?php echo $data['fn_writer2']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-2" name="nama2" style="width:65%;display:inline" value="<?php echo $data['co_writer2']?>">
									<input type="text" style="width:15%;display:inline" name="lnama2" value="<?php echo $data['ln_writer2']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-2" name="institusi2" value="<?php echo $data['institusi_cowriter2']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-2</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-3</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama3" value="<?php echo $data['fn_writer3']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-3" name="nama3" style="width:65%;display:inline" value="<?php echo $data['co_writer3']?>">
									<input type="text" style="width:15%;display:inline" name="lnama3" value="<?php echo $data['ln_writer3']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-3" name="institusi3" value="<?php echo $data['institusi_cowriter3']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-3</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-4</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama4" value="<?php echo $data['fn_writer4']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-4" name="nama4" style="width:65%;display:inline" value="<?php echo $data['co_writer4']?>">
									<input type="text" style="width:15%;display:inline" name="lnama4" value="<?php echo $data['ln_writer4']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-4" name="institusi4" value="<?php echo $data['institusi_cowriter4']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-4</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-5</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama5" value="<?php echo $data['fn_writer5']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-5" name="nama5" style="width:65%;display:inline" value="<?php echo $data['co_writer5']?>">
									<input type="text" style="width:15%;display:inline" name="lnama5" value="<?php echo $data['ln_writer5']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-5" name="institusi5" value="<?php echo $data['institusi_cowriter5']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-5</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-6</label>
							
							<section class="col col-6">
								<label class="input">
									<input type="text" style="width:15%;display:inline" name="fnama6" value="<?php echo $data['fn_writer6']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Depan</b>
									<input type="text" placeholder="Nama Penulis Ke-6" name="nama6" style="width:65%;display:inline" value="<?php echo $data['co_writer6']?>">
									<input type="text" style="width:15%;display:inline" name="lnama6" value="<?php echo $data['ln_writer6']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Gelar Belakang</b>
								</label>
							</section>
							<section class="col col-6">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-6" name="institusi6" value="<?php echo $data['institusi_cowriter6']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-6</b>
								</label>
							</section>
						</div>
					</fieldset>
			</div>
			<?php
			}
			?>
			<?php
				if ($data['status_fullpaper']=="3")
				{
					$diss="disabled";
				}
				else if ($data['id_payway']!="")
				{
					$diss="disabled";
				}
				else
				{
					$diss="";
				}
				?>
				<footer>
					<input name="daftar" value="Update" type="submit" class="btn btn-success" <?php echo $diss ?>>
				</footer>
				</form>
				</div>
				<div class="tab-pane fade" id="s3">
					<div class="well" style="color:#000">
						<center>
						<h3>Selamat Datang <b><?php echo $this->account_model->nama_peserta_gelar($data['no']) ?></b>,<br/> Silakan Upload <font color="red">Abstrak</font> Anda</h3>
						<form method="post" action="<?php echo base_url('panel/abstrak')?>" enctype="multipart/form-data" class="smart-form client-form">
						<input type="hidden" name="id" value="<?php echo $data['no'] ?>">
						<fieldset>
						<div class="row" style="margin-left:10%">
						<section class="col col-10">
						<label class="label"><b>Judul Abstrak <font color="red"><sup>*</sup></font></b></label>
								<label class="textarea">
									<textarea rows="3" name="judul_id" placeholder="Judul Abstrak Bahasa Indonesia" class="custom-scroll" required><?php echo $data['judul']?></textarea> 
								</label>
							</section>
						</div>
						
						<div class="row" style="margin-left:10%">
						<section class="col col-10">
						<label class="label"><b>Kata Kunci <font color="red"><sup>*</sup></font></b></label>
								<label class="input"><i class="icon-append fa fa-key"></i>
									<input type="text" placeholder="Kata Kunci" name="kata_kunci" required value="<?php echo $data['kata_kunci']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Kata Kunci Abstrak (Pisahkan dengan koma ',' )</b>
								</label>
							</section>
						</div>
						<div class="row" style="margin-left:10%">
						<section class="col col-10">
						<label class="label"><b>Title Abstract <font color="red"><sup>*</sup></font></b></label>
								<label class="textarea">
									<textarea rows="3" name="judul_en" placeholder="Title Abstract in English" class="custom-scroll" required><?php echo $data['title']?></textarea> 
								</label>
							</section>
						</div>
						
						<div class="row" style="margin-left:10%">
						<section class="col col-10">
						<label class="label"><b>Keyword <font color="red"><sup>*</sup></font></b></label>
								<label class="input"><i class="icon-append fa fa-key"></i>
									<input type="text" placeholder="Keyword" name="keyword" required value="<?php echo $data['keyword']?>">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Insert abstract keywords (separated by comma ',' )</b>
								</label>
							</section>
						</div>
						</fieldset>
						<div class="row">
							<section class="col col-2">
							</section>
							
							<section class="col col-6">
								<input type="file" name="abstrak" class="form-control" style="width:100%" style="display:inline" required>
							</section>
							<section class="col col-2">
								<?php
								if ($data['status_abstrak']=="3")
								{
									$disabled="disabled";
								}
								else
								{
									$disabled="";
								}
								?>
								<input type="submit" class="btn btn-sm btn-success" name="kirim" value="Upload" style="display:inline" <?php echo $disabled?>>
							</section>
						</div>
						<b>File yang dapat di upload hanya yang berekstensi .doc atau .docx</b><br/><br/>
						<?php
						if ($data['judulabstrak']!="")
						{
							if ($data['status_abstrak']=="3")
							{
								$ketverif="<font color='green'><b>Lolos</b></font>";
							}
							else if ($data['status_abstrak']=="2")
							{
								if ($data['review_abstrak']!="")
								{
									$revv="(<a href='".base_url('uploads/abstrak/'.$thn.'/review/'.$data['review_abstrak'].'')."'>Download Review Panitia</a>)";
								}
								else
								{
									$revv="";
								}
								$ketverif="<font color='orange'><b>Revisi</b> ".$revv."</font>";
							}
							else if ($data['status_abstrak']=="1")
							{
								$ketverif="<font color='red'><b>Tidak Lolos</b></font>";
							}
							else
							{
								$ketverif="<font color='blue'><b>Belum Dicek</b></font>";
							}
							echo "<center><b>File Abstrak Anda</b> = <a href='".base_url('uploads/abstrak/'.$thn.'/'.$data['abstrak'].'')."'>".$data['judulabstrak']."</a><br/>Status Verifikasi = ".$ketverif."</center><br/>";
						}
						?>
						</form>
						
					</center>
					</div>
				</div>
				<div class="tab-pane fade" id="s4">
					<div class="well" style="color:#000">
						<center>
						<h3>Selamat Datang <b><?php echo $this->account_model->nama_peserta_gelar($data['no']) ?></b>,<br/> Silakan Upload <font color="red">Full Paper</font> Anda</h3>
						<form method="post" action="<?php echo base_url('panel/fullpaper')?>" enctype="multipart/form-data" class="smart-form client-form">
						<input type="hidden" name="id" value="<?php echo $data['no'] ?>">
						
						<div class="row">
						<section class="col col-2">
						</section>
						<section class="col col-6">
							<input type="file" name="fullpaper" class="form-control" style="width:100%" required>
						</section>
						<section class="col col-2">
							<?php
							if ($data['status_fullpaper']=="3")
							{
								$disabled="disabled";
							}
							else
							{
								$disabled="";
							}
							?>
							<input type="submit" class="btn btn-sm btn-success" name="kirim" value="Upload" <?php echo $disabled?>>
						</section>
						</div>
						<b>File yang dapat di upload hanya yang berekstensi .doc atau .docx</b><br/><br/>
						<?php
						if ($data['fullpaper']!="")
						{
							if ($data['status_fullpaper']=="3")
							{
								$ketverif="<font color='green'><b>Lolos</b></font>";
							}
							else if ($data['status_fullpaper']=="2")
							{
								if ($data['review_fullpaper']!="")
								{
									$revv="(<a href='".base_url('uploads/fullpaper/'.$thn.'/review/'.$data['review_fullpaper'].'')."'>Download Review Panitia</a>)";
								}
								else
								{
									$revv="";
								}
								$ketverif="<font color='orange'><b>Revisi</b> ".$revv."</font>";
							}
							else if ($data['status_fullpaper']=="1")
							{
								$ketverif="<font color='red'><b>Tidak Lolos</b></font>";
							}
							else
							{
								$ketverif="<font color='blue'><b>Belum Dicek</b></font>";
							}
							echo "<center><b>File Full Paper Anda</b> = <a href='".base_url('uploads/fullpaper/'.$thn.'/'.$data['fullpaper'].'')."'>".$data['judulfile']."</a><br/>Status Verifikasi = ".$ketverif."</center><br/>";
						}
						?>
						</form>
					</center>
					</div>
				</div>
				<div class="tab-pane fade" id="s5">
					<div class="well" style="color:#000">
					<?php
					if ($data['judulabstrak']=="" && in_array($data['kategori'],$katpem))
						{
							echo "<h3><center>Silakan Upload Abstrak Terlebih Dahulu</center></h3>";
						}
						else
						{
							?>
						<center>
						<h3>Selamat Datang <b><?php echo $this->account_model->nama_peserta_gelar($data['no']) ?></b>,<br/> Silakan Upload <font color="red">Bukti Bayar</font> Anda</h3>
						<?php
							$diskonhppbi=$this->account_model->setting('hppbi');
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

							if ($data['is_hppbi']=='3')
							{
								$hppbi=$diskonhppbi;
							}
							else
							{
								$hppbi=0;
							}

							$totalakhir=$harga+$biayacoauthor-$hppbi;
							?>
						<center>
						
						<?php
						if (in_array($data['kategori'],$katpem))
						{
							?>
							<form method="POST" action="<?php echo base_url('panel/daftar_update')?>">
							<input type="hidden" name="idpes" value="<?php echo $data['no']?>">
							<table class="table" style="width:60%">
							<tr>
								<th colspan="2"><center>Verifikasi rencana kehadiran Co-author</center></th>
							</tr>
							<?php
							$hadir=explode(',',$data['cowriter_hadir']);
							for($j=2;$j<7;$j++)
							{
								if ($data['co_writer'.$j.'']!="")
								{
									if (in_array($j,$hadir))
									{
										$checked="checked";
									}
									else
									{
										$checked="";
									}
									echo "<tr>
											<td>".$data['co_writer'.$j.'']."</td>
											<td><input type='checkbox' class='form-control' name='tempjum[]' value='".$j."' ".$checked."></td>
										  </tr>";
								}
							}
							?>
						</table>
						<?php
						if ($data['status_bukti']=="2")
						{
							$diss="disabled";
						}
						else if ($data['id_payway']!="")
						{
							$diss="disabled";
						}
						else
						{
							$diss="";
						}
						?>
						<input type="submit" class="btn btn-sm btn-warning" value="Update Biaya Seminar" name="update" <?php echo $diss ?>>
						<a href= "<?php echo base_url('kwitansi?id='.$data['no'].'')?>" target='_blank' class="btn btn-sm btn-primary">Generate Bukti Bayar</a>
						</form>
						<?php
						}

						if ($data['is_hppbi']=="3")
						{
							$ketverif="<font color='green'><b>Terverifikasi</b></font>";
							$dis="disabled";
						}
						else
						{
							$ketverif="<font color='orange'><b>Belum Terverifikasi</b></font>";
							$dis="";
						}

						if ($data['is_generated']=="1")
						{
							$dis="disabled";
						}
						?>
						<br/>
						<form method="POST" action="<?php echo base_url('panel/daftar_update')?>" enctype="multipart/form-data">
							<input type="hidden" name="idpes" value="<?php echo $data['no']?>">
							<input type="hidden" name="jenis" value="hppbi">
							<table class="table" style="width:60%">
							<tr>
								<th colspan="2"><center>Silakan Upload Kartu HPPBI. Dapatkan Diskon Rp. <?php echo number_format($diskonhppbi,0,',','.')?> Untuk Anggota HPPBI</center></th>
							</tr>
							<tr>
								<td colspan="2">
									<input type="file" name="hppbi" class="form-control" style="width:100%" <?php echo $dis ?> required><br/><b>File yang dapat di upload hanya yang berekstensi .pdf atau .jpg atau .jpeg atau .png</b><br/><br/>
									<center><input type="submit" class="btn btn-success" name="kirim" value="Upload" <?php echo $dis ?>></center>
								</td>
							</tr>
						<?php
						if ($data['kta_hppbi']!='')
						{
							echo "<tr>";
							echo "<td colspan='2'><center><b>File KTA HPPBI Anda</b> = <a href='".base_url('uploads/hppbi/2018/'.$data['kta_hppbi'].'')."' target='_blank'>".$data['kta_hppbi']."</a><br/>Status Verifikasi = ".$ketverif."</center><br/></td>";
							echo "</tr>";
						}
						?>
							</table>
						</form>
						<table class="table" style="width:80%">
							<tr>
							<?php
							$early=$this->account_model->setting('bayar_early');
							if (substr($data['tglabstrak'],0,10)<=$early)
							{
								// $kett="(Early Bird)";
								$kett="(Regular)";
							}
							else
							{
								$kett="(Regular)";
							}
							?>
								<td style="width:30%"><?php echo $this->account_model->nama_kategori($data['kategori'])." ".$kett?></td>
								<td>Rp. <?php echo number_format($harga,2,',','.')?></td>
							</tr>
							<?php
							if (in_array($data['kategori'],$katpem))
							{
								?>
							<tr>
								<td><i>Co-Author</i></td>
								<td>Rp. <?php echo $this->account_model->tampil_biaya_co_author($data['no']);?></td>
							</tr>
								<?php
							}
							?>
							<tr>
								<td>Diskon HPPBI</td>
								<td><font color='red'> - Rp. <?php echo number_format($hppbi,0,',','.')?></font></td>
							</tr>
							<tr>
								<td colspan="2"><h4><center><font color="blue"><b>Total Biaya = Rp. <?php echo number_format($totalakhir,2,',','.')?></b></font></center></h4></td>
							</tr>
							<tr>
								<td>Kirim ke</td>
								<td>Payment Gateway UNS</td>
							</tr>
						</table>
						<?php
						if ($data['is_generated']=='1')
						{
							?>
							<!--
							<form method="post" action="<?php echo base_url('panel/bukti')?>" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $data['no'] ?>">
							<?php
							$dis="";
							if ($data['buktibayar']!="")
							{
								if ($data['status_bukti']=="2")
								{
									$ketverif="<font color='green'><b>Terverifikasi</b></font>";
									$dis="disabled";
								}
								else if ($data['status_bukti']=="3")
								{
									$ketverif="<font color='orange'><b>Berkas Tidak Lengkap</b></font>";
									$dis="";
								}
								else
								{
									$ketverif="<font color='red'><b>Belum Terverifikasi</b></font>";
									$dis="";
								}
								echo "<center><b>File Bukti Bayar Anda</b> = <a href='".base_url('uploads/bukti/'.$thn.'/'.$data['buktibayar'].'')."' target='_blank'>".$data['buktibayar']."</a><br/>Status Verifikasi = ".$ketverif."</center><br/>";
							}
							?>
							<input type="file" name="bukti" class="form-control" style="width:50%" required><br/><b>File yang dapat di upload hanya yang berekstensi .pdf atau .jpg atau .jpeg atau .png</b><br/><br/>
							<input type="submit" class="btn btn-success" name="kirim" value="Upload" <?php echo $dis ?>>
							</form>
							-->
							<?php
							$payway=$this->db->where('id',$data['id_payway'])->get('status_payway')->row_array();
							?>
							<table class="table" style="width:80%">
								<tr>
									<td style="width:30%">Virtual Account</td>
									<td><?php echo $payway['virtual_account']?> (Bank Mandiri)</td>
								</tr>
								<tr>
									<td>Jumlah Tagihan</td>
									<td><?php echo $payway['mata_uang']?> <?php echo number_format($payway['tagihan'],0,',','.')?></td>
								</tr>
								<tr>
									<td>Batas Awal Pembayaran</td>
									<td><?php echo $payway['tgl_awal_bayar']?></td>
								</tr>
								<tr>
									<td>Batas Akhir Pembayaran</td>
									<td><?php echo $payway['tgl_akhir_bayar']?></td>
								</tr>
								<tr>
									<td colspan="2"><a href="https://payway.uns.ac.id/tutorial/cara-bayar-mandiri" target="_blank" class="btn btn-block btn-primary">Cara Pembayaran</a></td>
								</tr>
							</table>
						<?php
						}
						else
						{
							?>
							<form method="post" action="<?php echo base_url('panel/genbayar')?>" enctype="multipart/form-data" onsubmit="return confirm('Pastikan isian telah sesuai sebelum mengenerate Virtual Account Pembayaran. Apabila pembayaran telah di generate maka data sudah tidak bisa diubah kembali')">
							<b>Pastikan isian telah sesuai sebelum mengenerate Virtual Account Pembayaran. Apabila pembayaran telah di generate maka data sudah tidak bisa diubah kembali</b><br/><br/>
							<input type="hidden" name="id" value="<?php echo $data['no']?>">
							<input type="submit" class="btn btn-success btn-block" name="kirim" value="Generate Akun Pembayaran">
							</form>
							<?php
						}
					}
						?>
					</center>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('footer');
?>

	
	
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo base_url('asset/asset_admin/')?>/js/plugin/pace/pace.min.js"></script>

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="https://distribution2.info/js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="https://distribution2.info/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
		<script src="http://distribution2.info/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/jarvis.widget.min.js"></script>

		<!-- EASY PIE CHARTS -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/bootstrap-slider.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/fastclick.js"></script>

		<!--[if IE 7]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!-- Demo purpose only -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/demo.js"></script>

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url('asset/asset_home/')?>/js/app.js"></script>		

		<script type="text/javascript">
		
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			
			$(document).ready(function() {
				pageSetUp();
			})

		</script>
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/ckeditor/ckeditor.js"></script>
		
		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!

		</script>

		<script type="text/javascript">
		var pem=[];
		<?php
		$pemak=$this->account_model->kategori('pemakalah');
		for($i=0;$i<count($pemak);$i++)
		{
			?>
			pem.push(<?php echo $pemak[$i]?>);
		<?php
		}
		?>

		function inArray(needle, haystack) {
		    var length = haystack.length;
		    for(var i = 0; i < length; i++) {
		        if(haystack[i] == needle) return true;
		    }
		    return false;
		}

		$(document).ready(function () {

			$('#pemakalah').hide();
			$("#pemakalah3").hide();
			$("#makalahkedua").hide();
			$(".kategori1").click(function () { //use change event
				if (inArray($(this).attr("value"),pem)) {
					$("#pemakalah").show();
				}
				else
				{
					$("#pemakalah").hide();
				}			
			});

 
	        var checking_html = 'Tunggu Sebentar...';  
	  
	        //when button is clicked  
	        $('#check_availability').click(function(){  
	            //run the character number check  
	            if($('#datapertama').val()==""){  
                	//if it's bellow the minimum show characters_error text '  
                	$('#availability_result').html('Data Tidak Ditemukan');  
            	}else{
	                //else show the cheking_text and run the function to check  
	                $('#availability_result').html(checking_html);  
	                check_availability(); 
	            } 
	        });  
		});

		//function to check availability  
		function check_availability(){  
		  
		        //get the username  
		        var username = $('#datapertama').val();  
		  
		        //use ajax to run the check  
		        $.post("<?php echo base_url('panel/cekpertama')?>", { username: username },  
		            function(result){  
		                //if the result is 1  
		                if(result != '0'){  
		                    //show that the username is available  
		                    $('#availability_result').html('Data Makalah pertama : ' + result);  

		                     $('#judulpertama').val(result);

		                    $("#jenisartikel").prop('disabled',false);
							$("#bidangilmu").prop('disabled',false);
							$("#fnama2").prop('disabled',false);
							$("#nama2").prop('disabled',false);
							$("#lnama2").prop('disabled',false);
							$("#institusi2").prop('disabled',false);
							$("#fnama3").prop('disabled',false);
							$("#nama3").prop('disabled',false);
							$("#lnama3").prop('disabled',false);
							$("#institusi3").prop('disabled',false);
							$("#fnama4").prop('disabled',false);
							$("#nama4").prop('disabled',false);
							$("#lnama4").prop('disabled',false);
							$("#institusi4").prop('disabled',false);
							$("#fnama5").prop('disabled',false);
							$("#nama5").prop('disabled',false);
							$("#lnama5").prop('disabled',false);
							$("#institusi5").prop('disabled',false);
							$("#fnama6").prop('disabled',false);
							$("#nama6").prop('disabled',false);
							$("#lnama6").prop('disabled',false);
							$("#institusi6").prop('disabled',false);
							$("#uppdate").prop('disabled',false);
							

		                }else{  
		                    //show that the username is NOT available  
		                    $('#availability_result').html(username + ' tidak terdaftar');  

							$("#jenisartikel").prop('disabled',true);
							$("#bidangilmu").prop('disabled',true);
							$("#fnama2").prop('disabled',true);
							$("#nama2").prop('disabled',true);
							$("#lnama2").prop('disabled',true);
							$("#institusi2").prop('disabled',true);
							$("#fnama3").prop('disabled',true);
							$("#nama3").prop('disabled',true);
							$("#lnama3").prop('disabled',true);
							$("#institusi3").prop('disabled',true);
							$("#fnama4").prop('disabled',true);
							$("#nama4").prop('disabled',true);
							$("#lnama4").prop('disabled',true);
							$("#institusi4").prop('disabled',true);
							$("#fnama5").prop('disabled',true);
							$("#nama5").prop('disabled',true);
							$("#lnama5").prop('disabled',true);
							$("#institusi5").prop('disabled',true);
							$("#fnama6").prop('disabled',true);
							$("#nama6").prop('disabled',true);
							$("#lnama6").prop('disabled',true);
							$("#institusi6").prop('disabled',true);
							$("#uppdate").prop('disabled',true);
		                }  
		        });  
		  
		}  

		$(".kategori2").click(function () { //use change event
			var pem=[];
			<?php
			$pemak=$this->account_model->kategori('pemakalah');
			for($i=0;$i<count($pemak);$i++)
			{
				?>
				pem.push(<?php echo $pemak[$i]?>);
			<?php
			}
			?>
				if (inArray($(this).attr("value"),pem)) {
					$("#pemakalah2").show();
				}
				else
				{
					$("#pemakalah2").hide();
				}			
			});

		$(".statusmakalah").change(function () { //use change event
				if($(this).val()=="2"){
					$("#makalahkedua").show();
					$("#jenisartikel").prop('disabled',true);
					$("#bidangilmu").prop('disabled',true);
					$("#fnama2").prop('disabled',true);
					$("#nama2").prop('disabled',true);
					$("#lnama2").prop('disabled',true);
					$("#institusi2").prop('disabled',true);
					$("#fnama3").prop('disabled',true);
					$("#nama3").prop('disabled',true);
					$("#lnama3").prop('disabled',true);
					$("#institusi3").prop('disabled',true);
					$("#fnama4").prop('disabled',true);
					$("#nama4").prop('disabled',true);
					$("#lnama4").prop('disabled',true);
					$("#institusi4").prop('disabled',true);
					$("#fnama5").prop('disabled',true);
					$("#nama5").prop('disabled',true);
					$("#lnama5").prop('disabled',true);
					$("#institusi5").prop('disabled',true);
					$("#fnama6").prop('disabled',true);
					$("#nama6").prop('disabled',true);
					$("#lnama6").prop('disabled',true);
					$("#institusi6").prop('disabled',true);
					$("#uppdate").prop('disabled',true);

				}
				else if($(this).val()=="1"){
					$("#makalahkedua").hide();
					$("#jenisartikel").prop('disabled',false);
					$("#bidangilmu").prop('disabled',false);
					$("#fnama2").prop('disabled',false);
					$("#nama2").prop('disabled',false);
					$("#lnama2").prop('disabled',false);
					$("#institusi2").prop('disabled',false);
					$("#fnama3").prop('disabled',false);
					$("#nama3").prop('disabled',false);
					$("#lnama3").prop('disabled',false);
					$("#institusi3").prop('disabled',false);
					$("#fnama4").prop('disabled',false);
					$("#nama4").prop('disabled',false);
					$("#lnama4").prop('disabled',false);
					$("#institusi4").prop('disabled',false);
					$("#fnama5").prop('disabled',false);
					$("#nama5").prop('disabled',false);
					$("#lnama5").prop('disabled',false);
					$("#institusi5").prop('disabled',false);
					$("#fnama6").prop('disabled',false);
					$("#nama6").prop('disabled',false);
					$("#lnama6").prop('disabled',false);
					$("#institusi6").prop('disabled',false);
					$("#uppdate").prop('disabled',false);
				}
			});

		$(".kategori3").click(function () { //use change event
			var pem2=[];
			<?php
			$pemak=$this->account_model->kategori('pemakalah');
			for($i=0;$i<count($pemak);$i++)
			{
				?>
				pem2.push(<?php echo $pemak[$i]?>);
			<?php
			}
			?>
				if (inArray($(this).attr("value"),pem2)) {
					$("#pemakalah3").show();
				}
				else
				{
					$("#pemakalah3").hide();
				}
				//console.log(pem);			
			});
		</script>
		<?php $this->load->view('setting_bahasa')?>
		<!-- /TinyMCE -->
<script language=Javascript>
<!--
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))

return false;
return true;
}

</script>

	</body>

</html>