<?php
    include ('../config/conn.php');

    if(isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['nama']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        
        // Periksa apakah file gambar telah diunggah
        if(isset($_FILES['image'])) {
            $img = $_FILES['image']['name'];
            $img_temp = $_FILES['image']['tmp_name']; // Path sementara di server
            $img_path = "" . $img; // Path tujuan untuk menyimpan gambar di server
            
            // Pindahkan file gambar dari path sementara ke folder uploads
            move_uploaded_file($img_temp, $img_path);
            
            // Simpan informasi gambar ke database
            $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $price, $img_path); // Gunakan path gambar untuk nilai image
            $stmt->execute();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doc Upload</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap");

        :root {
        --primary: #b6895b;
        --blue: #3498db;
        --red: #e74c3c;
        --orange: #f39c12;
        --black: #333;
        --white: #fff;
        --light-bg: #eee;
        --box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        --border: 2px solid var(--black);
        }

        * {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
        }

        *::-webkit-scrollbar {
        width: 10px;
        height: 5px;
        }

        *::-webkit-scrollbar-track {
        background-color: transparent;
        }

        *::-webkit-scrollbar-thumb {
        background-color: var(--blue);
        }

        body {
        background-color: var(--light-bg);
        }
        
        .btn,
        .delete-btn,
        .option-btn {
        display: inline-block;
        padding: 10px 30px;
        cursor: pointer;
        font-size: 18px;
        color: var(--white);
        border-radius: 5px;
        text-transform: capitalize;
        }

        .btn:hover,
        .delete-btn:hover,
        .option-btn:hover {
        background-color: var(--black);
        }

        .btn {
        background-color: var(--primary);
        margin-top: 10px;
        }

        .delete-btn {
        background-color: var(--red);
        }

        .option-btn {
        background-color: var(--orange);
        }

        .form-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        }

        .form-container form {
        width: 500px;
        border-radius: 5px;
        border: var(--border);
        padding: 20px;
        text-align: center;
        background-color: var(--white);
        }

        .form-container form h3 {
        font-size: 30px;
        margin-bottom: 10px;
        text-transform: uppercase;
        color: var(--black);
        }

        .form-container form .box {
        width: 100%;
        border-radius: 5px;
        border: var(--border);
        padding: 12px 14px;
        font-size: 18px;
        margin: 10px 0;
        }

        .form-container form p {
        margin-top: 20px;
        font-size: 20px;
        color: var(--black);
        }

        .form-container form p a {
        color: var(--red);
        }

        .form-container form p a:hover {
        color: var(--orange);
        }

        .password-container {
        position: relative;
        }

    </style>
</head>
<body>
    <div class="form-container">
    
    <form action="" method="post" enctype="multipart/form-data">
    <h3>Upload Gambar</h3>
        <input type="text" name="nama" placeholder="Nama Gambar" class="box">
        <input type="text" name="price" placeholder="Masukkan Harga" class="box">
        <input type="file" name="image" id="image" class="box"> <!-- Ubah input type menjadi file -->
        <input type="submit" name="submit" value="Upload" class="btn">
    </form>
</div>

</body>
</html>
