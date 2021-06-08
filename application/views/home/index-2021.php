<!DOCTYPE html>
<html lang="zxx" class="js">
<?php
        $query=$this->db->get_where('sembio_web', array('idkhusus =' => '22'))->row_array();
    ?>
<head>
    <meta charset="utf-8">
    <!-- Page Title  -->
    <title><?php echo $query['web_judul']?></title>
    <link rel="shortcut icon" href="http://fkip.uns.ac.id/wp-content/uploads/2013/02/logo-uns.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="fkip, seminar nasional" />
    <meta name="description" content="<?php echo $query['web_judul']?>">
    <meta name="author" content="FKIP UNS">
    <meta name="key" content="ictdef">
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo base_url('aset2021')?>/css/dashlite.css?ver=2.3.0">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url('aset2021')?>/css/theme.css?ver=2.3.0">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                    <a href="<?php echo base_url('')?>" class="logo-link">
                                        <img class="logo-light logo-img logo-img-lg" src="<?php echo base_url('uploads/logo.png')?>" srcset="<?php echo base_url('uploads/logo.png')?>" alt="logo">
                                        <img class="logo-dark logo-img logo-img-lg" src="<?php echo base_url('uploads/logo.png')?>" srcset="<?php echo base_url('uploads/logo.png')?>" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Sign-In</h5>
                                        <div class="nk-block-des">
                                            <p>Welcome to <?php echo $query['web_judul']?> <?php echo date("Y")?></p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <?php
                                if ($this->session->flashdata('msg'))
                                {
                                    ?>
                                    <div class="alert alert-fill alert-danger alert-dismissible alert-icon">
                                        <em class="icon ni ni-cross-circle"></em> <strong>Error</strong>! <?php echo $this->session->flashdata('msg') ?> <button class="close" data-dismiss="alert"></button>
                                    </div>
                                <?php
                                }
                                ?>
                                <form method="POST" action="<?php echo base_url('index.php/daftar/login')?>">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">E-mail</label>
                                        </div>
                                        <input type="email" name="email" class="form-control form-control-lg" id="default-01" placeholder="Fill your Email Address" required>
                                    </div><!-- .foem-group -->
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            <a class="link link-primary link-sm" tabindex="-1" href="<?php echo base_url('forgotpass')?>">Forgot Password</a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Fill your Password" required>
                                        </div>
                                    </div><!-- .foem-group -->
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form><!-- form -->
                                <div class="form-note-s2 pt-4"> Not have Account yet ? <a href="<?php echo base_url('daftar')?>">Register Now</a>
                                </div>
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="nk-block-between">
                                    <ul class="nav nav-sm">
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li> -->
                                    </ul><!-- .nav -->
                                </div>
                                <div class="mt-3">
                                    <p>&copy; Copyright © 2021 <?php echo $query['web_judul']?></p>
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->
                        <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                            <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                                <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                                    <div class="slider-item">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="<?php echo base_url('uploads')?>/icliqe.jpg" srcset="<?php echo base_url('uploads')?>/icliqe.jpg 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>ICLIQE 2021</h4>
                                                <p>The Future of Education and Counseling in Society 5.0.</p>
                                            </div>
                                        </div>
                                    </div><!-- .slider-item -->
                                </div><!-- .slider-init -->
                                <div class="slider-dots"></div>
                                <div class="slider-arrows"></div>
                            </div><!-- .slider-wrap -->
                        </div><!-- .nk-split-content -->
                    </div><!-- .nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="<?php echo base_url('aset2021')?>/js/bundle.js?ver=2.3.0"></script>
    <script src="<?php echo base_url('aset2021')?>/js/scripts.js?ver=2.3.0"></script>

</html>