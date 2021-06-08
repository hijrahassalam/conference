<!DOCTYPE html>
<html>
  <head>
   <?php
        $query=$this->db->get_where('umkm_web', array('idkhusus =' => '22'))->row_array();
        ?>
    <!-- Basic -->
    <meta charset="utf-8">
    <title><?php echo $query['web_judul']?></title>   
    <meta name="keywords" content="UMKM, Sukoharjo" />
    <meta name="description" content="Direktori UMKM Kabupaten Sukoharjo">
    <meta name="author" content="ICT Center FKIP UNS">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/vendor/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/vendor/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/vendor/owlcarousel/owl.carousel.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/vendor/owlcarousel/owl.theme.default.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/vendor/magnific-popup/magnific-popup.css" media="screen">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/css/theme-elements.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/css/theme-blog.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/css/theme-shop.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/css/theme-animate.css">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>/skin/home/css/custom.css">

    <!-- Head Libs -->
    <script src="<?php echo base_url()?>/skin/home/vendor/modernizr/modernizr.js"></script>
	
	<link rel="shortcut icon" href="<?php echo base_url('uploads/sukoharjo.png')?>">

    <!--[if IE]>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->

    <!--[if lte IE 8]>
      <script src="vendor/respond/respond.js"></script>
      <script src="vendor/excanvas/excanvas.js"></script>
    <![endif]-->

  </head>
  <body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.3&appId=263745923659962";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div class="body">
      <header id="header">
        <div class="container">
          <div class="logo">
            <a href="<?php echo base_url('')?>">
              <img alt="Direktori UMKM Kabupaten Sukoharjo" width="500" height="150" data-sticky-width="250" data-sticky-height="75" src="<?php echo base_url('uploads');?>/<?php echo $query['web_logo']?>" alt="UMKM SUKOHARJO" >
            </a>
          </div>
        </div>
              <div class="navbar-collapse nav-main-collapse collapse">
              <div class="container">
                <nav class="nav-main mega-menu">
                  <ul class="nav nav-pills nav-main" id="mainMenu">
                    <li><a href="<?php echo base_url('')?>">BERANDA</a></li>
                    <li><a  href="<?php echo base_url('welcome/visi')?>">VISI & MISI</a></li>
                    <li><a  href="<?php echo base_url('welcome/alur')?>">ALUR</a></li>
                    <li><a  href="<?php echo base_url('faq')?>">FAQ</a></li>
                    <li><a  href="<?php echo base_url('login')?>">LOGIN</a></li>
                    
                  </ul>
                </nav>
              </div>
			  <div style="float:right;margin-right:60px">
          <span><i class="fa fa-shopping-cart"></i>&nbsp; &nbsp;<b>Total Belanja : </b><?php echo $this->cart->total_items()?> Barang (Rp. <?php echo number_format($this->cart->total(),2,",",".");?>) <a href="<?php echo base_url('cart')?>" class="btn btn-sm btn-default">Lihat Keranjang</a>&nbsp;<a href="<?php echo base_url('checkout')?>" class="btn btn-sm btn-primary">Checkout</a></span>
          </div>
            </div>        
          </header>
        </div>
