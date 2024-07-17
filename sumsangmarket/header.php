<?php
include 'koneksi.php';
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
  $datakategori[] = $tiap;
}
function tanggal($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>Jaya Ponsel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="home/css/animate.css">

    <link rel="stylesheet" href="home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="home/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="home/css/magnific-popup.css">

    <link rel="stylesheet" href="home/css/flaticon.css">
    <link rel="stylesheet" href="home/css/style.css">
    <link rel="icon" type="image/x-icon" href="foto/logo.png">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <style>
      body {
        font-size: 15pt !important;
        color: #000;
      }

      label {
        font-size: 15pt !important;
        color: #000;
      }
    </style>
  </head>

  <body>
    <div class="wrap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <center>
            </center>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php"> <img src="foto/logo.png" width="50px" style="border-radius: 10px;">&nbsp;Jaya <span>Ponsel</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-list"></i>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item active"><a href="produk.php" class="nav-link">Produk</a></li>
            <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
              <div class="dropdown-menu" aria-labelledby="dropdown03">
                <?php foreach ($datakategori as $key => $value) : ?>
                  <a href="kategori.php?id=<?php echo $value["idkategori"] ?>" class="dropdown-item"><?php echo $value["namakategori"] ?></a>
                <?php endforeach ?>
              </div>
            </li>
            <?php
            if (isset($_SESSION["pengguna"])) { ?>
              <?php
                $id = $_SESSION["pengguna"]['id'];
                $ambil = $koneksi->query("SELECT *FROM pengguna WHERE id='$id'");
                $pecah = $ambil->fetch_assoc(); ?>
              <li class="nav-item active dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Akun </a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="akun.php">Profil Akun</a>
                  <a class="dropdown-item" href="riwayat.php">Riwayat Pembelian</a>
                  <a class="dropdown-item" href="keranjang.php">Keranjang</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
            <?php } else { ?>
              <li class="nav-item active"><a href="daftar.php" class="nav-link">Daftar</a></li>
              <li class="nav-item active"><a href="login.php" class="nav-link">Login</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>