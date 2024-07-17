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
				<p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span><span>Riwayat Pembelian <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">Riwayat Pembelian</h2>
			</div>
		</div>
	</div>
</section>
<br><br>
<section id="home-section" class="hero">
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="bg-primary text-white">
							<tr class="text-center">
								<th width="10px">No</th>
								<th width="30%x">Daftar</th>
								<th>Tanggal</th>
								<th>Total</th>
								<th>Opsi</th>
								<th>Bukti Pembayaran</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1;
							$id = $_SESSION["pengguna"]['id'];
							$ambil = $koneksi->query("SELECT *, pembelian.idpembelian as idpembelianreal FROM pembelian left join pembayaran on pembelian.idpembelian = pembayaran.idpembelian WHERE pembelian.id='$id' order by pembelian.tanggalbeli desc, pembelian.idpembelian desc");
							while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td>
										<ul>
											<?php $ambilproduk = $koneksi->query("SELECT * FROM pembelianproduk join produk on pembelianproduk.idproduk = produk.idproduk where idpembelian='$pecah[idpembelianreal]'");
												while ($produk = $ambilproduk->fetch_assoc()) { ?>
												<li>
													<?= $produk['namaproduk'] ?> x <?= $produk['jumlah'] ?>
												</li>
											<?php } ?>
										</ul>
									</td>
									<td><?php echo tanggal($pecah['tanggalbeli']) . '<br>Jam ' . date('H:i', strtotime($pecah['waktu'])) ?></td>
									<td>Rp. <?php echo number_format($pecah["totalbeli"] + $pecah["ongkir"]); ?></td>
									<!-- <td>
										<?php if ($pecah['statusbeli'] == "Belum Bayar") {
												$deadline = date('Y-m-d H:i', strtotime($pecah['waktu'] . ' +1 day'));
												$harideadline = date('Y-m-d', strtotime($pecah['waktu'] . ' +1 day'));
												$jamdeadline = date('H:i', strtotime($pecah['waktu'] . ' +1 day'));
												if (date('Y-m-d H:i') >= $deadline) {
													echo 'Waktu pembayaran<br>telah habis';
												} else { ?>
												<a href="pembayaran.php?id=<?php echo $pecah["idpembelianreal"] ?>" class="btn btn-danger">Upload Bukti<br>Pembayaran Sebelum<br><?= tanggal($harideadline) . ' - Jam ' . $jamdeadline ?></a>
											<?php }
												} elseif ($pecah['statusbeli'] == "Sudah Upload Bukti Pembayaran") { ?>
											<a class="btn btn-danger text-white">Menunggu Konfirmasi Admin</a>
										<?php } elseif ($pecah['statusbeli'] == "Barang Di Kirim") { ?>
											<a class="btn btn-danger text-white">Barang Anda Sedang Di Kirim, Mohon Di Tungggu</a>
											<br><br>
											<p><a target="_blank" href="https://cekresi.com">No Resi : <?= $pecah['resipengiriman'] ?></a></p>
										<?php } elseif ($pecah['statusbeli'] == "Barang Telah Sampai ke Pemesan") { ?>
											<a data-toggle="modal" data-target="#selesai<?= $nomor ?>" class="btn btn-success text-white">Konfirmasi Selesai</a>
										<?php } elseif ($pecah['statusbeli'] == "Selesai") { ?>
											Selesai
										<?php } elseif ($pecah['statusbeli'] == "Pesanan Di Tolak") { ?>
											<a class="btn btn-danger text-white">Pesanan Anda Di Tolak</a>
										<?php } ?>
									</td> -->
									<td>
										<?php if ($pecah['statusbeli'] == "Belum Bayar") {
												$deadline = date('Y-m-d H:i', strtotime($pecah['waktu'] . ' +1 day'));
												$harideadline = date('Y-m-d', strtotime($pecah['waktu'] . ' +1 day'));
												$jamdeadline = date('H:i', strtotime($pecah['waktu'] . ' +1 day'));
												if (date('Y-m-d H:i') >= $deadline) {
													echo 'Waktu pembayaran<br>telah habis';
												} else { ?>
												<a href="pembayaran.php?id=<?php echo $pecah["idpembelianreal"] ?>" class="btn btn-success">Silahkan Upload<br>Pembayaran Sebelum<br><?= tanggal($harideadline) . ' - Pukul ' . $jamdeadline . ' W.I.B' ?></a>
											<?php }
												} elseif ($pecah['statusbeli'] == "Sudah Upload Bukti Pembayaran") { ?>
											<a class="btn btn-primary text-white">Menunggu Konfirmasi Admin</a>
										<?php } elseif ($pecah['statusbeli'] == "Barang Di Kemas") { ?>
											<a class="btn btn-primary text-white">Barang Anda Sedang Di Kemas, Mohon Di Tungggu</a>
										<?php } elseif ($pecah['statusbeli'] == "Barang Di Kirim") { ?>
											<a class="btn btn-primary text-white">Barang Anda Sedang Di Kirim, Mohon Di Tungggu</a>
											<br><br>
											<p><a target="_blank" href="https://cekresi.com">No Resi : <?= $pecah['resipengiriman'] ?></a></p>
										<?php } elseif ($pecah['statusbeli'] == "Barang Telah Sampai ke Pemesan") { ?>
											<a data-toggle="modal" data-target="#selesai<?= $nomor ?>" class="btn btn-success text-white">Konfirmasi Selesai</a>
										<?php } elseif ($pecah['statusbeli'] == "Selesai") { ?>
											<a href="ulasan.php?id=<?= $pecah["idpembelian"] ?>" class="btn btn-success text-white">Berikan Ulasan</a>
										<?php } elseif ($pecah['statusbeli'] == "Pesanan Di Tolak") { ?>
											<a class="btn btn-danger text-white">Pesanan Anda Di Tolak</a>
										<?php } ?>
										<br>
										<br>
									</td>
									<td><img width="100px" src="foto/<?= $pecah['bukti'] ?>" alt=""></td>
								</tr>
								<?php $nomor++; ?>
							<?php  } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$no = 1;
$id = $_SESSION["pengguna"]['id'];
$ambil = $koneksi->query("SELECT *, pembelian.idpembelian as idpembelianreal FROM pembelian left join pembayaran on pembelian.idpembelian = pembayaran.idpembelian WHERE pembelian.id='$id' order by pembelian.tanggalbeli desc, pembelian.idpembelian desc");
while ($pecah = $ambil->fetch_assoc()) { ?>
	<div class="modal fade" id="selesai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan Selesai</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post">
					<div class="modal-body">
						<h5>Apakah anda yakin ingin mengkonfirmasi pesanan telah selesai ?</h5>
					</div>
					<div class="modal-footer">
						<input type="hidden" class="form-contol" value="<?= $pecah['idpembelian'] ?>" name="idpembelian">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" name="selesai" value="selesai" class="btn btn-primary">Konfirmasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
	$no++;
} ?>
<?php
if (isset($_POST["selesai"])) {
	$koneksi->query("UPDATE pembelian SET statusbeli='Selesai'
		WHERE idpembelian='$_POST[idpembelian]'");
	echo "<script>alert('Pesanan berhasil di konfirmasi selesai')</script>";
	echo "<script>location='riwayat.php';</script>";
}
?>
<div style="padding-top:250px"></div>
<?php
include 'footer.php';
?>