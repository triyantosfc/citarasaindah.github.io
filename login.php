<?php
session_start();
include('part/header-out.php');

$message = array();

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user_form WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $select = $stmt->get_result();

    if($select->num_rows > 0) {
        $row = $select->fetch_assoc();
        if(password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['message'] = "Login berhasil!";
            header('Location: landing.php');
            exit();
        } else {
            $_SESSION['message'] = "Password salah";
        }
    } else {
        $_SESSION['message'] = "User tidak ada";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <br><br><br>
    <br><br>
    <div class="container">
        <div class="form-container">
            <form action="" method="POST">
                <h3>Login Sekarang</h3>
                <input type="text" name="username" required placeholder="Masukan Username" class="box">
                <input type="password" name="password" required placeholder="Masukan Password" class="box">
                <input type="submit" name="submit" class="btn" value="Login">
                <p style="color: black;">Belum mempunyai akun? Daftar <a href="daftar.php">disini</a></p>
                <?php
                if (!empty($_SESSION['message'])) {
                    echo "<p style='color: red;'>{$_SESSION['message']}</p>";
                    unset($_SESSION['message']);
                }
                ?>
                <br><br>
            </form>
            
        </div>
    </div>
    <br><br>
<?php
    include('part/footer.php');
?>
