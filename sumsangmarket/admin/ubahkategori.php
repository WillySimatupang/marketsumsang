<?php
$ambil = $koneksi->query("SELECT * FROM kategori WHERE idkategori='$_GET[id]'");
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
						<label>Nama Kategori</label>
						<input type="text" class="form-control" name="kategori" value=" <?php echo $pecah['namakategori']; ?>">
					</div>
					<button class="btn btn-primary" name="ubah">Simpan</button>
				</form>

			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST['ubah'])) {
	$koneksi->query("UPDATE kategori SET namakategori='$_POST[kategori]' WHERE idkategori='$_GET[id]'");
	echo "<script>alert('Kategori Berhasil Di Ubah');</script>";
	echo "<script> location ='index.php?halaman=kategori';</script>";
}
?>