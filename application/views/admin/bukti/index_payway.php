<!DOCTYPE html>
<html lang="en-us">
  <?php $this->load->view('backend/head');?>
  
  <body class=" fixed-header fixed-navigation">

    <?php $this->load->view("backend/sidebar");?>
    
    <!-- END NAVIGATION -->
    <div id="main" role="main">
      <div id="ribbon">
        <ol class="breadcrumb">
          <li>Bukti Bayar</li>
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
							<span>> Bukti Bayar</span>
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->
								
				<!-- widget grid -->
				<section id="widget-grid" class="">
	<div class="row">

		<article class="col-sm-12 col-md-12 col-lg-12">
			
			<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
									<h2>Verifikasi Bukti Bayar</h2>
								</header>
								<div>
									<div class="widget-body no-padding">
				
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>
												<tr>
													<th data-class="expand" width="2%"><center>No</center></th>
													<th data-class="expand" width="18%"><center>Nama</center></th>
													<th data-class="expand" width="25%"><center>Asal</center></th>
													<th data-class="expand" width="15%"><center>Sebagai</center></th>
													<th data-hide="phone, tablet" width="10%"><center>Biaya Sistem</center></th>
													<th data-hide="phone, tablet" width="15%"><center>Biaya Payway</center></th>
													<th data-hide="phone, tablet" width="20%"><center>Action</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no=0;
												$query=$this->db->query("select * FROM registrasi where nourut<>'' ORDER BY id_payway DESC, nourut * 1 ASC");
												$katpem=$this->account_model->kategori('pemakalah');
												$diskonhppbi=$this->account_model->setting('hppbi');
												foreach ($query->result_array() as $row)
												{
													$biayacoauthor=0;
													if (in_array($row['kategori'],$katpem))
													{
														$harga=$this->account_model->biaya_registrasi($row['no'],$row['kategori'],$row['tglabstrak']);
														$biayacoauthor=$this->account_model->biaya_co_author($row['no']);
													}
													else
													{
														$harga=$this->account_model->biaya_registrasi($row['no'],$row['kategori'],$row['tanggal']);
													}

													if ($row['prosiding']=="1")
													{
														$prosidingpesan=$this->account_model->biaya_prosiding("prosiding");
													}
													else
													{
														$prosidingpesan="0";
													}

													if ($row['is_hppbi']=='3')
													{
														$hppbi=$diskonhppbi;
													}
													else
													{
														$hppbi=0;
													}

													$totalakhir=$harga+$biayacoauthor-$hppbi;

													$no++;
													$payway=$this->db->where('id',$row['id_payway'])->get('status_payway')->row_array();

													if ($payway['tagihan']==$totalakhir)
													{
														$warna="green";
													}
													else
													{
														$warna="orange";
													}
													?>
													<tr>
														<td><?php echo $no ?></td>
														<td><?php echo $this->account_model->nama_peserta_gelar($row['no'])?></td>
														<td><?php echo $row['institusi']?></td>
														<td><?php echo $this->account_model->nama_kategori($row['kategori'])?></td>
														<td>
															<?php
															// if ($row['is_generated']=="1")
															// {
																echo '<font color="'.$warna.'">'.number_format($totalakhir,2,',','.').'</font>';
															// }
															// else
															// {
															// 	echo '<font color="red">Belum Generate</font>';
															// }
															?>
														</td>
														<td>
														<?php
														if ($row['is_generated']=="1")
														{
															?>
														<font color='blue'><b><?php echo $payway['mata_uang']?>. <?php echo number_format($payway['tagihan'],2,',','.')?></b></font><br/>
														( VA Mandiri : <?php echo $payway['virtual_account']?>)
														<?php
														}
														else
														{
															?>
														<font color="red">Belum Generate</font>
															<?php
														}
														?>
														</td>
														<td>
															<?php
															if ($row['is_generated']=="1")
															{
																if ($this->account_model->status_payway($payway['id_payway'])==1)
																{
																	?>
																	<a data-id="<?php echo $payway['id_payway']?>" id="modalpayway" data-toogle="modal" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Sudah Dibayar</a>
																	<?php
																}
																else
																{
																?>
																	<a href="<?php echo base_url('admin/bukti/resetpayway/'.md5(date("YmdHIs")).$row['no'])?>" onclick="return confirm('Apakah Anda Yakin akan melakukan Reset akun Payway untuk Peserta ini ?')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Reset Payway</a>
															<?php
																}
															}
															else
															{
																echo "<font color='red'>Belum Generate</font>";
															}
															?>
														</td>
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
            $(document).on('click','#modalpayway',function(e){
                e.preventDefault();
                $("#modalToko").modal('show');
                $.post('<?php echo base_url('admin/bukti/cekpayway')?>',
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