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

	<!-- MAIN CONTENT -->
	<div id="content" class="container">
		<div class="row" style="margin-top:2%">
			<?php $this->load->view('logo');?>
			<div class="well bg-color-teal col-md-8 col-md-offset-2" style="margin-top:3%;color:#fff">
			<form method="POST" action="<?php echo base_url('daftar/submit')?>" id="frmreg" class="smart-form client-form">
			<fieldset>
				<div class="row">
				<section class="col col-6">
					<label class="label">Nama Depan</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" id="firstnama" placeholder="Nama Depan" name="firstnama">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Nama Depan Anda</b>
						</label>
				</section>
				<section class="col col-6">
					<label class="label">Nama Belakang</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" id="lastnama" placeholder="Nama Belakang" name="lastnama">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Nama Belakang Anda</b>
						</label>
				</section>
				</div>

				<section>
					<label class="label">Gelar Depan</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Gelar Depan" name="gelar_1">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Gelar Depan Anda</b>
						</label>
				</section>
					
				<section>
						<label class="label">Gelar Belakang</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Gelar Belakang" name="gelar_2">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Gelar Belakang Anda</b>
						</label>
				</section>
					
				<section>
						<label class="label">Institusi</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Nama Institusi" name="institusi" id="institusi">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Nama Institusi Anda</b>
						</label>
				</section>
					
				<section>
						<label class="label">Email</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="email" placeholder="Email" name="email" id="email">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Email Anda</b>
						</label>
				</section>
					
				<section>
						<label class="label">Alamat Surat</label>
						<label class="textarea">
							<textarea rows="3" placeholder="Alamat Lengkap" name="kirimprosiding"></textarea>
						</label>
				</section>
					
				<section>
						<label class="label">Nomor HP / Mobile Phone</label>
						<label class="input"><i class="icon-append fa fa-user"></i>
							<input type="text" placeholder="Nomor HP Anda" name="nohp" onkeypress="return isNumberKey(event)" id="nohp">
							<b class="tooltip tooltip-top-right">
								<i class="fa fa-warning txt-color-teal"></i> 
								Masukkan Nomor HP Anda</b>
						</label>
						<div class="note">
							<font color="red">Hanya angka, tanpa tanda + ( ) dan /, contoh <strong>082335554320</strong></font>
						</div>
				</section>
					
				<!-- <section>
						<label class="label">Keikutsertaan</label>
						<div class="inline-group">
						<label class="radio"><input name="kategori" value="1" type="radio" class="kategori1" checked><i></i>Pemakalah</label>
						<label class="radio"><input name="kategori" value="2" class="kategori1" type="radio"><i></i>Non Pemakalah Mahasiswa</label>
						<label class="radio"><input name="kategori" value="3" class="kategori1" type="radio"><i></i>on Pemakalah Umum</label>
				</section>
					
				<section>
						<label class="label">Pemesanan prosiding</label>
						<div class="inline-group">
						<label class="radio"><input name="prosiding" value="1" class="pesan1" type="radio" checked><i></i>Ya</label>
						<label class="radio"><input name="prosiding" value="0" class="pesan1" type="radio"><i></i>Tidak</label>
				</section>
					
				<section>
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
				</section> -->
				<section>
					<input name="cekperaturan" value="1" id="setuju" onchange="agree(this.value)" type="checkbox"> 
					<label for="setuju">Saya menyatakan data di atas benar.</label>
				</section>
				</fieldset>
				<footer>
				<a href="<?php echo base_url()?>" class="btn btn-danger">Login</a> <input name="submit" value="Daftar" type="submit" class="btn btn-success" disabled="disabled">
				</footer>
							</form>


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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="http://distribution2.info/js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="http://distribution2.info/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
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
<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/ckeditor/ckeditor.js"></script>
		
		<script type="text/javascript">
		$(document).ready(function () {
			$('#pesan').attr("disabled", false);
			
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

		<script>
$('#bahasa').on('change', function() {
	var url = $(location).attr('href');
  alert( url ); // or $(this).val()
});
</script>
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

<script type="text/javascript">
	runAllForms();

	$(function() {
		// Validation
		$("#frmreg").validate({
			// Rules for form validation
			rules : {
				firstnama : {
					required : true
				},
				institusi : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				nohp : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				firstnama : {
					required : 'Masukkan Nama Lengkap Anda'
				},
				institusi : {
					required : 'Masukan password anda'
				},
				email : {
					required : 'Email Harus Diisi',
					email : 'Format Email harus benar cth : sembio@gmail.com'
				},
				nohp : {
					required : 'Masukkan Nomor HP untuk verifikasi akun'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});
</script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
				_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>

	</body>

</html>