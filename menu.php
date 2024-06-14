<?php
session_start();
include('part/header.php');
include('config.php');

// Periksa apakah user_id sudah diinisialisasi
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    // Jika user_id tidak ditemukan, redirect ke halaman login
    header('Location: login.php');
    exit();
}

// Penghapusan produk dari keranjang belanja
if(isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("is", $remove_id, $user_id);
    $stmt->execute();
    $_SESSION['message'] = "Product removed from cart";
    // Redirect kembali ke halaman menu setelah menghapus
    header('Location: menu.php');
    exit();
}

// Penghapusan semua produk dari keranjang belanja
if(isset($_GET['delete_all'])) {
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $_SESSION['message'] = "All products removed from cart";
    // Redirect kembali ke halaman menu setelah menghapus semua produk
    header('Location: menu.php');
    exit();
}

// Handle penambahan produk ke keranjang
if(isset($_POST['add_to_cart'])) {
    $product_image = $_POST['products_image'];
    $product_name = $_POST['products_name'];
    $product_price = $_POST['products_price'];
    $product_quantity = $_POST['product_quantity'];

    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND name = ?");
    $stmt->bind_param("ss", $user_id, $product_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND name = ?");
        $stmt->bind_param("iss", $product_quantity, $user_id, $product_name);
        $stmt->execute();
        $_SESSION['message'] = "Product quantity updated in cart";
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, name, price, quantity, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $user_id, $product_name, $product_price, $product_quantity, $product_image);
        $stmt->execute();
        $_SESSION['message'] = "Product added to cart";
    }
}

// Mengambil data keranjang belanja
$grand_total = 0;
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$cart_query = $stmt->get_result();

?>

<section id="menu" class="menu">
    <h2><span>Menu</span> Kami</h2>
    <p>Selamat datang di Kedai kami <strong>Citarasa<span>Indah</span></strong>, tempat di mana setiap suapan tegukan membawa Anda pada petualangan rasa yang menggoda. Berikut adalah pilihan menu istimewa kami yang siap memanjakan lidah Anda</p>

    <div class="row">
        <?php
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $select_products = $stmt->get_result();

        if($select_products->num_rows > 0) {
            while ($fetch_product = $select_products->fetch_assoc()) {
                ?>
                <form action="" method="POST" class="box">
                    <div class="img">
                        <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
                    </div>
                    <div class="descrip">
                        <div class="name"><?php echo $fetch_product['name']; ?></div>
                        <div class="price">Harga : Rp<?php echo number_format($fetch_product['price'], 0, ',', '.'); ?></div>
                        <input type="number" min="1" name="product_quantity" value="1">
                        <input type="hidden" name="products_image" value="<?php echo $fetch_product['image']; ?>">
                        <input type="hidden" name="products_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="products_price" value="<?php echo $fetch_product['price']; ?>">
                        <div class="action">
                            <input type="submit" name="add_to_cart" value="add" class="btn">
                        </div>
                    </div>
                </form>
                <?php
            }
        }
        ?>
    </div>
</section>

<div class="shopping-cart">
    <h1 class="heading">Keranjang Menu</h1>
    <?php
    // Tampilkan pesan dari sesi
    if (isset($_SESSION['message'])) {
        echo "<p style='color: red;'>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($cart_query->num_rows > 0) {
                while ($fetch_cart = $cart_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $fetch_cart['name']; ?></td>
                        <td>Rp<?php echo number_format($fetch_cart['price'], 0, ',', '.'); ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                <input type="number" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                            </form>
                        </td>
                        <td>Rp<?php echo number_format($fetch_cart['price'] * $fetch_cart['quantity'], 0, ',', '.'); ?></td>
                        <td><a href="menu.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Hapus semua ?');">Hapus</a></td>
                    </tr>
                    <?php
                    $grand_total += $fetch_cart['price'] * $fetch_cart['quantity'];
                }
            }
            ?>
            <tr class="table-bottom">
                <td colspan="3">Grand Total</td>
                <td>Rp<?php echo number_format($grand_total, 0, ',', '.'); ?></td>
                <td><a href="menu.php?delete_all" onclick="return confirm('Hapus semua dari keranjang?');" class="delete-btn">Hapus</a></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="cart-btn">
    <a href="invoice.php" <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>>Proceed to Checkout</a>
</div>

<?php include ('part/footer.php'); ?>
