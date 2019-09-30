<?php
	include "koneksi.php";
	
	session_start();
	$cekLogin = $_SESSION['login_user'];
	$query = mysql_query("select id from tb_user where username='$cekLogin'");
	$data = mysql_fetch_array($query);
	if($data['id'] != 1){
		header('Location: /osis');
	} else {
		$bilik = $_GET['bilik'];
		mysql_query("truncate tb_hasil");
		header('Location: /osis/pengumuman.php?total=0');
	}
?>