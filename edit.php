<?php
	include "koneksi.php";
	
	session_start();
	$cekLogin = $_SESSION['login_user'];
	$query = mysql_query("select id from tb_user where username='$cekLogin'");
	$data = mysql_fetch_array($query);
	if($data['id'] != 1){
		header('Location: /osis');
	} 
	
	$noCalon =  $_GET['noCalon'];
	
	$sql = mysql_query("SELECT * FROM tb_pemilihanosis where no_calon='$noCalon'");
	$data = mysql_fetch_array($sql);
	$noCalon = $data['no_calon'];
	$nama = $data['nama'];
	$gambar = $data['gambar'];
	$color = $data['warna'];
		
	if(isset($_POST['submit'])) {
		
		$nama = $_POST['nama'];
		$foto = $_FILES['foto']['name'];
		$warna = $_POST['warna'];
		$sqlWarna = mysql_query("SELECT * FROM tb_pemilihanosis where warna = '$warna'");
		$warnaExist = mysql_num_rows($sqlWarna);
		
		$pesan;
		if ($warnaExist >= 1 && $warna != $color) {
			$pesan = "<script>$.Notify({caption: 'Save Failed',content: 'Warna tersebut sudah digunakan!!',type: 'alert'});</script>";
		} else {
			if ($foto == "") {
				$foto = $gambar;
			} else {
				$path = "foto/$gambar";
				if (file_exists($path)) {unlink($path);}
				if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
					move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$foto);
				}
			}
				
			$update = mysql_query("update tb_pemilihanosis set nama = '$nama', gambar= '$foto', warna='$warna' where id_biodata = '$noCalon'") or die(mysql_error());
			
			if ($update) {
				$_SESSION['message'] =  "<script>$.Notify({caption: 'Update Successs',content: 'Data berhasil disimpan!!',type: 'success'});</script>";
				header('Location: tab.php?tab=Pendaft');
			} else {
				$pesan = "<script>$.Notify({caption: 'Update Failed',content: 'Data gagal disimpan!!',type: 'alert'});</script>";
			}
		}
	}
?>
<html>
	<head>
		<title>Update</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/metro.js"></script>
	</head>
	<body>
		<?php echo "$pesan";?>
		<h1>Pembaruan Data</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<div id="main">
				<h2 style="text-align: center; margin-bottom: 30px;">Edit Data Calon</h2>
				<div id="sisiplogin">
					<input class="myInput" type="text" name="nama" value="<?php echo"$nama"?>" placeholder="Masukkan nama calon..." required="true"><br><br>
					<img id="gambar" src = "foto/<?php echo"$gambar"?>" style="width: 300px">
					<input id="imgInp" onchange="readURL(this)" style="margin-bottom: 30px;" type="file" name="foto" style="padding: 12px" accept="image/x-png,image/gif,image/jpeg">
					<br><br><span id="warnap">Pilih warna : <?php echo "$color"?></span><br>
					<input type="color" id="colorChoice" onchange="getWarna()" name="warna" value="<?php echo "$color"?>"><br><br>
					<input class="submit" type="submit" name="submit" value="Submit" onClick="return (validate())">
				</div>
			</div>
		</form>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script>
			function readURL(input) {
				 if (input.files && input.files[0]) {
					var reader = new FileReader();
					
					reader.onload = function(e) {
					  $('#gambar').attr('src', e.target.result);
					}
					
					reader.readAsDataURL(input.files[0]);
				  }
				}

				$("#imgInp").change(function() {
				  readURL(this);
			});
			
			function getWarna() {
			  var x = document.getElementById("colorChoice").value;
			  document.getElementById("warnap").innerHTML = 'Pilih warna : ' + x;
			};
			
			function validate() {
				var elements = document.getElementById("form").elements;
				for (var i = 0, element; element = elements[i++];) {
					if (element.type === 'color' && element.value === '#000000') {
						alert("Silahkan pilih warna selain hitam");
						return false;
					}
				}
				return true;
			};
		</script>
	</body>
</html>