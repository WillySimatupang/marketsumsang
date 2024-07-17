<?php
session_start();
include 'koneksi.php';
?>
<?php include 'header.php'; ?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('foto/bgutama.jpeg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate mb-5 text-center">
				<p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span> <span>Keranjang </span></p>
				<h2 class="mb-0 bread">Keranjang</h2>
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
								<th>Foto Produk</th>
								<th>Harga</th>
								<th>Jumlah Beli</th>
								<th>Total Harga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php if (!empty($_SESSION["keranjang"])) { ?>
								<?php foreach ($_SESSION["keranjang"] as $idproduk => $jumlah) : ?>
									<?php
											$ambil = $koneksi->query("SELECT * FROM produk 
								WHERE idproduk='$idproduk'");
											$pecah = $ambil->fetch_assoc();
											$totalharga = $pecah["hargaproduk"] * $jumlah;
											?>
									<tr class="text-center">
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['namaproduk']; ?></td>
										<td class="image-prod">
											<div class="img" style="background-image:url(foto/<?php echo $pecah["fotoproduk"]; ?>);"></div>
										</td>
										<td>Rp <?php echo number_format($pecah['hargaproduk']); ?></td>
										<td><?php echo $jumlah; ?></td>
										<td>Rp <?php echo number_format($totalharga); ?></td>
										<td>
											<a href="hapuskeranjang.php?id=<?php echo $idproduk ?>" class="btn btn-danger btn-xs">Hapus</a>
										</td>
									</tr>
									<?php $nomor++; ?>
							<?php endforeach;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br><br>
		<div class="row justify-content-center">
			<a href="index.php" class="btn btn-warning"><i class="fa fa-cart-plus"></i>Lanjutkan Belanja</a>
			&nbsp;<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>
		<br><br>
	</div>
</section>

<?php
include 'footer.php';
?>