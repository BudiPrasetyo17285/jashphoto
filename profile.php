<?php
include 'database/koneksi.php';
session_start();

/* UNTUK SIMULASI LOGING */
$user_id = 1;
$query = mysqli_query($host, "SELECT * FROM user WHERE id='$user_id'");
$data  = mysqli_fetch_assoc($query);

/* MENGAMBIL KATEGORI */
$kategori = mysqli_query($host, "SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Profile</title>
    <link rel="stylesheet" href="styles/profile.css">
</head>

<body>

<!-- BAGIAN SIDEBAR -->
<aside class="sidebar">
    <h2>JASHPHOTO</h2>

    <nav class="menu">
        <a href="homepage.php">Home</a>
        <a href="riwayat.php">Pesanan</a>

        <a class="dropdown-btn">Kategori</a>
        <section class="submenu">
            <?php while($row = mysqli_fetch_assoc($kategori)) { ?>
                <a href="kategori.php?jenis=<?= $row['name'] ?>">
                    <?= $row['name'] ?>
                </a>
            <?php } ?>
        </section>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </nav>
</aside>

<!-- BAGIAN UTAMA -->
<main class="main">

    <h2>My Profile</h2>

    <section class="card profile-card">
        <?php if(!empty($data['foto'])){ ?>
            <img src="photo/<?= $data['foto'] ?>">
        <?php } else { ?>
            <img src="https://via.placeholder.com/150">
        <?php } ?>

        <section class="profile-info">
            <h3><?= $data['username'] ?></h3>
            <span><?= $data['email'] ?></span>
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

<!-- JS DROPDOWN (TETAP SAMA) -->
<script>
document.querySelector('.dropdown-btn').addEventListener('click', function(){
    const submenu = document.querySelector('.submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
});
</script>

</body>
</html>
