<?php
    include ('part/header-out.php');
    
?>
<?php
    include ('config/conn.php');

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


<br>
<br>
<br><br><br>
<div class="container">
    <div class="form-container">

    <form action="" method="post" enctype="multipart/form-data">
    <h3>Upload Gambar</h3>
        <input type="text" name="nama" placeholder="Nama Gambar" class="box">
        <input type="text" name="price" placeholder="Masukkan Harga" class="box">
        <input type="file" name="image" id="image" class="box">
        <input type="submit" name="submit" value="Upload" class="btn">
    </form>
    </div>
</div>
<br><br><br>



<?php
    include('part/footer.php');
?>