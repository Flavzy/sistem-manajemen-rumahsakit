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