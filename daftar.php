<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php
	include 'menu.php';
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Daftar Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post" class="form-horizontal">
							<div class="form-gorup">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input type="text" name="nama" class="form-control" required>
								</div>
							</div>
							<div class="form-gorup">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<input type="email" name="email" class="form-control" required>
								</div>
							</div>
							<div class="form-gorup">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="password" name="password" class="form-control" required>
								</div>
							</div>
							<div class="form-gorup">
								<label class="control-label col-md-3">Alamat</label>
								<div class="col-md-7">
									<textarea class="form-control" name="alamat" required></textarea>
								</div>
							</div>
							<div class="form-gorup">
								<label class="control-label col-md-3">Tele/Hp</label>
								<div class="col-md-7">
									<input type="text" name="telepon" class="form-control" required>
								</div>
							</div>
							<div class="form-gorup">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="daftar">Daftar</button>
								</div>
							</div>
						</form>

						<?php 
							//jika ada tombol daftar(ditekan), maka
						if (isset($_POST["daftar"])) 
						{
							//mengambil isian nama,password,alamat,email,dan telepon
							$nama = $_POST["nama"];
							$email = $_POST["email"];
							$password = $_POST["password"];
							$telepon = $_POST["telepon"];
							$alamat = $_POST["alamat"];

							//cek apakah  email sudah digunakan
							$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");
							$yangcocok = $ambil->num_rows;
							if ($yangcocok==1) 
							{
								echo "<script>alert('email sudah digunakan,silahkan gunakan email berbeda');</script>";
								echo "<script>location= 'daftar.php';</script>";
							}
							else
							{
								//query insert ke tabel pelanggan
								$koneksi->query("INSERT INTO pelanggan(email_pelanggan,nama_pelanggan,password_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES('$email','$nama','$password','$telepon','$alamat')");

								echo "<script>alert('Akun anda telah terdaftar, silahkan login');</script>";
								echo "<script>location= 'login.php';</script>";
							}

						}
						 ?>

					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>