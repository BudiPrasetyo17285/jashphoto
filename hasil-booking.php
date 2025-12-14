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
  <link rel="stylesheet" href="styles/portofolio.css">

  <style>
    .result-box {
      background: white;
      max-width: 700px;
      margin: 40px auto;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .result-title {
      text-align: center;
      font-size: 24px;
      color: #876B2D;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .data-item {
      margin-bottom: 12px;
      font-size: 16px;
    }
    .data-item strong {
      color: #876B2D;
    }
    .btn-back {
      display: block;
      width: fit-content;
      margin: 25px auto 0;
      padding: 12px 25px;
      background: #876B2D;
      color: white;
      text-decoration: none;
      border-radius: 10px;
    }
  </style>
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
