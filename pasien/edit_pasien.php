<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

if (!isset($_GET['id'])) {
  echo "ID pasien tidak ditemukan";
  include "../koneksi/footer.php";
  exit;
}

$id = (int)$_GET['id'];
$data = mysqli_query($connect, "SELECT * FROM tbl_pasien WHERE id_pasien='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
  echo "Data tidak ditemukan";
  include "../koneksi/footer.php";
  exit;
}

if (isset($_POST['update'])) {
  $nama = $_POST['nama_pasien'];
  $umur = $_POST['umur'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $riwayat = $_POST['riwayat_penyakit'];
  $penyakit = $_POST['penyakit_dialami'];
  $id_dokter = $_POST['id_dokter'];

  $update = "UPDATE tbl_pasien SET 
      nama_pasien='$nama', 
      umur='$umur', 
      alamat='$alamat', 
      email='$email', 
      riwayat_penyakit='$riwayat', 
      penyakit_dialami='$penyakit', 
      id_dokter='$id_dokter'
      WHERE id_pasien='$id'";

  if (mysqli_query($connect, $update)) {
    echo "<div class='toast success'>✅ Data pasien berhasil diperbarui!</div>";
    echo "<meta http-equiv='refresh' content='1.2;url=pasien.php'>";
  } else {
    echo "<div class='toast error'>❌ Gagal memperbarui data!</div>";
  }
}
?>

<div class="form-card">
  <h2>✏️ Edit Data Pasien</h2>
  <form method="POST">
    <label>Nama Pasien</label>
    <input type="text" name="nama_pasien" value="<?= $row['nama_pasien'] ?>" required>

    <label>Umur</label>
    <input type="number" name="umur" value="<?= $row['umur'] ?>" required>

    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= $row['alamat'] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $row['email'] ?>" required>

    <label>Riwayat Penyakit</label>
    <input type="text" name="riwayat_penyakit" value="<?= $row['riwayat_penyakit'] ?>">

    <label>Penyakit Dialami</label>
    <input type="text" name="penyakit_dialami" value="<?= $row['penyakit_dialami'] ?>">

    <label>ID Dokter</label>
    <input type="number" name="id_dokter" value="<?= $row['id_dokter'] ?>">

    <button type="submit" name="update" class="btn-primary">💾 Simpan</button>
    <a href="pasien.php" class="btn-secondary">⬅ Kembali</a>
  </form>
</div>

<?php include "../koneksi/footer.php"; ?>
