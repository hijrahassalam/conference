<!DOCTYPE html>
<html lang="en-us">
	<?php $this->load->view('backend/head');?>
	
	<body class=" fixed-header fixed-navigation">
		
		<!-- END NAVIGATION -->
		<div id="main" role="main" style="margin-left:0px">
										

		
			<!-- MAIN CONTENT -->
			<div id="content">								
			<!-- END MAIN CONTENT -->
			<div style="margin-top:13%">
			<center>
				<h3>Masukkan Nomor Handphone untuk Verifikasi</h3>
				<br/>
				<form method="post" action="<?php echo base_url('bukti/unggah')?>">
				<input type="text" name="pass" placeholder="Masukkan No HP (Hanya Angka)" class="form-control" style="width:20%" onkeypress="return isNumberKey(event)" required><br/>
				<input type="submit" class="btn btn-success" name="kirim">
				</form>
				</form>
			</center>
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
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

		<!-- /TinyMCE -->
		<script>
		<!--
		function isNumberKey(evt)
		{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

		return false;
		return true;
		}

		</script>

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