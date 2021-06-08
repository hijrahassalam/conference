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
			<div class="col-md-8 col-md-offset-2" style="padding-left:0px">
				<table style="width:100%">
					<tr>
						<td style="width:15%;text-align:center"><img src="<?php echo base_url('uploads/uns.png')?>" width="100%"></td>
						<td style="text-align:center;width:70%">
							<h1 style="margin:0px"><font color="blue"><strong>SEMBIO 2016</strong></font></h1>
							<h2 style="margin:0px"><?php echo $query['web_judul']?> 2016</h2>
							<h3 style="margin:0px">Surakarta, 23 Februari 2016</h3></td>
						<td style="width:15%;text-align:center"><img src="<?php echo base_url('uploads/uns.png')?>" width="100%"></td>
					</tr>
				</table>
			</div>
			<div class="well bg-color-teal col-md-8 col-md-offset-2" style="margin-top:3%;color:#fff">
				<center>
					<h1><font color="lime"><strong>Pendaftaran Berhasil !!!</strong></font></h1>
					<h4>Berikut adalah data login akun Anda</h4>
					<br/>
					<table class="table table-bordered table-responsive" style="width:50%;font-size:14px">
						<tr>
							<td><strong>Username</strong></td>
							<td>:</td>
							<td>adadada@adadadadada.com</td>
						</tr>
						<tr>
							<td><strong>Password</strong></td>
							<td>:</td>
							<td>pasnamapertamaiddaftar</td>
						</tr>
					</table>
					<i>Data Username dan Password juga dikirimkan melalui no handphone dan Email Anda</i><br/><br/>
					<a href="<?php echo base_url()?>" class="btn btn-warning btn-lg">Login</a>
				</center>
			</div>
		</div>
	</div>
</div>
	
	
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