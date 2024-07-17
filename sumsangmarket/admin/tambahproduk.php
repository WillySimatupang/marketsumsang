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
				<h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
			</div>
			<div class="card-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama">
					</div>
					<div class="form-group">
						<label>Nama Kategori</label>
						<select class="form-control" name="idkategori">
							<option value="">Pilih Kategori</option>
							<?php foreach ($datakategori as $key => $value) : ?>

								<option value="<?php echo $value["idkategori"] ?>"><?php echo $value["namakategori"] ?></option>

							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Harga (Rp)</label>
						<input type="number" class="form-control" name="harga">
					</div>
					<div class="form-group">
						<label>Berat (*KG)</label>
						<input type="number" class="form-control" name="berat">
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"></textarea>
						<script>
							CKEDITOR.replace('deskripsi');
						</script>
					</div>
					<div class="form-group">
						<label>Foto</label>
						<div class="letak-input" style="margin-bottom: 10px;">
							<input type="file" class="form-control" name="foto">
						</div>
					</div>
					<div class="form-group">
						<label>Stok Produk</label>
						<input type="number" class="form-control" name="stok">
					</div>
					<button class="btn btn-primary" name="save"><i class="glyphicon glyphicon-saved"></i>Simpan</a></button>

				</form>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST['save'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasifoto, "../foto/" . $namafoto);
	$koneksi->query("INSERT INTO produk
		(namaproduk,idkategori, hargaproduk,beratproduk,fotoproduk,deskripsiproduk, stokproduk)
		VALUES('$_POST[nama]','$_POST[idkategori]','$_POST[harga]','$_POST[berat]','$namafoto','$_POST[deskripsi]','$_POST[stok]')");
	$idproduk_barusan = $koneksi->insert_id;
	echo "<script>alert('Produk Berhasil Di Simpan');</script>";
	echo "<script> location ='index.php?halaman=produk';</script>";
}
?>