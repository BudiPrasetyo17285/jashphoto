<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/database/koneksi.php";

/* =========================
   AMBIL ID DARI URL
========================= */
if (!isset($_GET['id'])) {
    die("Fotografer tidak ditemukan");
}

$id_photographer = (int) $_GET['id'];

/* =========================
   QUERY DATA
========================= */
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

/* =========================
   AMBIL DATA
========================= */
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

if (count($data) === 0) {
    die("Portofolio fotografer belum tersedia");
}

$profil = $data[0];

?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Portofolio <?= htmlspecialchars($profil['name']); ?></title>
  <link rel="stylesheet" href="styles/porto.css">
</head>
<body>

<div class="main-box">
<section class="profile-container">

  <!-- =========================
       PROFIL
  ========================= -->
  <div class="top-profile">
    <div class="left-profile">
      <img src="assets/<?= htmlspecialchars($profil['foto_profil']); ?>" class="profile-img">
      <h2 class="name"><?= htmlspecialchars($profil['name']); ?></h2>
      <h2 class="rating"><?= str_repeat("⭐", (int)$profil['rating']); ?></h2>
    </div>

    <div class="right-profile">
      <h3>Deskripsi Fotografer</h3>
      <p><?= nl2br(htmlspecialchars($profil['bio'])); ?></p>

      <h3>Style Photo</h3>
      <ol>
        <li>Portrait Photography</li>
        <li>Landscape Photography</li>
        <li>Wedding Photography</li>
        <li>Event Photography</li>
      </ol>
    </div>
  </div>

  <!-- =========================
       PORTOFOLIO
  ========================= -->
  <section class="portofolio-section">
    <h3>Portofolio</h3>
    <div class="portofolio-grid">
      <?php foreach ($data as $row) { ?>
        <img src="photo/<?= htmlspecialchars($row['foto']); ?>" alt="Portofolio">
      <?php } ?>
    </div>
  </section>

  <!-- =========================
       BUTTON
  ========================= -->
  <div class="row">
    <a href="wedding.php" class="btn-book">⬅ Kembali</a>
    <a href="lihatpaket.php?id=<?= $id_photographer; ?>" class="btn-book">Lihat Paket & Harga</a>
    <a href="booking.php?id=<?= $id_photographer; ?>" class="btn-book">Booking Sekarang</a>
    <a href="lihatjadwal.php?id=<?= $id_photographer; ?>" class="btn-book">Lihat Jadwal</a>
  </div>

</section>
</div>

</body>
</html>
