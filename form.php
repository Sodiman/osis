<?php
	include "koneksi.php";
		
	session_start();
	
	if(isset($_SESSION['login_user'])){
		header("location: admin.php");
	}
	
	$error = "";
	if(isset($_POST['submit'])) {
		// Variabel username dan password
		$user = $_POST['username'];
		$pass = $_POST['password'];
		// Mencegah MySQL injection 
		$usr = stripslashes($user);
		$pwd = stripslashes($pass);
		$u = mysql_real_escape_string($usr);
		$p = mysql_real_escape_string($pwd);
		
		$query = mysql_query("select * from tb_user where password='$p' AND username='$u'");
		$jumlahBaris = mysql_num_rows($query);
		if ($jumlahBaris == 1) {
			$_SESSION['login_user']=$u;
			$_SESSION['message']= "<script>$.Notify({caption: 'Login Success',content: 'Anda berhasil Login',type: 'success'});</script>";
			$data = mysql_fetch_array($query);
			 
			if ($data['id'] == 1) {
				header("location: tab.php?tab=Pendaft");
			} else {
				header("location: /osis");
			}
		} else {
			$error = "<script>$.Notify({caption: 'Login Failed',content: 'Periksa Username dan Password anda!!',type: 'alert'});</script>";
		}
		mysql_close($conn);
	}

?>
<html>
    <head>
        <title>Sign In</title>
		<link rel="stylesheet" type="text/css" href="css/home.css"/>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/metro.js"></script> 
    </head>
    <body>
	<?php echo "$error"?>;
        <form action="" method="POST">
		<h1>Pengguna</h1>
            <div id="main">
                <h2 style="text-align: center; margin-bottom: 30px">Login</h2>
                <div id="sisiplogin">
                    <input class="myInputA" type="text" name="username" value="" placeholder="Masukkan username anda..." required="true"><br>
                    <input class="myInput" type="password" name="password" value="" placeholder="Masukkan password anda..." required="true"><br>
					<input class="checkbox" type="checkbox" style="margin-bottom: 30px">Tampilkan Password<br>
                    <input class="submit" type="submit" name="submit" value="Submit">
                </div>
            </div>
        </form>
		<script type="text/javascript">
		// menampilkan password
			$(document).ready(function(){		
				$('.checkbox').click(function(){
					if($(this).is(':checked')){
						$('.myInput').attr('type','text');
					}else{
						$('.myInput').attr('type','password');
					}
				});
			});
		</script>
    </body>
</html>