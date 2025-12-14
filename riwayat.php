<!DOCTYPE html>
<html>
<head>
<title>Riwayat Transaksi | JASHPHOTO</title>
</head>
 <link rel="stylesheet" href="styles/riwayat.css">
</html>

<body>

<header>Riwayat Transaksi - JASHPHOTO</header>

<main>

    <nav>
        <label for="filter">Filter status: </label>
        <select id="filter" onchange="filterTransaksi()">
            <option value="semua">Semua</option>
            <option value="berhasil">Berhasil</option>
            <option value="pending">Pending</option>
            <option value="gagal">Gagal</option>
        </select>
    </nav>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tablebody id="dataTransaksi">
                <!-- Nanti akan diisi oleh PHP -->
                <tr>
                    <td colspan="5" class="kosong">
                        Belum ada riwayat transaksi.
                    </td>
                </tr>
            </tablebody>
        </table>
    </section>

</main>

<script>
function filterTransaksi() {
    // Karena data kosong, fungsi ini disiapkan untuk nanti saat sudah ada data
    console.log("Filter berubah:", document.getElementById("filter").value);
}
</script>

</body>
</html>