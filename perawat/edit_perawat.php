<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

if (!isset($_GET['id'])) {
  echo "<p>ID perawat tidak ditemukan.</p>";
  include "../koneksi/footer.php";
  exit;
}

$id = $_GET['id'];
$data = mysqli_query($connect, "SELECT * FROM tbl_perawat WHERE id_perawat='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
  echo "<p>Data tidak ditemukan.</p>";
  include "../koneksi/footer.php";
  exit;
}

if (isset($_POST['update'])) {
  $nama = $_POST['nama_perawat'];
  $no_hp = $_POST['no_hp'];
  $email = $_POST['email'];
  $shift = $_POST['shift'];

  $query = "UPDATE tbl_perawat SET 
              nama_perawat='$nama', 
              no_hp='$no_hp', 
              email='$email', 
              shift='$shift'
            WHERE id_perawat='$id'";

  if (mysqli_query($connect, $query)) {
    echo "<div class='toast success'>✅ Data perawat berhasil diperbarui!</div>";
    echo "<meta http-equiv='refresh' content='1.2;url=perawat.php'>";
  } else {
    echo "<div class='toast error'>❌ Gagal memperbarui data!</div>";
  }
}
?>

<div class="form-card">
  <h2>✏️ Edit Data Perawat</h2>
  <form method="POST">
    <label>Nama Perawat</label>
    <input type="text" name="nama_perawat" value="<?= $row['nama_perawat'] ?>" required>

    <label>No HP</label>
    <input type="text" name="no_hp" value="<?= $row['no_hp'] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $row['email'] ?>" required>

    <label>Shift</label>
    <select name="shift" required>
      <option value="Pagi" <?= $row['shift']=='Pagi'?'selected':'' ?>>Pagi</option>
      <option value="Siang" <?= $row['shift']=='Siang'?'selected':'' ?>>Siang</option>
      <option value="Malam" <?= $row['shift']=='Malam'?'selected':'' ?>>Malam</option>
    </select>

    <button type="submit" name="update" class="btn-primary">💾 Simpan</button>
    <a href="perawat.php" class="btn-secondary">⬅ Kembali</a>
  </form>
</div>

<?php include "../koneksi/footer.php"; ?>
