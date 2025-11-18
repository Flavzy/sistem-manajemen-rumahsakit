<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

$dokter = mysqli_query($connect, "SELECT * FROM tbl_dokter");
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
    background-image: url('../assets/images/bg2.jpg');
    background-color: rgba(0, 0, 0, 0.4);
    background-blend-mode: darken;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #fff;
    margin-bottom: 25px;
}

.search-box input {
    width: 250px;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.search-box button {
    padding: 8px 12px;
    border: none;
    background: #0d6efd;
    color: white;
    border-radius: 6px;
    cursor: pointer;
}
.add-btn {
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    background: #198754;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
}
.add-btn:hover {
    background: #157347;
}
</style>

<div class="container-box">
    <h2>Data Dokter</h2>
    <a class="add-btn" href="tambah_dokter.php">+ Tambah Dokter</a>
</div>

<div class="table-container dokter-theme">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Spesialis</th>
        <th>No HP</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($dokter)): ?>
      <tr>
        <td><?= $row['id_dokter'] ?></td>
        <td><?= $row['nama_dokter'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['spesialis'] ?></td>
        <td><?= $row['no_hp'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
          <a href="edit_dokter.php?id=<?= $row['id_dokter'] ?>" class="btn btn-edit">Edit</a>
          <a href="hapus_dokter.php?id=<?= $row['id_dokter'] ?>" class="btn btn-delete" onclick="return confirm('Hapus dokter ini?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include "../koneksi/footer.php"; ?>
