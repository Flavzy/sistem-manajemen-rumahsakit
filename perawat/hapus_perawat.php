<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";

$id = $_GET['id'];
$hapus = mysqli_query($connect, "DELETE FROM tbl_perawat WHERE id_perawat='$id'");

if ($hapus) {
    echo "<script>alert('Data perawat berhasil dihapus!'); window.location='perawat.php';</script>";
} else {
    echo "Gagal menghapus data perawat: " . mysqli_error($connect);
}
?>
