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
				
					<!-- row -->
					<div class="row">
				
						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-bullhorn"></i> </span>
									<h2>Informasi Pasar </h2>
								</header>
								
								<!-- widget div-->
								<div>
									<a href="<?php echo base_url('backend/info_pasar?do=add');?>" class="btn bg-color-greenLight txt-color-white"> <i class="fa fa-lg fa-fw fa-plus"></i> Tambah</a><br /><br />
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
				
									</div>
									<!-- end widget edit box -->
				
									<!-- widget content -->
									<div class="widget-body no-padding">
				
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>			                
												<tr>
													<th width="5%">No</th>
													<th width="26%">Judul</th>
													<th width="43%">Isi</th>
													<th width="16%">Status</th>
													<th width="10%">Aksi</th>
												</tr>
											</thead>
											<tbody>
											<?php   
											$n=1;
											$query = $this->db->query("SELECT * FROM umkm_info_pasar ORDER BY status asc");
											foreach ($query->result_array() as $data) {
											?>
											
												<tr>
													<td class="center"><?php echo $n; ?></td>
													 <td class="center"><?php echo strip_tags(substr($data['judul'],0,50)); ?></td>
													<td class="center"><?php echo strip_tags(substr($data['isi'],0,150)); ?></td>
												
													<?php if( $data['status']=="ON"){ ?>
													<td>
														<div class="btn-group">
																<a class="btn btn-success btn-sm" href="#"><i class="glyphicon glyphicon-ok icon-white"></i> Tampil</a>
																<a class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
																<ul class="dropdown-menu">
																	<li><a href="<?php echo base_url('backend/info_pasar?status_off='.$data['id']); ?>">Sembunyikan</a></li>
																</ul>
														</div>
													</td>
														
													<?php } else { ?>
													<td>
														<div class="btn-group">
																<a class="btn btn-warning btn-sm" href="#"><i class=" glyphicon glyphicon-remove icon-white"></i> Disembunyikan</a>
																<a class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
																<ul class="dropdown-menu">
																	<li><a href="<?php echo base_url('backend/info_pasar?status_on='.$data['id']); ?>">Tampilkan</a></li>
																</ul>
														</div>
													</td>
														
													<?php } ?>
													
													<td class="center">
													   
														<?php 
															echo '
															 <button class="btn btn-info" onclick="javascript:conf_edit('.$data['id'].')">
																<i class="glyphicon glyphicon-edit icon-white"></i>
															 </button>
															
															<button class="btn btn-danger" onclick="javascript:conf_del('.$data['id'].')">
																<i class="glyphicon glyphicon-trash icon-white"></i>
															</button>'; ?>
													</td>
												</tr>
											
											<?php
											$n++;
											} ?>
											</tbody>
										</table>

									</div>
									<!-- end widget content -->
				
								</div>
								<!-- end widget div -->
				
							</div>
							<!-- end widget -->
						</article>
					</div>
				</section>
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
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url('asset/asset_admin/');?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

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
	
			/* END BASIC */
			
			/* COLUMN FILTER  */
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
		    
		    // custom toolbar
		    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
		    	   
		    // Apply the filter
		    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    	
		        otable
		            .column( $(this).parent().index()+':visible' )
		            .search( this.value )
		            .draw();
		            
		    } );
		    /* END COLUMN FILTER */   
	    
			/* COLUMN SHOW - HIDE */
			$('#datatable_col_reorder').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_col_reorder) {
						responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_col_reorder.respond();
				}			
			});
			
			/* END COLUMN SHOW - HIDE */
	
			/* TABLETOOLS */
			$('#datatable_tabletools').dataTable({
				
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
		        "oTableTools": {
		        	 "aButtons": [
		             "copy",
		             "csv",
		             "xls",
		                {
		                    "sExtends": "pdf",
		                    "sTitle": "SmartAdmin_PDF",
		                    "sPdfMessage": "SmartAdmin PDF Export",
		                    "sPdfSize": "letter"
		                },
		             	{
	                    	"sExtends": "print",
	                    	"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
	                	}
		             ],
		            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
		        },
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_tabletools) {
						responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_tabletools.respond();
				}
			});
			
			/* END TABLETOOLS */
		
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
			
			function conf_del(id){
				var r = confirm("Apakah anda yakin akan menghapusnya ?");
				if(r) window.location.href = "<?php echo base_url('konfigurasi_beranda/process?act=berita&do=delete&id='); ?>" + id;
			}
			function conf_edit(id){
				window.location.href = "<?php echo base_url('konfigurasi_beranda/berita?do=edit&id='); ?>" + id;
			}
		</script>

	</body>

</html>