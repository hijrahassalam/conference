<head>
<?php
$this->db->where('idkhusus','22');
$query = $this->db->get('sembio_web')->row_array();
$judul = $query['web_judul'];
?>
		<meta charset="utf-8">
		<title><?php echo $query['web_judul']?></title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()."asset/asset_admin/"; ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()."asset/asset_admin/"; ?>css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()."asset/asset_admin/"; ?>css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()."asset/asset_admin/"; ?>css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()."asset/asset_admin/"; ?>css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()."asset/asset_admin/"; ?>css/smartadmin-rtl.min.css"> 

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()."asset/asset_admin/"; ?>css/demo.min.css">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="http://fkip.uns.ac.id/wp-content/uploads/2013/02/logo-uns.png" type="image/x-icon">
		<link rel="icon" href="http://fkip.uns.ac.id/wp-content/uploads/2013/02/logo-uns.png" type="image/x-icon">
		<!--
		<link rel="shortcut icon" href="<?php //echo base_url()."asset/asset_admin/"; ?>img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php //echo base_url()."asset/asset_admin/"; ?>img/favicon/favicon.ico" type="image/x-icon">
		-->

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
	

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="<?php echo base_url()."asset/asset_admin/"; ?>img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()."asset/"; ?>img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url()."asset/"; ?>img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url()."asset/"; ?>img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?php echo base_url()."asset/asset_admin/"; ?>img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url()."asset/asset_admin/"; ?>img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url()."asset/asset_admin/"; ?>img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	</head>
	<!-- HEADER -->
		<header id="header" class="col-md-12">
		<font style="font-size:14px"><h1 style="padding-left:20px"><?php echo $query['web_judul']?></h1></font>

		</header>
		<!-- END HEADER -->
		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo base_url();?>asset/asset_admin/js/plugin/pace/pace.min.js"></script>

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo base_url();?>asset/asset_admin/js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo base_url();?>asset/asset_admin/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
			document.body.className+='fixed-header fixed-navigation';
		</script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?php echo base_url();?>asset/asset_admin/js/app.config.js"></script>
		<style type="text/css">
		.modal-backdrop {
			z-index: -1;
		}
		.jarviswidget {
		  overflow: auto;
		}
		</style>