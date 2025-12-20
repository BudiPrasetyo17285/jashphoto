<!DOCTYPE html>
<html>
<head>
<title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="styles/riwayat.css">
</head>

<body>

<?php
// Hubungkan ke database
include 'database/koneksi.php';

// Mulai session
session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['id'])) {
    // Kalau belum login, arahkan ke halaman login
    header("Location: login/login.php");
    exit();
}

// Ambil ID user yang sedang login
$user_id = $_SESSION['id'] ?? 1;

// Query untuk ambil data booking milik user ini saja
$sql = "SELECT booking.*, products.name as product_name 
        FROM booking 
        LEFT JOIN products ON booking.id_products = products.id 
        WHERE booking.id_user = '$user_id' 
        ORDER BY booking.date DESC, booking.start_time DESC";

// Jalankan query
$result = mysqli_query($host, $sql);

// Simpan semua data ke array
$bookings = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}
?>

<!-- HEADER -->
<header class="header">
    <h1>JashPhoto Riwayat Transaksi</h1>
    <a href="Homepage.php" class="home-link">Home</a>
</header>

<!-- BAGIAN UTAMA -->
<main class="main-content">
    <nav class="filter-nav">
        <label for="filter">Filter status: </label>
        <select id="filter" onchange="filterTransaksi()">
            <option value="semua">Semua</option>
            <option value="dibayar">Dibayar</option>
            <option value="pending">Pending</option>
            <option value="batal">Batal</option>
        </select>
    </nav>

    <section class="table-container">
        <table>
         <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Lokasi</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
         </thead>

            <tbody id="dataTransaksi">
                <?php if (count($bookings) > 0): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr class="row-data" data-status="<?= strtolower($booking['status']) ?>">
                            <td><?= $booking['product_name'] ?></td>
                            <td><?= $booking['date'] ?></td>
                            <td><?= $booking['start_time'] ?> - <?= $booking['end_time'] ?></td>
                            <td><?= $booking['location'] ?></td>
                            <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                            <td>
                                <span class="status <?= strtolower($booking['status']) ?>">
                                    <?= $booking['status'] ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="kosong">
                            Belum ada riwayat transaksi.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

</main>

<script>
function filterTransaksi() {
    const filter = document.getElementById("filter").value;
    const rows = document.querySelectorAll(".row-data");
    
    rows.forEach(row => {
        if (filter === "semua") {
            row.style.display = "";
        } else {
            const status = row.getAttribute("data-status");
            row.style.display = status === filter ? "" : "none";
        }
    });
}
</script>

</body>
</html>