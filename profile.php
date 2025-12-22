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
    <title>Dashboard Profile - JashPhoto</title>
    <link rel="stylesheet" href="styles/profile.css">
</head>

<body>

<!-- HEADER -->
<header class="header">
    <h1>JashPhoto My Profile</h1>
</header>

<!-- BAGIAN SIDEBAR -->
<aside class="sidebar">
    <nav class="menu">
        <a href="index.php">Home</a>
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
    <section class="card profile-card">
        <figure>
            <?php if(!empty($data['foto'])){ ?>
                <img src="photo/<?= htmlspecialchars($data['foto']) ?>" alt="Foto profil <?= htmlspecialchars($data['username']) ?>">
            <?php } else { ?>
                <img src="https://via.placeholder.com/150" alt="Foto profil default">
            <?php } ?>
        </figure>

        <section class="profile-info">
            <h3><?= htmlspecialchars($data['username']) ?></h3>
            <address><?= htmlspecialchars($data['email']) ?></address>
        </section>
    </section>

    <section class="card">
        <a href="edit_profile.php" class="btn-edit">✏️ Edit Profile</a>
        <h3>Personal Information</h3>

        <section class="info-grid">
            <section class="info-item">
                <label>Username</label>
                <p><?= htmlspecialchars($data['username']) ?></p>
            </section>

            <section class="info-item">
                <label>Nama Lengkap</label>
                <p><?= !empty($data['fullname']) ? htmlspecialchars($data['fullname']) : '-' ?></p>
            </section>

            <section class="info-item">
                <label>Email</label>
                <p><?= htmlspecialchars($data['email']) ?></p>
            </section>

            <section class="info-item">
                <label>No HP</label>
                <p><?= !empty($data['no_hp']) ? htmlspecialchars($data['no_hp']) : '-' ?></p>
            </section>

            <section class="info-item">
                <label>Alamat</label>
                <p><?= !empty($data['alamat']) ? htmlspecialchars($data['alamat']) : '-' ?></p>
            </section>
        </section>
    </section>

</main>

<!-- JS DROPDOWN -->
<script>
document.querySelector('.dropdown-btn').addEventListener('click', function(){
    const submenu = document.querySelector('.submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
});
</script>

</body>
</html>