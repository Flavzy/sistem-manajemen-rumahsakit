<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tbl_dokter (nama_dokter, spesialis, no_hp, email, status)
            VALUES ('$nama', '$spesialis', '$no_hp', '$email', '$status')";
    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Data dokter berhasil ditambahkan!'); window.location='dokter.php';</script>";
    } else {
        echo mysqli_error($connect);
    }
}
?>


<div class="container-form">
    <div class="form-card">
        <h2>➕ Tambah Data Dokter</h2>
        <form method="POST">
            <label>Nama Dokter</label>
            <input type="text" name="nama_dokter" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Spesialis</label>
            <input type="text" name="spesialis" required>

            <label>No HP</label>
            <input type="text" name="no_hp" required>

            <label>Status</label>
            <select name="status" required>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>

            <button type="submit" name="submit" class="btn-submit">Simpan</button>
        </form>
    </div>
</div>

<?php include "../koneksi/footer.php"; ?>