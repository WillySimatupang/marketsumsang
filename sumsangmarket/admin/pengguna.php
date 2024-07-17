<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Data Member</h6>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="table">
					<thead class="bg-primary text-white">
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Telepon</th>
							<th>Alamat</th>
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
						<?php $ambil = $koneksi->query("SELECT * FROM pengguna where level = 'Pelanggan'"); ?>
						<?php while ($pecah = $ambil->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['nama'] ?></td>
								<td><?php echo $pecah['email'] ?></td>
								<td><?php echo $pecah['telepon'] ?></td>
								<td><?php echo $pecah['alamat'] ?></td>
								<?php
									if ($_SESSION['admin']['level'] == 'Admin') {
										?>
									<td>
										<a href="index.php?halaman=hapuspengguna&id=<?php echo $pecah['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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