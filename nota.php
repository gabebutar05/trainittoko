<?php session_start(); ?>
<?php
include 'koneksi.php';
//jika tidak ada session pelanggan(belum login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('anda belum login!');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<!--navbar -->
	<?php
	include 'menu.php';
	?>

	<section class="konten">
		<div class="container">
			
			<!-- nota disini  copas aja dari nota yang ada di admin  -->

			<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!--<h1>Data Pembelian $detail</h1>
<pre><?php print_r($detail); ?></pre> 
<h1>Data Orang yang Login di Session</h1>
<pre><?php print_r($_SESSION) ?></pre> -->

<!-- jika pelanggan yang login tidak sama dengan pelanggan yang beli,maka dilarikan ke riwayat.php karena tidak berhak melihat nota orang lain -->
<!-- pelanggan yang beli haeus pelanggan yang login -->

<?php 
	//mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail["id_pelanggan"];

//mendapatkan id_pelanggan yang masuk
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
if ($idpelangganyangbeli !== $idpelangganyanglogin) 
{
	echo "<script>alert('jangan nakal');</script>";
	echo "<script>location='riwayat.php'</script>";
	exit();
}
 ?>


<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No.Pembelian:<?php echo $detail['id_pembelian'] ?></strong><br>
		Tanggal : <?php echo $detail['tgl_pembelian']; ?><br>
		Total   : <?php echo number_format($detail['total_pembelian']) ?>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
		<p>
			<?php echo $detail['telepon_pelanggan'];?><br>
			<?php echo $detail['email_pelanggan'];?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail['nama_kota'] ?></strong> <br>
		Ongkos Kirim : Rp.<?php echo number_format($detail['tarif']); ?><br>
		Alamat Lengkap: <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Jumlah</th>
			<th>Subberat</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while ($pecah=$ambil->fetch_assoc()) { ?>
		<tr>
			<td>x</td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp.<?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['berat']; ?>Gram</td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo $pecah['subberat']; ?>Gram</td>
			<td>Rp.<?php echo number_format($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
		
<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan melakukan pembayaran Rp.<?php echo number_format($detail['total_pembelian']); ?> ke<br>
				<strong>Bank Mandiri 123-3343-4343-434 AN.budi suharjo</strong>
			</p>
		</div>
		<a href="riwayat.php"><button class="btn btn-primary">Bayar</button></a>
	</div>
</div>

		</div>
	</section>
</body>
</html>