<?php
if (isset($_POST['submit'])) {
	$tanggalawal = $_POST['tanggalawal'];
	$tanggalakhir = $_POST['tanggalakhir'];
} else {
	$hariini = date('Y-m-d');
	$tanggalawal = date('Y-m-01', strtotime($hariini));
	$tanggalakhir = date('Y-m-t', strtotime($hariini));
}
?>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="row mt-3 mb-3">
						<div class="col-md-3">
							<div class="form-group mb-3">
								<label class="mb-2">Tanggal Awal</label>
								<input type="date" class="form-control" name="tanggalawal" value="<?= $tanggalawal ?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-3">
								<label class="mb-2">Tanggal Akhir</label>
								<input type="date" class="form-control" name="tanggalakhir" value="<?= $tanggalakhir ?>" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-3">
								<button type="submit" name="submit" value="submit" class="btn btn-primary text-white" style="margin-top:30px">Cari</button>
								<a target="_blank" href="laporancetak.php?tanggalawal=<?= $tanggalawal ?>&tanggalakhir=<?= $tanggalakhir ?>" class="btn btn-success text-white" style="margin-top:30px">Cetak</a>
							</div>
						</div>
					</div>
				</form>
				<table class="table table-bordered" id="table">
					<thead class="bg-primary text-white">
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>No. Telepon</th>
							<th>Daftar</th>
							<th>Tanggal Pembelian</th>
							<th>Total Pembelian</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1;
						if (isset($_POST['submit'])) {
							$tanggalawal = $_POST['tanggalawal'];
							$tanggalakhir = $_POST['tanggalakhir'];
							$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pengguna ON pembelian.id=pengguna.id and waktu >= '$tanggalawal' and tanggalbeli <= '$tanggalakhir' order by idpembelian desc");
						} else {
							$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pengguna ON pembelian.id=pengguna.id and waktu >= '$tanggalawal' and tanggalbeli <= '$tanggalakhir' order by idpembelian desc");
						}
						while ($pecah = $ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama'] ?></td>
								<td><?php echo $pecah['telepon'] ?></td>
								<td>
									<ul>
										<?php $ambilproduk = $koneksi->query("SELECT * FROM pembelianproduk join produk on pembelianproduk.idproduk = produk.idproduk where idpembelian='$pecah[idpembelian]'");
											while ($produk = $ambilproduk->fetch_assoc()) { ?>
											<li>
												<?= $produk['namaproduk'] ?>
											</li>
										<?php } ?>
									</ul>
								</td>
								<td><?= tanggal(date('Y-m-d', strtotime($pecah['tanggalbeli']))) ?></td>
								<td>Rp. <?php echo number_format($pecah['totalbeli']) ?></td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>