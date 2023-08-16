<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Litle Meal Bento</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	
	<?php
	include 'menu.php';
	?>

<!-- konten -->
<section class="konten">
	<div class="container">
		<h1>Produk Terbaru</h1>

		  <div class="row">

		  	<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
		  	<?php while($perproduk = $ambil->fetch_assoc()){ ?>
		  		<!-- <pre><?php print_r($perproduk) ?></pre> -->
		    <div class="col-md-3">
		    	<div class="thumbnail">
		    		<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>">
		    		<div class="caption">
		    			<h3><?php echo $perproduk['nama_produk']; ?></h3>
		    			<h5><?php echo number_format($perproduk['harga_produk']); ?></h5>
		    			<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
		    			<a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-warning">Detail</a>
		    		</div>
		    	</div>
		    </div>
		<?php } ?>

		  </div>
	</div>
</section>
</body>
</html>

<!-- class ="img-responsive" untuk mengatur gambar produk secara otomatis --> 