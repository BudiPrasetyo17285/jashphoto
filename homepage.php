<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jashphoto - Platform Jasa Fotografi</title>
    <style>
        /* ========== RESET CSS ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* ========== HEADER ========== */
        header {
            background: linear-gradient(to right, #ef4444, #ec4899);
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            font-style: italic;
            color: white;
            cursor: pointer;
        }

        nav {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: opacity 0.3s;
            cursor: pointer;
        }

        nav a:hover {
            opacity: 0.8;
        }

        .user-icon {
            width: 35px;
            height: 35px;
            background-color: #93c5fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: transform 0.3s;
        }

        .user-icon:hover {
            transform: scale(1.1);
        }

        /* ========== HERO SECTION ========== */
        .hero-section {
            margin-top: 70px;
            height: 450px;
            background-image: url('https://images.unsplash.com/photo-1542038784456-1ea8e935640e?w=1200');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: background-image 0.5s ease-in-out;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-size: 48px;
            font-style: italic;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        /* Search Bar */
        .search-bar {
            background: white;
            border-radius: 50px;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .search-bar input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 16px;
        }

        .search-bar button {
            background: none;
            border: none;
            color: #06b6d4;
            font-size: 20px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .search-bar button:hover {
            transform: scale(1.2);
        }

        .hero-description {
            margin-top: 20px;
            max-width: 600px;
            font-size: 13px;
            line-height: 1.6;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        /* Slide Buttons */
        .slide-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 10;
        }

        .slide-btn:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }

        .slide-btn.prev {
            left: 20px;
        }

        .slide-btn.next {
            right: 20px;
        }

        /* ========== KATEGORI SECTION ========== */
        .kategori-section {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            padding: 60px 20px;
            margin-top: -50px;
            position: relative;
            z-index: 3;
        }

        .kategori-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .kategori-card {
            background: white;
            border: 3px solid #06b6d4;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .kategori-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
            background: #f0fdff;
        }

        .kategori-card.active {
            background: #06b6d4;
            color: white;
        }

        .kategori-card h3 {
            font-size: 18px;
            font-style: italic;
        }

        /* ========== KATALOG SECTION ========== */
        .katalog-section {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            padding: 60px 20px 80px 20px;
        }

        .katalog-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            color: white;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .filter-info {
            color: white;
            font-size: 16px;
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
        }

        .reset-btn {
            background: white;
            color: #06b6d4;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
            transition: all 0.3s;
        }

        .reset-btn:hover {
            background: #f0f0f0;
            transform: scale(1.05);
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }

        .card-header {
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .seller-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ec4899, #ef4444);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .seller-info h4 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
            color: #333;
        }

        .seller-info p {
            font-size: 11px;
            color: #666;
        }

        .card-image {
            width: 100%;
            height: 200px;
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2px;
            height: 200px;
        }

        .image-grid img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 40px;
        }

        .card-stats {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 12px;
            font-size: 12px;
            color: #666;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .star {
            color: #fbbf24;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #f0f0f0;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #06b6d4;
        }

        .location {
            font-size: 11px;
            color: #999;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            color: white;
            padding: 60px 20px;
        }

        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Loading Animation */
        .loading {
            text-align: center;
            color: white;
            padding: 40px;
            font-size: 18px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }

            nav {
                gap: 15px;
                font-size: 14px;
            }

            .logo {
                font-size: 22px;
            }

            .hero-section {
                height: 350px;
            }

            .hero-content h1 {
                font-size: 32px;
            }

            .search-bar {
                width: 90%;
                padding: 12px 20px;
            }

            .hero-description {
                font-size: 12px;
            }

            .slide-btn {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .slide-btn.prev {
                left: 10px;
            }

            .slide-btn.next {
                right: 10px;
            }

            .kategori-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .kategori-card {
                padding: 30px 15px;
            }

            .section-title {
                font-size: 28px;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- ========== HEADER ========== -->
    <header>
        <div class="logo" onclick="resetAll()">Jashphoto</div>
        <nav>
            <a onclick="scrollToSection('hero')">beranda</a>
            <a onclick="alert('Fitur keranjang belum tersedia')">keranjang</a>
            <a onclick="alert('Fitur chat belum tersedia')">chat</a>
            <a onclick="alert('Fitur login belum tersedia')">login</a>
            <div class="user-icon" onclick="alert('Profil user')">👤</div>
        </nav>
    </header>

    <!-- ========== HERO SECTION ========== -->
    <section class="hero-section" id="hero">
        <div class="hero-overlay"></div>
        
        <button class="slide-btn prev" onclick="slideImage(-1)" aria-label="Previous">‹</button>
        
        <div class="hero-content">
            <h1>Jashphoto</h1>
            
            <div class="search-bar">
                <input 
                    type="text" 
                    placeholder="Cari jasa fotografi..." 
                    id="searchInput"
                    aria-label="Search">
                <button onclick="searchProduct()" aria-label="Search">🔍</button>
            </div>

            <p class="hero-description">
                Selamat pun keunjungi dengan sebuah profil anu aya di Jash tu kami mau hargain kalian dan 
                keluarga beserta dengan sebuang sukuny pamamarahan kalian kami pun harus nyata panas 
                pancénan panasnaeun dan tekenkeun ayeuna anjeuk jeung kalayan kami sangat pemanaranan 
                dipencarian pamamaranan, dan tekenkeun ayeuna anjeuk jeung kalayan kami sangat pemanaranan 
                dengan pemanaranan...
            </p>
        </div>

        <button class="slide-btn next" onclick="slideImage(1)" aria-label="Next">›</button>
    </section>

    <section class="kategori-section" id="kategori">
        <div class="kategori-container">
            <div class="kategori-grid">
                <div class="kategori-card" onclick="filterByCategory('prewedding')" data-category="prewedding">
                    <h3>prewedding</h3>
                </div>
                <div class="kategori-card" onclick="filterByCategory('prewedding')" data-category="prewedding">
                    <h3>prewedding</h3>
                </div>
                <div class="kategori-card" onclick="filterByCategory('wedding')" data-category="wedding">
                    <h3>wedding</h3>
                </div>
                <div class="kategori-card" onclick="filterByCategory('dokumentasi')" data-category="dokumentasi">
                    <h3>dokumentasi</h3>
                </div>
                <div class="kategori-card" onclick="filterByCategory('event')" data-category="event">
                    <h3>event</h3>
                </div>
                <div class="kategori-card" onclick="filterByCategory('graduation')" data-category="graduation">
                    <h3>graduation</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== KATALOG SECTION ========== -->
    <section class="katalog-section" id="katalog">
        <div class="katalog-container">
            <div class="section-header">
                <h2 class="section-title">📸 Jasa Fotografi Terbaik</h2>
                <div class="filter-info" id="filterInfo">
                    Menampilkan semua produk
                </div>
            </div>
            
            <div class="product-grid" id="productGrid">
                <!-- Products will be rendered here by JavaScript -->
            </div>
        </div>
    </section>

    <!-- ========== JAVASCRIPT ========== -->
    <script>
        // ========== SLIDESHOW CONFIGURATION ==========
        const images = [
            'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?w=1200',
            'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1200',
            'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=1200',
            'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200'
        ];

        let currentIndex = 0;
        let currentFilter = null; // Track active filter

        // ========== PRODUCT DATA ==========
        const products = [
            {
                seller: "wijuHT",
                sellerTime: "terdaftar dalam 27 menit",
                image: "https://images.unsplash.com/photo-1511578314322-379afb476865?w=400",
                imageType: "single",
                title: "JASA FOTO EVENT PROFESIONAL 1 HARI JADI (JABODEBEK)",
                sold: 17,
                rating: 4.9,
                reviews: 118,
                price: "Rp450.000",
                location: "Jakarta",
                category: "event"
            },
            {
                seller: "Mochamad Yusuf",
                sellerTime: "terdaftar dalam 6 menit",
                image: "https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=400",
                imageType: "single",
                title: "Jasa Fotografi Interior & Properti : Jabodebabek, Serang, Cilegon",
                sold: 2,
                rating: 5.0,
                reviews: 42,
                price: "Rp1.000.000",
                location: "Jakarta",
                category: "dokumentasi"
            },
            {
                seller: "Neng Eppy Photoworks",
                sellerTime: "terdaftar dalam 1 jam",
                image: "https://images.unsplash.com/photo-1563245372-f21724e3856d?w=400",
                imageType: "single",
                title: "(JABODEBEK) JASA FOTO PRODUK, MAKANAN HALAL DAN MINUMAN",
                sold: 2,
                rating: 5.0,
                reviews: 2,
                price: "Rp100.000",
                location: "Jakarta",
                category: "dokumentasi"
            },
            {
                seller: "krisbiansandy",
                sellerTime: "terdaftar dalam 1 jam",
                images: [
                    "https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400",
                    "https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=400",
                    "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400",
                    "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400"
                ],
                imageType: "grid",
                title: "JABODEBEK & LUAR KOTA - JASA FOTO MAKANAN & MINUMAN",
                sold: 116,
                rating: 4.9,
                reviews: 869,
                price: "Rp150.000",
                location: "Jakarta",
                category: "dokumentasi"
            },
            {
                seller: "the.contactshot 80",
                sellerTime: "terdaftar dalam 1 menit",
                image: "https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=400",
                imageType: "single",
                title: "Jasa Fotografer Untuk Event Kota Bandung",
                sold: 1,
                rating: 5.0,
                reviews: 1,
                price: "Rp1.500.000",
                location: "Bandung",
                category: "event"
            },
            {
                seller: "Matthew T",
                sellerTime: "terdaftar dalam 22 menit",
                image: "https://images.unsplash.com/photo-1464047736614-af63643285bf?w=400",
                imageType: "single",
                title: "[JABODEBEK] JASA FOTO & VIDEO BIRTHDAY, SWEET SEVENTEEN, SANGAIT",
                sold: 78,
                rating: 4.9,
                reviews: 664,
                price: "Rp500.000",
                location: "Jakarta",
                category: "event"
            },
            {
                seller: "MK Studio",
                sellerTime: "terdaftar dalam 6 jam",
                image: "https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=400",
                imageType: "single",
                title: "Jasa Foto Produk Murah [JABODEBEK]",
                sold: 4,
                rating: 5.0,
                reviews: 1,
                price: "Rp120.000",
                location: "Jakarta",
                category: "dokumentasi"
            },
            {
                seller: "grogoh",
                sellerTime: "terdaftar dalam 5 menit",
                image: "https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400",
                imageType: "single",
                title: "[Bandung] Jasa Foto Produk Murah",
                sold: 99,
                rating: 4.9,
                reviews: 405,
                price: "Rp100.000",
                location: "Bandung",
                category: "dokumentasi"
            },
            {
                seller: "Wedding Dreams",
                sellerTime: "terdaftar dalam 2 jam",
                image: "https://images.unsplash.com/photo-1519741497674-611481863552?w=400",
                imageType: "single",
                title: "Paket Foto Wedding Lengkap + Video Cinematic",
                sold: 45,
                rating: 4.8,
                reviews: 234,
                price: "Rp3.500.000",
                location: "Jakarta",
                category: "wedding"
            },
            {
                seller: "PreWed Studio",
                sellerTime: "terdaftar dalam 3 jam",
                image: "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=400",
                imageType: "single",
                title: "Jasa Foto Prewedding Indoor & Outdoor Premium",
                sold: 67,
                rating: 4.9,
                reviews: 456,
                price: "Rp2.000.000",
                location: "Bandung",
                category: "prewedding"
            },
            {
                seller: "Graduation Moments",
                sellerTime: "terdaftar dalam 1 hari",
                image: "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400",
                imageType: "single",
                title: "Foto Wisuda & Graduation - Paket Hemat",
                sold: 89,
                rating: 5.0,
                reviews: 123,
                price: "Rp350.000",
                location: "Jakarta",
                category: "graduation"
            }
        ];

        // ========== SLIDESHOW FUNCTIONS ==========
        function slideImage(direction) {
            currentIndex = currentIndex + direction;

            if (currentIndex >= images.length) {
                currentIndex = 0;
            } else if (currentIndex < 0) {
                currentIndex = images.length - 1;
            }

            document.querySelector('.hero-section').style.backgroundImage = 
                `url('${images[currentIndex]}')`;
        }

        // Auto slide every 5 seconds
        setInterval(() => slideImage(1), 5000);

        // ========== PRODUCT CARD CREATION ==========
        function createProductCard(product) {
            const card = document.createElement('div');
            card.className = 'product-card';

            // Create image HTML based on type
            let imageHTML = '';
            if (product.imageType === 'grid') {
                imageHTML = `
                    <div class="card-image">
                        <div class="image-grid">
                            ${product.images.map(img => `<img src="${img}" alt="Produk ${product.title}">`).join('')}
                        </div>
                    </div>
                `;
            } else {
                imageHTML = `
                    <div class="card-image">
                        <img src="${product.image}" alt="Produk ${product.title}">
                    </div>
                `;
            }

            card.innerHTML = `
                <div class="card-header">
                    <div class="seller-avatar">${product.seller.charAt(0).toUpperCase()}</div>
                    <div class="seller-info">
                        <h4>${product.seller}</h4>
                        <p>${product.sellerTime}</p>
                    </div>
                </div>

                ${imageHTML}

                <div class="card-body">
                    <div class="card-title">${product.title}</div>
                    
                    <div class="card-stats">
                        <div class="stat-item">
                            <span>Terjual ${product.sold}</span>
                        </div>
                        <div class="stat-item">
                            <span class="star">⭐</span>
                            <span>${product.rating} (${product.reviews})</span>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="price">${product.price}</div>
                        <div class="location">📍 ${product.location}</div>
                    </div>
                </div>
            `;

            // Add click event
            card.addEventListener('click', () => {
                alert(`📸 ${product.title}\n\n💰 Harga: ${product.price}\n👤 Seller: ${product.seller}\n📍 Lokasi: ${product.location}\n⭐ Rating: ${product.rating} (${product.reviews} ulasan)`);
            });

            return card;
        }

        // ========== RENDER PRODUCTS ==========
        function renderProducts(filteredProducts = products) {
            const productGrid = document.getElementById('productGrid');
            productGrid.innerHTML = ''; // Clear existing

            if (filteredProducts.length === 0) {
                productGrid.innerHTML = `
                    <div class="empty-state">
                        <h3>🔍 Tidak ada produk ditemukan</h3>
                        <p>Coba kata kunci atau kategori lain</p>
                    </div>
                `;
                return;
            }

            filteredProducts.forEach(product => {
                const card = createProductCard(product);
                productGrid.appendChild(card);
            });
        }

        // ========== FILTER BY CATEGORY ==========
        function filterByCategory(category) {
            currentFilter = category;
            
            // Update active state on category cards
            document.querySelectorAll('.kategori-card').forEach(card => {
                card.classList.remove('active');
            });
            document.querySelectorAll(`[data-category="${category}"]`).forEach(card => {
                card.classList.add('active');
            });

            // Filter products
            const filtered = products.filter(p => p.category === category);
            renderProducts(filtered);

            // Update filter info
            const filterInfo = document.getElementById('filterInfo');
            filterInfo.innerHTML = `
                Kategori: ${category.toUpperCase()} (${filtered.length} produk)
                <button class="reset-btn" onclick="resetAll()">Lihat Semua</button>
            `;

            // Smooth scroll to catalog
            scrollToSection('katalog');
        }

        // ========== SEARCH FUNCTION ==========
        function searchProduct() {
            const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
            
            if (keyword === '') {
                alert('❗ Masukkan kata kunci pencarian');
                return;
            }

            currentFilter = 'search';

            // Filter products by title or seller
            const filtered = products.filter(p => 
                p.title.toLowerCase().includes(keyword) ||
                p.seller.toLowerCase().includes(keyword) ||
                p.location.toLowerCase().includes(keyword)
            );

            renderProducts(filtered);

            // Update filter info
            const filterInfo = document.getElementByIgit