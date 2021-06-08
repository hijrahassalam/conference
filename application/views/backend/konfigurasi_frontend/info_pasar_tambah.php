<!DOCTYPE html>
<html lang="en-us">
  <?php $this->load->view('backend/head');?>
  
  <body class=" fixed-header fixed-navigation">

    <?php $this->load->view("backend/sidebar");?>
    
    <!-- END NAVIGATION -->
    <div id="main" role="main">
      <div id="ribbon">
        <ol class="breadcrumb">
          <li>Konfigurasi Frontend</li>
          <li>Informasi Pasar</li>
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
							<i class="fa-fw fa fa-th-large"></i> 
								Konfigurasi Frontend
							<span>>  
								Informasi Pasar
							</span>
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->
								
				<!-- widget grid -->
				<section id="widget-grid" class="">


					<!-- START ROW -->

					<div class="row">

							<article class="col-sm-12 col-md-12 col-lg-12">
								
								<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false">
									<header>
										<span class="widget-icon"> <i class="fa fa-plus"></i> </span>
										<h2>Tambah Berita </h2>
									</header>
									<!-- widget div-->
									<div>
										<div class="widget-body no-padding">
											<form role="form" action="<?php echo base_url('backend/info_pasar?do=add&go=process'); ?>" method="post" id="tambah_berita" class="smart-form" name="tambah_berita">
												<fieldset>					
													<div class="row">
														<section class="col col-md-12">
															<?php echo form_error('judul_berita'); ?>
															<label class="label">Judul Berita</label>
															<label class="input">
																<input type="text" name="judul_berita" id="judul_berita" value="<?php echo set_value('judul'); ?>">
															</label>
														</section>
														<section class="col col-md-12">
															<?php echo form_error('isi_berita'); ?>
															<label class="label">Isi Berita</label>
															<textarea name="isi_berita" class="col col-12" id="isi_berita"><?php echo set_value('isi'); ?>
															</textarea>						
														</section>
													</div>
													<section>
														<label class="checkbox"><input type="checkbox" name="tampil_berita" id="tampil_berita" value="ON"><i></i>Tampilkan Berita</label>
													</section>
												</fieldset>
												<footer>
													<button type="submit" class="btn btn-primary">Simpan</button>
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

		<!--================================================== -->

		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/ckeditor/ckeditor.js"></script>
		
		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();

			var $reviewForm = $("#tambah_berita").validate({
				// Rules for form validation
				ignore: [],
				rules : {
					
					judul_berita : {
						required : true
					}
				},
	
				// Messages for form validation
				messages : {
					judul_berita : {
						required : 'Judul berita tidak boleh kosong'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					if (element.attr("name") == "isi_berita")
					{
						error.insertAfter("textarea#isi_berita");
					}
					else
					{
						error.insertAfter(element);
					}
					//error.insertAfter(element.parent());
				}
			});
		
		
		})

		</script>

		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			CKEDITOR.replace( 'isi_berita', { height: '380px', startupFocus : false} );
		
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