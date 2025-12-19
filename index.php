<!DOCTYPE html>
<html lang="id">
<head>
    <title>JashPhoto - Find the Best Photographer</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

    <!-- HEADER: Bagian atas halaman -->
    <header class="header">
        <div class="container">
            <!-- Logo website -->
            <h1 class="logo">JashPhoto</h1>
            
            <!-- Menu navigasi -->
            <nav class="nav">
                <a href="#" class="nav-link active">Home</a>
                <a href="#kategori" class="nav-link">Kategori</a>
                <a href="#" class="nav-link">Login</a>
            </nav>
        </div>
    </header>

    <!-- MAIN: Konten utama halaman -->
    <main>
        
        <!-- HERO SECTION: Bagian pembuka dengan judul besar -->
        <section class="hero">
            <div class="container">
                <h2 class="hero-title">Find the Best Photographer</h2>
                <p class="hero-text">Temukan fotografer profesional untuk setiap momen spesial Anda</p>
                
                <!-- Form pencarian -->
                <div class="search-box">
                    <input type="text" placeholder="Cari fotografer" class="search-input">
                    <button class="search-btn">Search</button>
                </div>
            </div>
        </section>

        <!-- KATEGORI SECTION: Daftar kategori fotografer -->
        <section id="kategori" class="kategori-section">
            <div class="container">
                <h3 class="section-title">OUR SERVICES</h3>
                
                <!-- Grid kategori -->
                <div class="kategori-grid">
                    
                    <!-- Card Kategori 1: Wedding -->
                    <article class="kategori-card" data-kategori="wedding">
                        <div class="kategori-image">
                            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=600" alt="Wedding Photography">
                        </div>
                        <div class="kategori-info">
                            <h4 class="kategori-name">WEDDING</h4>
                            <p class="kategori-desc">Abadikan momen pernikahan Anda</p>
                        </div>
                    </article>

                    <!-- Card Kategori 2: Portrait -->
                    <article class="kategori-card" data-kategori="portrait">
                        <div class="kategori-image">
                            <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=600" alt="Portrait Photography">
                        </div>
                        <div class="kategori-info">
                            <h4 class="kategori-name">PORTRAIT</h4>
                            <p class="kategori-desc">Foto pribadi yang profesional</p>
                        </div>
                    </article>

                    <!-- Card Kategori 3: Event -->
                    <article class="kategori-card" data-kategori="event">
                        <div class="kategori-image">
                            <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=600" alt="Event Photography">
                        </div>
                        <div class="kategori-info">
                            <h4 class="kategori-name">EVENT</h4>
                            <p class="kategori-desc">Dokumentasi acara lengkap</p>
                        </div>
                    </article>

                    <!-- Card Kategori 4: Wisuda -->
                    <article class="kategori-card" data-kategori="wisuda">
                        <div class="kategori-image">
                            <img src="https://osingstudio.com/wp-content/uploads/2019/11/foto-wisuda-keren-latar-wisuda-Osing-Studio.jpg" alt="Graduation Photography">
                        </div>
                        <div class="kategori-info">
                            <h4 class="kategori-name">WISUDA</h4>
                            <p class="kategori-desc">Kenangan kelulusan terbaik</p>
                        </div>
                    </article>

                    <!-- Card Kategori 5: Documentation -->
                    <article class="kategori-card" data-kategori="documentation">
                        <div class="kategori-image">
                            <img src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=600" alt="Documentation Photography">
                        </div>
                        <div class="kategori-info">
                            <h4 class="kategori-name">DOCUMENTATION</h4>
                            <p class="kategori-desc">Liputan berbagai kegiatan</p>
                        </div>
                    </article>

                </div>
            </div>
        </section>

        <!-- HIGHLIGHT PHOTOGRAPHER SECTION: Fotografer unggulan -->
        <section class="photographer-section">
            <div class="container">
                <h3 class="section-title">FEATURED PHOTOGRAPHERS</h3>
                
                <!-- Grid fotografer -->
                <div class="photographer-grid">
                    
                    <!-- Card Fotografer 1 -->
                    <article class="photographer-card">
                        <div class="photographer-image">
                            <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=400" alt="Budi Santoso">
                        </div>
                        <div class="photographer-info">
                            <h4 class="photographer-name">Budi Santoso</h4>
                            <p class="photographer-category">Wedding & Event</p>
                            <p class="photographer-price">Mulai dari Rp 2.500.000</p>
                            <button class="btn-detail">Lihat Detail</button>
                        </div>
                    </article>

                    <!-- Card Fotografer 2 -->
                    <article class="photographer-card">
                        <div class="photographer-image">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400" alt="Siti Nurhaliza">
                        </div>
                        <div class="photographer-info">
                            <h4 class="photographer-name">Siti Nurhaliza</h4>
                            <p class="photographer-category">Portrait & Wisuda</p>
                            <p class="photographer-price">Mulai dari Rp 1.800.000</p>
                            <button class="btn-detail">Lihat Detail</button>
                        </div>
                    </article>

                    <!-- Card Fotografer 3 -->
                    <article class="photographer-card">
                        <div class="photographer-image">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400" alt="Ahmad Fauzi">
                        </div>
                        <div class="photographer-info">
                            <h4 class="photographer-name">Ahmad Fauzi</h4>
                            <p class="photographer-category">Event & Documentation</p>
                            <p class="photographer-price">Mulai dari Rp 2.000.000</p>
                            <button class="btn-detail">Lihat Detail</button>
                        </div>
                    </article>

                    <!-- Card Fotografer 4 -->
                    <article class="photographer-card">
                        <div class="photographer-image">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400" alt="Maya Kusuma">
                        </div>
                        <div class="photographer-info">
                            <h4 class="photographer-name">Maya Kusuma</h4>
                            <p class="photographer-category">Wisuda & Portrait</p>
                            <p class="photographer-price">Mulai dari Rp 1.700.000</p>
                            <button class="btn-detail">Lihat Detail</button>
                        </div>
                    </article>

                    <!-- Card Fotografer 5 -->
                    <article class="photographer-card">
                        <div class="photographer-image">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400" alt="Hendra Saputra">
                        </div>
                        <div class="photographer-info">
                            <h4 class="photographer-name">Hendra Saputra</h4>
                            <p class="photographer-category">Wedding Photography</p>
                            <p class="photographer-price">Mulai dari Rp 3.000.000</p>
                            <button class="btn-detail">Lihat Detail</button>
                        </div>
                    </article>

                    <!-- Card Fotografer 6 -->
                    <article class="photographer-card">
                        <div class="photographer-image">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400" alt="Lina Hartono">
                        </div>
                        <div class="photographer-info">
                            <h4 class="photographer-name">Lina Hartono</h4>
                            <p class="photographer-category">Portrait & Product</p>
                            <p class="photographer-price">Mulai dari Rp 1.600.000</p>
                            <button class="btn-detail">Lihat Detail</button>
                        </div>
                    </article>

                </div>
            </div>
        </section>

        <section class="cta-fotografer">
            <div class="container">
                <div class="cta-content">
                    <h2>Apakah Kamu Fotografer?</h2>
                    <p>Bergabunglah dengan kami dan temukan klien baru</p>
                    <a href="register-fotografer.php" class="btn-cta">Daftar Sekarang</a>
                </div>
            </div>
        </section>
        
    </main>

    <!-- FOOTER: Bagian bawah halaman -->
    <footer class="footer">
        <div class="container">
            <p class="footer-text">JashPhoto - Platform marketplace jasa fotografer profesional di Indonesia</p>
            <p class="footer-copyright">&copy; 2024 JashPhoto. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Link ke file JavaScript -->
    <script src="homepage.js"></script>
</body>
</html>