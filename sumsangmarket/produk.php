<?php
session_start();
include 'koneksi.php';
?>

<?php
include 'header.php';
if (!empty($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
} else {
    $keyword = "";
}
?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('foto/bgutama.jpeg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate mb-5 text-center">
                <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span> <span>Produk <i class="fa fa-chevron-right"></i></span></p>
                <h2 class="mb-0 bread">Produk</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <form method="post">
                    <div class="row">
                        <div class="col-md-9  my-auto">
                            <div class="form-group">
                                <input type="text" name="keyword" value="<?= $keyword ?>" placeholder="Masukkan kata pencarian" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="cari" value="cari" class="btn btn-primary btn-block" style="padding:14px">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php $ambil = $koneksi->query("SELECT *FROM produk LEFT JOIN kategori ON produk.idkategori=kategori.idkategori WHERE namaproduk LIKE '%$keyword%' OR namaproduk LIKE '%$keyword%' OR hargaproduk LIKE '%$keyword%' OR namakategori LIKE '%$keyword%' order by idproduk desc"); ?>
            <?php while ($produk = $ambil->fetch_assoc()) { ?>
                <div class="col-md-4 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center" style="background-image: url(foto/<?php echo $produk['fotoproduk'] ?>);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="detail.php?id=<?php echo $produk['idproduk']; ?>" class="d-flex align-items-center justify-content-center"><span class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="category"><?= $produk['namakategori'] ?></span>
                            <h2><?php echo $produk['namaproduk'] ?></h2>
                            <p class="mb-0"><span class="price price-sale"></span> <span class="price">Rp <?php echo number_format($produk['hargaproduk']) ?></span></p>
                            <?php
                                $ambilulasan = mysqli_query($koneksi, "SELECT sum(bintang) as totalbintang FROM ulasan where ulasan.idproduk = '$produk[idproduk]'");
                                $dataulasan = $ambilulasan->fetch_assoc();
                                $ambilulasan = mysqli_query($koneksi, "SELECT * FROM ulasan where ulasan.idproduk = '$produk[idproduk]'");
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
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>