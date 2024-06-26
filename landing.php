<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>citarasaindah</title>
    <link rel="stylesheet" href="css/style.css">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,700&display=swap" rel="stylesheet">

    <!-- feather icon -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <!-- navbar start -->
    <nav class="navbar">
        <a href="#" class="navbar-logo">Citarasa<span>Indah</span>.</a>
        <div class="navbar-nav">
            <a href="landing.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="contact.php">Kontak</a>
        </div>
        <div class="navbar-extra">
            <!-- <a href="#" id="search"><i data-feather="search"></i></a> -->
            <!-- <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a> -->
            <!-- <a href="user.php"><i data-feather="user"></i></a> -->
            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');"><i data-feather="log-out"></i></a>
            <a href="#" id="humberger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Mari Nikmati<br><span>Mie</span> & <span>Kopi</span></h1>
            <p>"Ketika lelah menghampiri, saatnya berhenti sejenak. Ngopi dan makan bersama bisa mengembalikan energi dan semangatmu."</p>
            <a href="menu.php" class="cta">Beli Sekarang</a>
            <?php
            if (isset($_SESSION['message'])) {
                echo "<p style='color: red;'>{$_SESSION['message']}</p>";
                unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
            }
            ?>
        </main>
    </section>
    <!-- Hero section end -->
    <section>
      <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>

        <div class="row">
          <about class="about-img"> </about>
          <img src="img/kami.jpg" alt="" />
          <div class="content">
            <h2>Sebuah Kenangan yang Menghangatkan</h2>
            <p>
              Di Warung <strong>Citarasa Indah</strong>, kami percaya bahwa
              secangkir kopi dapat menjadi lebih dari kadar minuman. Kami
              mengundang Anda untuk merasakan aroma kopi yang harum, menikmati
              suasana yang santai, dan menjalin kenangan yang tak terlupakan
              bersama kami.
            </p>
            <p>
              Kami mengucapkan terima kasih atas dukungan dan kepercayaan Anda.
              Warung Kopi [Nama Warung Kopi Anda] hadir berkat Anda, dan kami
              berjanji untuk terus memberikan yang terbaik bagi komunitas kami.
            </p>
          </div>
        </div>
      </section>
    </section>
    <!-- Footer Section Start -->
    <footer>
        <div class="sosials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>
        <div class="links">
            <a href="landing.php">Home</a>
            <a href="landing.php#about">Tentang Kami</a>
            <a href="menu.php">Menu Kami</a>
            <a href="contact.php">Kontak Kami</a>
        </div>
        <div class="credit">
            <p>created by <a href="">Triyanto</a>. | &copy; 2023.</p>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- feather icon -->
    <script>
        feather.replace();
    </script>
    <!-- My JavaScirpt -->
    <script src="js/script.js"></script>
</body>
</html>
