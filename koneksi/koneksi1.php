<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_rumahsakit";

$connect = mysqli_connect($host, $user, $pass, $db);

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_set_charset($connect, "utf8");
?>
