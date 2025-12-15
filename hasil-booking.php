<?php
$nama    = $_POST['nama'] ?? '-';
$email   = $_POST['email'] ?? '-';
$wa      = $_POST['wa'] ?? '-';
$paket   = $_POST['paket'] ?? '-';
$tanggal = $_POST['tanggal'] ?? '-';
$waktu   = $_POST['waktu'] ?? '-';
$lokasi  = $_POST['lokasi'] ?? '-';
$request = $_POST['request'] ?? 'Tidak ada request.';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Booking</title>
  <link rel="stylesheet" href="styles/porto.css">

</head>

<body>

<div class="result-box">
  <div class="result-title">Booking Berhasil!</div>
  <p style="text-align:center;">Berikut detail booking Anda:</p>

  <div class="data-item"><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></div>
  <div class="data-item"><strong>Email:</strong> <?= htmlspecialchars($email) ?></div>
  <div class="data-item"><strong>WhatsApp:</strong> <?= htmlspecialchars($wa) ?></div>
  <div class="data-item"><strong>Paket:</strong> <?= htmlspecialchars($paket) ?></div>
  <div class="data-item"><strong>Tanggal:</strong> <?= htmlspecialchars($tanggal) ?></div>
  <div class="data-item"><strong>Waktu:</strong> <?= htmlspecialchars($waktu) ?></div>
  <div class="data-item"><strong>Lokasi:</strong> <?= htmlspecialchars($lokasi) ?></div>

  <div class="data-item">
    <strong>Request Tambahan:</strong><br>
    <?= nl2br(htmlspecialchars($request)) ?>
  </div>

  <a href="program.php" class="btn-back">← Kembali ke Profil</a>
</div>

</body>
</html>
