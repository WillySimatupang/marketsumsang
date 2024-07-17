<?php
$ambil = $koneksi->query("SELECT*FROM pembelian JOIN pengguna
	ON pembelian.id=pengguna.id
	WHERE pembelian.idpembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>



<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h3>Pembelian</h3>
						<hr>
						<strong>NO PEMBELIAN: <?php echo $detail['idpembelian']; ?></strong><br>
						Tanggal : <?= tanggal(date('Y-m-d', strtotime($detail['tanggalbeli']))) ?><br>
						Status Barang : <?php echo $detail['statusbeli']; ?><br>
						Total Pembelian : Rp. <?php echo number_format($detail['totalbeli']); ?><br>
						Ongkir : Rp. <?php echo number_format($detail['ongkir']); ?><br>
						Total Bayar : Rp. <?php echo number_format($detail['ongkir'] + $detail['totalbeli']); ?>
					</div>
					<div class="col-md-6">
						<h3>Pelanggan</h3>
						<hr>
						<strong>NAMA : <?php echo $detail['nama']; ?></strong><br>
						Telepon : <?php echo $detail['telepon']; ?><br>
						Email : <?php echo $detail['email']; ?>
						Kota : <?php echo $detail['kota']; ?><br>
						Alamat Pengiriman : <?php echo $detail['alamatpengiriman']; ?><br>
					</div>
				</div>
				<br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Total Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php $ambil = $koneksi->query("SELECT * FROM pembelianproduk WHERE idpembelian='$_GET[id]'"); ?>
						<?php while ($pecah = $ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama']; ?></td>
								<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
								<td><?php echo $pecah['jumlah']; ?></td>
								<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
$idpembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT*FROM pembayaran WHERE idpembelian='$idpembelian'");
$detail = $ambil->fetch_assoc();

?>
<?php $am = $koneksi->query("SELECT*FROM pembelian WHERE idpembelian='$idpembelian'");
$det = $am->fetch_assoc(); ?>
<div class="row">
	<?php if ($det['statusbeli'] != "Selesai") { ?>
		<div class="col-md-6 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Konfirmasi</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<tr>
									<th>Nama</th>
									<th><?php echo $detail['nama'] ?></th>
								</tr>
								<tr>
									<th>Tanggal Transfer</th>
									<th><?= tanggal(date('Y-m-d', strtotime($detail['tanggaltransfer']))) ?></th>
								</tr>
								<tr>
									<th>Tanggal Upload Bukti Pembayaran</th>
									<th><?= tanggal(date('Y-m-d', strtotime($detail['tanggal']))) ?></th>
								</tr>
							</table>
							<form method="post">
								<div class="form-group">
									<label>Masukkan No Resi Pengiriman</label>
									<input type="text" class="form-control" name="resi" value="<?php echo $det['resipengiriman'] ?>">
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="statusbeli">
										<option <?php if ($det['statusbeli'] == 'Belum di Konfirmasi') echo 'selected'; ?> value="Belum di Konfirmasi">Belum di Konfirmasi</option>
										<option <?php if ($det['statusbeli'] == 'Pesanan Di Tolak') echo 'selected'; ?> value="Pesanan Di Tolak">Pesanan Di Tolak</option>
										<option <?php if ($det['statusbeli'] == 'Barang Di Kemas') echo 'selected'; ?> value="Barang Di Kemas">Barang Di Kemas</option>
										<option <?php if ($det['statusbeli'] == 'Barang Di Kirim') echo 'selected'; ?> value="Barang Di Kirim">Barang Di Kirim</option>
										<option <?php if ($det['statusbeli'] == 'Barang Telah Sampai ke Pemesan') echo 'selected'; ?> value="Barang Telah Sampai ke Pemesan">Barang Telah Sampai ke Pemesan</option>
									</select>
								</div>
								<button class=" btn btn-primary float-right pull-right" name="proses">Simpan</button>
								<br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="col-md-6 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<h4>Bukti Pembayaran</h4>
						<img src="../foto/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST["proses"])) {
	$resi = $_POST["resi"];
	$statusbeli = $_POST["statusbeli"];
	$koneksi->query("UPDATE pembelian SET resipengiriman='$resi', statusbeli='$statusbeli'
		WHERE idpembelian='$idpembelian'");
	echo "<script>alert('Status Transaksi Berhasil Diupdate')</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
} ?>