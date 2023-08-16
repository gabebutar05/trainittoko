<?php 
	include 'koneksi.php';
	session_start();

	$id_pembelian = $_GET["id"];
	$ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
	$detbey = $ambil->fetch_assoc();
	//echo "<pre>";
	//print_r($detbey);
	//echo "</pre>"; 
	//jika belum aada data pembayaran
	if (empty($detbey)) 
	{
		echo "<script>alert('Belum ada data pembayaran!')</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}
	//jika data pelanggan tidak sesuai dengan yang login
	//echo "<pre>";
	//print_r($_SESSION);
	//echo "</pre>";
	if ($_SESSION["pelanggan"]['id_pelanggan']!==$detbey["id_pelanggan"]) 
	{
		echo "<script>alert('Anda tidak berhak!')</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}
	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Lihat Pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php 
	include 'menu.php';
 ?>
 <div class="container">
 	<h3>Lihat Pembayaran</h3>
 	<div class="row">
 		<div class="col-md-6">
 			<table class="table">
 				<tr>
 					<th>Nama</th>
 					<td><?php echo $detbey["nama"] ?></td>
 				</tr>
 				<tr>
 					<th>Bank</th>
 					<td><?php echo $detbey["bank"] ?></td>
 				</tr>
 				<tr>
 					<th>Tanggal</th>
 					<td><?php echo $detbey["tanggal"] ?></td>
 				</tr>
 				<tr>
 					<th>Jumlah</th>
 					<td>Rp.<?php echo number_format($detbey["total_pembelian"]) ?></td>
 				</tr>
 			</table>
 		</div>
 		<div class="col-md-6">
 			<img src="Bukti_Pembayaran/<?php echo $detbey["bukti"] ?>" class="img-responsive">
 		</div>
 	</div>
 </div>
</body>
</html>