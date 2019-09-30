<?php
	include "koneksi.php";
	
	// cek
	session_start();
	$cekLogin = $_SESSION['login_user'];
	$query = mysql_query("select id from tb_user where username='$cekLogin'");
	$data = mysql_fetch_array($query);
	if($data['id'] != 1){
		header('Location: /osis');
	}
	
	// pesan
	$pesan = $_SESSION["message"];
	$_SESSION["message"] = "";
	
	$sql_total = mysql_query("select * from tb_hasil where aktif = 'A'");
	$total = mysql_num_rows($sql_total);
	
?>
<html>
	<head>
		<title>Admin</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/metro.js"></script>
	</head>
	<body>
		<div id="mydiv">
		<?php echo "$pesan";?>
			<h1>Rekapitulasi Pemilihan Ketua OSIS</h1>
			<center>
				<table class="admin">
					<tbody>
						<tr>
							<td><a href="pendaftaran.php">Pendataran</td>
							<td colspan="2" style="text-align: right;"><a href='pengumuman.php?total=<?php echo"$total"?>'>Pengumuman</a></td>
						</tr>
						<tr style="text-align:center; background: #008080; color: white">
							<td>Calon
							</td>
							<td>
								Perolehan
							</td>
							<td>
								Persentase
							</td>
						</tr>
						
						<?php
							$calon = mysql_query("SELECT * FROM tb_pemilihanosis");
							while ($dataCalon = mysql_fetch_array($calon)) {
								$no = $dataCalon['no_calon'];
								$hasilSuara = mysql_query("select * from tb_hasil where pilihan = '$no' and  aktif = 'A'");
								$jml = mysql_num_rows($hasilSuara);
								$perolehan = 0;
								if ($jml >= '1'){
									$perolehan = round(($jml/$total) * 100);
								}
						?>
						<tr style="background: white">
							<td style="text-align:center">
								<?php echo"$no"?>
							</td>
							<td style="text-align:center">
								<?php echo"$jml"?>
							</td>
							<td >
								<img src="foto/<?php echo"$no"?>.gif" width="<?php echo"$perolehan%"?>" height="15">
								<?php echo"$perolehan"?>%
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				Pilih bilik dan klik aktifkan<br><br>
				<table style="margin-bottom: 20px; width: 50%; font-size: large;">
					<tr style="text-align: center; background: #ddd;">
						<?php 
							for($i = 2; $i <= 5; $i++){
								$queryBilik = mysql_query("select * from tb_hasil where user = '$i' and  aktif = 'A' and pilihan = '0'");
								$data = mysql_num_rows($queryBilik);
								$noBil = $i - 1;
								echo "
									<td>
									<p style='text-align: center; background: #778989; color: white;padding: 10px;'>Bilik $noBil</p>
									<a href='reset.php?bilik=$i' style='color: red'>RESET</a>
									<h3 style='display:block; background: white; border-radius: 4px; padding: 5px; margin: 5px;'>$data</h3><br>
									<a href='ulangi.php?bilik=$i' >Ulangi</a><br>
									<a href='aktif.php?bilik=$i&jumlah=$data' class='aktifButton'>Aktifkan</a>
									</td>";
							}
						?>
					</tr>
				</table>
				<a href="logout.php">LOGOUT</a><br><br>
			</center>
		</div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
		// refresh setiap 5 detik
			$(document).ready (function () {
				var updater = setTimeout (function () {
					$('div#mydiv').load ('admin.php', 'update=true');
					}, 5000);
			});
		</script>
	</body>
</html>