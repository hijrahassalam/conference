<!DOCTYPE html>
<html lang="zxx" class="js">
<?php
        $query=$this->db->get_where('sembio_web', array('idkhusus =' => '22'))->row_array();
    ?>
<head>
    <!-- Page Title  -->
    <title><?php echo $query['web_judul']?></title>
    <link rel="shortcut icon" href="http://fkip.uns.ac.id/wp-content/uploads/2013/02/logo-uns.png">
    <meta name="keywords" content="fkip, seminar nasional" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
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
                                        <h5 class="nk-block-title">Register</h5>
                                        <div class="nk-block-des">
                                            <p>Welcome to <?php echo $query['web_judul']?> <?php echo date("Y")?></p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <form method="POST" action="<?php echo base_url('index.php/daftar/submit')?>" id="frmreg">
                                    <div class="form-group">
                                        <label class="form-label" for="gelar_1">Front Title</label>
                                        <input type="text" class="form-control form-control-lg" name="gelar_1" id="gelar_1" placeholder="Fill your Front Title (Optional)">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="firstnama">First Name <font color='red'>*</font></label>
                                        <input type="text" class="form-control form-control-lg" name="firstnama" required id="firstnama" placeholder="Fill your First Name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="lastnama">Last Name <font color='red'>*</font></label>
                                        <input type="text" class="form-control form-control-lg" name="lastnama" required id="lastnama" placeholder="Fill your Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="gelar_2">Back Title</label>
                                        <input type="text" class="form-control form-control-lg" name="gelar_2" id="gelar_2" placeholder="Fill your Back Title (Optional)">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="category">Category <font color='red'>*</font></label>
                                        <ul class="custom-control-group g-3 align-center flex-wrap">
                                            <?php
                                            $ii=0;
                                            foreach ($this->db->where('is_active','1')->get('ref_kategori_pendaftaran')->result_array() as $k)
                                            {
                                                $act="";
                                                $ii++;
                                                if ($ii==1)
                                                {
                                                    $act="checked";
                                                }
                                                ?>
                                            <li>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" <?php echo $act ?> name="kategori" id="<?php echo 'pil'.$k['id']?>" value="<?php echo $k['id']?>">
                                                    <label class="custom-control-label" for="<?php echo 'pil'.$k['id']?>"><?php echo $k['nama_kategori']?></label>
                                                </div>
                                            </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="institusi">Institution <font color='red'>*</font></label>
                                        <input type="text" class="form-control form-control-lg" name="institusi" required id="institusi" placeholder="Fill Institution Name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email <font color='red'>*</font></label>
                                        <input type="email" class="form-control form-control-lg" name="email" required id="email" placeholder="Fill your active Email">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="nohp">Phone Number <font color='red'>*</font></label>
                                        <input type="text" class="form-control form-control-lg" name="nohp" onkeypress="return isNumberKey(event)" required id="nohp" placeholder="Fill your active Phone Number">
                                        <div class="note">
                                            <font color="red">Number only, without + ( ) and /, example <strong>082335550000</strong></font>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-control-xs custom-checkbox">
                                            <input name="cekperaturan" class="custom-control-input" value="1" id="checkbox" onchange="agree(this.value)" type="checkbox">
                                            <label class="custom-control-label" for="checkbox">I declare that the data that I entered is correct.</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="submit" value="Register" type="submit" class="btn btn-success btn-block" disabled="disabled">
                                    </div>
                                </form><!-- form -->
                                <div class="form-note-s2 pt-4"> Already registered ? <a href="<?php echo base_url()?>"><strong>Login here</strong></a>
                                </div>
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="nk-block-between">
                                    <ul class="nav nav-sm">
                                        
                                    </ul><!-- .nav -->
                                </div>
                                <div class="mt-3">
                                    <p>&copy; Copyright © 2021 <?php echo $query['web_judul']?></p>
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- nk-split-content -->
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
                        </div><!-- nk-split-content -->
                    </div><!-- nk-split -->
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

    if(frm.cekperaturan.checked==true)  frm.submit.disabled=false;

    else frm.submit.disabled=true;
    

}
</script>
</html>