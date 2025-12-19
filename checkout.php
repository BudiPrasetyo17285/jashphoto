<?php
include "database/koneksi.php";
session_start();

if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

// Ambil data dari session
$id_user = $_SESSION['id_user'] ?? 1;
$id_photographer = $_SESSION['id_photographer'] ?? 0;
$id_product = $_SESSION['id_product'] ?? 0;
$tanggal = $_SESSION['tanggal'] ?? '';
$jam_mulai = $_SESSION['jam_mulai'] ?? '';
$jam_selesai = $_SESSION['jam_selesai'] ?? '';

// Validasi data dari session
if ($id_photographer == 0 || $id_product == 0 || empty($tanggal) || empty($jam_mulai) || empty($jam_selesai)) {
    echo "<script>
            alert('Data booking tidak lengkap! Silakan ulangi dari awal.');
            window.location.href = 'index.php';
          </script>";
    exit;
}

// Validasi User harus login
if ($id_user == 0) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location.href = 'login.php';
          </script>";
    exit;
}

// Ambil data dari database
// Data user
$sql_user = "SELECT * FROM user WHERE id = '$id_user'";
$result_user = mysqli_query($host, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Data fotografer
$sql_photographer = "SELECT * FROM photographer WHERE id = '$id_photographer'";
$result_photographer = mysqli_query($host, $sql_photographer);
$photographer = mysqli_fetch_assoc($result_photographer);

// Ambil data produk/paket
$sql_product = "SELECT * FROM products WHERE id = '$id_product'";
$result_product = mysqli_query($host, $sql_product);
$product = mysqli_fetch_assoc($result_product);

// Proses konfirmasi booking
if (isset($_POST['konfirmasi'])) {
    $location = mysqli_real_escape_string($host, $_POST['location']);
    $metode = mysqli_real_escape_string($host, $_POST['metode_pembayaran']);
    $total = $product['price'];
    $status = 'dibayar';

    $sql = "INSERT INTO booking (id_user, id_photographer, id_products, date, start_time, end_time, location, payment_method, total_price, status)
            VALUES ('$id_user', '$id_photographer', '$id_product', '$tanggal', '$jam_mulai', '$jam_selesai', '$location', '$metode', '$total', '$status')";

    if (mysqli_query($host, $sql)) {
        // Hapus session setelah berhasil
        unset($_SESSION['tanggal'], $_SESSION['jam_mulai'], $_SESSION['jam_selesai']);
        unset($_SESSION['id_product'], $_SESSION['id_photographer']);
        header("Location: riwayat.php");
        exit;
    } 
}

$durasi = (strtotime($jam_selesai) - strtotime($jam_mulai)) / 3600;
?>

<!DOCTYPE html>
<html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Jashphoto</title>

<style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body {
    font-family: Arial, sans-serif;
    background: #f2f4f8;
    padding: 20px;
    color: #333;
}

/* CONTAINER */
.container {
    max-width: 720px;
    margin: auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    overflow: hidden;
}

/* HEADER (mirip halaman jadwal) */
header {
    background: #111;
    color: #fff;
    padding: 16px 20px;
}

header h1 {
    font-size: 20px;
}

/* MAIN */
main {
    padding: 20px;
}

h2 {
    font-size: 18px;
    margin-bottom: 16px;
}

/* ALERT */
.alert {
    background: #fff7ed;
    border-left: 4px solid #f59e0b;
    padding: 10px;
    font-size: 14px;
    margin-bottom: 14px;
}

.alert.error {
    background: #fef2f2;
    border-left-color: #ef4444;
}

/* BOX */
.box {
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 14px;
    margin-bottom: 14px;
}

.box h3 {
    font-size: 15px;
    color: #2563eb;
    margin-bottom: 10px;
}

/* PRODUCT */
.product {
    display: flex;
    gap: 12px;
}

.product img {
    width: 80px;
    height: 80px;
    border-radius: 6px;
    object-fit: cover;
}

.product h4 {
    font-size: 15px;
}

.product p {
    font-size: 13px;
    color: #666;
}

.price {
    margin-top: 6px;
    font-weight: bold;
    color: #2563eb;
}

/* ROW */
.row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    padding: 6px 0;
    border-bottom: 1px solid #eee;
}

.row:last-child {
    border-bottom: none;
}

.label {
    color: #6b7280;
}

.value {
    font-weight: 500;
}

/* FORM */
label {
    font-size: 14px;
    display: block;
    margin-bottom: 4px;
}

textarea, select {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #d1d5db;
}

textarea {
    min-height: 70px;
}

/* TOTAL */
.total {
    background: #2563eb;
    color: #fff;
    padding: 14px;
    border-radius: 6px;
    display: flex;
    justify-content: space-between;
    margin: 18px 0;
}

.total-amount {
    font-size: 18px;
    font-weight: bold;
}

/* BUTTON */
.buttons {
    display: flex;
    gap: 10px;
}

button {
    flex: 1;
    padding: 10px;
    font-size: 14px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.btn-back {
    background: #e5e7eb;
}

.btn-submit {
    background: #2563eb;
    color: #fff;
}

/* RESPONSIVE */
@media (max-width: 600px) {
    .product {
        flex-direction: column;
    }
    .row {
        flex-direction: column;
        gap: 4px;
    }
}
</style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Jashphoto</h1>
        </header>

        <main>
            <h2>Checkout Booking</h2>

            <div class="alert">
                <p>Pastikan semua data sudah benar</p>
            </div>

            <form method="POST">
                <section class="box">
                    <h3>Paket yang dipilih</h3>
                    <div class="product">
                        <img src="<?= $product['gambar'] ?? 'placeholder.jpg' ?>">
                        <div>
                            <h4><?= $product['name'] ?></h4>
                            <p><?= $product['deskripsi'] ?></p>
                            <div class="price">Rp <?= number_format($product['price'],0,',','.') ?></div>
                        </div>
                    </div>
                </section>

                <section class="box">
                    <h3>Fotografer</h3>
                    <div class="row">
                        <span class="label">Nama</span>
                        <span class="value"><?= $photographer['name'] ?></span>
                    </div>
                </section>

                <section class="box">
                <h3>Jadwal</h3>
                    <div class="row"><span class="label">Tanggal</span><span class="value"><?= date('d F Y', strtotime($tanggal)) ?></span></div>
                    <div class="row"><span class="label">Waktu</span><span class="value"><?= $jam_mulai ?> - <?= $jam_selesai ?></span></div>
                    <div class="row"><span class="label">Durasi</span><span class="value"><?= $durasi ?> Jam</span></div>
                </section>

                <section class="box">
                    <h3>Pemesan</h3>
                    <div class="row"><span class="label">Nama</span><span class="value"><?= $user['username'] ?></span></div>
                    <div class="row"><span class="label">Email</span><span class="value"><?= $user['email'] ?></span></div>
                </section>

                <section class="box">
                    <h3>Lokasi</h3>
                    <label>Alamat Lengkap</label>
                    <textarea name="location" required></textarea>
                </section>

                <section class="box">
                    <h3>Pembayaran</h3>
                    <label>Metode Pembayaran</label>
                    <select name="metode_pembayaran" required>
                        <option value="">-- Pilih --</option>
                        <option>Transfer Bank</option>
                        <option>E-Wallet</option>
                        <option>Tunai</option>
                    </select>
                </section>

                <div class="total">
                    <span>Total</span>
                    <span class="total-amount">Rp <?= number_format($product['price'],0,',','.') ?></span>
                </div>

                <div class="buttons">
                    <button type="button" class="btn-back" onclick="history.back()">Kembali</button>
                    <button type="submit" name="konfirmasi" class="btn-submit">Konfirmasi</button>
                </div>

            </form>
        </main>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!confirm('Konfirmasi booking sekarang?')) {
                e.preventDefault();
            }
        });
    </script>

</body>
</html>
