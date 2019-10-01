<?php
	include  "koneksi.php";
	
	session_start();
	$cekLogin = $_SESSION['login_user'];
	$query = mysql_query("select id from tb_user where username='$cekLogin'");
	$data = mysql_fetch_array($query);
	$login_session =$data['id'];
	if($login_session != 1){
		mysql_close($connection);
		header('Location: /osis');
	} 
	
	$noCalon =  $_GET['noCalon'];
	$gambar = $_GET['foto'];
	if ($noCalon != null) {
		if (unlink("foto/$gambar")) {
			$delete = mysql_query("delete from tb_pemilihanosis where no_calon='$noCalon'") or die(mysql_error());
			if ($delete) {
				mysql_query("delete from tb_hasil where pilihan='$noCalon'");
				$_SESSION['message'] =  "<script>$.Notify({caption: 'Delete Successs',content: 'Data berhasil dihapus!!',type: 'success'});</script>";
				header('Location: tab.php?tab=Pendaft');
			} else {
				$_SESSION['message'] =  "<script>$.Notify({caption: 'Delete Failed',content: 'Data gagal dihapus!!',type: 'alert'});</script>";
				header('Location: tab.php?tab=Pendaft');
			}
		}
	}
?>