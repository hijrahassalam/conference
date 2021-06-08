<!DOCTYPE html>
<html lang="en-us">
  <?php $this->load->view('backend/head');?>
  <style>
.green {background: green;}
.red {background: red;}
</style>
  <body class=" fixed-header fixed-navigation">

    <?php $this->load->view("backend/sidebar");?>
    
    <!-- END NAVIGATION -->
    <div id="main" role="main">
      <div id="ribbon">
        <ol class="breadcrumb">
          <li>Presensi Kehadiran Peserta</li>
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
							<span>> Presensi</span>
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->
								
				<!-- widget grid -->
				<section id="widget-grid" class="">
	<div class="row">

		<article class="col-sm-12 col-md-12 col-lg-12">
			<form method="POST">
				Pilih Bagian <select name='bagian' class='form-control' style='display:inline;width:30%'><option value='1'>Bagian 1 (1-30)</option></select> <input type="submit" class="btn btn-sm btn-primary" value="Cetak Sertifikat">
			</form>
			<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-user"></i> </span>
									<h2>Presensi Peserta Pemakalah</h2>
								</header>
								<div>
									<div class="widget-body no-padding">

										<form class="form-group" action="<?php echo base_url("admin/presensi/save");?>" method="post">
							               <table id="dt_basic" class="table table-striped table-hover">
														  <thead>
															 <tr>
																<td style="width:8%; text-align:center;"><b>No Urut</td>
																<td style="width:30%; text-align:center;"><b>Nama</td>
																<td style="width:30%; text-align:center;"><b>Instansi</td>
																<td style="width:30%; text-align:center;"><b>Judul Makalah</td>
							                    				<td style="text-align:center;"><font color='red'><b>Presensi</b></font></td>
															 </tr>
														  </thead>
														  <tbody>
							                  <?php
							                    $no=0;
							                    $peserta = $this->db->where(array('kategori'=>'1'))->order_by('nourut','asc')->get('registrasi')->result_array();
							                    $presensi=array();
							                    foreach ($peserta as $row)
							                    {
							                    	$no++;
							                      echo '<tr>
							                      <td style="text-align:center">'.$row['nourut'].'</td>
							    									<td style="text-align:left">'.$this->account_model->nama_peserta_gelar($row['no']).'</td>
							    									<td style="text-align:left">'.$row['institusi'].'</td>
							    									<td style="text-align:left">'.$row['judul'].'</td>';
							                      		
							                      		if (in_array($row['no'],$hadir))
							                      		{
							                            echo '<td style="text-align:center;" id="back" class="green">
							                            <input type="checkbox" data-jenis="pr" name="presensi[]" data-id="'.$row['no'].'" value="'.$row['no'].'" checked>';
							                        	}
							                        	else
							                        	{
							                        	echo '<td style="text-align:center;" id="back" class="red">
							                            <input type="checkbox" data-jenis="pr" name="presensi[]" data-id="'.$row['no'].'" value="'.$row['no'].'">';	
							                        	}
							                            
							                      echo '</td>';
							                      echo '</tr>';

							                      if ($row['kategori']=="1")
							                      {
							                      	$pecah=explode(',',$row['cowriter_hadir']);
							                      	for ($j=0;$j<count($pecah);$j++)
							                      	{
							                      		// $no++;
							                      		if ($pecah[$j]!="")
							                      		{
							                      		echo '<tr style="background-color:cyan">
									                      <td style="text-align:center"></td>
									    									<td style="text-align:left">'.$row['fn_writer'.$pecah[$j].''].' '.$row['co_writer'.$pecah[$j].''].' '.$row['ln_writer'.$pecah[$j].''].'</td>
									    									<td style="text-align:left">'.$row['institusi_cowriter'.$pecah[$j].''].'</td>
									    									<td style="text-align:left">Co-Author</td>';
									                      		if (in_array($row['no'].'-'.$pecah[$j],$cohadir))
							                      				{
									                            echo '<td style="text-align:center;" id="back" class="green">
									                            <input type="checkbox" name="presensico[]" data-id="'.$row['no'].'" data-jenis="co" value="'.$row['no'].'-'.$pecah[$j].'" checked>
									                            </td>';
									                        	}
									                        	else
									                        	{
									                        	echo '<td style="text-align:center;" id="back" class="red">
							                            		<input type="checkbox" name="presensico[]" data-id="'.$row['no'].'-'.$pecah[$j].'" data-jenis="co" value="'.$row['no'].'"></td>';	
									                        	}
									                      echo '</tr>';
							                      		}
							                      	}
							                      }
							                    }
							                   ?>
														  </tbody>
													   </table>
							               <!-- End of table -->
							               <br/>
							               <div class="pull-right" style="margin-right:30px">
							                  <input type="submit" value="Update Presensi" id="simpan" class="btn btn-success btn-sm" name="simpan">
							               </div>
							               <br/>
							               </form>
									</div>
									<br/>
								</div>
							</div>
			</article>
	</div>
</section>
	
			</div>
		</div>
		<?php $this->load->view("backend/foot");?>
		

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
					"iDisplayLength" : -1,
					"bSort": false,
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

		<script>
		$('[type="checkbox"]').click(function () {
		    if (this.checked) {
		    var id = $(this).attr("data-id");
		  	$(this).parent().removeClass('red');
				$(this).parent().removeClass('green');
				$(this).parent().addClass('green');
		    $(this).attr("value",id);
		    } else {
				$(this).parent().removeClass('green');
				$(this).parent().removeClass('red');
				$(this).parent().addClass('red');
		    }
		    //console.log(JSON.stringify( $("#presensi").serializeArray()));
		});
		// $("#simpan").click(function(){	
		// 		  var values=[];
		// 		  $("input:checkbox").each(function(){
		// 		    values.push({"name":this.name,"value":this.checked?this.value:"0"});
		// 		    // values[index]={"name:"+this.name,"value:"+this.checked?this.value:"false"};
		// 		  });
		// 		  //console.log(JSON.stringify(values));
		// 		  $.ajax({
		// 		    url:"presensi/save",
		// 		    type:"POST",
		// 		    data:{
		// 		      data:JSON.stringify(values)
		// 		    },
		// 		    success:function(e){
		// 		        alert("Presensi Berhasil Disimpan");
		// 		    },
		// 		    error:function(e){
		// 		      console.log(e.responseText);
		// 		    }
		// 		  })
		// 		});
		</script>

	</body>

</html>