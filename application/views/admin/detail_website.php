<!DOCTYPE html>
<html lang="en-us">
<?php $this->load->view('backend/head');?>
	<body class=" fixed-header fixed-navigation" onLoad="self.focus();document.detail_web.judul.focus()">
	<?php $this->load->view("backend/sidebar");?>
		<div id="main" role="main">
			<div id="ribbon">
				<ol class="breadcrumb">
					<li>Dashboard</li>
				</ol>
			</div>
			
			<div id="content">

				<div class="row">
					<!-- col -->
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">
							<!-- PAGE HEADER -->
							<i class="fa-fw fa fa-home"></i> 
							Detail Website
						</h1>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
					
						<div class="jarviswidget jarviswidget-color-blueDark">
							<header>
								<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
								<h2> Informasi Website </h2>                
							</header>
							<div>
								<div class="widget-body no-padding">
								<?php
									$query = $this->db->query("SELECT * FROM sembio_web")->row();
								?>
									<form role="form" action="<?php echo base_url('admin/setting/web?go=process'); ?>" method="post" name="detail_web" id="detail_web" class="smart-form" enctype="multipart/form-data">
										<fieldset>          
											<div class="row">
												<section class="col col-md-12">
													<?php echo form_error('judul'); ?>
													<label class="label">Judul Website</label>
													<label class="input"><input type="text" name="judul" id="judul" value="<?php echo $query->web_judul; ?>"></label>
												</section>
												
												<section class="col col-md-12">
													<?php echo form_error('deskripsi'); ?>
													<label class="label">Deksripsi Website</label>
													<label class="input"><input type="text" name="deskripsi" id="deskripsi" value="<?php echo $query->web_deskripsi; ?>"></label>
												</section>
												
												<!-- <section class="col col-md-12" style="width:40%">
													<label class="label">Logo Website</label>
													<img src="<?php echo base_url('uploads/')?>/<?php echo $query->web_logo;?>" style="width:30%"><br /><br />
													<div class="input input-file">
														<span class="button"><input type="file" id="file" accept="image/*" name="logo" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Upload Logo Website" readonly="">
													</div>
												</section> -->
											</div>
										</fieldset>
										
										<footer>
											<button type="submit" class="btn bg-color-green txt-color-white">Simpan</button>
										</footer>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN PANEL -->

		<!-- PAGE FOOTER -->
		<?php include(APPPATH."/views/backend/foot.php");?>
		<!-- END PAGE FOOTER -->

		<!--================================================== -->

		<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/moment/moment.min.js"></script>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/chartjs/chart.min.js"></script>


		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
		  
		  pageSetUp();
		
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