<?php
include "database/koneksi.php";

// CEK KONEKSI
if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

// Ambil ID dari URL (default 1 jika tidak ada)
$id = $_GET['id'] ?? 9;

// Query profil fotografer
$sql_profil = "SELECT * FROM photographer WHERE id = $id";
$result_profil = mysqli_query($host, $sql_profil);
$profil = mysqli_fetch_assoc($result_profil);

// Query foto portofolio
$sql_foto = "SELECT photo.image FROM portofolio 
              JOIN photo ON portofolio.id_photo = photo.id
              WHERE portofolio.id_photographer = $id";
$result_foto = mysqli_query($host, $sql_foto);

// Ambil semua foto
$foto = [];
while ($row = mysqli_fetch_assoc($result_foto)) {
    $foto[] = $row['image'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio <?= $profil['name']; ?></title>
    <link rel="stylesheet" href="styles/porto.css">
</head>
<body>

<div class="container">
    
    <!-- Profil -->
    <div class="profil">
        <div class="profil-kiri">
            <img src="photo/<?= $profil['foto_profil']; ?>" 
                 alt="<?= $profil['name']; ?>" 
                 class="foto-profil">
            <div class="nama"><?= $profil['name']; ?></div>
            <div class="rating">
                <?= str_repeat("⭐", $profil['rating']); ?>
            </div>
        </div>

        <div class="profil-kanan">
            <h2>Deskripsi Fotografer</h2>
            <p><?= nl2br($profil['bio']); ?></p>

            <!-- Info Kontak -->
            <div class="info-kontak">
                <h2>Informasi Kontak</h2>
                <div class="info-item">
                    <strong>Email:</strong>
                    <a href="mailto:<?= $profil['email']; ?>"><?= $profil['email']; ?></a>
                </div>
                <div class="info-item">
                    <strong>No. HP:</strong>
                    <a href="tel:<?= $profil['no_hp']; ?>"><?= $profil['no_hp']; ?></a>
                </div>
                <div class="info-item">
                    <strong>Lokasi:</strong>
                    <?= $profil['lokasi']; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Portofolio -->
    <div class="portofolio">
        <h2>Portofolio</h2>
        
        <?php if (count($foto) > 0) { ?>
            <div class="grid-foto">
                <?php foreach ($foto as $gambar) { ?>
                    <img src="photo/<?= $gambar; ?>" 
                         alt="Karya <?= $profil['name']; ?>"
                         onclick="zoomFoto(this.src)">
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>Belum ada portofolio tersedia</p>
        <?php } ?>
    </div>

    <!-- Tombol -->
    <div class="tombol-container">
        <a href="wedding.php" class="btn btn-kembali">Kembali</a>
        <a href="lihat-paket.php?id=<?= $id; ?>" class="btn btn-primary">Lihat Paket & Harga</a>
    </div>

</div>

<!-- Modal Zoom Foto -->
<div id="modal" class="modal" onclick="tutupModal()">
    <span class="close">&times;</span>
    <img class="modal-content" id="fotoModal">
</div>

<script>
// Fungsi zoom foto
function zoomFoto(src) {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('fotoModal').src = src;
}

// Fungsi tutup modal
function tutupModal() {
    document.getElementById('modal').style.display = 'none';
}
</script>

</body>
</html>