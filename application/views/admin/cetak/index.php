<!DOCTYPE html>
<html lang="en-us">
  <?php $this->load->view('backend/head');?>
  
  <body class=" fixed-header fixed-navigation">

    <?php $this->load->view("backend/sidebar");?>
    
    <!-- END NAVIGATION -->
    <div id="main" role="main">
      <div id="ribbon">
        <ol class="breadcrumb">
          <li>Cetak Dokumen</li>
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
								Cetak Dokumen
							<span>> Seminar</span>
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->
								
				<!-- widget grid -->
				<section id="widget-grid" class="">
	<div class="row">

		<article class="col-sm-12 col-md-12 col-lg-12">
			<?php
			if($this->session->flashdata('msg'))
			{
				echo "<div class='alert alert-block alert-success'><a class='close' data-dismiss='alert' href='#'>×</a><h4 class='alert-heading'><i class='fa fa-check-square-o'></i> ".$this->session->flashdata('msg')."</h4></div>";
			}
			?>
			<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-user"></i> </span>
									<h2>Cetak Dokumen <?php echo $this->account_model->setting('nama')?></h2>
								</header>
								<div>
								<div class="widget-body">
								
								<form method="POST" action="<?php echo base_url('admin/cetak/download')?>" target="_blank">
								<table class="table table-bordered table-hover" width="50%">
									<thead>
					                  <tr>
					                    <th>Nama Dokumen</th>
					                    <th>Tipe Dokumen</th>
					                    <th>Action</th>
					                  </tr>
					                </thead>
					                <tbody>
					                  <tr>
					                  	<td>Presensi Pemakalah Abstrak Diterima</td>
					                  	<td>Excel</td>
					                  	<td><input type="submit" name="presabs" value="Download" class="btn btn-sm btn-success"></td>
					                  </tr>
					                  <tr>
					                  	<td>Presensi Pemakalah Abstrak Diterima + Bukti Bayar Terverifikasi</td>
					                  	<td>Excel</td>
					                  	<td><input type="submit" name="presabsbuk" value="Download" class="btn btn-sm btn-success"></td>
					                  </tr>
					                  <tr>
					                  	<td>Presensi Pemakalah Abstrak Diterima + Bukti Bayar Terverifikasi + Full Paper Diterima</td>
					                  	<td>Excel</td>
					                  	<td><input type="submit" name="presabsbukfull" value="Download" class="btn btn-sm btn-success"></td>
					                  </tr>
					                  <tr>
					                  	<td>Presensi Peserta Non Pemakalah</td>
					                  	<td>Excel</td>
					                  	<td><input type="submit" name="prenon" value="Download" class="btn btn-sm btn-success"></td>
					                  </tr>
					                  <tr>
					                  	<td>Presensi Seminar Kit Pemakalah</td>
					                  	<td>Excel</td>
					                  	<td><input type="submit" name="semkitpem" value="Download" class="btn btn-sm btn-success"></td>
					                  </tr>
					                </tbody>
								</table>
								</form>
									</div>
								</div>
							</div>
			</article>
	</div>
</section>
	
			</div>
		</div>
		<?php $this->load->view("backend/foot");?>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/jquery-form/jquery-form.min.js"></script>
		<script>
		function delet(toko){
		    tanya = confirm("Data Pendaftar akan terhapus, apakah anda yakin ingin melanjutkan ?");
		    if(tanya == 1){
		        window.location.href="<?php echo base_url('admin/pendaftar/del?id=')?>"+toko;
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