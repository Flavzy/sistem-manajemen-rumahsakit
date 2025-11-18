<?php
session_start();

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Session timeout (30 menit)
$inactive = 1800;
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > $inactive)) {
    session_destroy();
    header("Location: login.php?error=session_expired");
    exit();
}

// Update waktu aktivitas
$_SESSION['login_time'] = time();
?>