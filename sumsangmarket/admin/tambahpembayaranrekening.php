<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Tambah Pembayaran Rekening</h6>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="form-group">
						<label>Nama Pembayaran</label>
						<input type="text" class="form-control" name="namapembayaran">
					</div>
					<div class="form-group">
						<label>No Rekening</label>
						<input type="text" class="form-control" name="norek">
					</div>
					<div class="form-group">
						<label>Atas Nama</label>
						<input type="text" class="form-control" name="atasnama">
					</div>
					<button class="btn btn-primary" name="tambah">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST['tambah'])) {
	$namapembayaran = $_POST["namapembayaran"];
	$norek = $_POST["norek"];
	$atasnama = $_POST["atasnama"];

	$koneksi->query("INSERT INTO pembayaranrekening(namapembayaran,norek,atasnama)
		VALUES ('$namapembayaran','$norek','$atasnama')");
	echo "<script> alert('Kategori Berhasil Di Tambah');</script>";
	echo "<script> location ='index.php?halaman=pembayaranrekening';</script>";
}
?>