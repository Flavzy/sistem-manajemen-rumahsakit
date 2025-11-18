<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

$perawat = mysqli_query($connect, "SELECT * FROM tbl_perawat");
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
    background-image: url('../assets/images/bg4.jpg');
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
    <h2>Data Perawat</h2>
    <a class="add-btn" href="tambah_perawat.php">+ Tambah Perawat</a>
</div>

<div class="table-container perawat-theme">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Shift</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($perawat)): ?>
      <tr>
        <td><?= $row['id_perawat'] ?></td>
        <td><?= $row['nama_perawat'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['no_hp'] ?></td>
        <td><?= $row['shift'] ?></td>
        <td>
          <a href="edit_perawat.php?id=<?= $row['id_perawat'] ?>" class="btn btn-edit">Edit</a>
          <a href="hapus_perawat.php?id=<?= $row['id_perawat'] ?>" class="btn btn-delete" onclick="return confirm('Hapus perawat ini?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include "../koneksi/footer.php"; ?>
