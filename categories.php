<?php
require_once "database/products.php";

$id_categories = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_categories <= 0) {
    die("Kategori tidak valid!");
}

$categories = getCategories(); // optional (untuk ditampilkan)
$products = getProductsByCategory($id_categories);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kategori</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .product-card {
            width: 240px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 10px;
            background: #fff;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>

<h1>Produk Berdasarkan Kategori</h1>

<a href="home.php">← Kembali ke Home</a>

<hr>

<div class="products">
    <?php if (empty($products)) : ?>
        <p>Tidak ada produk pada kategori ini.</p>
    <?php else : ?>
        <?php foreach ($products as $p): ?>
            <div class="product-card">
                <h3><?= $p['name']; ?></h3>
                <p><?= $p['deskripsi']; ?></p>
                <p><b>Rp <?= number_format($p['price']); ?></b></p>
                <a href="detail.php?id=<?= $p['id']; ?>">Lihat Detail</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
