
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<!-- Basic -->
		<meta charset="utf-8">
		<title>UMKM Kabupaten Sukoharjo</title>
		<link rel="shortcut icon" href="<?php echo base_url('asset/asset_home/img/kemdikbud.png');?>">
		<meta name="keywords" content="kkmk, prodep" />
		<meta name="description" content="LPPKS - Lembaga Pengembangan dan Pemberdayaan Kepala Sekolah">
		<meta name="author" content="ICT FKIP UNS">
		<meta name="key" content="ictdef">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('skin/admin/')?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('skin/admin/css/font-awesome.min');?>">

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('skin/admin/')?>/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('skin/admin/')?>/css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support is under construction
		<link rel="stylesheet" type="text/css" media="screen" href="http://distribution2.info/css/smartadmin-rtl.css"> -->

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="http://distribution2.info/css/your_style.css"> -->

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('skin/admin/')?>/css/your_style.css">

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('skin/admin/')?>/css/demo.min.css">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?php echo base_url('skin/admin/img/kemdikbud.png');?>" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url('skin/admin/img/kemdikbud.png');?>" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html 
		<link rel="apple-touch-icon" href="http://distribution2.info/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="http://distribution2.info/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="http://distribution2.info/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="http://distribution2.info/img/splash/touch-icon-ipad-retina.png">
		-->
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps 
		<link rel="apple-touch-startup-image" href="http://distribution2.info/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="http://distribution2.info/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="http://distribution2.info/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
		-->

	</head>
	<body 
		id="login" class="animated fadeInDown" 	>
		<!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
			 You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
		<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
	<!--<span id="logo"></span>-->

	<div id="logo-group">
		<span id="logo"> <a href="<?php echo base_url('')?>"> <img src="<?php echo base_url('skin/admin/img/logo_lppks1.png');?>" alt="SIM LPPKS - PPCKS"> </a> </span>

		<!-- END AJAX-DROPDOWN -->
	</div>
	
</header>

<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row center">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><center>
				<h1 class="txt-color-red login-header-big">SIM UMKM Kabupaten Sukoharjo</h1></center>
				<br/>
				<center>
				<div class="well no-padding" style="width:40%">
							<?php echo ($this->session->flashdata('msg') ? "<div class='alert alert-danger'>".$this->session->flashdata('msg')."</div>" : "<div class='alert alert-info'>Silakan masuk menggunakan akun anda.</div>"); ?>
					<form action="<?php base_url('login');?>" method="post" id="login-form" class="smart-form client-form">
						
						<fieldset>
							
							<section>
								
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="username" name="username" placeholder="User ID" autofocus>
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Masukan User Anda</b></label>
							</section>

							<section>
								
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password" placeholder="Password" autofocus>
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Masukan Password Anda</b> </label>
								
							</section>
						<footer>
							<button type="submit" class="btn btn-primary">
								Masuk
							</button>
						</footer>
					</form>
				</div>
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
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo base_url('skin/admin/')?>/js/plugin/pace/pace.min.js"></script>

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
		<script src="<?php echo base_url('skin/admin/')?>/js/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?php echo base_url('skin/admin/')?>/js/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?php echo base_url('skin/admin/')?>/js/jarvis.widget.min.js"></script>

		<!-- EASY PIE CHARTS -->
		<script src="<?php echo base_url('skin/admin/')?>/js/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="<?php echo base_url('skin/admin/')?>/js/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url('skin/admin/')?>/js/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo base_url('skin/admin/')?>/js/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?php echo base_url('skin/admin/')?>/js/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?php echo base_url('skin/admin/')?>/js/bootstrap-slider.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="<?php echo base_url('skin/admin')?>/js/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="<?php echo base_url('skin/admin/')?>/js/fastclick.js"></script>

		<!--[if IE 7]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!-- Demo purpose only -->
		<script src="<?php echo base_url('skin/admin/')?>/js/demo.js"></script>

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url('skin/admin/')?>/js/app.js"></script>		

		<script type="text/javascript">
		
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			
			$(document).ready(function() {
				pageSetUp();
			})

		</script>
<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				username : {
					required : true,
					username : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				},
        captcha : {
          required : true
        }
			},

			// Messages for form validation
			messages : {
				username : {
					required : 'Masukan username anda',
					username : 'Username anda salah'
				},
				password : {
					required : 'Masukan password anda'
				},
        captcha : {
          required : 'Masukkan captcha'
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