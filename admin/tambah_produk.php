<h2>Tambah produk</h2>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" name="harga" class="form-control">
	</div>
	<div class="form-group">
		<label>Berat(gram)</label>
		<input type="number" name="berat" class="form-control">
	</div>
	<div class="form-group">
		<label>Stok Produk</label>
		<input type="number" name="stok" class="form-control">
	</div>
	<div class="form-group">
		<label> Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-danger" name="simpan">Simpan</button>
</form>
<?php
	if (isset($_POST['simpan'])) 
	{
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "../foto_produk/".$nama);
		$koneksi->query("INSERT INTO produk(nama_produk,harga_produk,berat_produk,stok_produk,foto_produk,deskripsi_produk)VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$_POST[stok]','$nama','$_POST[deskripsi]')");
		echo "<div class='alert alert-info'>Data Tersimpan</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
?>
