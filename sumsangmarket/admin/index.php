<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include '../koneksi.php';

if (!isset($_SESSION['admin']) && !isset($_SESSION['pemilik'])) {
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
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
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Jaya Ponsel</title>
        <link href="css/css/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="css/css//sb-admin-2.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
        <link href="css/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <script src="assets/ckeditor/ckeditor.js"></script>
        <link rel="icon" type="image/x-icon" href="../foto/logo.png">
    </head>


    <?php
    if ($_SESSION['admin']['level'] == 'Admin') {
        $bg = "bg-success";
    } elseif ($_SESSION['admin']['level'] == 'Pemilik') {
        $bg = "bg-danger";
    }
    ?>

    <body id="page-top">
        <div id="wrapper">
            <ul class="navbar-nav <?= $bg ?> sidebar sidebar-dark accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?halaman=beranda">

                    <div class="sidebar-brand-text mx-3"><img style="" width="60%" src="../foto/logo.png"></div>
                </a>
                <hr class="sidebar-divider">
                <?php
                if ($_SESSION['admin']['level'] == 'Admin') {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=beranda">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=kategori">
                            <i class="fas fa-fw fa-list"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=produk">
                            <i class="fas fa-fw fa-pen"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=pembelian">
                            <i class="fas fa-fw fa-home"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=pembayaranrekening">
                            <i class="fas fa-fw fa-home"></i>
                            <span>Pembayaran Rekening</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=laporan">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=pengguna">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Data Member</span>
                        </a>
                    </li>
                <?php
                } elseif ($_SESSION['admin']['level'] == 'Pemilik') {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=beranda">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=kategori">
                            <i class="fas fa-fw fa-list"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=produk">
                            <i class="fas fa-fw fa-pen"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=pembelian">
                            <i class="fas fa-fw fa-home"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=laporan">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?halaman=pengguna">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Data Member</span>
                        </a>
                    </li>
                <?php
                }
                ?>

            </ul>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <a onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?');" class="nav-link" href="index.php?halaman=logout">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"> Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="container-fluid">
                        <div id="page-inner">
                            <?php
                            if (isset($_GET['halaman'])) {
                                if ($_GET['halaman'] == "produk") {
                                    include 'produk.php';
                                } elseif ($_GET['halaman'] == "pembelian") {
                                    include 'pembelian.php';
                                } elseif ($_GET['halaman'] == "pengguna") {
                                    include 'pengguna.php';
                                } elseif ($_GET['halaman'] == "detail") {
                                    include 'detail.php';
                                } elseif ($_GET['halaman'] == "tambahproduk") {
                                    include 'tambahproduk.php';
                                } elseif ($_GET['halaman'] == "hapusproduk") {
                                    include 'hapusproduk.php';
                                } elseif ($_GET['halaman'] == "ubahproduk") {
                                    include 'ubahproduk.php';
                                } elseif ($_GET['halaman'] == "logout") {
                                    include 'logout.php';
                                } elseif ($_GET['halaman'] == "pembayaran") {
                                    include 'pembayaran.php';
                                } elseif ($_GET['halaman'] == "kategori") {
                                    include 'kategori.php';
                                } elseif ($_GET['halaman'] == "ubahkategori") {
                                    include 'ubahkategori.php';
                                } elseif ($_GET['halaman'] == "detailproduk") {
                                    include 'detailproduk.php';
                                } elseif ($_GET['halaman'] == "hapusfotoproduk") {
                                    include 'hapusfotoproduk.php';
                                } elseif ($_GET['halaman'] == "tambahkategori") {
                                    include 'tambahkategori.php';
                                } elseif ($_GET['halaman'] == "hapuskategori") {
                                    include 'hapuskategori.php';
                                } elseif ($_GET['halaman'] == "hapuspengguna") {
                                    include 'hapuspengguna.php';
                                } elseif ($_GET['halaman'] == "beranda") {
                                    include 'beranda.php';
                                } elseif ($_GET['halaman'] == "laporan") {
                                    include 'laporan.php';
                                } elseif ($_GET['halaman'] == "pembayaranrekening") {
                                    include 'pembayaranrekening.php';
                                } elseif ($_GET['halaman'] == "tambahpembayaranrekening") {
                                    include 'tambahpembayaranrekening.php';
                                } elseif ($_GET['halaman'] == "editpembayaranrekening") {
                                    include 'editpembayaranrekening.php';
                                } elseif ($_GET['halaman'] == "hapuspembayaranrekening") {
                                    include 'hapuspembayaranrekening.php';
                                }
                            } else {
                                include 'beranda.php';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <script src="assets/js/jquery-1.10.2.js"></script>
                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/jquery.metisMenu.js"></script>
                <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
                <script src="assets/js/morris/morris.js"></script>
                <script src="css/js/sb-admin-2.min.js"></script>
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/js/bootstrap.bundle.min.js"></script>
                <script src="assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
                <script src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
                <script src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
                <script src="assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
                <script src="assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
                <script src="assets/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
                <script src="assets/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
                <script src="assets/DataTables/Buttons-1.5.6/js/buttons.colvis.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var table = $('#table').DataTable({
                            buttons: ['csv', 'print', 'excel', 'pdf'],
                            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                                "<'row'<'col-md-12'tr>>" +
                                "<'row'<'col-md-5'i><'col-md-7'p>>",
                            lengthMenu: [
                                [5, 10, 25, 50, 100, -1],
                                [5, 10, 25, 50, 100, "ALL"]
                            ]
                        });

                        table.buttons().container()
                            .appendTo('#table_wrapper .col-md-5:eq(0)');
                    });
                </script>
    </body>

    </html>