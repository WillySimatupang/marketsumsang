
<?php
$koneksi->query("DELETE FROM pembayaranrekening WHERE idpembayaranrekening='$_GET[id]'");

echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=pembayaranrekening';</script>";

?>