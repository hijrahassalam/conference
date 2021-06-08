<!DOCTYPE html>
<html lang="en-us">
	<?php $this->load->view('backend/head');?>
	
	<body class=" fixed-header fixed-navigation">

	<?php $this->load->view("backend/sidebar_daftar");?>

	<div id="main" role="main">
			<div id="ribbon">
				<ol class="breadcrumb">
					<li> &nbsp; </li>
				</ol>
			</div>
			<!-- MAIN CONTENT -->
			<div id="content">

				<!-- row -->
				<div class="row">
					
					<!-- col -->
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">
							
							<!-- PAGE HEADER -->
							<i class="fa-fw fa fa-home"></i> 
								Silahkan daftar disini
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->

				<!-- widget grid -->
				<section id="widget-grid" class="">
				<div class="row">

				<article class="col-sm-12 col-md-12 col-lg-12">
						
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false">
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Form Pendaftaran </h2>
					</header>
					<div>
						<div class="widget-body no-padding">
				<form class="smart-form" name="registrasi" id="frmreg" method="post" action="<?php echo base_url('daftar/submit')?>" enctype="multipart/form-data">
				<fieldset>
					<div class="row">
					<section class="col col-8">
						<label class="label">Nama Lengkap</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Nama Lengkap" name="nama" required>
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Nama Lengkap Anda</b>
						</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Gelar Depan</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Gelar Depan" name="gelar_1">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Gelar Depan Anda</b>
						</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Gelar Belakang</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Gelar Belakang" name="gelar_2">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Gelar Belakang Anda</b>
						</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Institusi</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Nama Institusi" name="institusi" required>
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Nama Institusi Anda</b>
						</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Email</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="email" placeholder="Email" name="email" required>
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Email Anda</b>
						</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Alamat Surat</label>
						<label class="textarea">
							<textarea rows="3" placeholder="Alamat Lengkap" name="kirimprosiding"></textarea>
						</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Nomor HP / Mobile Phone</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Nomor HP Anda" name="nohp" onkeypress="return isNumberKey(event)" required>
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Nomor HP Anda</b>
						</label>
						<div class="note">
							<font color="red">Hanya angka, tanpa tanda + ( ) dan /, contoh <strong>082335554320</strong>.Harus diisi karena digunakan sebagai <strong>password</strong></font>
						</div>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Keikutsertaan</label>
						<div class="inline-group">
						<label class="radio"><input name="kategori" value="1" type="radio" class="kategori1" checked><i></i>Pemakalah</label>
						<label class="radio"><input name="kategori" value="2" class="kategori1" type="radio"><i></i>Peserta non Pemakalah Mahasiswa</label>
						<label class="radio"><input name="kategori" value="3" class="kategori1" type="radio"><i></i>Peserta non Pemakalah Umum</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Pemesanan prosiding</label>
						<div class="inline-group">
						<label class="radio"><input name="prosiding" value="1" class="pesan1" type="radio" checked><i></i>Ya</label>
						<label class="radio"><input name="prosiding" value="0" class="pesan1" type="radio"><i></i>Tidak</label>
					</section>
					</div>
					<div class="row">
					<section class="col col-8">
						<label class="label">Jumlah Eksemplar Prosiding (Jika Memesan)</label>
							<select id="pesan" name="jumlahprosiding">
								<?php
								for ($i=1;$i<101;$i++)
								{
									echo "<option value='".$i."'>".$i."</option>";
								}
								?>
							</select>
						</label>
					</section>
					</div>
				</fieldset>
		<div id="pemakalah">		
				<fieldset>
		
						<section>
							<label class="label"><b>Untuk Pemakalah Silakan lengkapi data berikut:<br>Co. Writer (Jika Ada)</b></label>
						</section>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-2</label>
							
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Nama Penulis Ke-2" name="nama2">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-2</b>
								</label>
							</section>
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-2" name="institusi2">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-2</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-3</label>
							
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Nama Penulis Ke-3" name="nama3">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-3</b>
								</label>
							</section>
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-3" name="institusi3">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-3</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-4</label>
							
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Nama Penulis Ke-4" name="nama4">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-4</b>
								</label>
							</section>
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-4" name="institusi4">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-4</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-5</label>
							
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Nama Penulis Ke-5" name="nama5">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-5</b>
								</label>
							</section>
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-5" name="institusi5">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-5</b>
								</label>
							</section>
						</div>
						<div class="row">
							<label class="label" style="padding-left:15px">Penulis ke-6</label>
							
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Nama Penulis Ke-6" name="nama6">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Nama Penulis Ke-6</b>
								</label>
							</section>
							<section class="col col-4">
								<label class="input"><i class="icon-append fa fa-user"></i>
									<input type="text" placeholder="Institusi Penulis Ke-6" name="institusi6">
									<b class="tooltip tooltip-top-right">
										<i class="fa fa-warning txt-color-teal"></i> 
										Masukkan Institusi Penulis Ke-6</b>
								</label>
							</section>
						</div>
						
						<div class="row">
						<section class="col col-8">
						<label class="label">Jenis Artikel</label>
							<select class="form-control" id="jenisartikel" name="jenisartikel">
								<option value="">Pilih Salah Satu</option>
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
					<section class="col col-8">
						<label class="label">Bidang Ilmu</label>
							<select class="form-control" id="jenisartikel" name="bidangilmu" >
								<option value="">Pilih Satu</option>
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
					</fieldset>
					<fieldset>
					<section>
						<label class="label"><b>Makalah Bahasa Indonesia</b></label>
					</section>
					<div class="row">
					<section class="col col-8">
						<label class="label">Judul Makalah</label>
						<label class="input"><input name="judulid" value="" type="text"></label>
					</section>
					</div>
					
					<div class="row">
					<section class="col col-8">
						<label class="label">Kata Kunci</label>
						<label class="input"><input name="kunciid" value="" type="text"></label>
						<label class="label"><small><i>(Pisahkan dengan tanda koma)</i></small></label>
					</section>
					</div>
					
					<div class="row">
					<section class="col col-8">
						<label class="label">Abstrak Bahasa Indonesia</label>
						<label class="input">
							<textarea class="noeditor" id="abstrakid" name="abstrakid" rows="5" cols="100" style="width:100%"></textarea>
						</label>
					</section>
					</div>
				</fieldset>
				<fieldset>
					<section>
						<label class="label"><b>Makalah dalam English</b></label>
					</section>
					<div class="row">
					<section class="col col-8">
						<label class="label">Title</label>
						<label class="input"><input name="judulen" value="" type="text"></label>
					</section>
					</div>
					
					<div class="row">
					<section class="col col-8">
						<label class="label">Kata Kunci</label>
						<label class="input"><input name="kuncien" value="" type="text"></label>
						<label class="label"><small><i>(Separate with coma)</i></small></label>
					</section>
					</div>
					
					<div class="row">
					<section class="col col-8">
						<label class="label">Abstrak English</label>
						<label class="input">
							<textarea class="noeditor" id="abstraken" name="abstraken" rows="5" cols="100" style="width:100%"></textarea>
						</label>
					</section>
					</div>
				</fieldset>
			</div>
				<fieldset>
				<div class="row">
				<section class="col col-8">
					<input name="cekperaturan" value="1" id="setuju" onchange="agree(this.value)" type="checkbox"> 
					<label for="setuju">Saya menyatakan data di atas benar.</label>
				</section>
				</div>
				<input name="status" size="50" value="Belum Registrasi Ulang" type="hidden">
				<input name="Reset" value="Reset" type="reset" class="btn btn-danger btn-sm"> <input name="submit" value="Submit" type="submit" class="btn btn-success btn-sm" disabled="disabled">
				</fieldset>
			</form>
				</div>
			</div>
		</div>
		</article>
		</div>
		</section>
	</div>
<?php $this->load->view('backend/foot');?>
<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/ckeditor/ckeditor.js"></script>
		
		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			CKEDITOR.replace( 'abstrakid', { height: '380px', startupFocus : false} );
			CKEDITOR.replace( 'abstraken', { height: '380px', startupFocus : false} );
		
		})

		</script>
		
		<script type="text/javascript">
		$(document).ready(function () {
			$('#pemakalah').show();
			$('#pesan').attr("disabled", false);
			$(".kategori1").click(function () { //use change event
				if($(this).attr("value")=="1"){
					$("#pemakalah").show();
				}
				else if($(this).attr("value")=="2"){
					$("#pemakalah").hide();
				}
				else if($(this).attr("value")=="3"){
					$("#pemakalah").hide();
				}
			});
			
			$(".pesan1").click(function () {
				if($(this).attr("value")=="0"){
					$("#pesan").attr("disabled",true);
				}
				else if($(this).attr("value")=="1"){
					$("#pesan").attr("disabled",false);
				}
			});
		});
		</script>
	</body>
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
<script>

function agree(val){

	frm=document.forms['frmreg']

	if(frm.cekperaturan.checked==true)	frm.submit.disabled=false;

	else frm.submit.disabled=true;

		

}
</script>

</html>