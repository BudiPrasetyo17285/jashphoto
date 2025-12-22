<?php
include 'database/koneksi.php';
session_start();

/* UNTUK SIMULASI LOGING */
$user_id = $_SESSION['user_id'] ?? 0;
$query = mysqli_query($host, "SELECT * FROM user WHERE id='$user_id'");
$data  = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Profile</title>
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
            <a href="kategori.php?jenis=Wedding">Wedding</a>
            <a href="kategori.php?jenis=Dokumentasi">Dokumentasi</a>
            <a href="kategori.php?jenis=Wisuda">Wisuda</a>
            <a href="kategori.php?jenis=Protret">Potret</a>
        </section>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </nav>
</aside>

<!-- BAGIAN UTAMA -->
<main class="main"> 
    <section class="card profile-card">
        <?php if(!empty($data['foto'])){ ?>
            <img src="photo/<?= $data['foto'] ?>">
        <?php } else { ?>
            <img src="https://via.placeholder.com/150">
        <?php } ?>

        <section class="profile-info">
            <h3><?= $data['email'] ?></h3>
            <span><?= $data['password'] ?></span>
        </section>
    </section>

    <section class="card">
        <a href="edit_profile.php" class="btn-edit">Edit</a>
        <h3>Personal Information</h3>

        <section class="info-grid">
            <section class="info-item">
                <label>Username</label>
                <p><?= $data['username'] ?></p>
            </section>

            <section class="info-item">
                <label>Email</label>
                <p><?= $data['email'] ?></p>
            </section>

            <section class="info-item">
                <label>No HP</label>
                <p><?= $data['no_hp'] ?></p>
            </section>

            <section class="info-item">
                <label>Alamat</label>
                <p><?= $data['alamat'] ?></p>
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