



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - JashPhoto Admin</title>
    <body>
    <aside class="sidebar">
        <div class="logo">
            <div class="logo-icon">📸</div>
            <div class="logo-text">JashPhoto</div>
        </div>

        <div class="menu-section">
            <div class="menu-title">Menu</div>
            <a href="dashboard.php" class="menu-item">
                <span>📊</span>
                <span>Dashboard</span>
            </a>
            <a href="#" class="menu-item">
                <span>🛍️</span>
                <span>All Fotografer</span>
            </a>
            <a href="#" class="menu-item">
                <span>📦</span>
                <span>All Order</span>
                <span class="badge">3</span>
            </a>
            <a href="categories.php" class="menu-item active">
                <span>📂</span>
                <span>Categories</span>
            </a>
            <a href="#" class="menu-item">
                <span>👥</span>
                <span>Customer</span>
            </a>
            <a href="#" class="menu-item">
                <span>💬</span>
                <span>Message Center</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">Product & Event</div>
            <a href="#" class="menu-item">
                <span>↩️</span>
                <span>Return Request</span>
                <span class="badge">2</span>
            </a>
            <a href="#" class="menu-item">
                <span>📅</span>
                <span>Calendar</span>
            </a>
            <a href="#" class="menu-item">
                <span>⭐</span>
                <span>Reviews</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">Account</div>
            <a href="#" class="menu-item">
                <span>❓</span>
                <span>Help & Support</span>
            </a>
            <a href="#" class="menu-item">
                <span>📊</span>
                <span>Analytics</span>
            </a>
            <a href="#" class="menu-item">
                <span>⚙️</span>
                <span>Settings</span>
            </a>
            <a href="#" class="menu-item">
                <span>🚪</span>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>Categories</h1>
                <p>Here are the categories you are selling. Manage them any time easily.</p>
            </div>
            <div class="header-right">
                <button class="btn-export">
                    📋 Export List
                </button>
                <button class="btn-add">
                    ➕ Add New Category
                </button>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="controls">
            <div class="search-box">
                <input type="text" placeholder="Search categories">
            </div>
            <div class="filter-controls">
                <select>
                    <option>Sort By: Default</option>
                    <option>Name A-Z</option>
                    <option>Name Z-A</option>
                    <option>Most Items</option>
                </select>
                <button class="btn-filter">
                    ☰ Filter
                </button>
            </div>
        </div>

        <!-- Category Grid -->
        <div class="category-grid">
            <div class="category-card">
                <div class="category-image">
                    💒
                    <div class="category-menu">⋮</div>
                </div>
                <div class="category-info">
                    <div class="category-name">Wedding</div>
                    <div class="category-count">16 sub-category</div>
                </div>
            </div>

            <div class="category-card">
                <div class="category-image">
                    🎓
                    <div class="category-menu">⋮</div>
                </div>
                <div class="category-info">
                    <div class="category-name">Wisuda</div>
                    <div class="category-count">16 sub-category</div>
                </div>
            </div>

            <div class="category-card">
                <div class="category-image">
                    👤
                    <div class="category-menu">⋮</div>
                </div>
                <div class="category-info">
                    <div class="category-name">Portrait</div>
                    <div class="category-count">16 sub-category</div>
                </div>
            </div>

            <div class="category-card">
                <div class="category-image">
                    📹
                    <div class="category-menu">⋮</div>
                </div>
                <div class="category-info">
                    <div class="category-name">Dokumentasi</div>
                    <div class="category-count">16 sub-category</div>
                </div>
            </div>
        </div>
    </main>
</body>
</head>
</html>