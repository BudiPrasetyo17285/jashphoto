<?php
session_start();
require '../database/photographer.php';

$searchQuery = $_GET["search"] ?? false; 

$photographer = [];

if(!$searchQuery){
    $photographer = getAllPhotographer();
} else {
    $photographer = getPhotographerByName($searchQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotografer | Jashphoto</title>
    <link rel="stylesheet" href="photographer.css?v=<?= time() ?>">
</head>
<body>
     <!-- ===== HEADER ===== -->
    <header class="header_container">
        <div class="header-content">
            <a href="/" class="logo">
                <img src="/images/JPPP.png" alt="Jash Photo">
                <span>JashPhoto</span>
            </a>
            <nav class="nav">
                <a href="/products">Produk</a>
                <a href="/photographer">Fotografer</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="profile.php">Profil</a>
                    <a href="../logout.php">Logout</a>
                <?php else: ?>
                    <a href="../login">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="header">
            <div class="header_title">
                <div class="breadcrumb">
                    <?php
                        $breadcrumb = ['Home' => '/index.php', 'Photographer' => '/'];
                        
                        foreach ($breadcrumb as $name => $link) {
                            echo "<a href=\"$link\">$name</a> ";
                        }
                    ?>
                </div>
                <h1>Temukan Fotografer dan Abadikan Momenmmu</h1>
            </div>
            <form action="/photographer" method="GET">
                <div class="input_container">
                    <input type="text" name="search" placeholder="Cari produk..." value="<?= htmlspecialchars($searchQuery) ?>">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                    </button>
                </div>
            </form>
        </div>    
        <div class="content_container">
            <div class="content">
                <?php
                    foreach($photographer as $item) {
                        $foto_profil = $item["foto_profil"]; 
                        $image = "/photo/profil/" . $foto_profil;
                        $biografi = $item["bio"];
                        $lokasi = $item["lokasi"];
                        $name = $item["name"];
                        
                        // $foto_card = !empty($item["foto"]) ? "photo/profil".$item["foto"] : "../LOGOjp.png";
                        ?>
                        <a href="/portofolio.php?id=<?= $item["id"]?>" class="product_card">
                            <!-- <a href="/portofolio.php?id=<?= $item["id"]?>"></a> -->
                            <div class="image_container">
                                <img src="<?= $image ?>" alt="<?= htmlspecialchars($name) ?>">
                            </div>
                            <div class="product_info">
                                <!-- <div class="photographer">
                                    Paket oleh 
                                    <span><?= $photographer ?></span>
                                </div> -->
                                <div class="product_header"><?= $name ?></div>
                                <p><?= $biografi?></p>
                                <div class="detail_product">
                                    <div class="detail_item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span><?= $lokasi ?></span>
                                    </div>
                                    <!-- <div class="detail_item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-watch-icon lucide-watch"><path d="M12 10v2.2l1.6 1"/><path d="m16.13 7.66-.81-4.05a2 2 0 0 0-2-1.61h-2.68a2 2 0 0 0-2 1.61l-.78 4.05"/><path d="m7.88 16.36.8 4a2 2 0 0 0 2 1.61h2.72a2 2 0 0 0 2-1.61l.81-4.05"/><circle cx="12" cy="12" r="6"/></svg>
                                        <span><?= $duration ?> Jam</span>
                                    </div> -->
                                </div>
                                <!-- <div class="product_price">
                                    <p>Mulai dari</p>
                                    <span>Rp <?= $price ?></span>
                                </div> -->
                            </div>
                        </a>
                        <?php
                    } 
                ?>
            </div>
        </div>    
    </main>
</body>
</html>