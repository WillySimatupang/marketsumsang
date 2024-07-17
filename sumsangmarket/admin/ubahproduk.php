<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE idproduk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Ubah Produk</h6>
			</div>
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" name="nama" class="form-control" value="<?php echo $pecah['namaproduk']; ?>">
					</div>

					<div class="form-group">
						<label>Nama Kategori</label>
						<select class="form-control" name="idkategori">
							<option value="">Pilih Kategori</option>
							<?php foreach ($datakategori as $key => $value) : ?>

								<option value="<?php echo $value["idkategori"] ?>" <?php if ($pecah["idkategori"] == $value["idkategori"]) {
																						echo "selected";
																					} ?>><?php echo $value["namakategori"] ?></option>

							<?php endforeach ?>
						</select>
					</div>

					<div class="form-group">
						<label>Harga Rp</label>
						<input type="number" name="harga" class="form-control" value="<?php echo $pecah['hargaproduk']; ?>">
					</div>
					<div class="form-group">
						<label>Berat (*KG)</label>
						<input type="number" name="berat" class="form-control" value="<?php echo $pecah['beratproduk']; ?>">
					</div>

					<div class="form-group">

						<img src="../foto/<?php echo $pecah['fotoproduk']; ?>" width="200">

					</div>

					<div class="form-group">
						<label> Ganti Foto</label>
						<input type="file" class="form-control" name="foto">
					</div>

					<div class="form-group">
						<label>Deskripsi</label>
						<textarea name="deskripsi" class="form-control" id="deskripsi" rows="10">
		 <?php echo $pecah['deskripsiproduk']; ?>
	 </textarea>
					</div>
					<div class="form-group">
						<label>Stok Produk</label>
						<input type="number" name="stok" class="form-control" value="<?php echo $pecah['stokproduk']; ?>">
					</div>
					<button class="btn btn-primary" name="ubah">Ubah</button>
					<script>
						CKEDITOR.replace('deskripsi');
					</script>
				</form>
			</div>
		</div>
	</div>
</div>


<?php
if (isset($_POST['ubah'])) {

	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];

	if (!empty($lokasifoto)) {
		move_uploaded_file($lokasifoto, "../foto/$namafoto");

		$koneksi->query("UPDATE produk SET namaproduk='$_POST[nama]',idkategori='$_POST[idkategori]',hargaproduk='$_POST[harga]',beratproduk='$_POST[berat]',fotoproduk='$namafoto', deskripsiproduk='$_POST[deskripsi]', stokproduk='$_POST[stok]' WHERE idproduk='$_GET[id]'");
	} else {
		$koneksi->query("UPDATE produk SET namaproduk='$_POST[nama]', idkategori='$_POST[idkategori]',hargaproduk='$_POST[harga]',beratproduk='$_POST[berat]', deskripsiproduk='$_POST[deskripsi]', stokproduk='$_POST[stok]' WHERE idproduk='$_GET[id]'");
	}
	echo "<script>alert('Data Produk Berhasil Diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
?>