<?php
session_start();
include "database/koneksi.php";

if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

$id = (int) ($_GET['id'] ?? 0);
$_SESSION['id_photographer'] = $id;

$queryPhotographer = mysqli_query(
    $host,
    "SELECT name, foto_profil FROM photographer WHERE id = $id"
);
$photographer = mysqli_fetch_assoc($queryPhotographer);

if (!$photographer) {
    echo "<script>alert('Fotografer tidak ditemukan!');location='index.php';</script>";
    exit;
}

$queryPaket = mysqli_query(
    $host,
    "SELECT * FROM products WHERE id_photographer = $id"
);
$paket = mysqli_fetch_all($queryPaket, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Paket - <?= $photographer['name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/lihatpaket.css">
</head>
<body>

<main class="container">

    <!-- HEADER HALAMAN -->
    <header>
        <div class="info-header">
            <figure>
                <img src="photo/<?= $photographer['foto_profil']; ?>"
                     alt="Foto <?= $photographer['name']; ?>"
                     class="foto">
            </figure>
            <div>
                <h1>Pilih Paket</h1>
                <p class="subtitle">
                    Fotografer: <strong><?= $photographer['name']; ?></strong>
                </p>
            </div>
        </div>
    </header>

    <!-- DAFTAR PAKET -->
    <?php if ($paket): ?>
    <section class="grid-paket" aria-label="Daftar Paket Fotografi">
        <?php foreach ($paket as $item): ?>
        <article class="card">
            <header class="card-header">
                <h2 class="nama-paket"><?= $item['name']; ?></h2>
                <p class="harga">
                    Rp <?= number_format($item['price'], 0, ',', '.'); ?>
                </p>
            </header>

            <div class="card-body">
                <p class="deskripsi"><?= nl2br($item['deskripsi']); ?></p>
                <p class="durasi">
                    ⏱️ Durasi: <strong><?= $item['durasi_jam']; ?> Jam</strong>
                </p>
                <button class="btn btn-pilih"
                        onclick="pilihPaket(<?= $item['id']; ?>,'<?= $item['name']; ?>')">
                    Pilih Paket
                </button>
            </div>
        </article>
        <?php endforeach; ?>
    </section>
    <?php else: ?>

    <!-- JIKA KOSONG -->
    <section class="kosong" aria-live="polite">
        <h2>Belum ada paket</h2>
        <p>Fotografer ini belum menambahkan paket</p>
    </section>

    <?php endif; ?>

    <!-- NAVIGASI -->
    <nav aria-label="Navigasi Halaman">
        <a href="portofolio.php?id=<?= $id; ?>" class="btn-nav btn-kembali">Kembali</a>
        <a href="schedule.php" class="btn-nav btn-jadwal">Lihat Jadwal</a>
    </nav>

</main>

<script>
function pilihPaket(id, nama) {
    if (confirm(`Pilih paket "${nama}"?\n\nSelanjutnya pilih jadwal.`)) {
        location = 'schedule.php?paket=' + id;
    }
}
</script>

</body>
</html>
