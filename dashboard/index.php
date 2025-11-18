<?php
require_once "check_session.php";
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

// hitung data
$jmlPasien   = mysqli_fetch_row(mysqli_query($connect, "SELECT COUNT(*) FROM tbl_pasien"))[0];
$jmlDokter   = mysqli_fetch_row(mysqli_query($connect, "SELECT COUNT(*) FROM tbl_dokter"))[0];
$jmlPerawat  = mysqli_fetch_row(mysqli_query($connect, "SELECT COUNT(*) FROM tbl_perawat"))[0];

// top penyakit
$query = "SELECT penyakit_dialami, COUNT(*) AS jumlah 
          FROM tbl_pasien 
          GROUP BY penyakit_dialami 
          ORDER BY jumlah DESC 
          LIMIT 5";
$result = mysqli_query($connect, $query);

//chart
$penyakit = []; $jumlah = [];
while ($r = mysqli_fetch_assoc($result)) { $penyakit[]=$r['penyakit_dialami']; $jumlah[]=$r['jumlah']; }
mysqli_data_seek($result, 0);
?>


<section class="hero">
  <div class="bg-slider">
    <div class="bg-slide active" style="background-image:url('/SistemManajemenRumahsakit/assets/images/bg1.jpg')"></div>
    <div class="bg-slide" style="background-image:url('/SistemManajemenRumahsakit/assets/images/bg2.jpg')"></div>
    <div class="bg-slide" style="background-image:url('/SistemManajemenRumahsakit/assets/images/bg3.jpg')"></div>
  </div>

  <div class="hero-overlay"></div>

  <div class="hero-content container">
    <div class="hero-left">
      <h2>Rumah Sakit Sehat Selalu</h2>
      <p>Selamat datang di sistem manajemen internal. Kelola pasien, dokter, dan perawat dengan cepat dan aman.</p>
    </div>

    <div style="min-width:320px; text-align:right;">
      <a href="../pasien/pasien.php" class="btn" style="margin-right:8px">Data Pasien</a>
      <a href="../dokter/dokter.php" class="btn ghost">Data Dokter</a>
    </div>
  </div>

  <button class="arrow left">❮</button>
  <button class="arrow right">❯</button>
</section>

<div class="container">
  <div class="dashboard-grid">
    <div class="card center">
      <h3>Pasien</h3>
      <h1><?= $jmlPasien ?></h1>
      <a class="btn" href="../pasien/pasien.php">Lihat Data</a>
    </div>
    <div class="card center">
      <h3>Dokter</h3>
      <h1><?= $jmlDokter ?></h1>
      <a class="btn" href="../dokter/dokter.php">Lihat Data</a>
    </div>
    <div class="card center">
      <h3>Perawat</h3>
      <h1><?= $jmlPerawat ?></h1>
      <a class="btn" href="../perawat/perawat.php">Lihat Data</a>
    </div>
  </div>

  <div class="chart-container">
    <h3 class="center">📈 Grafik Penyakit Terbanyak</h3>
    <canvas id="chartPenyakit" style="max-height:300px"></canvas>
  </div>

  <div class="table-container">
    <h3 style="margin:6px 0 12px">🩺 Detail Penyakit Terbanyak</h3>
    <table>
      <thead><tr><th>Penyakit</th><th>Jumlah</th></tr></thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= htmlspecialchars($row['penyakit_dialami']) ?></td>
          <td><?= $row['jumlah'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartPenyakit')?.getContext('2d');
if (ctx) {
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($penyakit) ?>,
      datasets: [{ label:'Jumlah Pasien', data: <?= json_encode($jumlah) ?>, backgroundColor:'rgba(13,110,253,0.7)', borderColor:'#0d6efd', borderWidth:1 }]
    },
    options:{ scales:{ y:{ beginAtZero:true } }, plugins:{ legend:{ display:false } } }
  });
}

// background slider
document.querySelectorAll('.hero .arrow.left').forEach(btn => btn.addEventListener('click', ()=> window._bgPrev && window._bgPrev()));
document.querySelectorAll('.hero .arrow.right').forEach(btn => btn.addEventListener('click', ()=> window._bgNext && window._bgNext()));
</script>

<?php include "../koneksi/footer.php"; ?>
