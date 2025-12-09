<?php

require "database/products.php";

$products = getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="styles/products.css">
</head>
<body>
    <h1>Products</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <h2><?= $product["name"] ?></h2>
                <p><?= $product["deskripsi"] ?></p>
                <span>Price: <?= number_format($product["price"], 2) ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>