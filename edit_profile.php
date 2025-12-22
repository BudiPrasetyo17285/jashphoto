<?php
include 'database/koneksi.php';
session_start();

/* CEK APAKAH USER SUDAH LOGIN */
if(!isset($_SESSION['id'])){
    header("Location: login/index.php");
    exit();
}

/* AMBIL DATA USER YANG SEDANG LOGIN */
$user_id = $_SESSION['id'];
$query = mysqli_query($host, "SELECT * FROM user WHERE id='$user_id'");
$data  = mysqli_fetch_assoc($query);

/* JIKA DATA TIDAK DITEMUKAN */
if(!$data){
    session_destroy();
    header("Location: login/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - JashPhoto</title>
    <link rel="stylesheet" href="styles/profile.css">
</head>

<body>

<!-- HEADER -->
<header class="header">
    <h1>Edit Profile - JashPhoto</h1>
</header>

<!-- BAGIAN SIDEBAR -->
<aside class="sidebar">
    <nav class="menu">
        <a href="index.php">Home</a>
        <a href="profile.php">My Profile</a>
        <a href="riwayat.php">Pesanan</a>

        <a class="dropdown-btn">Kategori</a>
        <section class="submenu">
            <a href="kategori.php?jenis=Wedding">💍 Wedding</a>
            <a href="kategori.php?jenis=Dokumentasi">🎥 Dokumentasi</a>
            <a href="kategori.php?jenis=Wisuda">🎓 Wisuda</a>
            <a href="kategori.php?jenis=Protret">📸 Potret</a>
        </section>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </nav>
</aside>

<!-- BAGIAN UTAMA -->
<main class="main">
    <div class="edit-container">
        <section class="card">
            <h2>✏️ Edit Profile</h2>
            
            <div class="info-note">
                ⚠️ Username dan Nama Lengkap tidak dapat diubah. Hubungi admin jika perlu mengubahnya.
            </div>
            
            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                
                <!-- Upload Foto -->
                <div class="photo-upload">
                    <div class="photo-preview" onclick="document.getElementById('foto').click()">
                        <?php if(!empty($data['foto'])){ ?>
                            <img src="photo/<?= htmlspecialchars($data['foto']) ?>" alt="Current photo" id="preview-img">
                        <?php } else { ?>
                            <span id="preview-text">Klik untuk upload foto profil</span>
                        <?php } ?>
                    </div>
                    <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                    <label for="foto" class="btn-upload">📷 Pilih Foto</label>
                    <small style="display: block; margin-top: 10px; color: #666;">
                        Format: JPG, PNG, GIF. Maksimal 2MB
                    </small>
                </div>

                <!-- Username (Disabled) -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" value="<?= htmlspecialchars($data['username']) ?>" disabled>
                    <small>🔒 Username tidak dapat diubah</small>
                </div>

                <!-- Nama Lengkap (Disabled) -->
                <div class="form-group">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" id="fullname" value="<?= htmlspecialchars($data['fullname']) ?>" disabled>
                    <small>🔒 Nama lengkap tidak dapat diubah</small>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required placeholder="contoh@email.com">
                    <small>📧 Email akan digunakan untuk notifikasi</small>
                </div>

                <!-- No HP -->
                <div class="form-group">
                    <label for="phone">No HP</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($data['no_hp']) ?>" placeholder="08xxxxxxxxxx">
                    <small>📱 Nomor HP untuk dihubungi</small>
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap Anda"><?= htmlspecialchars($data['alamat']) ?></textarea>
                    <small>📍 Alamat lengkap untuk pengiriman</small>
                </div>

                <!-- Button Group -->
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                    <a href="profile.php" class="btn btn-secondary">❌ Batal</a>
                </div>
            </form>
        </section>
    </div>
</main>

<!-- JS DROPDOWN & PREVIEW IMAGE -->
<script>
// Dropdown toggle
document.querySelector('.dropdown-btn').addEventListener('click', function(){
    const submenu = document.querySelector('.submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
});

// Preview image before upload
function previewImage(event) {
    const file = event.target.files[0];
    
    // Validasi file
    if(file) {
        // Cek ukuran file (max 2MB)
        if(file.size > 2097152) {
            alert('❌ Ukuran file terlalu besar! Maksimal 2MB');
            event.target.value = '';
            return;
        }
        
        // Cek tipe file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if(!allowedTypes.includes(file.type)) {
            alert('❌ Format file tidak valid! Gunakan JPG, PNG, atau GIF');
            event.target.value = '';
            return;
        }
        
        // Preview image
        const reader = new FileReader();
        reader.onload = function(){
            const preview = document.querySelector('.photo-preview');
            let previewImg = document.getElementById('preview-img');
            const previewText = document.getElementById('preview-text');
            
            if(previewImg) {
                previewImg.src = reader.result;
            } else {
                if(previewText) previewText.remove();
                previewImg = document.createElement('img');
                previewImg.id = 'preview-img';
                previewImg.src = reader.result;
                preview.appendChild(previewImg);
            }
        };
        reader.readAsDataURL(file);
    }
}
</script>

</body>
</html>