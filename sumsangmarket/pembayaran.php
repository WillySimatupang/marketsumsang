<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
	exit();
}
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM pembelian WHERE idpembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

$id_beli = $detpem["id"];
$id_login = $_SESSION["pengguna"]["id"];
if ($id_login !== $id_beli) {
	echo "<script> alert('Gagal');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
$deadline = date('Y-m-d H:i', strtotime($detpem['waktu'] . ' +1 day'));
$harideadline = date('Y-m-d', strtotime($detpem['waktu'] . ' +1 day'));
$jamdeadline = date('H:i', strtotime($detpem['waktu'] . ' +1 day'));
if (date('Y-m-d H:i') >= $deadline) {
	echo "<script> alert('Waktu pembayaran telah habis');</script>";
	echo "<script> location ='riwayat.php';</script>";
}

?>
<?php include 'header.php'; ?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('foto/bgutama.jpeg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate mb-5 text-center">
				<p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Pembayaran <i class="fa fa-chevron-right"></i></a></span></p>
				<h2 class="mb-0 bread">Pembayaran</h2>
			</div>
		</div>
	</div>
</section>
<section id="home-section" class="ftco-section">
	<div class="container mt-4">
		<?php
		$ambil = $koneksi->query("SELECT*FROM pembelian JOIN pengguna
		ON pembelian.id=pengguna.id
		WHERE pembelian.idpembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
		?>
		<h4 class="text-danger">Upload Bukti Pembayaran Sebelum <?= tanggal($harideadline) . ' - Jam ' . $jamdeadline ?></h4>
		<br>
		<div class="row">
			<div class="col-md-6">
				<strong>NO PEMBELIAN: <?php echo $detail['idpembelian']; ?></strong><br>
				Status Barang : <?php echo $detail['statusbeli']; ?><br>
				Total Pembelian : Rp. <?php echo number_format($detail['totalbeli']); ?><br>
				Ongkir : Rp. <?php echo number_format($detail['ongkir']); ?><br>
				Total Bayar : Rp. <?php echo number_format($detail['ongkir'] + $detail['totalbeli']); ?>
			</div>
			<div class="col-md-6">
				<strong>NAMA : <?php echo $detail['nama']; ?></strong><br>
				Telepon : <?php echo $detail['telepon']; ?><br>
				Email : <?php echo $detail['email']; ?>
				Kota : <?php echo $detail['kota']; ?><br>
				Alamat Pengiriman : <?php echo $detail['alamatpengiriman']; ?><br>
			</div>
		</div>
		<br>
		<table class="table table-bordered">
			<thead class="bg-primary text-white">
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
		<div class="row justify-content-center mb-5 mt-5">
			<div class="col-md-5">
				<img width="100%" src="foto/bayar.webp">
			</div>
			<div class="col-md-7">
				<div class="table-responsive">
					<table class="table ">
						<thead class="bg-primary text-white">
							<tr>
								<th>No</th>
								<th>Nama Pembayaran</th>
								<th>No Rekening</th>
								<th>Atas Nama</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM pembayaranrekening"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['namapembayaran']; ?></td>
									<td><?php echo $pecah['norek']; ?></td>
									<td><?php echo $pecah['atasnama']; ?></td>
								</tr>
								<?php $nomor++; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<br>
				<br>
				<div class="alert alert-info">Total Tagihan Anda : <strong>Rp. <?php echo number_format($detpem["totalbeli"] + $detpem["ongkir"]) ?> <br>(Sudah
						Termasuk biaya pengiriman)</strong></div>

				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Rekening</label>
						<input type="text" name="nama" class="form-control" value="<?= $_SESSION['pengguna']['nama'] ?>" required>
					</div>
					<div class="form-group">
						<label>Tanggal Transfer</label>
						<input type="date" name="tanggaltransfer" class="form-control" value="<?= date('Y-m-d') ?>" required>

					</div>
					<div class="form-group">
						<label>Foto Bukti</label>
						<input type="file" name="bukti" class="form-control" required>
					</div>
					<button class="btn btn-primary float-right" name="kirim">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</section>
<?php
if (isset($_POST["kirim"])) {
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis") . $namabukti;
	move_uploaded_file($lokasibukti, "foto/$namafix");

	$nama = $_POST["nama"];
	$tanggaltransfer = $_POST["tanggaltransfer"];
	$tanggal = date("Y-m-d");
	$norek = $_POST["norek"];
	$atasnama = $_POST["atasnama"];

	$koneksi->query("INSERT INTO pembayaran(idpembelian, nama, tanggaltransfer,tanggal, bukti)
		VALUES ('$idpem','$nama','$tanggaltransfer','$tanggal','$namafix')");

	$koneksi->query("UPDATE pembelian SET statusbeli='Sudah Upload Bukti Pembayaran'
		WHERE idpembelian='$idpem'");
	echo "<script> alert('Terima kasih');</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>