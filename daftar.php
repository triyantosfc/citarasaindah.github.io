<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start(); // Memulai sesi
    include('part/header-out.php');
    $message = array(); // Deklarasi $message sebagai array kosong

    if(isset($_POST['submit'])) {
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        if($pass === $cpass) {
            $hassed_pass = password_hash($pass, PASSWORD_DEFAULT);

            // Periksa apakah username sudah ada
            $stmt = $conn->prepare("SELECT * FROM user_form WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $select = $stmt->get_result();

            if($select->num_rows > 0) {
                $_SESSION['message'] = "User Sudah Digunakan";
            } else {
                // Insert data baru ke dalam database
                $stmt = $conn->prepare("INSERT INTO user_form (full_name, username, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $fullname, $username, $email, $hassed_pass);

                if($stmt->execute()) {
                    // Registrasi berhasil, redirect ke halaman login
                    $_SESSION['message'] = "Registrasi Berhasil!";
                    header('Location: login.php');
                    exit();
                } else {
                    $_SESSION['message'] = "Registrasi gagal";
                }
            }
        } else {
            $_SESSION['message'] = "Password tidak sama!";
        }

        $stmt->close();
        $conn->close();
    }
?>

<br><br><br><br>

<div class="container">
    <div class="form-container">
        <?php
        // Tampilkan pesan-pesan dari $_SESSION['message']
        if (!empty($_SESSION['message'])) {
            echo "<p>{$_SESSION['message']}</p>";
            unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
        }
        ?>
        <form action="" method="POST">
            <h3>Lengkapi Data Dibawah ini</h3>
            <input type="text" name="full_name" required placeholder="Masukan Nama" class="box">
            <input type="text" name="username" required placeholder="Masukan Username" class="box">
            <input type="text" name="email" required placeholder="Masukan Email" class="box">
            <input type="password" name="password" required placeholder="Masukan Password" class="box">
            <input type="password" name="cpassword" required placeholder="Konfirmasi Password" class="box">
            <input type="submit" name="submit" class="btn" value="Daftar">
            <p style="color: black;">Sudah mempunyai akun? Login <a href="login.php">disini</a></p>
        </form>
    </div>
</div>

<br>

<?php include('part/footer.php'); ?>
