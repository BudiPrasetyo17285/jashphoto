<?php
require '../database/products.php';

$products = [];

$categorySlug = isset($_GET['kategori']) ? $_GET['kategori'] : null;
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

$allCategories = getCategories();
$allProduct = getAllProducts($categorySlug, $searchQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kami</title>
    <link rel="stylesheet" href="kategori.css?v=<?= time() ?>">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <img src="../LOGOjp.png" alt="JashPhoto">
                    <h2>JashPhoto</h2>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="/homepage.php">Home</a></li>
                    <li><a href="#fotografer">Fotografer</a></li>
                    <li><a href="/kategori class="active">Kategori</a></li>
                    <li><a href="/login.php" class="btn-login">Login</a></li>
                    <li><a href="/register.php" class="btn-register">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="header">
            <div class="header_title">
                <div class="breadcrumb">
                    <?php
                        $breadcrumb = ['Home' => '/homepage.php', 'Kategori' => '/kategori'];
                        
                        foreach ($breadcrumb as $name => $link) {
                            echo "<a href=\"$link\">$name</a> ";
                        }
                    ?>
                </div>
                <h1>Produk Kami</h1>
            </div>
            <form action="/kategori" method="GET">
                <div class="input_container">
                    <input type="text" name="search" placeholder="Cari produk..." value="<?= htmlspecialchars($searchQuery) ?>">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                    </button>
                </div>
            </form>
        </div>    
        <div class="content_container">
            <aside class="category_container">
                <a href="/kategori">Reset filter</a>
                <h3>
                    Kategory
                    <span class="arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
                    </span>
                </h3>
                <div class="category_wrapper">
                    <?php
                    foreach ($allCategories as $category) {
                        $isActive = ($category['slug'] === $categorySlug) ? 'class="active"' : '';
                        $isChecked = ($category['slug'] === $categorySlug) ? 'checked' : '';
                        echo "<div $isActive><a href=\"/kategori?kategori={$category['slug']}\">{$category['name']}</a></div>\n";
                    }
                    ?>
                </div>
            </aside>
            <div class="content">
                <?php
                    foreach($allProduct as $product) {
                        $image = ($product["images"] != "[null]") ? "../photo/" . json_decode($product["images"])[0] : "../LOGOjp.png";
                        $productname = $product["product_name"];
                        $photographer = $product["name"];
                        $description = $product["deskripsi"];
                        $price = number_format($product["price"], 0, ',', '.');
                        $location = $product["lokasi"];
                        $rating = $product["rating"];
                        $duration = $product["durasi_jam"];
                        
                        echo ""?>
                        <div class="product_card">
                            <div class="image_container">
                                <img src="<?= $image ?>" alt="<?= htmlspecialchars($productname) ?>">
                            </div>
                            <div class="product_info">
                                <div class="photographer">
                                    Paket oleh 
                                    <span><?= $photographer ?></span>
                                </div>
                                <div class="product_header"><?= $productname ?></div>
                                <p><?= $description?></p>
                                <div class="detail_product">
                                    <div class="detail_item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span><?= $location ?></span>
                                    </div>
                                    <div class="detail_item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-watch-icon lucide-watch"><path d="M12 10v2.2l1.6 1"/><path d="m16.13 7.66-.81-4.05a2 2 0 0 0-2-1.61h-2.68a2 2 0 0 0-2 1.61l-.78 4.05"/><path d="m7.88 16.36.8 4a2 2 0 0 0 2 1.61h2.72a2 2 0 0 0 2-1.61l.81-4.05"/><circle cx="12" cy="12" r="6"/></svg>
                                        <span><?= $duration ?> Jam</span>
                                    </div>
                                </div>
                                <div class="product_price">
                                    <p>Mulai dari</p>
                                    <span>Rp <?= $price ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    } 
                ?>
            </div>
        </div>    
    </main>
</body>
</html>