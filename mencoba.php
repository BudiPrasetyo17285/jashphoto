<?php
include "database/koneksi.php";
session_start();

/* ===============================
   CEK KONEKSI DATABASE
=============================== */
if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

/* ===============================
   AMBIL DATA KATEGORI
=============================== */
$data_kategori = [];

$sql_kategori = "SELECT * FROM categories";
$query_kategori = mysqli_query($host, $sql_kategori);

while ($row = mysqli_fetch_assoc($query_kategori)) {
    $data_kategori[] = $row;
}

/* ===============================
   AMBIL DATA PHOTOGRAPHER + KATEGORI
=============================== */
$data_photographer = [];

$sql_photographer = "
    SELECT 
        photographer.id,
        photographer.name,
        photographer.rating,
        photographer.foto_profil,
        categories.name AS nama_kategori
    FROM photographer
    JOIN categories ON photographer.id_categories = categories.id
";

$query_photographer = mysqli_query($host, $sql_photographer);

while ($row = mysqli_fetch_assoc($query_photographer)) {
    $data_photographer[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JashPhoto - Find the Best Photographer</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<!-- ================= HEADER ================= -->
<header class="header">
    <div class="container">
        <h1 class="logo">JashPhoto</h1>
        <nav class="nav">
            <a href="#" class="nav-link active">Home</a>
            <a href="#kategori" class="nav-link">Kategori</a>
            <a href="#">Login</a>
        </nav>
    </div>
</header>

<main>

<!-- ================= HERO ================= -->
<section class="hero">
    <div class="container">
        <h2>Find the Best Photographer</h2>
        <p>Temukan fotografer profesional untuk momen spesial Anda</p>

        <input type="text" placeholder="Cari fotografer...">
    </div>
</section>

<!-- ================= KATEGORI ================= -->
<section id="kategori" class="kategori-section">
    <div class="container">
        <h3>OUR SERVICES</h3>

        <div class="kategori-grid">
            <?php foreach ($data_kategori as $kategori): ?>
                <div class="kategori-card">
                    <img src="photo/<?= $kategori['foto']; ?>" alt="<?= $kategori['name']; ?>">
                    <h4><?= strtoupper($kategori['name']); ?></h4>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================= PHOTOGRAPHER ================= -->
<section class="photographer-section">
    <div class="container">
        <h3>FEATURED PHOTOGRAPHERS</h3>

        <div class="photographer-grid">
            <?php foreach ($data_photographer as $p): ?>
                <div class="photographer-card">
                    <img src="<?= $p['foto_profil']; ?>" alt="<?= $p['name']; ?>">

                    <h4><?= $p['name']; ?></h4>
                    <p><?= $p['nama_kategori']; ?></p>
                    <p>Rating: <?= $p['rating']; ?>/5</p>

                    <a href="detail-photographer.php?id=<?= $p['id']; ?>">
                        <button>Lihat Detail</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</main>

<!-- ================= FOOTER ================= -->
<footer class="footer">
    <p>© 2024 JashPhoto</p>
</footer>

<script src="homepage.js"></script>
</body>
</html>
