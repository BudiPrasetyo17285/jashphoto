<?php
include 'database/koneksi.php';
session_start();

/* simulasi user login */
$user_id = 1;

$sql    = "SELECT * FROM user WHERE id='$user_id'";
$result = mysqli_query($host, $sql);
$data   = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile JASHPHOTO</title>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f2f4f7;
    margin:0;
}

h2{
    text-align:center;
    margin-top:30px;
}

.card{
    background:white;
    padding:25px;
    border-radius:12px;
    max-width:600px;
    margin:30px auto;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
}

/* FOTO PROFIL */
.foto-wrapper{
    width:120px;
    height:120px;
    border-radius:50%;
    border:2px dashed #aaa;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    margin:0 auto 20px;
    overflow:hidden;
    background:#f9fafb;
}

.foto-wrapper span{
    font-size:13px;
    color:#555;
}

.foto-wrapper img{
    width:100%;
    height:100%;
    object-fit:cover;
}

input[type="file"]{
    display:none;
}

/* FORM */
label{
    font-weight:bold;
    margin-top:10px;
    display:block;
}

input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border-radius:6px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#2563eb;
    color:white;
    font-size:15px;
    cursor:pointer;
}

button:hover{
    background:#1e40af;
}
</style>
</head>

<body>

<h2>Profile JASHPHOTO</h2>

<div class="card">
<form action="update_profile.php" method="POST" enctype="multipart/form-data">

    <!-- FOTO PROFIL -->
    <div class="foto-wrapper" onclick="document.getElementById('foto').click()">
        <?php if(!empty($data['foto'])): ?>
            <img id="preview" src="photo/<?= $data['foto'] ?>">
        <?php else: ?>
            <span id="text">Ganti Foto</span>
            <img id="preview" style="display:none;">
        <?php endif; ?>
    </div>

    <input type="file" name="foto" id="foto" accept="image/*" onchange="previewFoto(this)">

    <!-- DATA UTAMA -->
    <label>Username</label>
    <input type="text" value="<?= $data['username'] ?>" disabled>

    <label>Password</label>
    <input type="password" value="<?= $data['password'] ?>" disabled>

    <!-- DATA PELENGKAP -->
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

