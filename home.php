<?php
require_once "database/products.php";
require_once "database/user.php";

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["username"];

$allProducts = getAllProducts();
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - JashPhoto</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .category-list a {
            padding: 8px 14px;
            background: #eee;
            margin-right: 8px;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }
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

<h1>JashPhoto</h1>

<p>Selamat Datang, <?= $user ?></p>


<h2>Pilih Kategori</h2>
<div class="category-list">
    <?php foreach ($categories as $cat): ?>
        <a href="categories.php?id=<?= $cat['id']; ?>">
            <?= $cat['name']; ?>
        </a>
    <?php endforeach; ?>
</div>



<hr>

<h2>Semua Produk</h2>
<div class="products">
    <?php foreach ($allProducts as $p): ?>
        <div class="product-card">
            <h3><?= $p['name']; ?></h3>
            <p><?= $p['deskripsi']; ?></p>
            <p><b>Rp <?= number_format($p['price']); ?></b></p>
            <a href="detail.php?id=<?= $p['id']; ?>">Lihat Detail</a>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>


