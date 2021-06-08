<!DOCTYPE html>
<html lang="en-us">
	<?php $this->load->view('backend/head');?>
	<script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
	<script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
	<script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
	<body class=" fixed-header fixed-navigation">
	<?php
	foreach ($data as $r)
	{
		$temp[]=$r['jum'];
	}
	?>
	<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "pie",
					"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
					"labelText": "[[title]]: [[value]]",
					"titleField": "category",
					"valueField": "column-1",
					"gradientType": "linear",
					"innerRadius": "39%",
					"labelRadius": 18,
					"allLabels": [],
					"balloon": {},
					"marginTop" : 0,
					"marginBottom" : 0,
					"marginLeft" : 0,
					"marginRight" : 0,
					"pullOutRadius" : 0,
					"legend": {
						"enabled": true,
						"align": "center",
						"markerType": "circle",
						"valueText": "",
						"margintop" : 20
					},
					"titles": [],
					"dataProvider": [
					<?php
					foreach ($query as $ro)
					{
						?>
						{
							"category": "<?php echo $ro['kat_nama']?>",
							"column-1": <?php echo $ro['jum']; ?>
						},
						<?php
					}
					?>
					]
				}
			);
		</script>
		<script type="text/javascript">
			AmCharts.makeChart("buktibayar",
				{
					"type": "pie",
					"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
					"gradientType": "linear",
					"innerRadius": "39%",
					"labelRadius": 18,
					"marginTop" : 0,
					"marginBottom" : 0,
					"marginLeft" : 0,
					"marginRight" : 0,
					"pullOutRadius" : 0,
					"labelText": "[[title]]: [[value]] Peserta",
					"colors": [
						"#FF0F00",
						"#FF6600",
						"#999999",
						"#FCD202",
						"#F8FF01",
						"#B0DE09",
						"#04D215",
						"#0D8ECF",
						"#0D52D1",
						"#2A0CD0",
						"#8A0CCF",
						"#CD0D74",
						"#754DEB",
						"#DDDDDD",
						"#999999",
						"#333333",
						"#000000",
						"#57032A",
						"#CA9726",
						"#990000",
						"#4B0C25"
					],
					"titleField": "category",
					"valueField": "column-1",
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true,
						"align": "center",
						"labelWidth": 0,
						"markerType": "circle",
						"tabIndex": 4
					},
					"titles": [],
					"dataProvider": [
						{
							"category": "Terverifikasi",
							"column-1": <?php echo $buktiverif ?>
						},
						{
							"category": "Belum Terverifikasi",
							"column-1": <?php echo $buktinonverif ?>
						},
						{
							"category": "Belum Upload",
							"column-1": <?php echo $blmbuktibayar ?>
						}
					]
				}
			);
		</script>
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv2",
				{
					"type": "serial",
					"categoryField": "category",
					"rotate": true,
					"startDuration": 1,
					"processCount": 1001,
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[category]]:[[value]] Artikel",
							"fillAlphas": 1,
							"id": "AmGraph-1",
							"title": "Bidang Artikel",
							"type": "column",
							"valueField": "column-1"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": ""
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true,
						"useGraphSettings": true
					},
					"titles": [],
					"dataProvider": [
					<?php
					foreach ($bidang as $rr)
					{
						?>
						{
							"category": "<?php echo $rr['bidang']?>",
							"column-1": <?php echo $rr['jum']?>
						},
					<?php
					}
					?>
					]
				}
			);
		</script>

		<?php $this->load->view("backend/sidebar");?>
		
		<!-- END NAVIGATION -->
		<div id="main" role="main">
			<div id="ribbon">
				<ol class="breadcrumb">
					<li>Dashboard</li>
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
							<i class="fa-fw fa fa-home"></i> 
								Dashboard
						</h1>
					</div>
					<!-- end col -->
					
				</div>
				<!-- end row -->
								
				<div class="row">
						<div class="col-sm-6">						
							<div class="jarviswidget jarviswidget-color-blueDark">
								<header>
									<span class="widget-icon"> <i class="fa fa-paperclip"></i> </span>
									<h2> Data Peserta per Kategori </h2>								
								</header>
									<div>
										<div class="widget-body">
											<div class="col-lg-12">
											<div id="chartdiv" style="width: 100%; height: 260px; background-color: #FFFFFF;" ></div>
											</div>
										</div>	
									</div>
								</div>
							<div class="jarviswidget jarviswidget-color-blueDark">
								<header>
									<span class="widget-icon"> <i class="fa fa-paperclip"></i> </span>
									<h2> Data Bukti Bayar </h2>								
								</header>
									<div>
										<div class="widget-body">
											<div class="col-lg-12">
											<div id="buktibayar" style="width: 100%; height: 290px; background-color: #FFFFFF;" ></div>
											</div>
											<br>
										
											<b>Jumlah Uang Masuk</b> : <button class="btn btn-primary btn-sm" id="modalku" data-id="1"><b>Rp. <?php echo number_format($totaluang,2,',','.');?></b></button> <br/><i><?php echo terbilang($totaluang)?> Rupiah</i>
										</div>	
										
									</div>
								</div>
							</div>
						<div class="col-sm-6">						
							<div class="jarviswidget jarviswidget-color-blueDark">
								<header>
									<span class="widget-icon"> <i class="fa fa-paperclip"></i> </span>
									<h2> Data Abstrak dan Full Paper </h2>								
								</header>
									<div>
										<div class="widget-body">
										<br>
											<div class="col-lg-12">
											<div class="row">	
												<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> 
													<span class="text"> Abstrak Masuk 
														<span class="pull-right"><?php echo $jumabstrak ?> Dokumen</span> 
													</span>
													<div class="progress">
														<div class="progress-bar bg-color-greenLight" style="width: <?php echo $persenjumabstrak ?>%;"></div>
													</div> 
												</div>
												<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> 
													<span class="text"> Abstrak Diterima 
														<span class="pull-right"><?php echo $abstrak ?> Dokumen</span> 
													</span>
													<div class="progress">
														<div class="progress-bar bg-color-greenLight" style="width: <?php echo $persenabstrak ?>%;"></div>
													</div> 
												</div>
												<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> 
													<span class="text"> Total Full Paper Dikirim 
														<span class="pull-right"><?php echo $jumfullpaper ?> Dokumen</span> 
													</span>
													<div class="progress">
														<div class="progress-bar bg-color-greenLight" style="width: <?php echo $persenjumfull ?>%;"></div>
													</div> 
												</div>
												<div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> 
													<span class="text"> Full Paper Diterima
														<span class="pull-right"><?php echo $fullpaper ?> Dokumen</span> 
													</span>
													<div class="progress">
														<div class="progress-bar bg-color-greenLight" style="width: <?php echo $persenfull ?>%;"> Dokumen</div>
													</div> 
												</div>
											</div>
											</div>
										</div>	
									</div>
								</div>

							<div class="jarviswidget jarviswidget-color-blueDark">
								<header>
									<span class="widget-icon"> <i class="fa fa-paperclip"></i> </span>
									<h2> Data Abstrak berdasarkan Bidang </h2>								
								</header>
									<div>
										<div class="widget-body">
										<br>
											<div class="col-lg-12">
											<div id="chartdiv2" style="width: 100%; height: 330px; background-color: #FFFFFF;" ></div>
											</div>
										</div>	
									</div>
								</div>
							</div>
							</div>
					</div>
			</div>
			<!-- Modal -->
							<div class="modal fade" id="modalToko" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
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
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/jquery-form/jquery-form.min.js"></script>
		<script src="<?php echo base_url();?>asset/asset_admin/js/plugin/chartjs/chart.min.js"></script>


		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
		
		})

		</script>

		<script>
        $(function(){
            $(document).on('click','#modalku',function(e){
                e.preventDefault();
                $("#modalToko").modal('show');
                $.post('<?php echo base_url('admin/bukti/detail')?>',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    </script>

	</body>

</html>