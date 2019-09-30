<?php
	include "koneksi.php";
	$query = mysql_query("select id_no from tb_hasil where aktif = 'A' and pilihan = '0'");
	$data = mysql_fetch_array($query);
	$id = $data['id_no'];
	$user = $_GET['user'];
	$no_pilih = $_GET['pilihan'];
	
	mysql_query("update tb_hasil set pilihan = '$no_pilih', user = '$user' where id_no = '$id'");
	session_start();
		$_SESSION['message']= "<script>$.Notify({caption: 'Success',content: 'Terima kasih atas partisipasi anda!!',type: 'success'});</script>";
	header('Location: /osis');
?>