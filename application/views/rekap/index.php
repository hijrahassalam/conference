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
				<?php
				$arurut=array("2","3","4","5","6","7","8","9","10","11");
				$u=0;
				foreach ($this->db->get('ref_kategori')->result_array() as $kat)
				{
				?>		
				<li class="">
					<a aria-expanded="false" href="#s<?php echo $arurut[$u]?>" data-toggle="tab"></i><?php echo $kat['kat_nama']?></a>
				</li>
				<?php
				$u++;
				}
				?>
				<!-- <li class="">
					<a aria-expanded="false" href="#s3" data-toggle="tab"></i>Peserta non Pemakalah S1 dan S2</a>
				</li>
				<li class="">
					<a aria-expanded="false" href="#s4" data-toggle="tab"></i>Peserta non Pemakalah S3 dan Umum</a>
				</li> -->
				<li class="">
					<a aria-expanded="false" href="#s51" data-toggle="tab"></i>Pemesan Prosiding</a>
				</li>
				<li class="" style="background:#7FFF00">
					<a aria-expanded="false" href="#s61" data-toggle="tab"></i>Peserta Abstrak Diterima</a>
				</li>
				<li class="" style="background:#7FFF00">
					<a aria-expanded="false" href="#s71" data-toggle="tab"></i>Peserta Full Paper Diterima</a>
				</li>
			</ul>
			<br />

			<div id="myTabContent1" class="tab-content padding-10">
			<div class="tab-pane fade active in" id="s1">
			<div class="table-responsive">
				<?php
				$this->db->order_by('nourut','asc');
				$peserta=$this->db->get('registrasi')->result_array(); //data banyak
				//$peserta=$this->db->get('registrasi')->row_array(); //data satu
				?>
				<table id="dt_basic" class="table table-bordered">
				<thead>
					<tr>
						<th><center>NO</center></th>
						<th><center>NO URUT</center></th>
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
						<td><?php echo $row['nourut']?></td>
						<td><?php echo $this->account_model->tanggal_indonesia($row['tanggal'])?></td>
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
		<?php
		$u=0;
		foreach ($this->db->get('ref_kategori')->result_array() as $kat)
		{
			?>
			<div class="tab-pane fade" id="s<?php echo $arurut[$u]?>">
			<?php
				// $this->db->join('ref_kategori', 'registrasi.kategori=ref_kategori.kat_id', 'left');
				// $this->db->where('ref_kategori.kat_id','1');
				// $this->db->order_by('bidang_ilmu','asc');
				// $this->db->order_by('nourut','asc');
				// $peserta=$this->db->get('registrasi')->result_array(); //data banyak
				if ($kat['is_pemakalah']=='1')
				{
				$peserta=$this->db->query("SELECT a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where a.kategori='".$kat['kat_id']."' ORDER BY CONVERT(SUBSTRING_INDEX(bidang_ilmu,'-',-1),UNSIGNED INTEGER) asc, nourut asc")->result_array();
				//$peserta=$this->db->get('registrasi')->row_array(); //data satu
				//echo $this->output->enable_profiler(TRUE);
				?>
			<table class="table table-bordered" id="dt_basic<?php echo $arurut[$u]?>">
			
			<thead>
				<tr>
					<th><center>NO</center></th>
					<th><center>NO URUT</center></th>
					<th><center>TANGGAL</center></th>
					<th><center>NAMA LENGKAP</center></th>
					<th><center>INSTITUSI</center></th>
					<th><center>KEIKUTSERTAAN</center></th>
					<th><center>JUDUL</center></th>
					<th><center>BIDANG ILMU</center></th>
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
						<td><?php echo $row['nourut']?></td>
						<td><?php echo $this->account_model->tanggal_indonesia($row['tanggal'])?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
						<td><?php echo $row['judul']?></td>
						<td><?php 
						// $status=$row['status_abstrak'];
						
						// switch($status) {
						// 	case '0' : echo "<font color='orange'>Abstrak belum dicek</font>";
						// 	break;
						// 	case '1' : echo "<font color='red'>Abstrak ditolak</font>";
						// 	break;
						// 	case '2' : echo "<font color='green'>Abstrak diterima</font>";
						// 	break;
						// }
						echo $this->account_model->nama_bidang($row['bidang_ilmu']);
						?></td>
					</tr>
				<?php
				}
				?>									
			</tbody>
			</table>
			<?php
			}
			else
			{
			?>
			<?php
			// $this->db->where('kategori','2');
			// $this->db->order_by('nourut','asc');
			$peserta=$this->db->query("SELECT a.* from registrasi a LEFT JOIN ref_kategori b ON a.kategori=b.kat_id where a.kategori='".$kat['kat_id']."' ORDER BY nourut asc")->result_array(); //data banyak
			//$peserta=$this->db->get('registrasi')->row_array(); //data satu
			?>
			<table class="table table-bordered" id="dt_basic<?php echo $arurut[$u]?>">			
			<thead>
				<tr>
					<th><center>NO</center></th>
					<th><center>NO URUT</center></th>
					<th><center>TANGGAL</center></th>
					<th><center>NAMA LENGKAP</center></th>
					<th><center>INSTITUSI</center></th>
					<th><center>KEIKUTSERTAAN</center></th>	
					<th><center>BUKTI BAYAR</center></th>					
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
						<td><?php echo $row['nourut']?></td>
						<td><?php echo $this->account_model->tanggal_indonesia($row['tanggal'])?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
						<td><?php
						if ($row['buktibayar']!="")
						{
							?>
							<a href="<?php echo base_url('uploads/bukti/'.$this->account_model->setting('tahun').'/'.$row['buktibayar'].'')?>" class="btn btn-default btn-xs"><?php echo $row['buktibayar']?></a></td>
							<?php
						}
						else
						{
						?>
						<font color="red">Bukti Bayar belum diupload</font></td>
						<?php
						}
						?>
					</tr>
				<?php
				}
				?>
				</tbody>
				</table>
			<?php
			}
			?>		
		</div>
		<?php
		$u++;
	}
	?>
			<div class="tab-pane fade" id="s51">
			<?php
			$this->db->where('prosiding','1');
			$peserta=$this->db->get('registrasi')->result_array(); //data banyak
			//$peserta=$this->db->get('registrasi')->row_array(); //data satu
			?>
				<table class="table table-bordered" id="dt_basic51">

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
						<td><?php echo $this->account_model->tanggal_indonesia($row['tanggal'])?></td>
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

		<div class="tab-pane fade" id="s61">
			<?php
				$this->db->where('status_abstrak','3');
				$peserta=$this->db->get('registrasi')->result_array(); //data banyak
				//$peserta=$this->db->get('registrasi')->row_array(); //data satu
				?>
			<table class="table table-bordered" id="dt_basic61">
			
			<thead>
				<tr>
					<th><center>NO</center></th>
					<th><center>TANGGAL</center></th>
					<th><center>NAMA LENGKAP</center></th>
					<th><center>INSTITUSI</center></th>
					<th><center>JUDUL</center></th>
					<th><center>UNDANGAN</center></th>
					<th><center>BUKTI BAYAR</center></th>
					<th><center>FULLPAPER</center></th>
					<th><center>STATUS FULLPAPER</center></th>
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
						<td><?php echo $this->account_model->tanggal_indonesia($row['tanggal'])?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $row['judul']?></td>
						<td><!-- <a href="<?php echo base_url('undangan?id='.$row['no'].'')?>" class="btn btn-primary btn-xs">Download Undangan</a> --></td></td>
						<td><?php
						if ($row['buktibayar']!="")
						{
							?>
							<a href="<?php echo base_url('uploads/bukti/'.$this->account_model->setting('tahun').'/'.$row['buktibayar'].'')?>" class="btn btn-default btn-xs"><?php echo $row['buktibayar']?></a></td>
							<?php
						}
						else
						{
						?>
						<font color="red">Bukti Bayar belum diupload</font></td>
						<?php
						}
						?>
						<td>
						<?php
						if ($row['fullpaper']!="" && $row['status_fullpaper']!="1")
						{
							echo $row['judulfile']."</td>";
						}
						else
						{
						?>
						<font color="red">Full Paper belum diupload</font></td>
						<?php
						}
						?>
						<td><?php 
						$status=$row['status_fullpaper'];
						
						switch($status) {
							case '0' : echo "<font color='orange'>Belum dicek</font>";
							break;
							case '1' : echo "<font color='red'>Ditolak</font>";
							break;
							case '2' : echo "<font color='orange'>Revisi</font>";
							break;
							case '3' : echo "<font color='green'>Diterima</font>";
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
		
		<div class="tab-pane fade" id="s71">
			<?php
				//$this->db->where('fullpaper !=','');
				$this->db->where('status_fullpaper','3');
				$peserta=$this->db->get('registrasi')->result_array(); //data banyak
				//$peserta=$this->db->get('registrasi')->row_array(); //data satu
				?>
			<table class="table table-bordered" id="dt_basic71">
			
			<thead>
				<tr>
					<th><center>NO</center></th>
					<th><center>TANGGAL</center></th>
					<th><center>NAMA LENGKAP</center></th>
					<th><center>INSTITUSI</center></th>
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
						<td><?php echo $this->account_model->tanggal_indonesia($row['tanggal'])?></td>
						<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
						<td><?php echo $row['institusi']?></td>
						<td><?php echo $row['judul']?></td>
						<td>
						<?php
						if ($row['fullpaper']!="")
						{
							echo $row['judulfile']."</td>";
						}
						else
						{
						?>
						<font color="red">Full Paper belum diupload</font></td>
						<?php
						}
						?>
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
				
				<?php
				$u=0;
				foreach ($this->db->get('ref_kategori')->result_array() as $kat)
				{
					?>
				$('#dt_basic<?php echo $arurut[$u]?>').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic<?php echo $arurut[$u]?>'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				<?php
				$u++;
				}
				?>
				
				$('#dt_basic51').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic51'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				
				$('#dt_basic61').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic61'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});
				
				$('#dt_basic71').dataTable({
					"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
					"autoWidth" : true,
					"preDrawCallback" : function() {
						// Initialize the responsive datatables helper once.
						if (!responsiveHelper_dt_basic) {
							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic71'), breakpointDefinition);
						}
					},
					"rowCallback" : function(nRow) {
						responsiveHelper_dt_basic.createExpandIcon(nRow);
					},
					"drawCallback" : function(oSettings) {
						responsiveHelper_dt_basic.respond();
					}
				});

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

	</body>

</html>