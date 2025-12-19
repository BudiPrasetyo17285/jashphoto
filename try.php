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
$sql_user = "SELECT * FROM user WHERE id = '$id_user'";
$result_user = mysqli_query($host, $sql_user);
$user = mysqli_fetch_assoc($result_user);

$sql_photographer = "SELECT * FROM photographer WHERE id = '$id_photographer'";
$result_photographer = mysqli_query($host, $sql_photographer);
$photographer = mysqli_fetch_assoc($result_photographer);

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
    <link rel="stylesheet" href="styles/try.css">
</head>
<body>
    <header>
        <div class="header-bar">
            <button class="btn-back" onclick="history.back()">← Kembali</button>
            <h1>Jashphoto</h1>
        </div>
    </header>

    <!-- CONTAINER UTAMA -->
    <div class="container">
        <h2>Checkout Booking</h2>

        <!-- NOTIFIKASI -->
        <div class="notifikasi">
            <p>Pastikan semua data sudah benar sebelum konfirmasi</p>
        </div>

        <!-- FORM -->
        <form method="POST">
            
            <!-- PAKET YANG DIPILIH (Full Width) -->
            <section class="kartu kartu-penuh">
                <h3>Paket yang Dipilih</h3>
                <div class="info-produk">
                    <img src="<?= $product['gambar'] ?? 'placeholder.jpg' ?>" alt="Gambar Produk">
                    <div class="detail-produk">
                        <h4><?= $product['name'] ?></h4>
                        <p><?= $product['deskripsi'] ?></p>
                        <div class="harga">Rp <?= number_format($product['price'], 0, ',', '.') ?></div>
                    </div>
                </div>
            </section>

            <!-- BARIS 1: FOTOGRAFER & JADWAL -->
            <div class="baris-flex">
                <!-- FOTOGRAFER (Kiri) -->
                <section class="kartu">
                    <h3>Fotografer</h3>
                    <div class="baris-info">
                        <span class="label-info">Nama Fotografer</span>
                        <span class="nilai-info"><?= $photographer['name'] ?></span>
                    </div>
                </section>

                <!-- JADWAL (Kanan) -->
                <section class="kartu">
                    <h3>Jadwal</h3>
                    <div class="baris-info">
                        <span class="label-info">Tanggal</span>
                        <span class="nilai-info"><?= date('d F Y', strtotime($tanggal)) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label-info">Waktu</span>
                        <span class="nilai-info"><?= $jam_mulai ?> - <?= $jam_selesai ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label-info">Durasi</span>
                        <span class="nilai-info"><?= $durasi ?> Jam</span>
                    </div>
                </section>
            </div>

            <!-- BARIS 2: PEMESAN & LOKASI -->
            <div class="baris-flex">
                <!-- PEMESAN (Kiri) -->
                <section class="kartu">
                    <h3>Data Pemesan</h3>
                    <div class="baris-info">
                        <span class="label-info">Nama</span>
                        <span class="nilai-info"><?= $user['username'] ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label-info">Email</span>
                        <span class="nilai-info"><?= $user['email'] ?></span>
                    </div>
                </section>

                <!-- LOKASI (Kanan) -->
                <section class="kartu">
                    <h3>Lokasi Pemotretan</h3>
                    <label for="location">Alamat Lengkap</label>
                    <textarea name="location" id="location" required placeholder="Masukkan alamat lengkap lokasi pemotretan..."></textarea>
                </section>
            </div>

            <!-- PEMBAYARAN (Full Width) -->
            <section class="kartu kartu-penuh">
                <h3>Metode Pembayaran</h3>
                <label for="metode_pembayaran">Pilih Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet (OVO, GoPay, Dana)</option>
                    <option value="Tunai">Tunai</option>
                </select>
            </section>

            <!-- TOTAL -->
            <div class="box-total">
                <span>Total Pembayaran</span>
                <span class="jumlah-total">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
            </div>

            <!-- TOMBOL -->
            <div class="grup-tombol">
                <button type="button" class="tombol-kembali" onclick="history.back()">Kembali</button>
                <button type="submit" name="konfirmasi" class="tombol-konfirmasi">Konfirmasi Booking</button>
            </div>

        </form>
    </div>

    <script>
        // Konfirmasi sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin mengkonfirmasi booking ini?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>