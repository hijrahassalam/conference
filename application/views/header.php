<!DOCTYPE html>
<html lang="en-us">
<?php
		$query=$this->db->get_where('sembio_web', array('idkhusus =' => '22'))->row_array();
	?>
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<!-- Basic -->
		<meta charset="utf-8">
		<title><?php echo $query['web_judul']?></title>
		<link rel="shortcut icon" href="https://fkip.uns.ac.id/wp-content/uploads/2013/02/logo-uns.png">
		<meta name="keywords" content="fkip, seminar nasional" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="<?php echo $query['web_judul']?>">
	    <meta name="author" content="FKIP UNS">
	    <meta name="key" content="ictdef">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('asset/asset_home/')?>/css/bootstrap.min.css">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('asset/asset_home/')?>/css/smartadmin-production.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('asset/asset_home/')?>/css/smartadmin-skins.css">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('asset/asset_home/')?>/css/your_style.css">

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('asset/asset_home/')?>/css/demo.css">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="https://fkip.uns.ac.id/wp-content/uploads/2013/02/logo-uns.png" type="image/x-icon">
		<link rel="icon" href="https://fkip.uns.ac.id/wp-content/uploads/2013/02/logo-uns.png" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">