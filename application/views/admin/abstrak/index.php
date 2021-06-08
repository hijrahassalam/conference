<!DOCTYPE html>
<html lang="en-us">
  <?php $this->load->view('backend/head');?>
  
  <body class=" fixed-header fixed-navigation">

    <?php $this->load->view("backend/sidebar");?>
    
    <!-- END NAVIGATION -->
    <div id="main" role="main">
      <div id="ribbon">
        <ol class="breadcrumb">
          <li>Abstrak</li>
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
								Verifikasi 
							<span>> Abstrak</span>
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->
								
				<!-- widget grid -->
				<section id="widget-grid" class="">
	<div class="row">
	<?php $this->db->where_in('kategori',$katpem);
												// masalahnya disini
												
												$this->db->join('registrasi_abstrak','registrasi.no=registrasi_abstrak.id_registrasi','left');
												
												$query=$this->db->get('registrasi');
												echo $this->db->last_query();
												?>
		<article class="col-sm-12 col-md-12 col-lg-12">
			<?php
					if($this->session->flashdata('msg'))
								{
									echo "<div class='alert alert-block alert-success'><a class='close' data-dismiss='alert' href='#'>×</a><h4 class='alert-heading'><i class='fa fa-check-square-o'></i> ".$this->session->flashdata('msg')."</h4></div>";
								}
								?>
			<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
									<h2>Verifikasi Abstrak </h2>
								</header>
								<div>
									<div class="widget-body no-padding">
				
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>
												<tr>
													<th data-class="expand" width="2%"><center>No</center></th>
													<th data-class="expand" width="18%"><center>Nama</center></th>
													<th data-class="expand" width="20%"><center>Asal</center></th
>													<th data-hide="phone, tablet" width="33%"><center>Judul</center></th>
													<th data-hide="phone, tablet" width="12%"><center>Abstrak</center></th>
													<th data-hide="phone, tablet" width="15%"><center>Action</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no=0;
												$katpem=$this->account_model->kategori('pemakalah');
												$this->db->where_in('kategori',$katpem);
												// masalahnya disini
												
												$this->db->join('registrasi_abstrak','registrasi.no=registrasi_abstrak.id_registrasi','left');
												
												$query=$this->db->get('registrasi');
												$tahun=$this->account_model->setting('tahun');
												foreach ($query->result_array() as $row)
												{
													$no++
													?>
													<tr>
														<td><?php echo $no ?></td>
														<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
														<td><?php echo $row['institusi']?></td>
														<td><?php echo $row['judul']?></td>
														<td>
														<!-- <button class="btn btn-primary" id="modalku" data-id="<?php echo $row['no']?>">Lihat Abstrak</button></td> -->
														<?php
														if ($row['abstrak']!="")
														{
															?>
														<a class="btn btn-primary" href="<?php echo base_url('uploads/abstrak/'.$tahun.'/'.$row['abstrak'].'')?>">Download</a>
														<?php
														}
														else
														{
															?>
														<a class="btn btn-warning" href="#" disabled>Belum Upload</a>
															<?php
														}
														?>
														</td>
														<?php if($row['status_abstrak']=="3"){ ?>
														<td>
															<div class="btn-group">
																	<a class="btn btn-success btn-sm" href="#"><i class="glyphicon glyphicon-ok icon-white"></i> Lolos</a>
																	<a class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
																	<ul class="dropdown-menu">
																		<li><a href="<?php echo base_url('admin/abstrak?lolos_rev='.$row['no']); ?>">Revisi</a></li>
																		<li><a href="<?php echo base_url('admin/abstrak?lolos_off='.$row['no']); ?>">Tidak Lolos</a></li>
																	</ul>
															</div>
														</td>

														<?php } else if($row['status_abstrak']=="2"){ ?>
														<td>
															<div class="btn-group">
																	<a class="btn btn-warning btn-sm" href="#"><i class="glyphicon glyphicon-ok icon-white"></i> Revisi</a>
																	<a class="btn btn-warning dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
																	<ul class="dropdown-menu">
																		<li><a href="<?php echo base_url('admin/abstrak?lolos_on='.$row['no']); ?>">Lolos</a></li>
																		<li><a href="<?php echo base_url('admin/abstrak?lolos_off='.$row['no']); ?>">Tidak Lolos</a></li>
																	</ul>
															</div>
															<button class="btn btn-default" id="modalku" data-id="<?php echo $row['no']?>">Upload Review</button>
														</td>
															
															
														<?php } else if($row['status_abstrak']=="1"){ ?>
														<td>
															<div class="btn-group">
																	<a class="btn btn-danger btn-sm" href="#"><i class="glyphicon glyphicon-ok icon-white"></i> Tidak Lolos</a>
																	<a class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
																	<ul class="dropdown-menu">
																		<li><a href="<?php echo base_url('admin/abstrak?lolos_on='.$row['no']); ?>">Lolos</a></li>
																		<li><a href="<?php echo base_url('admin/abstrak?lolos_rev='.$row['no']); ?>">Revisi</a></li>
																	</ul>
															</div>
														</td>
															
														<?php } else { ?>
														<td>
															<div class="btn-group">
																	<a class="btn btn-primary btn-sm" href="#"><i class=" glyphicon glyphicon-remove icon-white"></i> Belum Dicek</a>
																	<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
																	<ul class="dropdown-menu">
																	<li><a href="<?php echo base_url('admin/abstrak?lolos_on='.$row['no']); ?>">Lolos</a></li>
																	<li><a href="<?php echo base_url('admin/abstrak?lolos_rev='.$row['no']); ?>">Revisi</a></li>
																		<li><a href="<?php echo base_url('admin/abstrak?lolos_off='.$row['no']); ?>">Tidak Lolos</a></li>
																	</ul>
															</div>
														</td>
															
														<?php } ?>
													</tr>
													<?php
												}
													?>
											</tbody>
										</table>

									</div>
								</div>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="modalToko" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">
												Tutup
											</button>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
			</article>
	</div>
</section>
	
			</div>
		</div>
		<?php $this->load->view("backend/foot");?>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/jquery-form/jquery-form.min.js"></script>
		<script>
		function delet(toko){
		    tanya = confirm("Data Toko, Akun dan User dari Toko ini akan terhapus, apakah anda yakin ingin melanjutkan ?");
		    if(tanya == 1){
		        window.location.href="<?php echo base_url('backend/toko?do=del&id=')?>"+toko;
		    }
		}
		</script>

		<script>
        $(function(){
            $(document).on('click','#modalku',function(e){
                e.preventDefault();
                $("#modalToko").modal('show');
                $.post('<?php echo base_url('admin/abstrak/modal')?>',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    </script>

		<script type="text/javascript">
	
		
		function conf_edit(id){
				window.location.href = "<?php echo base_url('input_presensi/akademik?id='); ?>" + id;
			}
		
		$(document).ready(function() {
			
			pageSetUp();

			var $reviewForm = $("#tambah-form").validate({
				rules : {
					operator : {
						required : true
					},
					name : {
						required : true,
						minlength : 5
					},
					pass : {
						required : true,
						minlength : 5
					},
					/*role : {
						required : true
					},
					*/
					email : {
						required : true,
						email:true
					},
					hp : {
						required : true,
						digits:true,
						minlength : 10
					}
				},
	
				// Messages for form validation
				messages : {
					operator : {
						required : 'Masukkan nama anda'
					},
					name : {
						required : 'Masukkan username',
						minlength: 'Username minimal 5 karakter'
					},
					pass : {
						required : 'Masukkan password',
						minlength: 'Password minimal 5 karakter'
					},
					email : {
						required : 'Masukkan e-mail',
						email: 'Masukkan e-mail yang valid. misal : email@email.com'
					},
					hp : {
						required : 'Masukkan nomor HP / telepon',
						digits: 'Hanya bisa menerima inputan berupa angka',
						minlength: 'Nomor yang dimasukkan minimal 10 karakter'
					}
					
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
			
			
		
		})

		</script>
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
					"autoWidth" : false,
					//diganti
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