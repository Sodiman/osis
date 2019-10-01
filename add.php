<?php
	include "koneksi.php";
	
	session_start();
	$cekLogin = $_SESSION['login_user'];
	$query = mysql_query("select id from tb_user where username='$cekLogin'");
	$data = mysql_fetch_array($query);
	if($data['id'] != 1){
		header('Location: /osis');
	} 
	
	if(isset($_POST['submit'])) {
		$sql = mysql_query("SELECT id_biodata FROM tb_pemilihanosis ORDER BY id_biodata DESC LIMIT 1");
		$data = mysql_fetch_assoc($sql);
		$noCalon = 1;
		if ($data >= 1) {
			$noCalon = $data['id_biodata'] + 1;
		}
		
		$nama = $_POST['nama'];
		$foto = $_FILES['foto']['name'];
		$warna = $_POST['warna'];
		$sqlWarna = mysql_query("SELECT * FROM tb_pemilihanosis where warna = '$warna'");
		$warnaExist = mysql_num_rows($sqlWarna);
		
		$pesan;
		if ($warnaExist >= 1) {
			$pesan = "<script>$.Notify({caption: 'Save Failed',content: 'Warna tersebut sudah digunakan!!',type: 'alert'});</script>";
		} else {
			if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
				move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$foto);
			}
				
			$insert = mysql_query("insert into tb_pemilihanosis (no_calon, nama, gambar, warna)
					values ('$noCalon','$nama','$foto','$warna')") or die(mysql_error());
			
			if ($insert) {
				$_SESSION['message'] =  "<script>$.Notify({caption: 'Save Successs',content: 'Data berhasil disimpan!!',type: 'success'});</script>";
				header('Location: tab.php?tab=Pendaft');
			} else {
				$pesan = "<script>$.Notify({caption: 'Save Failed',content: 'Data gagal disimpan!!',type: 'alert'});</script>";
			}
		}
	}
?>
<html>
	<head>
		<title>Pendaftaran</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/metro.js"></script>
	</head>
	<body>
		<?php echo "$pesan";?>
		<h1>Pendaftaran Calon</h1>
		<form id="form" action="" method="POST" enctype="multipart/form-data">
			<div id="main">
				<h2 style="text-align: center; margin-bottom: 30px;">Tambah Data</h2>
				<div id="sisiplogin">
					<input class="myInput" type="text" name="nama" value="" placeholder="Masukkan nama calon..." required="true"><br>
					<img id="gambar" src="foto/gambar.jpg" style="width: 300px">
					<input id="imgInp" onchange="readURL(this)" style="margin-bottom: 0px;" type="file" name="foto" style="padding: 12px" value="" required="true" accept="image/x-png,image/gif,image/jpeg">
					<br><br><span id="warnap">Pilih warna : </span><br>
					<input type="color" id="colorChoice" onchange="getWarna()" name="warna" value="<?php echo "$color"?>"><br><br>
					<input class="submit" type="submit" name="submit" value="Submit" onClick="return (validate() && spamCheck())">
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