<!DOCTYPE html>
<html>
<head>
<title>Riwayat Transaksi</title>
 <link rel="stylesheet" href="styles/riwayat.css">
</head>

<body>

<?php
include 'database/koneksi.php';
session_start();

// Cek koneksi
if (!$host) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel booking dan join dengan products
$sql = "SELECT booking.*, products.name as product_name 
        FROM booking 
        LEFT JOIN products ON booking.id_products = products.id 
        ORDER BY booking.date DESC, booking.start_time DESC";
$result = mysqli_query($host, $sql);

// Simpan data ke dalam array
$bookings = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
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
                            <td><?= htmlspecialchars($booking['product_name'] ?? 'Tidak ada produk') ?></td>
                            <td><?= htmlspecialchars($booking['date']) ?></td>
                            <td><?= htmlspecialchars($booking['start_time']) ?> - <?= htmlspecialchars($booking['end_time']) ?></td>
                            <td><?= htmlspecialchars($booking['location']) ?></td>
                            <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                            <td>
                                <span class="status <?= strtolower($booking['status']) ?>">
                                    <?= htmlspecialchars($booking['status']) ?>
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