<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Fotografer - JashPhoto</title>
    <style>
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Layout Utama - Full Screen Split */
        .main-layout {
            display: flex;
            min-height: 100vh;
        }

        /* ========== KIRI: MENU CARDS ========== */
        .left-section {
            width: 35%;
            background: url("foforegister.jpeg") center/cover no-repeat;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 30px;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .left-header {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .left-header h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .left-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .menu-card {
            background-color: transparent;
            padding: 50px 40px;
            border-radius: 15px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .menu-card:hover::before {
            left: 100%;
        }

        .menu-card:hover {
            transform: translateX(10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .menu-card-icon {
            font-size: 60px;
            margin-bottom: 20px;
            display: block;
        }

        .menu-card h3 {
            font-size: 28px;
            color: #333;
            margin-bottom: 15px;
        }

        .menu-card p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        .arrow {
            position: absolute;
            top: 30px;
            right: 30px;
            font-size: 40px;
            color: #ccc;
            transition: all 0.3s ease;
        }

        .menu-card:hover .arrow {
            color: #2e2e2eff;
            transform: translateX(10px);
        }

        /* ========== KANAN: PROFILE & PORTFOLIO ========== */
        .right-section {
            width: 65%;
            background-color: white;
            overflow-y: auto;
            padding: 60px;
        }

        /* Profile Container */
        .profile-container {
            margin-bottom: 60px;
        }

        .profile-content {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        /* Foto Profil */
        .profile-image-wrapper {
            flex-shrink: 0;
        }

        .profile-image {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid #585858ff;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .profile-stats {
            margin-top: 20px;
            text-align: center;
        }

        .stat-item {
            margin: 12px 0;
            color: #666;
            font-size: 15px;
        }

        .rating {
            color: #f8d6a3ff;
            font-weight: bold;
            font-size: 20px;
        }

        /* Info Fotografer */
        .profile-info {
            flex: 1;
        }

        .profile-info h1 {
            font-size: 42px;
            color: #333;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .profile-info .bio {
            color: #666;
            font-size: 17px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        /* Spesialisasi */
        .specialties {
            margin: 25px 0;
        }

        .specialties h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .specialty-tags {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .tag {
            background: linear-gradient(135deg, #454546ff 0%, #363636ff 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .stat-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 25px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-box .number {
            font-size: 32px;
            font-weight: bold;
            color: #222222ff;
            margin-bottom: 5px;
        }

        .stat-box .label {
            font-size: 14px;
            color: #666;
        }

        /* Kontak */
        .contact-box {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #181818ff;
        }

        .contact-box h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .contact-box p {
            color: #555;
            font-size: 15px;
            margin: 8px 0;
        }

        /* Divider */
        .divider {
            height: 2px;
            background: linear-gradient(90deg, #474747ff, #764ba2, transparent);
            margin: 50px 0;
        }

        /* Portfolio Section */
        .portfolio-section {
            margin-top: 50px;
        }

        .portfolio-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .portfolio-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #030303ff 0%, #444444ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .portfolio-header-text h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 5px;
        }

        .portfolio-header-text p {
            color: #666;
            font-size: 16px;
        }

        /* Portfolio Grid */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .portfolio-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            cursor: pointer;
            height: 300px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .portfolio-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .portfolio-item:hover img {
            transform: scale(1.15);
        }

        .portfolio-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
            padding: 30px;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }

        .portfolio-overlay p {
            font-size: 16px;
            font-weight: 500;
        }

        .btn-view-all {
            display: block;
            width: 250px;
            margin: 0 auto;
            padding: 18px 40px;
            background: linear-gradient(135deg, #000000ff 0%, #313131ff 100%);
            color: white;
            text-align: center;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-view-all:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        /* Modal Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.95);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .lightbox-content img {
            width: 100%;
            height: auto;
            border-radius: 15px;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: rgba(255,255,255,0.2);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 35px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .lightbox-close:hover {
            background-color: rgba(255,255,255,0.4);
            transform: rotate(90deg);
        }

        .lightbox-title {
            color: white;
            text-align: center;
            margin-top: 25px;
            font-size: 22px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-layout {
                flex-direction: column;
            }

            .left-section {
                width: 100%;
                height: auto;
                position: relative;
            }

            .right-section {
                width: 100%;
            }

            .portfolio-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .profile-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .right-section {
                padding: 30px 20px;
            }

            .left-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main-layout">
        <!-- ========== KIRI: MENU CARDS ========== -->
        <div class="left-section">
            <div class="left-header">
                <h2>📸 JashPhoto</h2>
                <p>Layanan Profesional untuk Momen Terbaik Anda</p>
            </div>

            <!-- Card Lihat Jadwal -->
            <a href="jadwal.html" class="menu-card">
                <span class="menu-card-icon">📅</span>
                <h3>Lihat Jadwal</h3>
                <p>Cek ketersediaan jadwal fotografer dan booking tanggal yang Anda inginkan untuk acara spesial Anda</p>
                <span class="arrow">→</span>
            </a>

            <!-- Card Lihat Paket -->
            <a href="paket.html" class="menu-card">
                <span class="menu-card-icon">📦</span>
                <h3>Lihat Paket</h3>
                <p>Pilih paket layanan photography yang sesuai dengan kebutuhan dan budget Anda</p>
                <span class="arrow">→</span>
            </a>
        </div>

        <!-- ========== KANAN: PROFILE & PORTFOLIO ========== -->
        <div class="right-section">
            <!-- Profile Container -->
            <div class="profile-container">
                <div class="profile-content">
                    <!-- Foto Profil & Stats -->
                    <div class="profile-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop" alt="Budi Santoso" class="profile-image" id="fotoProfil">
                        <div class="profile-stats">
                            <div class="stat-item">
                                <span class="rating">⭐ 4.8</span>
                                <p>(127 reviews)</p>
                            </div>
                            <div class="stat-item">
                                <p>📍 Yogyakarta</p>
                            </div>
                            <div class="stat-item">
                                <p>📷 350+ Projects</p>
                            </div>
                        </div>
                    </div>

                    <!-- Info & Deskripsi -->
                    <div class="profile-info">
                        <h1 id="namaFotografer">Budi Santoso</h1>
                        <p class="bio" id="bioFotografer">
                            Fotografer profesional dengan pengalaman 8+ tahun di bidang wedding, prewedding, dan event photography. 
                            Saya percaya bahwa setiap momen adalah cerita yang layak diabadikan dengan sempurna. Dengan pendekatan 
                            kreatif dan teknologi terkini, saya siap membantu Anda mengabadikan momen berharga.
                        </p>

                        <!-- Spesialisasi -->
                        <div class="specialties">
                            <h3>Spesialisasi:</h3>
                            <div class="specialty-tags">
                                <span class="tag">Wedding</span>
                                <span class="tag">Prewedding</span>
                                <span class="tag">Event</span>
                                <span class="tag">Portrait</span>
                            </div>
                        </div>

                        <!-- Stats Grid -->
                        <div class="stats-grid">
                            <div class="stat-box">
                                <div class="number">8+</div>
                                <div class="label">Tahun Pengalaman</div>
                            </div>
                            <div class="stat-box">
                                <div class="number">350+</div>
                                <div class="label">Project Selesai</div>
                            </div>
                            <div class="stat-box">
                                <div class="number">127</div>
                                <div class="label">Total Review</div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="contact-box">
                            <h3>Kontak:</h3>
                            <p>📧 budi.photo@gmail.com</p>
                            <p>📱 +62 812-3456-7890</p>
                            <p>🌐 www.budisantoso-photography.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Portfolio Section -->
            <div class="portfolio-section">
                <div class="portfolio-header">
                    <div class="portfolio-icon">🖼️</div>
                    <div class="portfolio-header-text">
                        <h2>Portfolio</h2>
                        <p>Hasil karya terbaik yang telah saya ciptakan untuk klien</p>
                    </div>
                </div>

                <!-- Portfolio Grid -->
                <div class="portfolio-grid" id="portfolioGrid">
                    <!-- Portfolio items akan ditambahkan dengan JavaScript -->
                </div>

                <a href="#" class="btn-view-all">Lihat Semua Portfolio</a>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div class="lightbox" id="lightbox">
        <button class="lightbox-close" onclick="closeLightbox()">×</button>
        <div class="lightbox-content">
            <img src="" alt="" id="lightboxImage">
            <p class="lightbox-title" id="lightboxTitle"></p>
        </div>
    </div>

    <script>
        // Data portfolio (nanti bisa diambil dari database PHP)
        const portfolioData = [
            { id: 1, url: "https://images.unsplash.com/photo-1519741497674-611481863552?w=600&h=400&fit=crop", title: "Wedding Sarah & Andi" },
            { id: 2, url: "https://images.unsplash.com/photo-1606800052052-a08af7148866?w=600&h=400&fit=crop", title: "Prewedding Linda & Eko" },
            { id: 3, url: "https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=600&h=400&fit=crop", title: "Wedding Fitri & Dimas" },
            { id: 4, url: "https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=600&h=400&fit=crop", title: "Corporate Event" },
            { id: 5, url: "https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=600&h=400&fit=crop", title: "Portrait Session" },
            { id: 6, url: "https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=600&h=400&fit=crop", title: "Wedding Rina & Budi" },
            { id: 7, url: "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&h=400&fit=crop", title: "Prewedding Siti & Ahmad" },
            { id: 8, url: "https://images.unsplash.com/photo-1525258686509-7d87e93c6fbb?w=600&h=400&fit=crop", title: "Birthday Party" }
        ];

        // Fungsi untuk menampilkan portfolio
        function displayPortfolio() {
            const grid = document.getElementById('portfolioGrid');
            
            portfolioData.forEach(item => {
                // Buat elemen portfolio item
                const portfolioItem = document.createElement('div');
                portfolioItem.className = 'portfolio-item';
                portfolioItem.onclick = () => openLightbox(item.url, item.title);
                
                // Tambahkan gambar
                const img = document.createElement('img');
                img.src = item.url;
                img.alt = item.title;
                
                // Tambahkan overlay
                const overlay = document.createElement('div');
                overlay.className = 'portfolio-overlay';
                overlay.innerHTML = `<p>${item.title}</p>`;
                
                // Gabungkan semua
                portfolioItem.appendChild(img);
                portfolioItem.appendChild(overlay);
                grid.appendChild(portfolioItem);
            });
        }

        // Fungsi untuk membuka lightbox
        function openLightbox(imageUrl, title) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxTitle = document.getElementById('lightboxTitle');
            
            lightboxImage.src = imageUrl;
            lightboxTitle.textContent = title;
            lightbox.classList.add('active');
        }

        // Fungsi untuk menutup lightbox
        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
        }

        // Tutup lightbox saat klik di luar gambar
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        // Jalankan fungsi saat halaman dimuat
        window.onload = function() {
            displayPortfolio();
        };
    </script>
</body>
</html>