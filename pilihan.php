<?php
	include "koneksi.php";
	
	session_start();
	$cekLogin = $_SESSION['login_user'];
	$queryCekLogin = mysql_query("select id from tb_user where username='$cekLogin'");
	$dataLogin = mysql_fetch_array($queryCekLogin);
	$login_session =$dataLogin['id'];
	if (!isset($login_session)) {
		$_SESSION['message'] = "<script>$.Notify({caption: 'Access Failed',content: 'Device anda belum terdaftar!!',type: 'alert'});</script>";
		header('Location: /osis');
	} else {
		
		if($login_session == 1)	{
			header('Location: /osis');
		} else {
			$query = mysql_query("select id_no from tb_hasil where aktif = 'A' and user='$login_session' and pilihan = '0'");
			$data = mysql_fetch_array($query);
			$id = $data['id_no'];
			
			$pesan = $_SESSION["message"];
			$_SESSION["message"] = "";
			if ($id == '' || $id == NULL) {
				$_SESSION['message']= "<script>$.Notify({caption: 'Access Failed',content: 'Menunggu konfirmasi dari admin!!',type: 'alert'});</script>";
				header("Location: /osis");
			}
			
		}
	}
?>
<html>
	<head>
		<title>SMP N 2 Kebumen</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
	<head>
	<body>
		<h1>Pemilihan Ketua Osis</h1>
		<table class="pilihan">
			<tbody>	
				<tr>
				<?php
					$sql = mysql_query("select * from tb_pemilihanosis");
	
					while ( $data = mysql_fetch_array($sql)) {
				?>
					<td style="background:<?php echo"$data[warna]"?>; color:white; border-radius: 4px;">
						<center>
						<h2><?php echo"$data[no_calon]"?></h1>
						<a href="selesai.php?pilihan=<?php echo"$data[no_calon]"?>&user=<?php echo"$login_session"?>"   onclick="return confirm('Apakah anda yakin mililih <?php echo"$data[nama]"?> ?')">
							<img src="foto/<?php echo"$data[gambar]"?>" class="calon">
						</a>
						<h3><?php echo"$data[nama]"?></h2>
						</center>
					</td>
					<?php } ?>
				</tr>
			</tbody>
		</table>
	</body>
</html>