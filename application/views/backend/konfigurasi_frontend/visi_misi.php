<!DOCTYPE html>
<html lang="en-us">
	<?php $this->load->view('backend/head');?>
  
	<body class=" fixed-header fixed-navigation">
    <?php $this->load->view("backend/sidebar");?>
    
    <!-- END NAVIGATION -->
    <div id="main" role="main">
		<div id="ribbon">
			<ol class="breadcrumb">
				<li>Konfigurasi Beranda</li>
			</ol>
		</div>

		<!-- MAIN CONTENT -->
		<div id="content">


			<div class="row">
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<h1 class="page-title txt-color-blueDark">
						
						<!-- PAGE HEADER -->
						<i class="fa-fw fa fa-th-large"></i> 
							Konfigurasi Beranda
							<span> >
							Visi & Misi
							</span>
					</h1>
				</div>
			</div>

			<!-- widget grid -->
			<section id="widget-grid" class="">


				<!-- START ROW -->

				<div class="row">

						<article class="col-sm-12 col-md-12 col-lg-12">
							
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-deletebutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-plus"></i> </span>
									<h2>Visi-Misi </h2>
								</header>
								<!-- widget div-->
								<div>
									<div class="widget-body no-padding">
										<form role="form" action="<?php echo base_url('backend/setting/visi?go=process'); ?>" method="post" name="visi_misi" id="visi_misi" class="smart-form" enctype="multipart/form-data">
											<?php
												$query = $this->db->query("SELECT * FROM umkm_visimisi")->row();
											?>
											<fieldset>					
												<div class="row">
													<section class="col col-md-12">
														<label><b>VISI</b></label>
														<?php //echo form_error('visi'); ?>
														<textarea type="text" name="visi" class="col col-12" id="visi"><?php echo $query->visi; ?>
														</textarea>
													</section>
													<section class="col col-md-12">
														<label><b>MISI</b></label>
														<?php //echo form_error('misi'); ?>
														<textarea type="text" name="misi" class="col col-12" id="misi"><?php echo $query->misi; ?>
														</textarea>
													</section>
												</div>
											</fieldset>
											<footer>
												<button type="submit" class="btn bg-color-green txt-color-white">Simpan</button>
												<a href="<?php echo base_url('konfigurasi_beranda/pengumuman');?>" class="btn btn-danger">Kembali</a>
											</footer>
										</form>						
									</div>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->
								
							</div>
							<!-- end widget -->				

							<!-- Widget ID (each widget will need unique ID)-->
						</article>
					</div>
				<!-- END ROW -->

			</section>
			<!-- end widget grid -->
		</div>
		<!-- END MAIN CONTENT -->

	</div>
	<!-- END MAIN PANEL -->

		<!-- PAGE FOOTER -->
		<?php include(APPPATH."/views/backend/foot.php");?>
		<!-- END PAGE FOOTER -->

		<!--================================================== -->

		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/ckeditor/ckeditor.js"></script>

		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			CKEDITOR.replace( 'visi', { height: '380px', startupFocus : false} );
			CKEDITOR.replace( 'misi', { height: '380px', startupFocus : false} );
		})

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