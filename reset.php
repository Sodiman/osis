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
		mysql_query("delete from tb_hasil where user = '$bilik' and  pilihan = '0'");
		header('Location: tab.php?tab=Pelak');
	}
?>