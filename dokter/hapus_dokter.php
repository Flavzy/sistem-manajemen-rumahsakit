<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";

if (!isset($_GET['id'])) {
    die("ID dokter tidak ditemukan.");
}

$id = $_GET['id'];

// Hapus dokter berdasarkan ID
$sql = "DELETE FROM tbl_dokter WHERE id_dokter = $id";

if (mysqli_query($connect, $sql)) {
    header("Location: dokter.php");
    exit;
} else {
    echo "Gagal menghapus data dokter: " . mysqli_error($connect);
}
?>
