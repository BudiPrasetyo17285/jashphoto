<?php
// Koneksi database
include "database/koneksi.php";
session_start();

// CEK KONEKSI
if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

// Ambil ID fotografer dari URL
$id = $_GET['id'] ?? 0;

// Simpan ke session
$_SESSION['id_photographer'] = $id;

// Ambil data fotografer
$sql_photographer = "SELECT name, foto_profil FROM photographer WHERE id = $id";
$result = mysqli_query($host, $sql_photographer);
$photographer = mysqli_fetch_assoc($result);

// Jika fotografer tidak ditemukan
if (!$photographer) {
    echo "<script>
            alert('Fotografer tidak ditemukan!');
            window.location.href='index.php';
          </script>";
    exit;
}

// Ambil semua paket fotografer ini
$sql_paket = "SELECT * FROM products WHERE id_photographer = $id";
$result = mysqli_query($host, $sql_paket);

$paket = [];
while ($row = mysqli_fetch_assoc($result)) {
    $paket[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Paket - <?= $photographer['name']; ?></title>
    <link rel="stylesheet" href="styles/lihat-paket.css">
</head>
<body>

<div class="container">
    
    <!-- Header -->
    <header>
        <div class="info-header">
            <img src="photo/<?= $photographer['foto_profil']; ?>" 
                 alt="<?= $photographer['name']; ?>" 
                 class="foto">
            <div>
                <h1>Pilih Paket</h1>
                <p class="subtitle">Fotografer: <strong><?= $photographer['name']; ?></strong></p>
            </div>
        </div>
    </header>

    <!-- Grid Paket -->
    <?php if (count($paket) > 0) { ?>
        <section class="grid-paket">
            <?php foreach ($paket as $item) { ?>
                <article class="card">
                    
                    <!-- Header Card -->
                    <div class="card-header">
                        <div class="nama-paket"><?= $item['name']; ?></div>
                        <div class="harga">
                            Rp <?= number_format($item['price'], 0, ',', '.'); ?>
                        </div>
                    </div>

                    <!-- Body Card -->
                    <div class="card-body">
                        <p class="deskripsi"><?= nl2br($item['deskripsi']); ?></p>
                        
                        <div class="durasi">
                            ⏱️ Durasi: <strong><?= $item['durasi_jam']; ?> Jam</strong>
                        </div>

                        <!-- Tombol Pilih Paket -->
                        <button class="btn btn-pilih" onclick="pilihPaket(<?= $item['id']; ?>, '<?= $item['name']; ?>')">
                            Pilih Paket
                        </button>
                    </div>

                </article>
            <?php } ?>
        </section>
    <?php } else { ?>
        <div class="kosong">
            <h2>Belum ada paket</h2>
            <p>Fotografer ini belum menambahkan paket</p>
        </div>
    <?php } ?>

    <!-- Navigasi -->
    <nav>
        <a href="porto.php?id=<?= $id; ?>" class="btn-nav btn-kembali">⬅ Kembali</a>
        <a href="schedule.php" class="btn-nav btn-jadwal">📅 Lihat Jadwal</a>
    </nav>

</div>

<script>
// Fungsi pilih paket
function pilihPaket(idPaket, namaPaket) {
    // Tampilkan konfirmasi
    var konfirmasi = confirm('Pilih paket "' + namaPaket + '"?\n\nSelanjutnya pilih jadwal yang tersedia.');
    
    // Jika user klik OK
    if (konfirmasi == true) {
        // Pindah ke halaman schedule dengan membawa ID paket
        window.location.href = 'schedule.php?paket=' + idPaket;
    }
    // Jika user klik Cancel, tidak terjadi apa-apa
}
</script>

</body>
</html>