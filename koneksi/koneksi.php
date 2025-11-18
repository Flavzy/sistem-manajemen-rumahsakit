<?php
$host = "sql12.freesqldatabase.com";
$user = "sql12807151";
$pass = "NPvz7QxJ42";
$db   = "sql12807151";
$port = 3306;

// Buat koneksi
$connect = mysqli_connect($host, $user, $pass, $db, $port);

// Cek koneksi
if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>