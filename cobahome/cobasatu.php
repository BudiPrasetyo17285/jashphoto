<?php
session_start();
include "../database/koneksi.php";

// Ambil 4 kategori
$sql_kategori = "SELECT id, name, foto FROM categories LIMIT 4";
$hasil_kategori = mysqli_query($host, $sql_kategori);

// Ambil 4 photographer terbaik
$sql_photographer = "
    SELECT photographer.*, categories.name AS nama_kategori
    FROM photographer
    JOIN categories ON photographer.id_categories = categories.id
    ORDER BY photographer.rating DESC
    LIMIT 4
";
$hasil_photographer = mysqli_query($host, $sql_photographer);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JashPhoto - Find the Best Photographer</title>
    
    <style>
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* ===== HEADER ===== */
        .header {
            background: #000;
            color: #fff;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 30px;
            text-transform: uppercase;
            font-size: 14px;
        }

        .nav a:hover {
            color: #ccc;
        }

        /* ===== HERO SLIDER ===== */
        .hero {
            position: relative;
            width: 100%;
            height: 600px;
            background: #000;
            overflow: hidden;
        }

        /* Slide */
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s;
        }

        .slide.active {
            opacity: 1;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Overlay Text */
        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
        }

        .slide-title {
            font-size: 56px;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
        }

        .slide-text {
            font-size: 22px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
        }

        /* Tombol Panah */
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.3);
            color: #fff;
            border: none;
            font-size: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
        }

        .slider-arrow:hover {
            background: rgba(255,255,255,0.5);
        }

        .slider-arrow.prev {
            left: 20px;
        }

        .slider-arrow.next {
            right: 20px;
        }

        /* Dots Navigation */
        .slider-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s;
        }

        .dot.active {
            background: #fff;
            width: 30px;
            border-radius: 6px;
        }

        /* ===== CONTAINER ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .section-title {
            font-size: 36px;
            text-align: center;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* ===== KATEGORI SECTION ===== */
        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .kategori-card {
            position: relative;
            height: 400px;
            overflow: hidden;
            cursor: pointer;
            border-radius: 8px;
        }

        .kategori-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .kategori-card:hover img {
            transform: scale(1.1);
        }

        .kategori-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: #fff;
            padding: 30px 20px;
        }

        .kategori-overlay h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .kategori-overlay p {
            font-size: 14px;
            color: #ddd;
        }

        /* ===== PHOTOGRAPHER SECTION ===== */
        #photographer {
            background: #f5f5f5;
        }

        .photographer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .photographer-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .photographer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .photographer-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .photographer-info {
            padding: 20px;
            text-align: center;
        }

        .photographer-info h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .photographer-info .category {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .photographer-info .location {
            color: #999;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .photographer-info .rating {
            color: #000;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .btn-detail {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #fff;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 14px;
        }

        .btn-detail:hover {
            background: #333;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #000;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }

        .footer p {
            margin: 5px 0;
            color: #ccc;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .kategori-grid,
            .photographer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .slide-title {
                font-size: 32px;
            }

            .slide-text {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .kategori-grid,
            .photographer-grid {
                grid-template-columns: 1fr;
            }

            .nav a {
                margin-left: 15px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- ===== HEADER ===== -->
    <header class="header">
        <div class="header-content">
            <div class="logo">JashPhoto</div>
            <nav class="nav">
                <a href="#home">Home</a>
                <a href="#kategori">Kategori</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="profil.php">Profil</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="cobalogin.php">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- ===== HERO SLIDER ===== -->
    <section id="home" class="hero">
        <div class="slider-container">
            
            <!-- Slide 1 -->
            <div class="slide active">
                <img src="../photo/slider1.jpg" alt="Slide 1">
                <div class="slide-overlay">
                    <h2 class="slide-title">Find the Best Photographer</h2>
                    <p class="slide-text">Capture Your Special Moments</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide">
                <img src="../photo/slider2.jpg" alt="Slide 2">
                <div class="slide-overlay">
                    <h2 class="slide-title">Professional Photography</h2>
                    <p class="slide-text">For Every Occasion</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide">
                <img src="../photo/slider3.jpeg" alt="Slide 3">
                <div class="slide-overlay">
                    <h2 class="slide-title">Create Lasting Memories</h2>
                    <p class="slide-text">With Expert Photographers</p>
                </div>
            </div>

            <!-- Tombol Panah -->
            <button class="slider-arrow prev" onclick="changeSlide(-1)">‹</button>
            <button class="slider-arrow next" onclick="changeSlide(1)">›</button>

            <!-- Dots -->
            <div class="slider-dots">
                <span class="dot active" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
            </div>

        </div>
    </section>

    <!-- ===== KATEGORI SECTION ===== -->
    <section id="kategori">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            
            <div class="kategori-grid">
                <?php while($kategori = mysqli_fetch_assoc($hasil_kategori)): ?>
                    <div class="kategori-card">
                        <img src="../photo/<?php echo $kategori['foto']; ?>" 
                             alt="<?php echo $kategori['name']; ?>">
                        <div class="kategori-overlay">
                            <h3><?php echo strtoupper($kategori['name']); ?></h3>
                            <p>Layanan fotografi profesional</p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- ===== PHOTOGRAPHER SECTION ===== -->
    <section id="photographer">
        <div class="container">
            <h2 class="section-title">Featured Photographers</h2>
            
            <div class="photographer-grid">
                <?php while($photo = mysqli_fetch_assoc($hasil_photographer)): ?>
                    <div class="photographer-card">
                        <img src="../photo/<?php echo $photo['foto_profil']; ?>" 
                             alt="<?php echo $photo['name']; ?>">
                        
                        <div class="photographer-info">
                            <h3><?php echo $photo['name']; ?></h3>
                            <p class="category"><?php echo $photo['nama_kategori']; ?></p>
                            <p class="location">📍 <?php echo $photo['lokasi']; ?></p>
                            <p class="rating">⭐ <?php echo number_format($photo['rating'], 1); ?>/5.0</p>
                            <button class="btn-detail">Lihat Detail</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <p>JashPhoto - Platform Booking Fotografer Profesional</p>
        <p>&copy; <?php echo date('Y'); ?> JashPhoto. All rights reserved.</p>
    </footer>

    <script>
        // ===== SLIDER =====
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        // Fungsi tampilkan slide
        function showSlide(index) {
            // Sembunyikan semua slide dan dots
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Tampilkan slide yang aktif
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        // Fungsi ganti slide (prev/next)
        function changeSlide(direction) {
            currentSlideIndex += direction;

            // Loop ke awal/akhir
            if (currentSlideIndex >= slides.length) {
                currentSlideIndex = 0;
            } else if (currentSlideIndex < 0) {
                currentSlideIndex = slides.length - 1;
            }

            showSlide(currentSlideIndex);
        }

        // Fungsi klik dot
        function currentSlide(index) {
            currentSlideIndex = index;
            showSlide(currentSlideIndex);
        }

        // Auto slide setiap 5 detik
        setInterval(() => changeSlide(1), 5000);
    </script>

</body>
</html>