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

// Mengambil data keranjang belanja
$grand_total = 0;
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$cart_query = $stmt->get_result();
?>
<br><br><br><br>
<br><br>
<div class="invoice">
    <h1 class="heading">Invoice Pembelian</h1>
    <div class="invoice-details">
        <p><strong>Tanggal:</strong> <?php echo date('d-m-Y'); ?></p>
        <p><strong>Nomor Invoice:</strong> INV-<?php echo uniqid(); ?></p>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Nama Makanan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
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
                        <td><?php echo $fetch_cart['quantity']; ?></td>
                        <td>Rp<?php echo number_format($fetch_cart['price'] * $fetch_cart['quantity'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php
                    $grand_total += $fetch_cart['price'] * $fetch_cart['quantity'];
                }
            }
            ?>
            <tr class="invoice-total">
                <td colspan="3">Total Keseluruhan</td>
                <td>Rp<?php echo number_format($grand_total, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="invoice-actions no-print">
        <button id="printButton">Print</button>
    </div>
</div>
<br>

<?php include ('part/footer.php'); ?>

<style>
@media print {
    .no-print {
        display: none;
    }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
document.getElementById('printButton').addEventListener('click', function () {
    var element = document.querySelector('.invoice'); // Pilih elemen yang ingin dicetak
    var printButton = document.querySelector('.invoice-actions.no-print');
    
    // Sembunyikan tombol print sebelum konversi
    printButton.style.display = 'none';

    var opt = {
        margin:       0.5,
        filename:     'invoice.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().from(element).set(opt).save().then(function () {
        // Tampilkan kembali tombol print setelah konversi selesai
        printButton.style.display = 'block';
    });
});
</script>
