<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_perawat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $shift = $_POST['shift'];

    $query = "INSERT INTO tbl_perawat (nama_perawat, no_hp, email, shift)
              VALUES ('$nama', '$no_hp', '$email', '$shift')";
    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Data perawat berhasil ditambahkan!'); window.location='perawat.php';</script>";
    } else {
        echo "Gagal: " . mysqli_error($connect);
    }
}
?>

<div class="container-form">
    <div class="form-card">
        <h2>➕ Tambah Data Perawat</h2>
        <form method="POST">
            <label>Nama Perawat</label>
            <input type="text" name="nama_perawat" required>

            <label>No HP</label>
            <input type="text" name="no_hp" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Shift</label>
            <select name="shift" required>
                <option value="Pagi">Pagi</option>
                <option value="Siang">Siang</option>
                <option value="Malam">Malam</option>
            </select>

            <button type="submit" name="submit" class="btn-submit">Simpan</button>
        </form>
    </div>
</div>

<?php include "../koneksi/footer.php"; ?>
