
// kategori.php
// require_once 'config.php';

// Get parameters from URL
// $categorySlug = isset($_GET['kategori']) ? $_GET['kategori'] : null;
// $showPopular = isset($_GET['popular']) && $_GET['popular'] == '1';
// $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

// // Get all categories for navigation
// $allCategories = getAllCategories();

// Get current category info
// $currentCategory = null;
// if ($categorySlug) {
//     $currentCategory = getCategoryBySlug($categorySlug);
// }

// Get photographers
// if ($showPopular) {
//     $photographers = getPhotographersByCategory(null, true);
//     $pageTitle = "Fotografer Terpopuler";
//     $pageSubtitle = "Fotografer terbaik dan terpercaya";
// } elseif ($currentCategory) {
//     $photographers = getPhotographersByCategory($currentCategory['id']);
//     $pageTitle = "Kategori: " . $currentCategory['name'];
//     $pageSubtitle = $currentCategory['description'];
// } else {
//     $photographers = getPhotographersByCategory();
//     $pageTitle = "Semua Fotografer";
//     $pageSubtitle = "Temukan fotografer terbaik sesuai kebutuhanmu";
// }

// Filter by search if provided
// if ($searchQuery) {
//     $photographers = array_filter($photographers, function($p) use ($searchQuery) {
//         return stripos($p['name'], $searchQuery) !== false || 
//                stripos($p['city'], $searchQuery) !== false;
//     });
//     $pageTitle = "Hasil Pencarian: " . htmlspecialchars($searchQuery);
}

// $totalResults = count($photographers);
// ?> -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - JashPhoto</title>
    <link rel="stylesheet" href="kategori-style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <a href="index.php" class="logo">
                    <img src="logos/jashphoto.png" alt="JashPhoto">
                    <span>JashPhoto</span>
                </a>
                
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="kategori.php" class="active">Fotografer</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="riwayat.php">Riwayat Pesanan</a></li>
                        <li><a href="profil.php">Profil</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php" class="btn-login">Login</a></li>
                    <?php endif; ?>
                </ul>
                
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1><?= $pageTitle ?></h1>
            <p><?= $pageSubtitle ?></p>
        </div>
    </section>

    <!-- Category Navigation -->
    <section class="category-nav">
        <div class="container">
            <div class="category-pills">
                <a href="kategori.php" class="pill <?= !$categorySlug && !$showPopular ? 'active' : '' ?>">
                    Semua
                </a>
                <a href="kategori.php?popular=1" class="pill <?= $showPopular ? 'active' : '' ?>">
                    ⭐ Terpopuler
                </a>
                <?php foreach ($allCategories as $cat): ?>
                    <a href="kategori.php?kategori=<?= $cat['slug'] ?>" 
                       class="pill <?= $categorySlug === $cat['slug'] ? 'active' : '' ?>">
                        <?= $cat['icon'] ?> <?= $cat['name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Search & Filter -->
    <section class="search-section">
        <div class="container">
            <div class="search-controls">
                <form method="GET" action="kategori.php" class="search-form">
                    <?php if ($categorySlug): ?>
                        <input type="hidden" name="kategori" value="<?= $categorySlug ?>">
                    <?php endif; ?>
                    <?php if ($showPopular): ?>
                        <input type="hidden" name="popular" value="1">
                    <?php endif; ?>
                    
                    <div class="search-box">
                        <input type="text" name="search" placeholder="Cari fotografer atau kota..." 
                               value="<?= htmlspecialchars($searchQuery) ?>">
                        <button type="submit">🔍</button>
                    </div>
                </form>
                
                <div class="result-count">
                    <strong><?= $totalResults ?></strong> fotografer ditemukan
                </div>
            </div>
        </div>
    </section>

    <!-- Fotografer Grid -->
    <section class="fotografer-section">
        <div class="container">
            <?php if ($totalResults > 0): ?>
                <div class="fotografer-grid">
                    <?php foreach ($photographers as $foto): ?>
                        <div class="fotografer-card">
                            <div class="card-image">
                                <img src="<?= $foto['profile_image'] ?>" alt="<?= $foto['name'] ?>">
                                <div class="rating-badge">
                                    ⭐ <?= $foto['rating'] ?>
                                </div>
                            </div>
                            
                            <div class="card-content">
                                <h3><?= $foto['name'] ?></h3>
                                <p class="location">📍 <?= $foto['city'] ?></p>
                                <p class="category"><?= $foto['categories'] ?></p>
                                <p class="price">Mulai dari <?= formatPrice($foto['min_price']) ?></p>
                                
                                <div class="card-actions">
                                    <a href="detail.php?id=<?= $foto['id'] ?>" class="btn-detail">
                                        Lihat Detail
                                    </a>
                                    <a href="https://wa.me/<?= formatWhatsApp($foto['whatsapp']) ?>" 
                                       target="_blank" class="btn-whatsapp" title="Chat via WhatsApp">
                                        💬
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <div class="no-results-icon">🔍</div>
                    <h2>Tidak Ada Fotografer Ditemukan</h2>
                    <p>Maaf, tidak ada fotografer yang sesuai dengan pencarian Anda.</p>
                    <a href="kategori.php" class="btn-back">← Lihat Semua Fotografer</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    
                    <h3>📸 JashPhoto</h3>
                    <p>Platform pencarian fotografer terbaik di Indonesia</p>
                </div>
                
                <div class="footer-section">
                    <h4>Link Cepat</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="kategori.php">Fotografer</a></li>
                        <li><a href="tentang.php">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Kontak</h4>
                    <ul>
                        <li>📧 info@jashphoto.com</li>
                        <li>📱 +62 812-3456-7890</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> JashPhoto. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="kategori-script.js"></script>
</body>
</html>