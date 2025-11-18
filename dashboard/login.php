<?php
session_start();
include "../koneksi/koneksi.php";

// Cek jika sudah login, langsung redirect ke index
if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = $_POST['password'];

    // Debug: cek apakah data sampai
    error_log("Login attempt - Username: $username");

    $sql = "SELECT * FROM tbl_admin WHERE username='$username'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Debug: cek hash password
        error_log("Stored hash: " . $row['password']);
        error_log("Password verify: " . password_verify($password, $row['password']));
        
        if (password_verify($password, $row['password'])) {
            // Set session dengan data lengkap
            $_SESSION['admin'] = $row['username'];
            $_SESSION['user_id'] = $row['id']; // pastikan kolom id ada
            $_SESSION['login_time'] = time();
            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
            
            // Debug: cek session setelah set
            error_log("Session set: " . $_SESSION['admin']);
            
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
    
    // Tutup koneksi
    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0;font-family:'Poppins',sans-serif}
    body{
      display:flex;
      justify-content:center;
      align-items:center;
      height:100vh;
      background:url('../assets/images/bglogin.jpg') center/cover no-repeat;
      position:relative;
    }

    body::before{
      content:'';
      position:absolute;
      inset:0;
      background:rgba(0,0,0,0.35);
      backdrop-filter:blur(4px);
    }

    .login-box{
      position:relative;
      z-index:2;
      width:400px;
      background:rgba(255,255,255,0.12);
      border:1px solid rgba(255,255,255,0.25);
      border-radius:18px;
      padding:40px 45px;
      box-shadow:0 8px 32px rgba(0,0,0,0.25);
      backdrop-filter:blur(20px);
      color:white;
      text-align:center;
      animation:fadeIn .6s ease;
    }

    .login-box img {
      width: 150px;
      height: 120px;
      object-fit: contain;
      margin-bottom: 18px;
      filter: drop-shadow(0 0 12px rgba(0, 200, 255, 0.7)); 
      transition: transform 0.3s ease, filter 0.3s ease;
    }

    .login-box img:hover {
      transform: scale(1.38);
      filter: drop-shadow(0 0 20px rgba(0, 255, 255, 0.9));
    }

    .login-box h2{
      margin-bottom:25px;
      font-size:26px;
      font-weight:600;
      color:#fff;
    }

    .login-box input{
      width:100%;
      padding:12px 14px;
      margin:10px 0;
      border-radius:10px;
      border:none;
      background:rgba(255,255,255,0.2);
      color:white;
      font-size:15px;
      transition:0.3s;
      outline:none;
    }

    .login-box input::placeholder{color:#ddd}
    .login-box input:focus{
      background:rgba(255,255,255,0.3);
      box-shadow:0 0 0 2px rgba(255,255,255,0.4);
    }

    .btn{
      width:100%;
      padding:12px;
      border:none;
      border-radius:10px;
      background:linear-gradient(135deg,#00bfff,#007bff);
      color:white;
      font-weight:600;
      font-size:15px;
      cursor:pointer;
      transition:all .3s ease;
      margin-top:10px;
    }
    .btn:hover{
      transform:translateY(-2px);
      background:linear-gradient(135deg,#0095ff,#005ce6);
    }

    .error{
      background:rgba(255,0,0,0.1);
      border:1px solid rgba(255,0,0,0.25);
      padding:10px;
      border-radius:8px;
      color:#ffbaba;
      font-size:14px;
      margin-bottom:15px;
    }

    .footer{
      text-align:center;
      color:#ccc;
      font-size:13px;
      margin-top:20px;
    }

    @keyframes fadeIn{
      from{opacity:0;transform:translateY(20px);}
      to{opacity:1;transform:translateY(0);}
    }
  </style>
</head>
<body>

<div class="login-box">

  <img src="../assets/images/logo rs.png" alt="Logo Rumah Sakit">

  <h2>Silahkan Login</h2>

  <?php if (!empty($error)): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="submit" class="btn">Login</button>
  </form>

  <div class="footer">&copy; 2025 Sistem Manajemen Rumah Sakit</div>
</div>

</body>
</html>