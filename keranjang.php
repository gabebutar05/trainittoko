<?php
session_start();

//echo "<pre>";
//print_r($_SESSION['keranjang']);
//echo "</pre>";

include 'koneksi.php';

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('keranjang masih kosong,silahkan Belanja!')</script>";
	echo "<script>location='index.php'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!--navbar -->

<?php  
include 'menu.php';
?>

	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Gambar</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
					<!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
					<?php 
						$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah['harga_produk'] * $jumlah;
						//echo "<pre>";
						//print_r($pecah);
						//echo "</pre>";
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td>
							<img src="foto_produk/<?php echo $pecah['foto_produk']; ?>" width="250" height="200">
						</td>
						<td>Rp.<?php echo number_format($pecah['harga_produk']); ?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp.<?php echo number_format($subharga); ?></td>
						<td>
							<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger">Hapus</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-danger">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>
	</section>
</body>
</html>