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

<style>
*{box-sizing:border-box}

body{
    margin:0;
    font-family:"Segoe UI", Arial, sans-serif;
    background:#f4f6f8;
    color:#1f2937;
}

/* ===== SIDEBAR ===== */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:250px;
    height:100vh;
    background:white;
    padding:25px 20px;
    box-shadow:4px 0 20px rgba(0,0,0,0.05);
    display:flex;
    flex-direction:column;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
    font-weight:700;
    color:#2563eb;
}

/* ===== MENU ===== */
.menu{
    flex:1;
}

.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 14px;
    margin-bottom:6px;
    border-radius:8px;
    color:#374151;
    text-decoration:none;
    font-size:15px;
    transition:0.3s;
}

/* hover effect (sama semua menu) */
.menu a:hover{
    background:#e0e7ff;
    color:#2563eb;
}

/* ===== DROPDOWN ===== */
.dropdown-btn{
    cursor:pointer;
}

.submenu{
    display:none;
    padding-left:30px;
    margin-top:6px;
}

.submenu a{
    font-size:14px;
    padding:8px 14px;
}

/* ===== LOGOUT ===== */
.logout{
    margin-top:20px;
    border-top:1px solid #e5e7eb;
    padding-top:15px;
}

/* ===== MAIN ===== */
.main{
    margin-left:250px;
    padding:30px 40px;
}

/* ===== CARD ===== */
.card{
    background:white;
    border-radius:16px;
    padding:28px;
    margin-bottom:28px;
    box-shadow:0 15px 35px rgba(0,0,0,0.06);
}

/* PROFILE */
.profile-card{
    display:flex;
    gap:25px;
    align-items:center;
}

.profile-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #e5e7eb;
}

.profile-info h3{
    margin:0;
}

.profile-info span{
    color:#6b7280;
    font-size:14px;
}

/* INFO GRID */
.info-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:22px;
    margin-top:20px;
}

.info-item label{
    font-size:13px;
    color:#6b7280;
}

.info-item p{
    margin:6px 0 0;
    font-weight:500;
}

/* BUTTON */
.btn-edit{
    float:right;
    background:#2563eb;
    color:white;
    padding:8px 16px;
    font-size:13px;
    border-radius:8px;
    text-decoration:none;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
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

        <!-- LOGOUT -->
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
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

<!-- JS DROPDOWN -->
<script>
document.querySelector('.dropdown-btn').addEventListener('click', function(){
    const submenu = document.querySelector('.submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
});
</script>

</body>
</html>
