<!DOCTYPE html>
<html>
<head>
<title>Riwayat Transaksi | JASHPHOTO</title>
 <link rel="stylesheet" href="styles/riwayat.css">
</head>

<body>

<?php
include 'database/koneksi.php';

// Cek koneksi
if (!$host) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel booking
$sql = "SELECT * FROM booking ORDER BY date DESC, start_time DESC";
$result = mysqli_query($host, $sql);

// Simpan data ke dalam array
$bookings = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
}
?>

<header>Riwayat Transaksi - JASHPHOTO</header>
<main>

    <nav>
        <label for="filter">Filter status: </label>
        <select id="filter" onchange="filterTransaksi()">
            <option value="semua">Semua</option>
            <option value="dibayar">Dibayar</option>
            <option value="pending">Pending</option>
            <option value="batal">Batal</option>
        </select>
    </nav>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
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
                            <td><?= htmlspecialchars($booking['id']) ?></td>
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