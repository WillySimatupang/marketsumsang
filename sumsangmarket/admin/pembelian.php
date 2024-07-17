<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Data Pembelian</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="table">
					<thead class="bg-primary text-white">
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Daftar</th>
							<th>Tanggal Pembelian</th>
							<th>Total Pembelian</th>
							<th>Status Belanja</th>
							<?php
							if ($_SESSION['admin']['level'] == 'Admin') {
								?>
								<th>Aksi</th>
							<?php
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pengguna ON pembelian. id=pengguna.id order by pembelian.tanggalbeli desc, pembelian.idpembelian desc"); ?>
						<?php while ($pecah = $ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama'] ?></td>
								<td>
									<ul>
										<?php $ambilproduk = $koneksi->query("SELECT * FROM pembelianproduk join produk on pembelianproduk.idproduk = produk.idproduk where idpembelian='$pecah[idpembelian]'");
											while ($produk = $ambilproduk->fetch_assoc()) { ?>
											<li>
												<?= $produk['namaproduk'] ?> x <?= $produk['jumlah'] ?>
											</li>
										<?php } ?>
									</ul>
								</td>
								<td><?= tanggal(date('Y-m-d', strtotime($pecah['tanggalbeli']))) ?></td>
								<td>Rp. <?php echo number_format($pecah['totalbeli'] + $pecah['ongkir']) ?></td>
								<td><?php echo $pecah['statusbeli'] ?></td>
								<?php
									if ($_SESSION['admin']['level'] == 'Admin') {
										?>
									<td>
										<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['idpembelian'] ?>" class="btn btn-info">Detail</a>
									</td>
								<?php
									}
									?>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>