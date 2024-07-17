<?php
$kategori = $koneksi->query("SELECT * FROM kategori");
$jumlahkategori = $kategori->num_rows;

$produk = $koneksi->query("SELECT * FROM produk");
$jumlahproduk = $produk->num_rows;

$member = $koneksi->query("SELECT * FROM pengguna where level = 'Pelanggan'");
$jumlahmember = $member->num_rows;

$pembelian = $koneksi->query("SELECT * FROM pembelian");
$jumlahpembelian = $pembelian->num_rows;

$tahunini = date('Y');
$bulanini = date('m');

$bulan = 1;
$penjualangrafik = array();
$pembeliangrafik = array();
while ($bulan <= 13) {
    // penjualan
    $penjualan = $koneksi->query("SELECT * FROM pembelian where month(tanggalbeli) = '$bulan' and year(tanggalbeli) = '$tahunini' and statusbeli != 'Menunggu Konfirmasi Admin' and statusbeli != 'Belum Bayar' and statusbeli != 'Pesanan Di Tolak'");
    $totalpenjualan = 0;
    while ($jumlahpenjualan = $penjualan->fetch_assoc()) {
        $totalpenjualan += $jumlahpenjualan['totalbeli'];
    }
    $penjualangrafik[] = $totalpenjualan;
    $bulan++;
}
?>
<br>
<div class="row mb-3">
    <div class="col-md-12">
        <center>
            <img src="../foto/bgdepan.png" width="400px" style="border-radius: 10px">
        </center>
    </div>
</div>
<br>
<div class="row">
    <?php
    if ($_SESSION['admin']['level'] == "Admin") { ?>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlahkategori ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="index.php?halaman=kategori" class="btn btn-primary mt-3 btn-sm">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahproduk ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="index.php?halaman=produk" class="btn btn-primary mt-3 btn-sm">Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Jumlah Member</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahmember ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="index.php?halaman=pengguna" class="btn btn-primary mt-3 btn-sm">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Jumlah Transaksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahpembelian ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="index.php?halaman=pembelian" class="btn btn-primary mt-3 btn-sm">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
</div>