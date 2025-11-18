<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

if (!isset($_GET['id'])) {
  echo "<p>ID dokter tidak ditemukan.</p>";
  include "../koneksi/footer.php";
  exit;
}

$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM tbl_dokter WHERE id_dokter = $id");
$dokter = mysqli_fetch_assoc($result);

if (!$dokter) {
  echo "<p>Data dokter tidak ditemukan.</p>";
  include "../koneksi/footer.php";
  exit;
}

if (isset($_POST['submit'])) {
  $nama = $_POST['nama_dokter'];
  $spesialis = $_POST['spesialis'];
  $no_hp = $_POST['no_hp'];
  $email = $_POST['email'];
  $status = $_POST['status'];

  $sql = "UPDATE tbl_dokter 
          SET nama_dokter='$nama',
              spesialis='$spesialis',
              no_hp='$no_hp',
              email='$email',
              status='$status'
          WHERE id_dokter=$id";

  if (mysqli_query($connect, $sql)) {
    echo "<div class='toast success'>✅ Data dokter berhasil diperbarui!</div>";
    echo "<meta http-equiv='refresh' content='1.2;url=dokter.php'>";
  } else {
    echo "<div class='toast error'>❌ Gagal memperbarui data!</div>";
  }
}
?>

<div class="form-card">
  <h2>✏️ Edit Data Dokter</h2>
  <form method="POST">
    <label>Nama Dokter</label>
    <input type="text" name="nama_dokter" value="<?= htmlspecialchars($dokter['nama_dokter']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($dokter['email']) ?>" required>

    <label>Spesialis</label>
    <input type="text" name="spesialis" value="<?= htmlspecialchars($dokter['spesialis']) ?>" required>

    <label>No HP</label>
    <input type="text" name="no_hp" value="<?= htmlspecialchars($dokter['no_hp']) ?>" required>

    <label>Status</label>
    <select name="status" required>
      <option value="Aktif" <?= ($dokter['status'] == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
      <option value="Tidak Aktif" <?= ($dokter['status'] == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
    </select>

    <button type="submit" name="submit" class="btn-primary">💾 Simpan</button>
    <a href="dokter.php" class="btn-secondary">⬅ Kembali</a>
  </form>
</div>

<?php include "../koneksi/footer.php"; ?>
