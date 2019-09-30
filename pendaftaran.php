<?php
	include "koneksi.php";
	
	session_start();
	$cekLogin = $_SESSION['login_user'];
	$query = mysql_query("select id from tb_user where username='$cekLogin'");
	$data = mysql_fetch_array($query);
	$login_session =$data['id'];
	if($login_session != 1){
		mysql_close($connection);
		header('Location: /osis');
	}
	$pesan = $_SESSION["message"];
	$_SESSION["message"] = "";
?>
<html>
	<head>
		<title>SMP N 2 Kebumen</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/metro.js"></script>
	</head>
	<body>
		<h1>Pendaftaran Calon Ketua OSIS</h1>
		<center>
		<table class="admin">
			<thead>
				<tr>
					<td colspan="2" style="text-align: left; "><a href="admin.php"><img src="foto/back.png" style="width:30px"></a></td>
					<td colspan="2" style="text-align: right"><a href="add.php">Tambah</a></td>
				</tr>
				<tr>
					<th>No</th>
					<th>No. Urut Calon</th>
					<th>Nama Calon</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no = 1;
					$sql = mysql_query("SELECT * FROM tb_pemilihanosis");
					while ($data = mysql_fetch_array($sql)) {
				?>
				<tr style="background: white;">
					<td style="text-align: center"><?php echo"$no"?></td>
					<td><?php echo"$data[no_calon]"?></td>
					<td><?php echo"$data[nama]"?></td>
					<td><a href="edit.php?noCalon=<?php echo"$data[no_calon]"?>">Edit</a><br><a href="delete.php?noCalon=<?php echo"$data[no_calon]"?>&foto=<?php echo"$data[gambar]"?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a></td>
				</tr>
					<?php $no++;}?>
			</tbody>
		</table>
		<a href="logout.php">LOGOUT</a>
		</center>
		<?php echo "$pesan";?>
	</body>
</html>