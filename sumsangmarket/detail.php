<?php
session_start();
include 'koneksi.php';
?>
<?php
$idproduk = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM produk WHERE idproduk='$idproduk'");
$detail = $ambil->fetch_assoc();
$kategori = $detail["idkategori"];
?>
<?php include 'header.php'; ?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('foto/bgutama.jpeg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate mb-5 text-center">
				<p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span><span>Detail Produk <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">Detail Produk</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate">
				<a href="images/prod-1.jpg" class="image-popup prod-img-bg"><img src="foto/<?php echo $detail["fotoproduk"]; ?>" class="img-fluid" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3><?php echo $detail["namaproduk"] ?></h3>
				<p class="price"><span>Rp. <?php echo number_format($detail["hargaproduk"]); ?></span></p>
				<?php
				$ambilulasan = mysqli_query($koneksi, "SELECT sum(bintang) as totalbintang FROM ulasan where ulasan.idproduk = '$idproduk'");
				$dataulasan = $ambilulasan->fetch_assoc();
				$ambilulasan = mysqli_query($koneksi, "SELECT * FROM ulasan where ulasan.idproduk = '$idproduk'");
				$hitungulasan = $ambilulasan->num_rows;
				if ($hitungulasan == 0) {
					$jumlahulasan = 1;
				} else {
					$jumlahulasan = $hitungulasan;
				}
				$rataulasan = $dataulasan['totalbintang'] / $jumlahulasan;
				$kritik = "";
				for ($i = 1; $i <= 5; $i++) {
					if ($rataulasan >= $i) {
						$kritik .= '<span class="fa fa-star checked" style="color:#ffc700;font-size:15pt"></span>';
					} else {
						$kritik .= '<span class="fa fa-star" style="font-size:15pt"></span>';
					}
				}
				if ($hitungulasan >= 1) {
					echo $kritik;
				}
				?>
				<br>
				<br>
				<span style="color: #000;font-size:15pt !important;"><?php echo $detail["deskripsiproduk"]; ?></span>
				<div class="row mt-4">
					<div class="w-100"></div>
					<div class="col-md-12">
						<p style="color: #000;font-size:15pt !important;">Sisa Produk : <?php echo number_format($detail["stokproduk"]); ?></p>
					</div>
				</div>
				<form method="post">
					<div class="form-group">
						<label>Beli Produk</label>
						<input type="number" placeholder="Jumlah" min="1" class="form-control" name="jumlah" max="<?php echo number_format($detail["stokproduk"]); ?>" required></input>
						<br>
						<button class="btn btn-success float-right" name="beli"><i class="fa fa-shopping-cart"></i> Beli</button>
					</div>
				</form>
				<?php
				if (isset($_POST["beli"])) {
					$jumlah = $_POST["jumlah"];
					$_SESSION["keranjang"][$idproduk] = $jumlah;
					echo "<script> alert('Produk Masuk Ke Keranjang');</script>";
					echo "<script> location ='keranjang.php';</script>";
				}
				?>
				<br>
				<br>
				<?php
				$ambilulasan = mysqli_query($koneksi, "SELECT * FROM ulasan left join pengguna ON pengguna.id = ulasan.idpengguna where ulasan.idproduk = '$idproduk' order by waktu desc");
				$cekulasan = $ambilulasan->num_rows;
				if ($cekulasan >= 1) { ?>
					<div class="row mb-3">
						<div class="col-md-12">
							<ul class="comment-list">
								<?php
									$top = 190;
									while ($ulasan = mysqli_fetch_assoc($ambilulasan)) {
										$kritik = "";
										for ($i = 1; $i <= 5; $i++) {
											if ($ulasan['bintang'] >= $i) {
												$kritik .= '<span class="fa fa-star checked" style="color:#ffc700"></span>';
											} else {
												$kritik .= '<span class="fa fa-star"></span>';
											}
										}
										?>
									<div class="card mb-3 p-3 shadow-sm">
										<div class="row">
											<?php if ($ulasan['foto'] != "") { ?>
												<div class="col-md-7 my-auto">
													<li class="comment-list-item">
														<div class="comment-list-item-image">
															<p class="text-success"><?= tanggal(date('Y-m-d', strtotime($ulasan['waktu']))) ?> - <?= date('H:i', strtotime($ulasan['waktu'])) ?></p>
														</div>
														<div class="comment-list-item-content">
															<?php if ($ulasan['tampilannama'] == "Tampilkan Nama") { ?>
																<h5 class="text-success mb-3"><?= $ulasan['nama'] ?></h5>
															<?php } else { ?>
																<h5 class="text-success mb-3">*******</h5>
															<?php } ?>
															<?= $kritik ?>
															<p class="mt-3"><?= $ulasan['ulasan'] ?></p>
														</div>
													</li>
												</div>
												<div class="col-md-5">
													<img src="foto/<?= $ulasan['foto'] ?>" width="100%" style="border-radius: 10px;">
												</div>
											<?php } else { ?>
												<div class="col-md-12">
													<li class="comment-list-item">
														<div class="comment-list-item-image">
															<p class="text-success"><?= tanggal(date('Y-m-d', strtotime($ulasan['waktu']))) ?> - <?= date('H:i', strtotime($ulasan['waktu'])) ?></p>
														</div>
														<div class="comment-list-item-content">
															<h5 class="text-success mb-3"><?= $ulasan['nama'] ?></h5>
															<?= $kritik ?>
															<p class="mt-3"><?= $ulasan['ulasan'] ?></p>
														</div>
													</li>
												</div>
											<?php } ?>
										</div>
									</div>
								<?php
									} ?>
							</ul>
						</div>
					</div>
				<?php } else { ?>
					<div class="row mb-3">
						<div class="col-md-12">
							<div class="card mb-3 p-3 shadow-sm">
								<h3 class="text-center">Ulasan masih kosong</h3>
								<img src="foto/kosong.png" width="100%" style="border-radius: 10px;">
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<?php
include 'footer.php';
?>