<?php
include "database/koneksi.php";
session_start();

// Cek koneksi database
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

// Validasi: Data booking harus lengkap
if ($id_photographer == 0 || $id_product == 0 || empty($tanggal) || empty($jam_mulai) || empty($jam_selesai)) {
    echo "<script>
            alert('Data booking tidak lengkap! Silakan ulangi dari awal.');
            window.location.href = 'homepage.php';
          </script>";
    exit;
}

// Validasi: User harus login
if ($id_user == 0) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location.href = 'login.php';
          </script>";
    exit;
}

// Ambil data user dari database
$sql_user = "SELECT * FROM user WHERE id = '$id_user'";
$result_user = mysqli_query($host, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Ambil data photographer dari database
$sql_photographer = "SELECT * FROM photographer WHERE id = '$id_photographer'";
$result_photographer = mysqli_query($host, $sql_photographer);
$photographer = mysqli_fetch_assoc($result_photographer);

// Ambil data product dari database
$sql_product = "SELECT * FROM products WHERE id = '$id_product'";
$result_product = mysqli_query($host, $sql_product);
$product = mysqli_fetch_assoc($result_product);

// Proses konfirmasi booking ketika form disubmit
if (isset($_POST['konfirmasi'])) {
    $location = mysqli_real_escape_string($host, $_POST['location']);
    $metode = mysqli_real_escape_string($host, $_POST['metode_pembayaran']);
    $total = $product['price'];
    $status = 'pending';

    $sql = "INSERT INTO booking (id_user, id_photographer, id_products, date, start_time, end_time, location, payment_method, total_price, status)
            VALUES ('$id_user', '$id_photographer', '$id_product', '$tanggal', '$jam_mulai', '$jam_selesai', '$location', '$metode', '$total', '$status')";

    if (mysqli_query($host, $sql)) {
        // Hapus session setelah berhasil booking
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

// Hitung durasi booking dalam jam
$durasi = (strtotime($jam_selesai) - strtotime($jam_mulai)) / 3600;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - JashPhoto</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

       /* header */
        header {
            background-color: #000;
            color: #fff;
            padding: 10px;
            text-align: left;
            position: sticky;
            top: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 25px;
            letter-spacing: 2px;
        }

        /* Container */
        main {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* ========================================
           JUDUL HALAMAN
        ======================================== */
        .page-title {
            font-size: 32px;
            margin-bottom: 10px;
            color: #000;
        }

        /* ========================================
           BOX NOTIFIKASI
           Peringatan untuk user
        ======================================== */
        .alert {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .alert p {
            color: #856404;
            font-size: 14px;
        }

        /* ========================================
           CARD / KOTAK KONTEN
           Box putih untuk setiap section
        ======================================== */
        .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #000;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        /* ========================================
           SECTION PRODUK
           Info paket fotografer dengan gambar
        ======================================== */
        .product-section {
            display: flex;
            gap: 20px;
        }

        .product-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .product-details h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #000;
        }

        .product-details p {
            color: #666;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }

        /* ========================================
           GRID 2 KOLOM
           Layout untuk card yang berdampingan
        ======================================== */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* ========================================
           BARIS INFO
           Pasangan label dan value
        ======================================== */
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
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

        /* ========================================
           FORM ELEMENTS
           Input, textarea, select
        ======================================== */
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        textarea:focus,
        select:focus {
            outline: none;
            border-color: #000;
        }

        select {
            background-color: #fff;
            cursor: pointer;
        }

        /* ========================================
           BOX TOTAL PEMBAYARAN
           Highlight total harga
        ======================================== */
        .total-section {
            background-color: #000;
            color: #fff;
            padding: 20px 25px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .total-label {
            font-size: 18px;
        }

        .total-amount {
            font-size: 28px;
            font-weight: bold;
        }

        /* ========================================
           TOMBOL
           Button kembali dan konfirmasi
        ======================================== */
        .button-container {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        button {
            padding: 14px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-back {
            background-color: #fff;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-back:hover {
            background-color: #f5f5f5;
            border-color: #999;
        }

        .btn-confirm {
            background-color: #000;
            color: #fff;
        }

        .btn-confirm:hover {
            background-color: #333;
        }

        /* ========================================
           RESPONSIVE DESIGN
           Tampilan mobile
        ======================================== */
        @media (max-width: 768px) {
            /* Grid jadi 1 kolom */
            .grid-container {
                grid-template-columns: 1fr;
            }

            /* Product section jadi vertikal */
            .product-section {
                flex-direction: column;
            }

            .product-image {
                width: 100%;
                height: 200px;
            }

            /* Tombol jadi vertikal */
            .button-container {
                flex-direction: column-reverse;
            }

            button {
                width: 100%;
            }

            /* Total box jadi vertikal */
            .total-section {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <h1>JashPhoto</h1>
    </header>

    <!-- KONTEN UTAMA -->
    <main>
        <h1 class="page-title">Checkout Booking</h1>

        <!-- NOTIFIKASI -->
        <aside class="alert">
            <p>⚠️ Pastikan semua data sudah benar sebelum konfirmasi</p>
        </aside>

        <form method="POST" id="checkoutForm">
            
            <!-- PAKET YANG DIPILIH -->
            <section class="card">
                <h2>📦 Paket yang Dipilih</h2>
                <div class="product-section">
                    <img src="photo/<?= $product['foto'] ?? 'default.jpg' ?>" 
                         alt="<?= $product['name'] ?>" 
                         class="product-image">
                    <div class="product-details">
                        <h3><?= $product['name'] ?></h3>
                        <p><?= $product['description'] ?? 'Paket fotografer profesional' ?></p>
                        <div class="product-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></div>
                    </div>
                </div>
            </section>

            <!-- GRID: FOTOGRAFER & JADWAL -->
            <div class="grid-container">
                
                <!-- FOTOGRAFER -->
                <section class="card">
                    <h2>📷 Fotografer</h2>
                    <div class="info-item">
                        <span class="info-label">Nama Fotografer</span>
                        <span class="info-value"><?= $photographer['name'] ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Lokasi</span>
                        <span class="info-value"><?= $photographer['lokasi'] ?? '-' ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Rating</span>
                        <span class="info-value">⭐ <?= number_format($photographer['rating'], 1) ?>/5.0</span>
                    </div>
                </section>

                <!-- JADWAL -->
                <section class="card">
                    <h2>📅 Jadwal</h2>
                    <div class="info-item">
                        <span class="info-label">Tanggal</span>
                        <span class="info-value"><?= date('d F Y', strtotime($tanggal)) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Waktu</span>
                        <span class="info-value"><?= $jam_mulai ?> - <?= $jam_selesai ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Durasi</span>
                        <span class="info-value"><?= $durasi ?> Jam</span>
                    </div>
                </section>

            </div>

            <!-- GRID: PEMESAN & LOKASI -->
            <div class="grid-container">
                
                <!-- DATA PEMESAN -->
                <section class="card">
                    <h2>👤 Data Pemesan</h2>
                    <div class="info-item">
                        <span class="info-label">Nama</span>
                        <span class="info-value"><?= $user['name'] ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= $user['email'] ?></span>
                    </div>
                </section>

                <!-- LOKASI PEMOTRETAN -->
                <section class="card">
                    <h2>📍 Lokasi Pemotretan</h2>
                    <label for="location">Alamat Lengkap</label>
                    <textarea 
                        name="location" 
                        id="location" 
                        required 
                        placeholder="Contoh: Jl. Malioboro No. 123, Yogyakarta"></textarea>
                </section>

            </div>

            <!-- METODE PEMBAYARAN -->
            <section class="card">
                <h2>💳 Metode Pembayaran</h2>
                <label for="metode_pembayaran">Pilih Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet (OVO, GoPay, Dana)</option>
                    <option value="Tunai">Tunai</option>
                </select>
            </section>

            <!-- TOTAL PEMBAYARAN -->
            <section class="total-section">
                <span class="total-label">Total Pembayaran</span>
                <span class="total-amount">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
            </section>

            <!-- TOMBOL AKSI -->
            <div class="button-container">
                <button type="button" class="btn-back" onclick="history.back()">
                    Kembali
                </button>
                <button type="submit" name="konfirmasi" class="btn-confirm">
                    Konfirmasi Booking
                </button>
            </div>

        </form>
    </main>

    <script>
        // Konfirmasi sebelum submit form
        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            const confirmed = confirm('Apakah Anda yakin ingin mengkonfirmasi booking ini?');
            if (!confirmed) {
                event.preventDefault();
            }
        });
    </script>

</body>
</html>