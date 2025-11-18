<?php
require_once '../dashboard/check_session.php';
include "../koneksi/koneksi.php";
include "../koneksi/header.php";

// AMBIL DATA DOKTER AKTIF dari database
$query_dokter = mysqli_query($connect, "SELECT id_dokter, nama_dokter, spesialis, email, no_hp FROM tbl_dokter WHERE status = 'Aktif' ORDER BY nama_dokter");
$dokters = [];
while ($row = mysqli_fetch_assoc($query_dokter)) {
    $dokters[] = $row;
}

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($connect, $_POST['nama_pasien']);
    $umur = mysqli_real_escape_string($connect, $_POST['umur']);
    $alamat = mysqli_real_escape_string($connect, $_POST['alamat']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $riwayat = mysqli_real_escape_string($connect, $_POST['riwayat_penyakit']);
    $penyakit = mysqli_real_escape_string($connect, $_POST['penyakit_dialami']);
    $id_dokter = mysqli_real_escape_string($connect, $_POST['id_dokter']);

    // Validasi: pastikan dokter yang dipilih ada dan aktif
    $check_dokter = mysqli_query($connect, "SELECT id_dokter FROM tbl_dokter WHERE id_dokter = '$id_dokter' AND status = 'Aktif'");
    
    if (mysqli_num_rows($check_dokter) > 0) {
        $query = "INSERT INTO tbl_pasien (nama_pasien, umur, alamat, email, riwayat_penyakit, penyakit_dialami, id_dokter)
                  VALUES ('$nama', '$umur', '$alamat', '$email', '$riwayat', '$penyakit', '$id_dokter')";
        
        if (mysqli_query($connect, $query)) {
            echo "<script>
                    alert('Data pasien berhasil ditambahkan!'); 
                    window.location='pasien.php';
                  </script>";
        } else {
            echo "<div class='error-message'>❌ Error: " . mysqli_error($connect) . "</div>";
        }
    } else {
        echo "<div class='error-message'>❌ Error: Dokter yang dipilih tidak valid atau tidak aktif!</div>";
    }
}
?>

<div class="container-form">
    <div class="form-card">
        <h2>➕ Tambah Data Pasien</h2>
        
        <?php if (empty($dokters)): ?>
            <div class="no-doctors">
                <strong>⚠ Tidak ada dokter aktif tersedia!</strong><br>
                Silakan tambah data dokter terlebih dahulu di 
                <a href="../dokter/tambah_dokter.php" style="color: #856404; text-decoration: underline;">
                    halaman tambah dokter
                </a>
                atau aktifkan dokter yang ada.
            </div>
        <?php else: ?>
            <div class="doctor-info">
                <strong>💡 Informasi:</strong> Pilih dokter yang akan menangani pasien dari daftar dokter aktif di bawah.
            </div>
        <?php endif; ?>
        
        <div id="successMessage" class="success-message">
            Data berhasil disimpan!
        </div>
        
        <form id="formTambahPasien" class="validated-form" method="POST">
            <div class="form-group">
                <label for="nama_pasien" class="required">Nama Pasien</label>
                <input type="text" id="nama_pasien" name="nama_pasien" class="form-control" 
                       placeholder="Masukkan nama lengkap pasien" required>
            </div>

            <div class="form-group">
                <label for="umur" class="required">Umur</label>
                <input type="number" id="umur" name="umur" class="form-control" 
                       placeholder="Masukkan umur pasien" min="1" max="120" required>
            </div>

            <div class="form-group">
                <label for="alamat" class="required">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" 
                          placeholder="Masukkan alamat lengkap" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="email" class="required">Email</label>
                <input type="email" id="email" name="email" class="form-control" 
                       placeholder="Masukkan alamat email" 
                       required 
                       data-validation="email">
            </div>

            <div class="form-group">
                <label for="riwayat_penyakit">Riwayat Penyakit</label>
                <textarea id="riwayat_penyakit" name="riwayat_penyakit" class="form-control" 
                          placeholder="Masukkan riwayat penyakit (jika ada)" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label for="penyakit_dialami">Penyakit yang Dialami Saat Ini</label>
                <textarea id="penyakit_dialami" name="penyakit_dialami" class="form-control" 
                          placeholder="Masukkan penyakit yang sedang dialami" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label for="id_dokter" class="required">Dokter Penanggung Jawab</label>
                <select id="id_dokter" name="id_dokter" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    <?php foreach ($dokters as $dokter): ?>
                        <option value="<?= $dokter['id_dokter'] ?>" 
                                data-spesialis="<?= htmlspecialchars($dokter['spesialis']) ?>"
                                data-email="<?= htmlspecialchars($dokter['email']) ?>"
                                data-nohp="<?= htmlspecialchars($dokter['no_hp']) ?>">
                            Dr. <?= htmlspecialchars($dokter['nama_dokter']) ?> - <?= htmlspecialchars($dokter['spesialis']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small style="color: #7f8c8d; margin-top: 5px; display: block;">
                    💡 Hanya menampilkan dokter dengan status "Aktif"
                </small>
                
                <!-- Info dokter yang dipilih -->
                <div id="doctorSelected" class="doctor-selected">
                    <div class="doctor-name" id="selectedDoctorName"></div>
                    <div class="doctor-details">
                        Spesialis: <span id="selectedDoctorSpecialty"></span><br>
                        Email: <span id="selectedDoctorEmail"></span><br>
                        No. HP: <span id="selectedDoctorPhone"></span>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" class="btn-submit">💾 Simpan Data Pasien</button>
            <a href="pasien.php" class="btn-back">⬅ Kembali ke Daftar Pasien</a>
        </form>
    </div>
</div>

<script>
// Tampilkan info dokter yang dipilih
document.getElementById('id_dokter').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const doctorInfo = document.getElementById('doctorSelected');
    
    if (this.value !== '') {
        document.getElementById('selectedDoctorName').textContent = selectedOption.text;
        document.getElementById('selectedDoctorSpecialty').textContent = selectedOption.getAttribute('data-spesialis');
        document.getElementById('selectedDoctorEmail').textContent = selectedOption.getAttribute('data-email');
        document.getElementById('selectedDoctorPhone').textContent = selectedOption.getAttribute('data-nohp');
        doctorInfo.style.display = 'block';
    } else {
        doctorInfo.style.display = 'none';
    }
});

// Validasi tambahan sebelum submit
document.getElementById('formTambahPasien').addEventListener('submit', function(e) {
    const doctorSelect = document.getElementById('id_dokter');
    
    // Validasi umur
    const umur = document.getElementById('umur').value;
    if (umur < 1 || umur > 120) {
        e.preventDefault();
        alert('Umur harus antara 1 dan 120 tahun!');
        document.getElementById('umur').focus();
        return;
    }
    
    // Validasi dokter
    if (doctorSelect.value === '') {
        e.preventDefault();
        alert('Silakan pilih dokter penanggung jawab!');
        doctorSelect.focus();
        return;
    }
});

// Inisialisasi: sembunyikan info dokter saat pertama kali load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('doctorSelected').style.display = 'none';
});
</script>

<?php include "../koneksi/footer.php"; ?>
