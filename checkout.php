<?php
include "database/koneksi.php";
session_start();

// Cek koneksi database
if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

// Ambil data dari session
$id_user = $_SESSION['id'] ?? 0;
$id_photographer = $_SESSION['id_photographer'] ?? 0;
$id_product = $_SESSION['id_product'] ?? 0;
$tanggal = $_SESSION['tanggal'] ?? '';
$jam_mulai = $_SESSION['jam_mulai'] ?? '';
$jam_selesai = $_SESSION['jam_selesai'] ?? '';

// Validasi: Data booking harus lengkap
if ($id_photographer == 0 || $id_product == 0 || empty($tanggal) || empty($jam_mulai) || empty($jam_selesai)) {
    echo "<script>
            alert('Data booking tidak lengkap! Silakan ulangi dari awal.');
            window.location.href = 'index.php';
          </script>";
    exit;
}

// Validasi: User harus login
if ($id_user == 0) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location.href = '/login';
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

// Ambil 1 foto portofolio fotografer
$sql_foto = "
    SELECT photo.image
    FROM portofolio
    JOIN photo ON portofolio.id_photo = photo.id
    WHERE portofolio.id_photographer = '$id_photographer'
    LIMIT 1
";

$result_foto = mysqli_query($host, $sql_foto);
$foto = mysqli_fetch_assoc($result_foto);
$foto_produk = 'default.png';

if ($foto && !empty($foto['image'])) {
    $foto_produk = $foto['image'];
}



// Proses konfirmasi booking ketika form disubmit
if (isset($_POST['konfirmasi'])) {
    $location = mysqli_real_escape_string($host, $_POST['location']);
    $metode = mysqli_real_escape_string($host, $_POST['metode_pembayaran']);
    $total = $product['price'];
    $status = 'dibayar';

    $sql = "INSERT INTO booking (id_user, id_photographer, id_products, date, start_time, end_time, location, payment_method, total_price, status)
            VALUES ('$id_user', '$id_photographer', '$id_product', '$tanggal', '$jam_mulai', '$jam_selesai', '$location', '$metode', '$total', '$status')";

    if (mysqli_query($host, $sql)) {
        // Hapus session setelah berhasil booking
        unset($_SESSION['tanggal'], $_SESSION['jam_mulai'], $_SESSION['jam_selesai']);
        unset($_SESSION['id_product'], $_SESSION['id_photographer']);
        
        header("Location: riwayat.php");
        exit;
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
    <link rel="stylesheet" href="styles/checkout.css">
</head>
<body>
    <header>
        <h1>JashPhoto</h1>
    </header>

    <main>
        <h1 class="page-title">Checkout Booking</h1>

        <aside class="alert">
            <p>Pastikan semua data sudah benar sebelum konfirmasi</p>
        </aside>

        <form method="POST" id="checkoutForm">
            <section class="card">
                <h2>Paket yang Dipilih</h2>
                <div class="product-section">
                    <img src="photo/<?= $foto_produk ?>" alt="Foto Produk" class="product-image">

                    <div class="product-details">
                        <h3><?= $product['name'] ?></h3>
                        <p><?= $product['deskripsi'] ?></p>
                        <div class="product-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></div>
                    </div>
                </div>
            </section>

            <div class="grid-container">            
                <section class="card">
                    <h2>Fotografer</h2>
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
                        <span class="info-value"><?= number_format($photographer['rating'], 1) ?>/5.0</span>
                    </div>
                </section>
                <section class="card">
                    <h2>Jadwal</h2>
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

            <div class="grid-container">                
                <section class="card">
                    <h2>Data Pemesan</h2>
                    <div class="info-item">
                        <span class="info-label">Nama</span>
                        <span class="info-value"><?= $user['username'] ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= $user['email'] ?></span>
                    </div>
                </section>

                <section class="card">
                    <h2>Lokasi Pemotretan</h2>
                    <label for="location">Alamat Lengkap</label>
                    <textarea name="location" id="location" required placeholder="Contoh: Jl. Malioboro No. 123, Yogyakarta"></textarea>
                </section>

            </div>

            <section class="card">
                <h2>Metode Pembayaran</h2>
                <label for="metode_pembayaran">Pilih Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet (OVO, GoPay, Dana)</option>
                    <option value="Tunai">Tunai</option>
                </select>
            </section>

            <section class="total-section">
                <span class="total-label">Total Pembayaran</span>
                <span class="total-amount">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
            </section>

            <div class="button-container">
                <button type="button" class="btn-back" onclick="history.back()">Kembali</button>
                <button type="submit" name="konfirmasi" class="btn-confirm">Konfirmasi Booking</button>
            </div>

        </form>
    </main>

    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            const confirmed = confirm('Apakah Anda yakin ingin mengkonfirmasi booking ini?');
            if (!confirmed) {
                event.preventDefault();
            }
        });
    </script>

</body>
</html>