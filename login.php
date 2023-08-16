<?php
session_start();
//koneksi ke database
include 'koneksi.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<!--navbar -->
	<?php
	include 'menu.php';
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						
						<h3 class="panel-title" align="center">Login Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							
							<button class="btn btn-primary" name="login">Login</button>
							
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php

	//jika ada tombol login ditekan
if (isset($_POST["login"])) 
{
	$Email = $_POST["email"];
	$Password = $_POST["password"];

	//lakukan query cek akun di tabel pelanggan di database
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$Email' AND password_pelanggan='$Password'");
	//ngitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;
	//jika ada 1 akun yang cocok,maka boleh login
 
	if ($akunyangcocok==1) 
	{
		//anda sudah login
		//mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda sukses login');</script>";
		//jika sudah belanja
		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
		{
			echo "<script>location='checkout.php';</script>";
		}
		else
		{
			echo "<script>location='riwayat.php';</script>";
		}

	}
	else
	{
		//akun tidak cocok atau gagal login
		echo "<script>alert('anda gagal login, cek email dan password');</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>

</body>
</html>