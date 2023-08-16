<h2>Data Pembayaran Pelanggan</h2>
<?php 
//mendapatkan id_pembelian dari url
$id_pembelian = $_GET["id"];

//mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

 ?>
 <div class="row">
 	<div class="col-md-6">
 		<table class="table">
 			<tr>
 				<th>Nama</th>
 				<th><?php echo $detail['nama']; ?></th>
 			</tr>
 			<tr>
 				<th>Bank</th>
 				<th><?php echo $detail['bank']; ?></th>
 			</tr>
 			<tr>
 				<th>Jumlah</th>
 				<th>Rp.<?php echo number_format($detail['jumlah']); ?></th>
 			</tr>
 			<tr>
 				<th>Tanggal</th>
 				<th><?php echo $detail['tanggal']; ?></th>
 			</tr>

 		</table>
 	</div>
 	<div class="col-md-6">
 		<img src="../Bukti_Pembayaran/<?php echo $detail['bukti'] ?>"class="img-responsive">
 	</div>
 </div>

 <form method="post">
 	<div class="form-group">
 		<label>No Resi Pengiriman</label>
 		<input type="text" name="resi" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Status</label>
 		<select class="form-control" name="status">
 			<option value="">Pilih Status</option>
 			<option value="lunas">Lunas</option>
 			<option value="Barang dikirim">Barang dikirim</option>
 			<option value="batal">Batal</option>
 		</select>
 	</div>
 	<button class="btn btn-primary" name="proses">Proses</button>
 </form>

 <?php 
 if (isset($_POST["proses"])) 
 {
 	$Resi = $_POST["resi"];
 	$Status = $_POST["status"];

 	$koneksi->query("UPDATE pembelian SET resi_pengiriman ='$Resi',status_pembelian='$Status' WHERE id_pembelian='$id_pembelian'");

 	echo "<script>alert('Data pembelian Ter-Update');</script>";
 	echo "<script>location='index.php?halaman=pembelian';</script>";
 }
  ?>