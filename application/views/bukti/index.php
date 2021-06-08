<!DOCTYPE html>
<html lang="en-us">
	<?php $this->load->view('backend/head');?>
	
	<body class=" fixed-header fixed-navigation">
		
		<!-- END NAVIGATION -->
		<div id="main" role="main" style="margin-left:0px">
										
			<ul id="myTab1" class="nav nav-tabs bordered">
				<li class="active">
					<a aria-expanded="true" href="#s1" data-toggle="tab">Semua Peserta Terdaftar</a>
				</li>
				<li class="">
					<a aria-expanded="false" href="#s2" data-toggle="tab"></i>Peserta Pemakalah</a>
				</li>
				<li class="">
					<a aria-expanded="false" href="#s3" data-toggle="tab"></i>Peserta non Pemakalah Mahasiswa</a>
				</li>
				<li class="">
					<a aria-expanded="false" href="#s4" data-toggle="tab"></i>Peserta non Pemakalah Umum</a>
				</li>
				<li class="">
					<a aria-expanded="false" href="#s5" data-toggle="tab"></i>Pemesan Prosiding</a>
				</li>
				<li class="" style="background:#7FFF00">
					<a aria-expanded="false" href="#s6" data-toggle="tab"></i>Peserta Abstrak Diterima</a>
				</li>
			</ul>
			<br />

			<div id="myTabContent1" class="tab-content padding-10">
			<div class="tab-pane fade active in" id="s1">
			<div class="table-responsive">
				<?php
				$peserta=$this->db->get('registrasi')->result_array(); //data banyak
				//$peserta=$this->db->get('registrasi')->row_array(); //data satu
				?>
				<table id="dt_basic" class="table table-bordered">
				<thead>
					<tr>
						<th><center>NO</center></th>
						<th><center>TANGGAL</center></th>
						<th><center>NAMA LENGKAP</center></th>
						<th><center>INSTITUSI</center></th>
						<th><center>KEIKUTSERTAAN</center></th>										
					</tr>
				</thead>
				<tbody>

				<?php
				$no=0;
				foreach($peserta as $row)
				{
					$no++;
				?>
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $row['tanggal']?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
				</table>
											
			</div>
		</div>

			<div class="tab-pane fade" id="s2">
			<?php
				$this->db->where('kategori','1');
				$peserta=$this->db->get('registrasi')->result_array(); //data banyak
				//$peserta=$this->db->get('registrasi')->row_array(); //data satu
				?>
			<table class="table table-bordered" id="dt_basic2">
			
			<thead>
				<tr>
					<th><center>NO</center></th>
					<th><center>TANGGAL</center></th>
					<th><center>NAMA LENGKAP</center></th>
					<th><center>INSTITUSI</center></th>
					<th><center>KEIKUTSERTAAN</center></th>
					<th><center>JUDUL</center></th>
					<th><center>STATUS</center></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=0;
				foreach($peserta as $row)
				{
					$no++;
				?>
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $row['tanggal']?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
						<td><?php echo $row['judul']?></td>
						<td><?php 
						$status=$row['status_abstrak'];
						
						switch($status) {
							case '0' : echo "<font color='orange'>Abstrak belum dicek</font>";
							break;
							case '1' : echo "<font color='red'>Abstrak ditolak</font>";
							break;
							case '2' : echo "<font color='green'>Abstrak diterima</font>";
							break;
						}
						?></td>
					</tr>
				<?php
				}
				?>									
			</tbody>
			</table>		
		</div>

			<div class="tab-pane fade" id="s3">
			<?php
			$this->db->where('kategori','2');
			$peserta=$this->db->get('registrasi')->result_array(); //data banyak
			//$peserta=$this->db->get('registrasi')->row_array(); //data satu
			?>
			<table class="table table-bordered" id="dt_basic3">			
			<thead>
				<tr>
					<th><center>NO</center></th>
					<th><center>TANGGAL</center></th>
					<th><center>NAMA LENGKAP</center></th>
					<th><center>INSTITUSI</center></th>
					<th><center>KEIKUTSERTAAN</center></th>			
				</tr>
			</thead>
			<tbody>
				<?php
				$no=0;
				foreach($peserta as $row)
				{
					$no++;
				?>
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $row['tanggal']?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
				</table>		
			</div>

			<div class="tab-pane fade" id="s4">
			<?php
			$this->db->where('kategori','3');
			$peserta=$this->db->get('registrasi')->result_array(); //data banyak
			//$peserta=$this->db->get('registrasi')->row_array(); //data satu
			?>
				<table class="table table-bordered" id="dt_basic4">
				<thead>
					<tr>
						<th><center>NO</center></th>
						<th><center>TANGGAL</center></th>
						<th><center>NAMA LENGKAP</center></th>
						<th><center>INSTITUSI</center></th>
						<th><center>KEIKUTSERTAAN</center></th>													
					</tr>
				</thead>
				<tbody>
				<?php
				$no=0;
				foreach($peserta as $row)
				{
					$no++;
				?>
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $row['tanggal']?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
				</table>		

			</div>

			<div class="tab-pane fade" id="s5">
			<?php
			$this->db->where('prosiding','1');
			$peserta=$this->db->get('registrasi')->result_array(); //data banyak
			//$peserta=$this->db->get('registrasi')->row_array(); //data satu
			?>
				<table class="table table-bordered" id="dt_basic5">

				<thead>
					<tr>
						<th><center>NO</center></th>
						<th><center>TANGGAL</center></th>
						<th><center>NAMA LENGKAP</center></th>
						<th><center>INSTITUSI</center></th>
						<th><center>JUMLAH EKSEMPLAR</center></th>																										
					</tr>
				</thead>
				<tbody>
				<?php
				$no=0;
				foreach($peserta as $row)
				{
					$no++;
				?>
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $row['tanggal']?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $row['jumlahprosiding']?></td>
					
					</tr>
				<?php
				}
				?>
				</tbody>
				</table>		
			</div>

		<div class="tab-pane fade" id="s6">
			<?php
				$this->db->where('status_abstrak','2');
				$peserta=$this->db->get('registrasi')->result_array(); //data banyak
				//$peserta=$this->db->get('registrasi')->row_array(); //data satu
				?>
			<table class="table table-bordered" id="dt_basic6">
			
			<thead>
				<tr>
					<th><center>NO</center></th>
					<th><center>TANGGAL</center></th>
					<th><center>NAMA LENGKAP</center></th>
					<th><center>INSTITUSI</center></th>
					<th><center>KEIKUTSERTAAN</center></th>
					<th><center>JUDUL</center></th>
					<th><center>UPLOAD</center></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=0;
				foreach($peserta as $row)
				{
					$no++;
				?>
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $row['tanggal']?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
						<td><?php echo $row['judul']?></td>
						<td><a href="<?php echo base_url('paper/upload/'.$row['no'].'')?>" class="btn btn-success btn-sm">Upload Full Paper</a></td>
					</tr>
				<?php
				}
				?>									
			</tbody>
			</table>		
		</div>
											
	</div>
				
</div>
				
		
			<!-- MAIN CONTENT -->
			<div id="content">								
				
			<!-- END MAIN CONTENT -->

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


		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
			
				var responsiveHelper_dt_basic = undefined;
				var responsiveHelper_datatable_fixed_column = undefined;
				var responsiveHelper_datatable_col_reorder = undefined;
				var responsiveHelper_datatable_tabletools = undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
	
				$('#dt_basic').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				
				$('#dt_basic2').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				
				$('#dt_basic3').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				
				$('#dt_basic4').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				
				$('#dt_basic5').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				
				$('#dt_basic6').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
	
		    var otable = $('#datatable_fixed_column').DataTable({
		    	
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_fixed_column) {
						responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_fixed_column.respond();
				}		
			
		    });
		    $("div.toolbar").html('<div class="text-right"><img src="<?php echo base_url();?>asset/img/logo.png" alt="SIM LPPKS - PPCKS" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
		    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    	
		        otable
		            .column( $(this).parent().index()+':visible' )
		            .search( this.value )
		            .draw();
		            
		    } );

		
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