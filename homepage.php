<!DOCTYPE html>
<head>
    <title>JashPhoto - Temukan Fotografer Terbaik</title>
    <link rel="stylesheet" href="styles/homepage.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <img src="logo.png" alt="JashPhoto">
                    <h2>JashPhoto</h2>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#fotografer">Fotografer</a></li>
                    <li><a href="#kategori">Kategori</a></li>
                    <li><a href="login.php" class="btn-login">Login</a></li>
                    <li><a href="register.php" class="btn-register">Register</a></li>
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
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Temukan Fotografer Terbaik di Daerahmu</h1>
                <p>Layanan pencarian fotografer cepat dan mudah untuk berbagai kebutuhan</p>
                
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari fotografer berdasarkan kota atau nama...">
                    <button class="btn-search" id="btnSearch">
                        🔍 Cari
                    </button>
                </div>
                
                <div class="hero-buttons">
                    <a href="#fotografer" class="btn-primary">Mulai Cari Fotografer</a>
                    <a href="#kategori" class="btn-secondary">Lihat Semua Kategori</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="kategori" id="kategori">
        <div class="container">
            <h2 class="section-title">Kategori Fotografer</h2>
            <p class="section-subtitle">Pilih kategori sesuai kebutuhanmu</p>
            
            <div class="kategori-grid">
                <div class="kategori-card">
                    <div class="kategori-icon">💒</div>
                    <h3>Wedding</h3>
                    <p>Abadikan momen spesialmu</p>
                    <a href="wedding.php?kategori=wedding" class="kategori-link">Lihat →</a>
                </div>
                
                <div class="kategori-card">
                    <div class="kategori-icon">🎓</div>
                    <h3>Wisuda</h3>
                    <p>Kenangan kelulusan terbaik</p>
                    <a href="list.php?kategori=wisuda" class="kategori-link">Lihat →</a>
                </div>
                
                <div class="kategori-card">
                    <div class="kategori-icon">🎉</div>
                    <h3>Event</h3>
                    <p>Dokumentasi acara lengkap</p>
                    <a href="list.php?kategori=event" class="kategori-link">Lihat →</a>
                </div>
                
                <div class="kategori-card">
                    <div class="kategori-icon">👤</div>
                    <h3>Portrait</h3>
                    <p>Foto pribadi profesional</p>
                    <a href="list.php?kategori=portrait" class="kategori-link">Lihat →</a>
                </div>
                
                <div class="kategori-card">
                    <div class="kategori-icon">📹</div>
                    <h3>Dokumentasi</h3>
                    <p>Liputan berbagai kegiatan</p>
                    <a href="list.php?kategori=dokumentasi" class="kategori-link">Lihat →</a>
                </div>

            </div>
        </div>
    </section>

    <!-- Highlight Fotografer -->
    <section class="highlight" id="fotografer">
        <div class="container">
            <h2 class="section-title">Fotografer Terpopuler</h2>
            <p class="section-subtitle">Fotografer terbaik dan terpercaya</p>
            
            <div class="fotografer-grid">
                <div class="fotografer-card">
                    <div class="fotografer-image">
                        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=400" alt="Fotografer 1">
                        <div class="fotografer-badge">⭐ 4.9</div>
                    </div>
                    <div class="fotografer-info">
                        <h3>Budi Santoso</h3>
                        <p class="fotografer-location">📍 Jakarta</p>
                        <p class="fotografer-category">Wedding & Event</p>
                        <p class="fotografer-price">Mulai dari Rp 2.500.000</p>
                        <a href="detail.php?id=1" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>
                
                <div class="fotografer-card">
                    <div class="fotografer-image">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=400" alt="Fotografer 2">
                        <div class="fotografer-badge">⭐ 4.8</div>
                    </div>
                    <div class="fotografer-info">
                        <h3>Siti Nurhaliza</h3>
                        <p class="fotografer-location">📍 Bandung</p>
                        <p class="fotografer-category">Portrait & Wisuda</p>
                        <p class="fotografer-price">Mulai dari Rp 1.800.000</p>
                        <a href="detail.php?id=2" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>
                
                <div class="fotografer-card">
                    <div class="fotografer-image">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=400" alt="Fotografer 3">
                        <div class="fotografer-badge">⭐ 5.0</div>
                    </div>
                    <div class="fotografer-info">
                        <h3>Farid Ashidiq</h3>
                        <p class="fotografer-location">📍 Purworejo</p>
                        <p class="fotografer-category">Wedding</p>
                        <p class="fotografer-price">Mulai dari Rp 1.500.000</p>
                        <a href="program.php?id=3" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>

                <div class="fotografer-card">
                    <div class="fotografer-image">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400" alt="Fotografer 4">
                        <div class="fotografer-badge">⭐ 4.9</div>
                    </div>
                    <div class="fotografer-info">
                        <h3>Dimas Prakoso</h3>
                        <p class="fotografer-location">📍 Yogyakarta</p>
                        <p class="fotografer-category">Pre-Wedding & Engagement</p>
                        <p class="fotografer-price">Mulai dari Rp 2.200.000</p>
                        <a href="detail.php?id=4" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>

                <div class="fotografer-card">
                    <div class="fotografer-image">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400" alt="Fotografer 5">
                        <div class="fotografer-badge">⭐ 4.7</div>
                    </div>
                    <div class="fotografer-info">
                        <h3>Ratna Sari</h3>
                        <p class="fotografer-location">📍 Bali</p>
                        <p class="fotografer-category">Maternity & Family</p>
                        <p class="fotografer-price">Mulai dari Rp 1.900.000</p>
                        <a href="detail.php?id=5" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>

                <div class="fotografer-card">
                    <div class="fotografer-image">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400" alt="Fotografer 6">
                        <div class="fotografer-badge">⭐ 4.8</div>
                    </div>
                    <div class="fotografer-info">
                        <h3>Rizky Firmansyah</h3>
                        <p class="fotografer-location">📍 Semarang</p>
                        <p class="fotografer-category">Event & Corporate</p>
                        <p class="fotografer-price">Mulai dari Rp 2.000.000</p>
                        <a href="detail.php?id=6" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <a href="list.php" class="btn-more">Lihat Semua Fotografer →</a>
            </div>
        </div>
    </section>

    <!-- CTA Fotografer -->
    <section class="cta-fotografer">
        <div class="container">
            <div class="cta-content">
                <h2>Apakah Kamu Fotografer?</h2>
                <p>Tambahkan portofoliomu dan temukan klien dari daerahmu!</p>
                <a href="register-fotografer.php" class="btn-cta">Daftar Sebagai Fotografer</a>
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="keunggulan">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih JashPhoto?</h2>
            
            <div class="keunggulan-grid">
                <div class="keunggulan-card">
                    <div class="keunggulan-icon">🔍</div>
                    <h3>Pencarian Cepat</h3>
                    <p>Temukan fotografer sesuai kebutuhanmu dalam hitungan detik</p>
                </div>
                
                <div class="keunggulan-card">
                    <div class="keunggulan-icon">📂</div>
                    <h3>Kategori Lengkap</h3>
                    <p>Berbagai kategori fotografer untuk semua kebutuhan</p>
                </div>
                
                <div class="keunggulan-card">
                    <div class="keunggulan-icon">💬</div>
                    <h3>Kontak Langsung</h3>
                    <p>Hubungi fotografer langsung via WhatsApp dengan mudah</p>
                </div>
                
                <div class="keunggulan-card">
                    <div class="keunggulan-icon">🖼️</div>
                    <h3>Portofolio Jelas</h3>
                    <p>Lihat hasil karya fotografer sebelum memutuskan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="testimoni">
        <div class="container">
            <h2 class="section-title">Apa Kata Mereka?</h2>
            
            <div class="testimoni-grid">
                <div class="testimoni-card">
                    <div class="testimoni-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimoni-text">"Sangat membantu! Saya menemukan fotografer wedding yang sempurna untuk acara saya."</p>
                    <div class="testimoni-author">
                        <strong>Dewi Lestari</strong>
                        <span>Klien Wedding</span>
                    </div>
                </div>
                
                <div class="testimoni-card">
                    <div class="testimoni-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimoni-text">"Platform yang mudah digunakan. Banyak pilihan fotografer berkualitas!"</p>
                    <div class="testimoni-author">
                        <strong>Rizki Pratama</strong>
                        <span>Klien Wisuda</span>
                    </div>
                </div>
                
                <div class="testimoni-card">
                    <div class="testimoni-rating">⭐⭐⭐⭐⭐</div>
                    <p class="testimoni-text">"Sebagai fotografer, JashPhoto membantu saya mendapat banyak klien baru!"</p>
                    <div class="testimoni-author">
                        <strong>Andi Wijaya</strong>
                        <span>Fotografer Professional</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel -->
    <section class="artikel">
        <div class="container">
            <h2 class="section-title">Tips & Inspirasi</h2>
            
            <div class="artikel-grid">
                <div class="artikel-card">
                    <div class="artikel-image">
                        <img src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=400" alt="Artikel 1">
                    </div>
                    <div class="artikel-content">
                        <h3>Tips Memilih Fotografer yang Tepat</h3>
                        <p>Panduan lengkap memilih fotografer sesuai budget dan kebutuhan...</p>
                        <a href="#" class="artikel-link">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <div class="artikel-card">
                    <div class="artikel-image">
                        <img src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=400" alt="Artikel 2">
                    </div>
                    <div class="artikel-content">
                        <h3>Cara Membuat Brief Foto yang Baik</h3>
                        <p>Komunikasikan kebutuhanmu dengan jelas kepada fotografer...</p>
                        <a href="#" class="artikel-link">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <div class="artikel-card">
                    <div class="artikel-image">
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400" alt="Artikel 3">
                    </div>
                    <div class="artikel-content">
                        <h3>Ide Foto Wisuda yang Kreatif</h3>
                        <p>Inspirasi pose dan lokasi untuk foto wisuda yang memorable...</p>
                        <a href="#" class="artikel-link">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>📸 JashPhoto</h3>
                    <p>Platform pencarian fotografer terbaik di Indonesia</p>
                    <div class="social-links">
                        <a href="#" class="social-icon">📘</a>
                        <a href="#" class="social-icon">📷</a>
                        <a href="#" class="social-icon">🐦</a>
                        <a href="#" class="social-icon">💼</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Link Cepat</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#fotografer">Fotografer</a></li>
                        <li><a href="#kategori">Kategori</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#">Daftar Fotografer</a></li>
                        <li><a href="#">Cari Fotografer</a></li>
                        <li><a href="#">Bantuan</a></li>
                        <li><a href="#">FAQ</a></li>
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
                <p>&copy; 2024 JashPhoto. All Rights Reserved.</p>
                <div class="footer-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="javascript/
    
    
    
    
    
    homepage.js"></script>
</body>
</html>