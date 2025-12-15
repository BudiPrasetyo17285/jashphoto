<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/database/koneksi.php";

// id photographer yang ingin ditampilkan
$id_photographer = 1;

// Query JOIN portofolio -> photographer -> photo
$query = mysqli_query($host, "
    SELECT 
        ph.name,
        ph.bio,
        ph.rating,
        ph.foto_profil,
        pt.image AS foto
    FROM portofolio pf
    JOIN photographer ph ON pf.id_photographer = ph.id
    JOIN photo pt ON pf.id_photo = pt.id
    WHERE pf.id_photographer = $id_photographer
");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

// Data profil diambil dari baris pertama
$profil = $data[0];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Portofolio Fotografer</title>
  <link rel="stylesheet" href="styles/porto.css">
</head>
<body>

<div class="main-box">
<section class="profile-container">

  <div class="top-profile">
    <div class="left-profile">
      <img src="assets/<?= $profil['foto_profil']; ?>" class="profile-img">
      <h2 class="name"><?= $profil['name']; ?></h2>
      <h2 class="rating"><?= str_repeat("⭐", (int)$profil['rating']); ?></h2>
    </div>

    <div class="right-profile">
      <h3>Deskripsi Fotografer</h3>
      <p><?= $profil['bio']; ?></p>

      <h3>Style Photo</h3>
      <ol>
        <li>Portrait Photography</li>
        <li>Landscape Photography</li>
        <li>Wedding Photography</li>
        <li>Event Photography</li>
      </ol>
    </div>
  </div>

  <section class="portofolio-section">
    <h3>Portofolio</h3>
    <div class="portofolio-grid">
      <?php foreach ($data as $row) { ?>
        <img src="assets/<?= $row['foto']; ?>">
      <?php } ?>
    </div>
  </section>
 <div class="row">
  <a href="homepage.php" class="btn-book">Kembali</a>
  <a href="lihatpaket.php" class="btn-book">Lihat Paket & Harga</a>
  <a href="booking.php" class="btn-book">Booking Sekarang</a>
  <a href="lihatjadwal.php" class="btn-book">Lihat Jadwal</a>
</div>
</section>
</div>

</body>
</html>
