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
				<p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span><span>Login <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">Login</h2>
			</div>
		</div>
	</div>
</section>
<section id="home-section" class="ftco-section">
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<img width="100%" src="foto/daftar.png">
			</div>
			<div class="col-md-7">
				<form method="post">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password">
					</div>
					<br>
					<button class="btn btn-primary btn-block" name="simpan">Masuk</button>
				</form>
			</div>
		</div>
</section>
<?php
if (isset($_POST["simpan"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$ambil = $koneksi->query("SELECT * FROM pengguna WHERE email='$email' AND password='$password' LIMIT 1");
	$akunyangcocok = $ambil->num_rows;

	if ($akunyangcocok == 1) {
		$akun = $ambil->fetch_assoc();

		if ($akun['level'] == "Pelanggan") {
			$_SESSION["pengguna"] = $akun;
			echo "<script>alert('Anda sukses login');</script>";
			echo "<script>location ='index.php';</script>";
		} elseif ($akun['level'] == "Admin") {
			$_SESSION['admin'] = $akun;
			echo "<script>alert('Anda sukses login');</script>";
			echo "<script>location ='admin/index.php';</script>";
		} elseif ($akun['level'] == "Pemilik") {
			$_SESSION['admin'] = $akun;
			echo "<script>alert('Anda sukses login');</script>";
			echo "<script>location ='admin/index.php';</script>";
		}
	} else {
		echo "<script>alert('Anda gagal login, Cek akun Anda');</script>";
		echo "<script>location ='login.php';</script>";
	}
}
?>

<?php
include 'footer.php';
?>