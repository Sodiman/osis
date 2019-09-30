<?php
	include "koneksi.php";
	
	$cekLogin = $_SESSION['login_user'];
	$query = mysql_query("select id from tb_user where username='$cekLogin'");
	$data = mysql_fetch_array($query);
	if($data['id'] != 1){
		$bilik = $_GET['bilik'];
		$jml = $_GET['jumlah'];
		if ($jml == 0) {
			mysql_query("insert into tb_hasil (aktif, user) values ('A', '$bilik')");
		}
	}
	header('Location: /osis');
?>