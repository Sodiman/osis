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
	$tab = $_GET['tab'];
	if (!isset($tab)) {
		header('Location: /osis');
	} else {
		if ($tab == '' || $tab == null) {
			header('Location: /osis');
		}
	}
?>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/metro.js"></script>
	</head>
	<body>
		<div class="tab">
			<button id="Pendaft" class="tablinks" onclick="openCity(event, 'Pendaftaran')">Pendaftaran</button>
			<button id="Pelak" class="tablinks" onclick="openCity(event, 'Pelaksanaan')">Pelaksanaan</button>
			<button id="Pengum" class="tablinks" onclick="openCity(event, 'Pengumuman')">Pengumuman</button>
			<a href= "logout.php" onclick="return confirm('Apakah anda yakin untuk Log Out?')"><button style="color:blue">Logout</button></a>
		</div>
		<div id="Pendaftaran" class="tabcontent">
			<?php include "pendaftaran.php";?>
		</div>
		<div id="Pelaksanaan" class="tabcontent">
			<?php include "admin.php";?>
		</div>
		<div id="Pengumuman" class="tabcontent">
			<?php include "pengumuman.php";?>
		</div>
		<script>
			function openCity(evt, namaKota) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(namaKota).style.display = "block";
				evt.currentTarget.className += " active";
			}
			document.getElementById("<?php echo $tab ?>").click();
		</script>
		<h1>Administrator</h1>
	</body>
</html>