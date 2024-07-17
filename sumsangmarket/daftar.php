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
				<p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span> <span>Daftar <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">Daftar</h2>
			</div>
		</div>
	</div>
</section>
<section id="home-section" class="ftco-section">
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<img width="100%" src="foto/loginn.png">
			</div>
			<div class="col-md-7">
				<form method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Email</label>
						<input type="email" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="text" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Alamat</label>
						<textarea class="form-control " name="alamat" required></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Telepon</label>
						<input type="text" name="telepon" class="form-control">
					</div>
					<div class="form-group ">
						<br>
						<button class="btn btn-primary btn-block" name="daftar">Daftar</button>
					</div>
				</form>
			</div>
		</div>
</section>
<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];
	$ambil = $koneksi->query("SELECT*FROM pengguna 
							WHERE email='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Pendaftaran Gagal, email sudah ada')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO pengguna	(nama, email,  password, alamat, telepon, fotoprofil, level)
								VALUES('$nama','$email','$password','$alamat','$telepon','Untitled.png','Pelanggan')");
		echo "<script>alert('Pendaftaran Berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>