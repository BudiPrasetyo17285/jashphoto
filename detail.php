<?php
require_once "database/products.php";
require_once "database/photographer.php";

// Cek apakah ada ID di URL
if (!isset($_GET['id'])) {
    echo "Produk tidak ditemukan.";
    exit;
}

// Ambil produk utama
$product = getProductById($_GET['id']);

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit;
}

// Ambil fotografer berdasarkan id_photographer pada produk
$photographer = getPhotographerById($product['id_photographer']);

// Ambil portofolio fotografer
$portfolio = getPortfolioByPhotographer($product['id_photographer']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
</head>
<body>

<h1><?= $product['name'] ?></h1>
<img src="uploads/<?= $product['image'] ?>" width="250">
<p><?= $product['deskripsi'] ?></p>
<p><b>Harga: Rp <?= number_format($product['price']) ?></b></p>

<hr>

<h2>Fotografer</h2>
<p>Nama: <?= $photographer['name'] ?></p>
<p>Email: <?= $photographer['email'] ?></p>
<p>No HP: <?= $photographer['no_hp'] ?></p>
<p>Lokasi: <?= $photographer['lokasi'] ?></p>
<p>Rating: <?= $photographer['rating'] ?></p>
<p>Bio: <?= $photographer['bio'] ?></p>

<h2>Portofolio Fotografer</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">
<?php while ($p = $portfolio->fetch_assoc()): ?>
    <div style="border:1px solid #ccc; padding:10px; width:150px; text-align:center;">
        <img src="uploads/<?= $p['image'] ?>" width="130">
    </div>
<?php endwhile; ?>
</div>

<br><br>

<a href="categories.php?id=<?= $product['id_categories'] ?>">← Kembali ke Kategori</a><br>
<a href="jadwal.php">Pilih Jadwal</a>

</body>
</html>
