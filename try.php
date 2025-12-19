<?php
include "database/koneksi.php";
session_start();

if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

// Ambil data dari session
$id_user = $_SESSION['user_id'] ?? 1;
$id_photographer = $_SESSION['id_photographer'] ?? 0;
$id_product = $_SESSION['id_product'] ?? 0;
$tanggal = $_SESSION['tanggal'] ?? '';
$jam_mulai = $_SESSION['jam_mulai'] ?? '';
$jam_selesai = $_SESSION['jam_selesai'] ?? '';

// Validasi data dari session
if ($id_photographer == 0 || $id_product == 0 || empty($tanggal) || empty($jam_mulai) || empty($jam_selesai)) {
    echo "<script>
            alert('Data booking tidak lengkap! Silakan ulangi dari awal.');
            window.location.href = 'homepage.php';
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
    $status = 'pending';

    $sql = "INSERT INTO booking (id_user, id_photographer, id_products, date, start_time, end_time, location, payment_method, total_price, status)
            VALUES ('$id_user', '$id_photographer', '$id_product', '$tanggal', '$jam_mulai', '$jam_selesai', '$location', '$metode', '$total', '$status')";

    if (mysqli_query($host, $sql)) {
        unset($_SESSION['tanggal'], $_SESSION['jam_mulai'], $_SESSION['jam_selesai']);
        unset($_SESSION['id_product'], $_SESSION['id_photographer']);
        echo "<script>
                alert('Booking berhasil dikonfirmasi!');
                window.location.href = 'riwayat.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan booking!');</script>";
    }
}

$durasi = (strtotime($jam_selesai) - strtotime($jam_mulai)) / 3600;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - JashPhoto</title>
    
    <style>
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        /* ===== HEADER ===== */
        header {
            background: #000;
            color: #fff;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            text-align: center;
        }

        .header-content h1 {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* ===== CONTAINER ===== */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 32px;
            margin-bottom: 10px;
            color: #000;
        }

        /* ===== NOTIFIKASI ===== */
        .notifikasi {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .notifikasi p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }

        /* ===== CARD ===== */
        .card {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #000;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        /* ===== PRODUCT INFO ===== */
        .product-info {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .product-info img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-detail h4 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #000;
        }

        .product-detail p {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .product-price {
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }

        /* ===== GRID 2 KOLOM ===== */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        /* ===== INFO ROW ===== */
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #666;
            font-size: 14px;
        }

        .info-value {
            color: #000;
            font-weight: 500;
            font-size: 14px;
        }

        /* ===== FORM ELEMENTS ===== */
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            resize: vertical;
            min-height: 100px;
        }

        textarea:focus {
            outline: none;
            border-color: #000;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background: #fff;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #000;
        }

        /* ===== TOTAL BOX ===== */
        .total-box {
            background: #000;
            color: #fff;
            padding: 20px 25px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .total-box span:first-child {
            font-size: 18px;
        }

        .total-amount {
            font-size: 28px;
            font-weight: bold;
        }

        /* ===== BUTTONS ===== */
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .btn {
            padding: 14px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-back {
            background: #fff;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-back:hover {
            background: #f5f5f5;
            border-color: #999;
        }

        .btn-confirm {
            background: #000;
            color: #fff;
        }

        .btn-confirm:hover {
            background: #333;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .product-info {
                flex-direction: column;
            }

            .product-info img {
                width: 100%;
                height: 200px;
            }

            .button-group {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }

            .total-box {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- ===== HEADER ===== -->
    <header>
        <div class="header-content">
            <h1>JashPhoto</h1>
        </div>
    </header>

    <!-- ===== CONTAINER ===== -->
    <div class="container">
        <h2 class="page-title">Checkout Booking</h2>

        <!-- NOTIFIKASI -->
        <div class="notifikasi">
            <p>⚠️ Pastikan semua data sudah benar sebelum konfirmasi</p>
        </div>

        <form method="POST">
            
            <!-- PAKET YANG DIPILIH -->
            <article class="card">
                <h3>📦 Paket yang Dipilih</h3>
                <div class="product-info">
                    <img src="photo/<?= $product['foto'] ?? 'default.jpg' ?>" alt="<?= $product['name'] ?>">
                    <div class="product-detail">
                        <h4><?= $product['name'] ?></h4>
                        <p><?= $product['description'] ?? 'Deskripsi paket fotografer profesional' ?></p>
                        <div class="product-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></div>
                    </div>
                </div>
            </article>

            <!-- GRID 2 KOLOM: FOTOGRAFER & JADWAL -->
            <div class="grid-2">
                <!-- FOTOGRAFER -->
                <article class="card">
                    <h3>📷 Fotografer</h3>
                    <div class="info-row">
                        <span class="info-label">Nama Fotografer</span>
                        <span class="info-value"><?= $photographer['name'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Lokasi</span>
                        <span class="info-value"><?= $photographer['lokasi'] ?? '-' ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Rating</span>
                        <span class="info-value">⭐ <?= number_format($photographer['rating'], 1) ?>/5.0</span>
                    </div>
                </article>

                <!-- JADWAL -->
                <article class="card">
                    <h3>📅 Jadwal</h3>
                    <div class="info-row">
                        <span class="info-label">Tanggal</span>
                        <span class="info-value"><?= date('d F Y', strtotime($tanggal)) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Waktu</span>
                        <span class="info-value"><?= $jam_mulai ?> - <?= $jam_selesai ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Durasi</span>
                        <span class="info-value"><?= $durasi ?> Jam</span>
                    </div>
                </article>
            </div>

            <!-- GRID 2 KOLOM: PEMESAN & LOKASI -->
            <div class="grid-2">
                <!-- DATA PEMESAN -->
                <article class="card">
                    <h3>👤 Data Pemesan</h3>
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value"><?= $user['name'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= $user['email'] ?></span>
                    </div>
                </article>

                <!-- LOKASI PEMOTRETAN -->
                <article class="card">
                    <h3>📍 Lokasi Pemotretan</h3>
                    <label for="location">Alamat Lengkap</label>
                    <textarea name="location" id="location" required placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat"></textarea>
                </article>
            </div>

            <!-- METODE PEMBAYARAN -->
            <article class="card">
                <h3>💳 Metode Pembayaran</h3>
                <label for="metode_pembayaran">Pilih Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet (OVO, GoPay, Dana)</option>
                    <option value="Tunai">Tunai</option>
                </select>
            </article>

            <!-- TOTAL PEMBAYARAN -->
            <div class="total-box">
                <span>Total Pembayaran</span>
                <span class="total-amount">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="button-group">
                <button type="button" class="btn btn-back" onclick="history.back()">Kembali</button>
                <button type="submit" name="konfirmasi" class="btn btn-confirm">Konfirmasi Booking</button>
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