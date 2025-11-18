# 🏥 Sistem Manajemen Rumah Sakit

Sistem Manajemen Rumah Sakit adalah aplikasi berbasis web yang digunakan untuk mengelola data operasional rumah sakit, seperti data pasien, dokter, dan perawat. Aplikasi ini dibangun menggunakan **PHP**, **MySQL**, dan menggunakan struktur modular untuk memudahkan pengembangan.

---

## 📌 Fitur Utama

### **1. Manajemen Dokter**
- Tambah data dokter  
- Edit data dokter  
- Hapus data dokter  
- Menampilkan daftar seluruh dokter  
- Informasi dasar: nama, kontak, spesialis, dll.

### **2. Manajemen Perawat**
- Tambah data perawat  
- Edit data perawat  
- Hapus data perawat  
- Menampilkan daftar perawat  
- Informasi dasar: nama, nomor HP, shift, email

### **3. Manajemen Pasien**
- Tambah data pasien  
- Edit data pasien  
- Hapus data pasien  
- Menampilkan semua pasien  
- Informasi pasien seperti nama, alamat, dan tanggal lahir

### **4. Dashboard Administrator**
- Menampilkan ringkasan data dokter, pasien, dan perawat  
- Akses modul via sidebar  
- UI sederhana dan mudah dipahami

### **5. Sistem Login**
- Halaman login  
- Validasi user dari database  
- Session admin (check_session.php)  
- Logout

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| **PHP (Native)** | Logika backend |
| **MySQL** | Basis data |
| **HTML, CSS, JS** | Struktur & interaksi tampilan |
| **Bootstrap (jika digunakan di dalam header.php)** | Desain responsive |
| **Custom CSS & JS** | Aset dalam folder `/assets` |

---

## 📁 Struktur Folder

SistemManajemenRumahsakit/
│ README.md
│
├───assets/
│ ├── css/
│ ├── images/
│ └── js/
│
├───dashboard/
│ ├── index.php
│ ├── login.php
│ ├── logout.php
│ ├── check_session.php
│ └── hash.php
│
├───db/
│ └── db_rumahsakit.sql
│
├───dokter/
│ ├── dokter.php
│ ├── tambah_dokter.php
│ ├── edit_dokter.php
│ └── hapus_dokter.php
│
├───pasien/
│ ├── pasien.php
│ ├── tambah_pasien.php
│ ├── edit_pasien.php
│ └── hapus_pasien.php
│
├───perawat/
│ ├── perawat.php
│ ├── tambah_perawat.php
│ ├── edit_perawat.php
│ └── hapus_perawat.php
│
└───koneksi/
├── koneksi.php
├── koneksi1.php
├── header.php
└── footer.php


---

## ⚙️ Instalasi & Setup

### **1. Clone Repository**
```bash
git clone https://github.com/USERNAME/REPOSITORY.git
cd SistemManajemenRumahsakit

====Pembuatan Database Awal=====

1. create database
2. import db_rumahsakit.sql ke dalam database db_rumahsakit
3. atur file koneksi.php, sesuaikan dengan database


====Login Akun Admin====
id  : Admin1
pass: Admin#1234

Admin bisa melakukan proses CRUD di dalam sistem
Sistem ini memudahkan untuk melakukan pencatatan data rumah sakit
Seperti pencatatan data pasien, dokter, dan perawat

====Cara Membuat Akun Admin====
1. buka file hash.php
2. tambahkan "echo password_hash('[masukkan_password]', PASSWORD_DEFAULT) . "<br>";"
3. buka browser dan masuk ke dalam " http://localhost/SistemManajemenRumahsakit/dashboard/hash.php " dan salin password yang sudah di hash
4. insert data ke dalam tbl_admin di database yang sudah di buat 
melalui terminal mysql:
insert into tbl_admin (username, password, email) values
('[masukkan_username]','[password_yang_sudah_dihash_sebelumnya]','[masukkan_email]');
