<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/metro.js"></script> 
	<head>
	<body>
		<?php
			include "koneksi.php";
			session_start();
			$cekLogin = $_SESSION['login_user'];
			$query = mysql_query("select id from tb_user where username='$cekLogin'");
			$data = mysql_fetch_array($query);
			$login_session =$data['id'];
			
			if(isset($login_session)){
				$label = "<a href='logout.php'>Logout</a>";
				if ($login_session == 1) {
					header('Location: tab.php?tab=Pendaft');
				}
			} else {
				$label = "<a href='form.php'>Login</a>";
			}
			
			$pesan = $_SESSION["message"];
			
			echo "$pesan";
			$_SESSION["message"] = "";
		?>
		<h1>Pemilihan Ketua Osis</h1>
		<center>
			<h2 style="margin-top:100px";>Pilihlah sesuai hati nurani anda</h2><br>
			<a href="pilihan.php"" style="text-decoration:none;"><input type="button" value="Mulai" style="padding:12px; width:20%"></a></br>
			<br>Pastikan Device telah terdaftar. <?php echo"$label"?>
		</center>
	</body>
</html>