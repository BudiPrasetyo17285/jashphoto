<?php
include 'database/koneksi.php';
session_start();

/* simulasi login */
$user_id = 1;

$query = mysqli_query($host, "SELECT * FROM user WHERE id='$user_id'");
$data  = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Saya</title>

<style>
*{
    box-sizing: border-box;
}

body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f2f4f7;
}

/* ===== HEADER ===== */
header{
    background:#2563eb;
    color:white;
    padding:16px 30px;
}

header h2{
    margin:0;
}

/* ===== CONTAINER ===== */
main{
    max-width:900px;
    margin:40px auto;
    padding:0 20px;
}

/* ===== CARD ===== */
.card{
    background:white;
    border-radius:12px;
    padding:30px;
    display:flex;
    gap:30px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* FOTO */
.profile-img{
    text-align:center;
}

.profile-img img{
    width:150px;
    height:150px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #e5e7eb;
}

/* INFO */
.profile-info{
    flex:1;
}

.profile-info h3{
    margin-top:0;
    font-size:22px;
}

.profile-info p{
    margin:8px 0;
    color:#374151;
}

/* ===== BUTTON ===== */
.actions{
    margin-top:25px;
    display:flex;
    gap:12px;
}

.btn{
    padding:10px 18px;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
    display:inline-block;
}

.btn-primary{
    background:#2563eb;
    color:white;
}

.btn-secondary{
    background:#e5e7eb;
    color:#111827;
}

/* ===== FOOTER ===== */
footer{
    text-align:center;
    margin-top:40px;
    color:#6b7280;
    font-size:14px;
}
</style>
</head>

<body>

<header>
    <h2>Profil Pengguna</h2>
</header>

<main>
    <section class="card">

        <div class="profile-img">
            <?php if(!empty($data['foto'])){ ?>
                <img src="photo/<?= $data['foto'] ?>">
            <?php } else { ?>
                <img src="https://via.placeholder.com/150">
            <?php } ?>
        </div>

        <div class="profile-info">
            <h3><?= $data['username'] ?></h3>
            <p><strong>Email:</strong> <?= $data['email'] ?></p>
            <p><strong>No HP:</strong> <?= $data['no_hp'] ?></p>
            <p><strong>Alamat:</strong> <?= $data['alamat'] ?></p>

            <div class="actions">
                <a href="edit_profile.php" class="btn btn-primary">Edit Profil</a>
                <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

    </section>
</main>

<footer>
    &copy; <?= date('Y') ?> Profil Saya
</footer>

</body>
</html>
