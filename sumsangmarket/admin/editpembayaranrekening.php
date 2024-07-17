<?php
$ambil = $koneksi->query("SELECT * FROM pembayaranrekening WHERE idpembayaranrekening='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Ubah Kategori</h6>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="form-group">
						<label>Nama Pembayaran</label>
						<input type="text" class="form-control" name="namapembayaran" value=" <?php echo $pecah['namapembayaran']; ?>">
					</div>
					<div class="form-group">
						<label>No Rekening</label>
						<input type="text" class="form-control" name="norek" value=" <?php echo $pecah['norek']; ?>">
					</div>
					<div class="form-group">
						<label>Atas Nama</label>
						<input type="text" class="form-control" name="atasnama" value=" <?php echo $pecah['atasnama']; ?>">
					</div>
					<button class="btn btn-primary" name="ubah">Simpan</button>
				</form>

			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST['ubah'])) {
	$koneksi->query("UPDATE pembayaranrekening SET namapembayaran='$_POST[namapembayaran]',norek='$_POST[norek]',atasnama='$_POST[atasnama]' WHERE idpembayaranrekening='$_GET[id]'");
	echo "<script>alert('Kategori Berhasil Di Ubah');</script>";
	echo "<script> location ='index.php?halaman=pembayaranrekening';</script>";
}
?>