<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
?>

<?php include 'header.php'; ?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('foto/bgutama.jpeg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate mb-5 text-center">
				<p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Check Out <i class="fa fa-chevron-right"></i></a></span></p>
				<h2 class="mb-0 bread">Check Out</h2>
			</div>
		</div>
	</div>
</section>
<section id="home-section" class="hero">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="bg-primary text-white">
							<tr class="text-center">
								<th>No</th>
								<th>Produk</th>
								<th>Harga</th>
								<th>Jumlah Beli</th>
								<th>SubHarga</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$nomor = 1;
							$totalbelanja = 0;
							foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
								<?php
									$ambil = $koneksi->query("SELECT * FROM produk 
								WHERE idproduk='$idproduk'");
									$pecah = $ambil->fetch_assoc();
									$totalharga = $pecah["hargaproduk"] * $jumlah;
									?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['namaproduk']; ?></td>
									<td>Rp <?php echo number_format($pecah['hargaproduk']); ?></td>
									<td><?php echo $jumlah; ?></td>
									<td>Rp <?php echo number_format($totalharga); ?></td>
								</tr>
								<?php $nomor++; ?>
								<?php $totalbelanja += $totalharga; ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<br><br>
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
				<form method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['nama'] ?>" class="form-control" name="namapelanggan">
							</div>
							<div class="form-group">
								<label>No. Handphone Pelanggan</label>
								<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['telepon'] ?>" class="form-control">
							</div>
							<div class="form-group">
								<label>Alamat Lengkap Pengiriman</label>
								<input type="hidden" name="totalberatnya" value="<?php echo $totalberat ?>" required>
								<textarea class="form-control" name="alamatpengiriman" placeholder="Masukkan Alamat"><?php echo $_SESSION["pengguna"]['alamat'] ?></textarea>
							</div>
							<div class="form-group">
								<label>Kota Pengiriman</label>
								<select name="kota" class="form-control" required id="kota" onchange="check()">
									<option value="">Pilih Kota</option>
									<option value="Palembang">Palembang</option>
									<option value="Jakarta">Jakarta</option>
									<option value="Bandung">Bandung</option>
									<option value="Surabaya">Surabaya</option>
									<option value="Yogyakarta">Yogyakarta</option>
									<option value="Bali">Bali</option>
									<option value="Cirebon">Cirebon</option>
									<option value="Medan">Medan</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<input type="hidden" id="totalbelanja" name="totalbelanja" value="<?php echo $totalbelanja ?>">
							<div class="form-group">
								<label>Ongkir Pengiriman</label>
								<input class="form-control" name="ongkir" type="number" readonly required id="ongkir">
							</div>
							<div class="form-group">
								<label>Grandtotal</label>
								<input class="form-control" id="grandtotal" required readonly type="number">
							</div>
							<button class="btn btn-primary pull-right btn-lg" name="checkout">Selesaikan Pembayaran</button>
						</div>
					</div>
				</form>
			</div> <!-- .col-md-8 -->
		</div>
	</div>
</section>
<?php
if (isset($_POST["checkout"])) {
	$notransaksi = '#INV-' . date("Ymdhis");
	$id = $_SESSION["pengguna"]["id"];
	$tanggalbeli = date("Y-m-d");
	$waktu = date("Y-m-d H:i:s");
	$alamatpengiriman = $_POST["alamatpengiriman"];
	$totalbeli = $totalbelanja;
	$totalberatnya = $_POST["totalberatnya"];
	$ongkir = $_POST["ongkir"];
	$kota = $_POST["kota"];
	$koneksi->query(
		"INSERT INTO pembelian(notransaksi,
				id, tanggalbeli, totalbeli, alamatpengiriman, kota, ongkir, statusbeli, waktu)
				VALUES('$notransaksi','$id', '$tanggalbeli', '$totalbeli', '$alamatpengiriman','$kota','$ongkir', 'Belum Bayar', '$waktu')"
	) or die(mysqli_error($koneksi));
	$idpembelian_barusan = $koneksi->insert_id;
	foreach ($_SESSION['keranjang'] as $idproduk => $jumlah) {
		$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
		$perproduk = $ambil->fetch_assoc();
		$nama = $perproduk['namaproduk'];
		$harga = $perproduk['hargaproduk'];

		$subharga = $perproduk['hargaproduk'] * $jumlah;
		$koneksi->query("INSERT INTO pembelianproduk (idpembelian, idproduk, nama, harga, subharga, jumlah)
					VALUES ('$idpembelian_barusan','$idproduk', '$nama','$harga','$harga','$jumlah')") or die(mysqli_error($koneksi));
	}
	unset($_SESSION["keranjang"]);
	echo "<script> alert('Pembelian Sukses');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
?>
<?php
include 'footer.php';
?>

<script>
	function check() {
		var val = document.getElementById('kota').value;
		if (val == 'Medan') {
			document.getElementById('ongkir').value = "5000";
		} else if (val == 'Palembang') {
			document.getElementById('ongkir').value = "7000";
		} else if (val == 'Jakarta') {
			document.getElementById('ongkir').value = "7000";
		} else if (val == 'Bandung') {
			document.getElementById('ongkir').value = "7000";
		} else if (val == 'Surabaya') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Yogyakarta') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Bali') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Cirebon') {
			document.getElementById('ongkir').value = "10000";
		} else if (val == 'Tanjung Enim') {
			document.getElementById('Tanjung Enim').value = "12000";
		}
		var num1 = document.getElementById("ongkir").value;
		var num2 = document.getElementById("totalbelanja").value;
		result = parseInt(num1) + parseInt(num2);
		document.getElementById("grandtotal").value = result;

	}
</script>