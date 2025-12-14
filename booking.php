<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Booking</title>
  <link rel="stylesheet" href="styles/portofolio.css">
</head>

<body>

<div class="main-box">
  <h2>Form Booking Fotografer</h2>
  <p>Isi data berikut untuk melakukan pemesanan layanan fotografi.</p>

  <form class="booking-form" action="hasil-booking.php" method="post">

    <label>Nama Lengkap</label>
    <input type="text" name="nama" required placeholder="Masukkan nama lengkap">

    <label>Email</label>
    <input type="email" name="email" required placeholder="Masukkan email">

    <label>Nomor WhatsApp</label>
    <input type="text" name="wa" required placeholder="08xxxxxxxxxx">

    <label>Pilih Paket</label>
    <select name="paket" required>
      <option value="">-- Pilih Paket --</option>
      <option value="Bronze">Paket Bronze</option>
      <option value="Silver">Paket Silver</option>
      <option value="Gold">Paket Gold</option>
    </select>

    <label>Tanggal Pemotretan</label>
    <input type="date" name="tanggal" required>

    <label>Waktu</label>
    <input type="time" name="waktu" required>

    <label>Lokasi Pemotretan</label>
    <input type="text" name="lokasi" required placeholder="Contoh: Kampus, rumah, dll">

    <label>Request Tambahan</label>
    <textarea name="request" rows="4" placeholder="Tulis request khusus..."></textarea>

    <button type="submit" class="btn-book">Kirim Booking</button>
  </form>

  <div class="row" style="margin-top: 25px;">
    <a href="program.php" class="btn-book">← Kembali ke Profil</a>
  </div>

</div>

</body>
</html>
