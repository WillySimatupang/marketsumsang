<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="hero-wrap" style="background-image: url('foto/bgutama.jpeg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-8 ftco-animate d-flex align-items-end">
				<div class="text w-100 text-center">
					<h1 class="mb-4">Selamat<span> Datang</span> Di <span>Jaya Ponsel</span>.</h1>
					<p><a href="produk.php" class="btn btn-primary py-2 px-4">Produk Kami</a></p>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="ftco-intro">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-md-4 d-flex">
				<div class="intro d-lg-flex w-100 ftco-animate">
					<div class="icon">
						<span class="flaticon-support"></span>
					</div>
					<div class="text">
						<h2>Layanan 24 Jam</h2>
						<p>Melayani Dengan Integritas Dan Pelayanan Yang Terpadu</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex">
				<div class="intro color-1 d-lg-flex w-100 ftco-animate">
					<div class="icon">
						<span class="flaticon-cashback"></span>
					</div>
					<div class="text">
						<h2>Harga Worth It</h2>
						<p>Kami menjual produk dengan harga paling murah</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex">
				<div class="intro color-2 d-lg-flex w-100 ftco-animate">
					<div class="icon">
						<span class="flaticon-shopping-bag"></span>
					</div>
					<div class="text">
						<h2>Barang Original</h2>
						<p>Produk yang kami jual adalah produk original</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-no-pb">
	<div class="container">
		<div class="row">
			<div class="col-md-6 img img-3 d-flex justify-content-center align-items-center">
				<img src="foto/bgkiri.webp" width="100%" style="border-radius: 10px">
			</div>
			<div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
				<div class="heading-section">
					<span class="subheading">Sejak 2021</span>
					<h3 class="mt-4">Tentang Kami</h3>
					<p>Kami yakin bahwa membeli dan menjual gadget seharusnya aman, mudah dan dengan standar yang jelas.

						Oleh karena itu kami memulai Jaya Ponsel pada tahun 2016 dengan menyediakan informasi yang akurat dan terkini dalam hal Harga Gadget Preloved, sehingga Anda akan selalu mengetahui harga yang tepat saat ingin menjual gadget Anda, begitu pula agar Anda tidak salah harga saat ingin membeli gadget.</p>
					<p>Jika Anda adalah individu yang hanya ingin menjual gadget preloved tanpa membeli yang baru, kami punya solusi yang sangat mudah, cepat, dan menguntungkan, yaitu Maujual dan Langsung Laku by Tokopedia.</p>
				</div>

			</div>
		</div>
	</div>
</section>

<!-- <section class="ftco-section ftco-no-pb">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-4 ">
				<div class="sort w-100 text-center ftco-animate">
					<div class="img" style="background-image: url(home/images/bg1.jpg);"></div>
					<h3>Bunga Plastik</h3>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 ">
				<div class="sort w-100 text-center ftco-animate">
					<div class="img" style="background-image: url(home/images/bg2.jpg);"></div>
					<h3>Vas Bunga</h3>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 ">
				<div class="sort w-100 text-center ftco-animate">
					<div class="img" style="background-image: url(home/images/bg3.jpg);"></div>
					<h3>Tas</h3>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 ">
				<div class="sort w-100 text-center ftco-animate">
					<div class="img" style="background-image: url(home/images/bg4.jpg);"></div>
					<h3>Dream Catcher</h3>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 ">
				<div class="sort w-100 text-center ftco-animate">
					<div class="img" style="background-image: url(home/images/bg5.jpg);"></div>
					<h3>Celengan</h3>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 ">
				<div class="sort w-100 text-center ftco-animate">
					<div class="img" style="background-image: url(home/images/bg6.webp);"></div>
					<h3>Kotak Tisu</h3>
				</div>
			</div>

		</div>
	</div>
</section> -->

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center pb-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Produk</span>
				<h2>Produk Kami</h2>
			</div>
		</div>
		<div class="row">
			<?php $ambil = $koneksi->query("SELECT *FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori order by idproduk desc limit 3"); ?>
			<?php while ($perproduk = $ambil->fetch_assoc()) { ?>
				<div class="col-md-4 d-flex">
					<div class="product ftco-animate">
						<div class="img d-flex align-items-center justify-content-center" style="background-image: url(foto/<?php echo $perproduk['fotoproduk'] ?>);">
							<div class="desc">
								<p class="meta-prod d-flex">
									<a href="detail.php?id=<?php echo $perproduk['idproduk']; ?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
								</p>
							</div>
						</div>
						<div class="text text-center">
							<span class="category"><?= $perproduk['namakategori'] ?></span>
							<h2><?php echo $perproduk["namaproduk"] ?></h2>
							<p class="mb-0"><span class="price price-sale"></span> <span class="price">Rp <?php echo number_format($perproduk['hargaproduk']) ?></span></p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<a href="produk.php" class="btn btn-primary d-block">Lihat Semua Produk <span class="fa fa-long-arrow-right"></span></a>
			</div>
		</div>
	</div>
</section>
<?php
include 'footer.php';
?>