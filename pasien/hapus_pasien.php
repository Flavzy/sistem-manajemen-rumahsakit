<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";

$id = $_GET['id'];
$hapus = mysqli_query($connect, "DELETE FROM tbl_pasien WHERE id_pasien='$id'");

if ($hapus) {
    echo "<script>alert('Data pasien berhasil dihapus!'); window.location='pasien.php';</script>";
} else {
    echo "Gagal menghapus data pasien: " . mysqli_error($connect);
}
?>
