<?php
	include('koneksi.php');
	$sql_total = mysql_query("select * from tb_hasil where aktif = 'A'");
	$total = mysql_num_rows($sql_total);
?>
<html>
	<head>
		<title>Pengumuman Hasil</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/highcharts.js" type="text/javascript"></script>
		<script src="js/exporting.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				var options = {
					
				chart: {
				   events: {
						drilldown: function (e) {
							if (!e.seriesOptions) {

								var chart = this;

									

								// Show the loading label
								chart.showLoading('Loading ...');

								setTimeout(function () {
									chart.hideLoading();
									chart.addSeriesAsDrilldown(e.point, series);
								}, 1000); 
							}

						}
					},
					plotBorderWidth: 0
				},
					title: {
						text: 'Hasil Pemungutan Suara'
					},
					subtitle: {
						text: 'Total Suara : <?php echo $total;?>'
					},
					xAxis: {
						allowDecimals: false,
						type: 'category'
					},
					yAxis: {
						allowDecimals: false,
						labels: {
							style: {
								fontSize: '',
								width: ''
							},
							formatter: function(){
								return Math.round(this.value/<?php echo"$total"?>*100)+'%';
							}
						},
						title: {
						   text: 'Persentase Suara'
						},
					},
  
					tooltip: {
						valueSuffix: ' Suara',
					},
					legend: {
						enabled: false
					},
					plotOptions: {
						series: {
							borderWidth: 0,
							dataLabels: {
								enabled: true,
								inside : false,
								format: '{point.y} suara',
								
								style: {
									fontSize: '',
									width: ''
								}
							}
						}
					},
						  series:          
						[
							{
								name: "Jumlah Suara",
								colorByPoint: true,
								data: [
									
						<?php 
							$sql   = "select * from tb_pemilihanosis";
							$query = mysql_query( $sql )  or die(mysql_error());
							while( $calon = mysql_fetch_array( $query ) ){
								$no=$calon['no_calon'];
								$nama = $calon['nama'];
								$sql_jumlah   = "select * from tb_hasil where pilihan='$no' and aktif = 'A'";        
								$query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
								$data = mysql_num_rows($query_jumlah);
								$warna;
								switch ($no) {
									case 1:
										$warna = "maroon";
										break;
									case 2:
										$warna = "darkblue";
										break;
									case 3:
										$warna = "green";
										break;
									case 4:
										$warna = "purple";
										break;
									case 5:
										$warna = "orange";
										break;
									default:
										break;
								}
						?>
								 //data yang diambil dari database dimasukan ke variable nama dan data
								 //
								  {
									  name: '<?php echo $no; ?>. <?php echo $nama; ?>',
									  y: <?php echo "$data"; ?>,
									  color: '<?php echo $warna; ?>',
								  },
						<?php } ?>
								]
								
							}
						]
						
				  };
				  
				  // Column chart
				options.chart.renderTo = 'container';
				options.chart.type = 'column';
				options.plotOptions.series.dataLabels.format = '{point.y} suara';
				var chart1 = new Highcharts.Chart(options);

				chartfunc = function()
				{
				var column = document.getElementById('column');
				var bar = document.getElementById('bar');
				var pie = document.getElementById('pie');
				var line = document.getElementById('line');

						
				if(column.checked)
					{
						
						options.chart.renderTo = 'container';
						options.chart.type = 'column';
						options.plotOptions.series.dataLabels.format = '{point.y} suara';
						var chart1 = new Highcharts.Chart(options);
					}
				else if(bar.checked)
					{
						options.chart.renderTo = 'container';
						options.chart.type = 'bar';
						options.plotOptions.series.dataLabels.format = '{point.y} suara';
						var chart1 = new Highcharts.Chart(options);
					}
				else if(pie.checked)
					{
						options.chart.renderTo = 'container';
						options.chart.type = 'pie';
						options.plotOptions.series.dataLabels.format = '<b>{point.name}</b><br>{point.percentage:.1f} %';
						var chart1 = new Highcharts.Chart(options);
					}
				else
					{
						options.chart.renderTo = 'container';
						options.chart.type = 'line';
						options.plotOptions.series.dataLabels.format = '{point.y} suara';
						var chart1 = new Highcharts.Chart(options);
					}

				}
			});
			   
			   
		</script>
	</head>
	<body>
		<center>
			<div id="container"></div>
			<input type="radio" name="mychart" class="mychart" id= "column" value="column" onclick= "chartfunc()" checked>Column
			<input type="radio" name="mychart" class="mychart" id= "bar" value="bar" onclick= "chartfunc()">Bar
			<input type="radio" name="mychart" class="mychart" id= "pie" value="pie" onclick= "chartfunc()">Pie
			<input type="radio" name="mychart" class="mychart" id= "line" value="line" onclick= "chartfunc()">Line
		</center>
			<a class="kosongkan" href="truncate.php" onclick="return confirm('Apakah anda yakin menghapus semua data?')">Kosongkan Data</a>
	</body>
</html>