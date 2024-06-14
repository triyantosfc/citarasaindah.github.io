<?php
  include ('config/conn.php');


  if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>citarasaindah</title>
    <link rel="stylesheet" href="css/style.css" />

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- feather icon -->
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <!-- navbar start -->
    <nav class="navbar">
    <a href="index.html" class="navbar-logo">Citarasa<span>Indah</span>.</a>

      <div class="navbar-nav">
        <a href="landing.php">Home</a>
        <!-- <a href="landing.php#about">Tentang Kami</a> -->
        <a href="menu.php">Menu</a>
        <a href="contact.php">Kontak</a>
      </div>

      <div class="navbar-extra">
        <!-- <a href="#" id="search"><i data-feather="search"></i></a> -->
        <!-- <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a> -->
        <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');"><i data-feather="log-out"></i></a>

        <a href="#" id="humberger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>