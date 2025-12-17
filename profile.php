<?php
include 'database/koneksi.php';
session_start();

/* simulasi login */
$user_id = 1;
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

<!-- BAGIAN SIDEBAR -->
<div class="sidebar">
    <h2>JASHPHOTO</h2>

    <div class="menu">
        <a href="homepage.php">Home</a>
        <a href="riwayat.php">Pesanan</a>

        <a class="dropdown-btn">Kategori</a>
        <div class="submenu">
            <a href="kategori.php?jenis=wisuda">🎓 Wisuda</a>
            <a href="kategori.php?jenis=wedding">💍 Wedding</a>
            <a href="kategori.php?jenis=potret">📸 Potret</a>
            <a href="kategori.php?jenis=dokumentasi">🎥 Dokumentasi</a>
        </div>

        <!-- UNTUK LOGOUT -->
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<!-- MAIN UNTUK CONTENT -->
<div class="main">

    <h2>My Profile</h2>

    <div class="card profile-card">
        <?php if(!empty($data['foto'])){ ?>
            <img src="photo/<?= $data['foto'] ?>">
        <?php } else { ?>
            <img src="https://via.placeholder.com/150">
        <?php } ?>

        <div class="profile-info">
            <h3><?= $data['username'] ?></h3>
            <span><?= $data['email'] ?></span>
        </div>
    </div>

    <div class="card">
        <a href="edit_profile.php" class="btn-edit">Edit</a>
        <h3>Personal Information</h3>

        <div class="info-grid">
            <div class="info-item">
                <label>Username</label>
                <p><?= $data['username'] ?></p>
            </div>
            <div class="info-item">
                <label>Email</label>
                <p><?= $data['email'] ?></p>
            </div>
            <div class="info-item">
                <label>No HP</label>
                <p><?= $data['no_hp'] ?></p>
            </div>
            <div class="info-item">
                <label>Alamat</label>
                <p><?= $data['alamat'] ?></p>
            </div>
        </div>
    </div>

</div>

<!-- JS DIGUNAKAN UNTUK DROPDOWN -->
<script>
document.querySelector('.dropdown-btn').addEventListener('click', function(){
    const submenu = document.querySelector('.submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
});
</script>

</body>
</html>
