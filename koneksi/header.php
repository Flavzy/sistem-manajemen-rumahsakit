<?php
// Di header.php - tambahkan di bagian atas
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Manajemen Rumah Sakit</title>

  <link rel="stylesheet" href="/SistemManajemenRumahsakit/assets/css/style.css">


  <script src="/SistemManajemenRumahsakit/assets/js/script.js" defer></script>
</head>
<body>

<header>
  <div class="brand">
    <div class="logo">
      <img src="/SistemManajemenRumahsakit/assets/images/logo rs.png" alt="Logo Rumah Sakit">
    </div>
    <div class="brand-text">
      <h1>Rumah Sakit Sehat Selalu</h1>
      <div class="muted">Sistem Manajemen Rumah Sakit</div>
    </div>
  </div>

  <nav>
    <a href="/SistemManajemenRumahsakit/dashboard/index.php">Dashboard</a>
    <a href="/SistemManajemenRumahsakit/pasien/pasien.php">Pasien</a>
    <a href="/SistemManajemenRumahsakit/dokter/dokter.php">Dokter</a>
    <a href="/SistemManajemenRumahsakit/perawat/perawat.php">Perawat</a>
    <a href="/SistemManajemenRumahsakit/dashboard/logout.php">Logout</a>
  </nav>
</header>


<main class="container">

