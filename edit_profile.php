<?php
include 'database/koneksi.php';
session_start();

/* untuk user login */
$user_id = 1;

$sql    = "SELECT * FROM user WHERE id='$user_id'";
$result = mysqli_query($host, $sql);
$data   = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile JASHPHOTO</title>
<link rel="stylesheet" href="styles/edit_profile.css">
</head>

<body>

<h2>Profile JASHPHOTO</h2>

<div class="card">
<form action="update_profile.php" method="POST" enctype="multipart/form-data">

    <!-- KODE BERISI UNTUK FOTO PROFIL -->
    <div class="foto-wrapper" onclick="document.getElementById('foto').click()">
        <?php if(!empty($data['foto'])): ?>
            <img id="preview" src="photo/<?= $data['foto'] ?>">
        <?php else: ?>
            <span id="text">Ganti Foto</span>
            <img id="preview" style="display:none;">
        <?php endif; ?>
    </div>

    <input type="file" name="foto" id="foto" accept="image/*" onchange="previewFoto(this)">

    <!-- KODE UNTUK DATA UTAMA -->
    <label>Username</label>
    <input type="text" value="<?= $data['username'] ?>" disabled>

    <label>Password</label>
    <input type="password" value="<?= $data['password'] ?>" disabled>

    <!-- KODE UNTUK DATA PELENGKAP -->
    <label>Email</label>
    <input type="email" name="email" value="<?= $data['email'] ?>">

    <label>No Telepon</label>
    <input type="text" name="phone" value="<?= $data['no_hp'] ?>">

    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= $data['alamat'] ?>">

    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <button type="submit">Simpan Profil</button>
</form>
</div>

<script>
function previewFoto(input){
    const preview = document.getElementById('preview');
    const text = document.getElementById('text');

    if(input.files && input.files[0]){
        const reader = new FileReader();
        reader.onload = function(e){
            preview.src = e.target.result;
            preview.style.display = 'block';
            if(text) text.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>

