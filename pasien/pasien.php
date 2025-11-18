<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

$cari = "";
if (isset($_GET['search'])) {
    $cari = mysqli_real_escape_string($connect, $_GET['search']);
    $query = "SELECT p.*, d.nama_dokter, d.spesialis 
              FROM tbl_pasien p 
              LEFT JOIN tbl_dokter d ON p.id_dokter = d.id_dokter 
              WHERE 
                p.id_pasien LIKE '%$cari%' OR 
                p.nama_pasien LIKE '%$cari%' OR 
                p.penyakit_dialami LIKE '%$cari%' OR 
                p.email LIKE '%$cari%' OR 
                p.alamat LIKE '%$cari%' OR
                d.nama_dokter LIKE '%$cari%'";
} else {
    $query = "SELECT p.*, d.nama_dokter, d.spesialis 
              FROM tbl_pasien p 
              LEFT JOIN tbl_dokter d ON p.id_dokter = d.id_dokter";
}
$pasien = mysqli_query($connect, $query);
?>

<style>
.card-header {
    font-size: 22px;
    font-weight: 700;
    background: #0d6efd;
    color: white;
    padding: 15px;
    border-radius: 8px 8px 0 0;
}

.container-box {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    background-image: url('../assets/images/bg3.jpg');
    background-color: rgba(0, 0, 0, 0.4);
    background-blend-mode: darken;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #fff;
    margin-bottom: 25px;
}

.search-box {
    margin-bottom: 10px;
}

.search-box input {
    width: 250px;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-right: 6px;
}

.search-box button {
    padding: 8px 12px;
    border: none;
    background: #0d6efd;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}
.search-box button:hover {
    background: #0b5ed7;
}

.add-btn {
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    background: #198754;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    transition: 0.3s;
}
.add-btn:hover {
    background: #157347;
}
</style>

<div class="container-box">
    <h2>Data Pasien</h2>

    <!-- 🔍 Form pencarian -->
    <form class="search-box" method="GET" action="pasien.php">
        <input type="text" name="search" placeholder="Cari pasien atau dokter..." value="<?= htmlspecialchars($cari) ?>">
        <button type="submit">🔍 Cari</button>
    </form>

    <a class="add-btn" href="tambah_pasien.php">+ Tambah Pasien</a>
</div>

<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Pasien</th>
        <th>Umur</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Riwayat Penyakit</th>
        <th>Penyakit Dialami</th>
        <th>Dokter Penanggung Jawab</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($pasien) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($pasien)): ?>
        <tr>
          <td><?= $row['id_pasien'] ?></td>
          <td><?= htmlspecialchars($row['nama_pasien']) ?></td>
          <td><?= $row['umur'] ?> tahun</td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['alamat']) ?></td>
          <td><?= htmlspecialchars($row['riwayat_penyakit'] ?: '-') ?></td>
          <td><?= htmlspecialchars($row['penyakit_dialami'] ?: '-') ?></td>
          <td>
            <?php if (!empty($row['nama_dokter'])): ?>
              <div class="doctor-info">
                <div class="doctor-name">Dr. <?= htmlspecialchars($row['nama_dokter']) ?></div>
                <div class="doctor-specialty"><?= htmlspecialchars($row['spesialis']) ?></div>
              </div>
            <?php else: ?>
              <span class="no-doctor">Belum ditugaskan</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="edit_pasien.php?id=<?= $row['id_pasien'] ?>" class="btn btn-edit">✏️ Edit</a>
            <a href="hapus_pasien.php?id=<?= $row['id_pasien'] ?>" class="btn btn-delete" onclick="return confirm('Hapus pasien ini?')">🗑️ Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" style="text-align:center; padding: 20px;">
            <p style="color: #6c757d; font-size: 16px;">
              <?= $cari ? 'Tidak ada data ditemukan untuk "' . htmlspecialchars($cari) . '"' : 'Tidak ada data pasien.' ?>
            </p>
            <?php if (!$cari): ?>
              <a href="tambah_pasien.php" class="btn" style="background: #198754; color: white; margin-top: 10px;">+ Tambah Pasien Pertama</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include "../koneksi/footer.php"; ?>