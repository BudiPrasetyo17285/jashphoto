<?php
include "database/koneksi.php";
session_start();

// Ambil data dari session
$id_user = $_SESSION['id_user'] = 1; // Simulasi user yang login
$id_photographer = $_SESSION['id_photographer'] = 17; // Simulasi fotografer yang dipilih
$id_product = $_SESSION['id_product'] = 18; // Simulasi produk/paket yang dipilih
$tanggal = $_SESSION['tanggal'];
$jam_mulai = $_SESSION['jam_mulai'];
$jam_selesai = $_SESSION['jam_selesai'];

// Ambil data dari database
// Data user
$sql_user = "SELECT * FROM user WHERE id = '$id_user'";
$result_user = mysqli_query($host, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Data fotografer
$sql_photographer = "SELECT * FROM photographer WHERE id = '$id_photographer'";
$result_photographer = mysqli_query($host, $sql_photographer);
$photographer = mysqli_fetch_assoc($result_photographer);

// Ambil data produk/paket
$sql_product = "SELECT * FROM products WHERE id = '$id_product'";
$result_product = mysqli_query($host, $sql_product);
$product = mysqli_fetch_assoc($result_product);

// Proses konfirmasi booking
if (isset($_POST['konfirmasi'])) {
    $location = mysqli_real_escape_string($host, $_POST['location']);
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $total_harga = $product['harga'];
    
    // Validasi : user harus login
    if (!$id_user) {
        echo "<script>
                alert('Silakan login terlebih dahulu!');
                window.location.href = 'login.php';
              </script>";
        exit();
    }
    
    // Simpan ke database
    $sql = "INSERT INTO booking (id_user, id_photographer, id_products, date, start_time, end_time, location, total_price, payment_method, status) 
    VALUES ('$id_user','$id_photographer','$id_product','$tanggal','$jam_mulai','$jam_selesai','$location','$total_harga','$metode_pembayaran','sudah dibayar')";
    
    if (mysqli_query($host, $sql)) {
        // Hapus session setelah berhasil
        unset($_SESSION['tanggal']);
        unset($_SESSION['jam_mulai']);
        unset($_SESSION['jam_selesai']);
        unset($_SESSION['id_product']);
        
        echo "<script>
                alert('Booking berhasil dan sudah dibayar!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Booking gagal! Error: " . mysqli_error($host) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Jashphoto</title>
    <link rel="stylesheet" href="styles/checkout.css">
</head>
<body>
    <header>
        <nav>
            <button type="button" onclick="window.history.back()" aria-label="Kembali ke halaman sebelumnya">←</button>
        </nav> 
        <h1>Jashphoto</h1>
    </header>

    <main>
        <h2>Detail Pesanan</h2>

        <!-- Alert/Warning menggunakan aside -->
        <aside class="warning" role="alert">
            <strong>Perhatian:</strong> <p>Pastikan semua data sudah benar sebelum konfirmasi.</p>
        </aside>

        <!-- FORM -->
        <form method="post" action="">
            
            <!-- SECTION: Paket/Produk yang dipilih -->
            <section aria-labelledby="product-heading">
                <h3 id="product-heading">📦 Paket yang Dipilih</h3>
                
                <?php if ($product): ?>
                <figure>
                    <?php if (!empty($product['gambar'])): ?>
                        <img src="<?= htmlspecialchars($product['gambar']) ?>" 
                             alt="Gambar paket <?= htmlspecialchars($product['name']) ?>">
                    <?php else: ?>
                        <img src="placeholder.jpg" alt="Tidak ada gambar">
                    <?php endif; ?>
                    
                    <figcaption>
                        <h4><?= htmlspecialchars($product['name']) ?></h4>
                        <p><?= htmlspecialchars($product['deskripsi']) ?></p>
                        <p class="product-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                    </figcaption>
                </figure>
                <?php else: ?>
                    <p>Data produk tidak ditemukan</p>
                <?php endif; ?>
            </section>

            <!-- GRID: Fotografer & Jadwal -->
            <div class="grid-container">
                
                <!-- ARTICLE: Fotografer -->
                <article aria-labelledby="photographer-heading">
                    <h3 id="photographer-heading">📸 Fotografer</h3>
                    
                    <?php if ($photographer): ?>
                        <dl>
                            <div class="detail-row">
                                <dt>Nama:</dt>
                                <dd><?= htmlspecialchars($photographer['name']) ?></dd>
                            </div>
                            
                            <?php if (!empty($photographer['id_categories'])): ?>
                            <div class="detail-row">
                                <dt>Spesialisasi:</dt>
                                <dd><?= htmlspecialchars($photographer['id_categories']) ?></dd>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($photographer['email'])): ?>
                            <div class="detail-row">
                                <dt>Email:</dt>
                                <dd><a href="mailto:<?= htmlspecialchars($photographer['email']) ?>"><?= htmlspecialchars($photographer['email']) ?></a></dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                    <?php else: ?>
                        <p>Data fotografer tidak ditemukan</p>
                    <?php endif; ?>
                </article>

                <!-- ARTICLE: Jadwal -->
                <article aria-labelledby="schedule-heading">
                    <h3 id="schedule-heading">📅 Jadwal Pemotretan</h3>
                    
                    <dl>
                        <div class="detail-row">
                            <dt>Tanggal:</dt>
                            <dd><time datetime="<?= $tanggal ?>"><?= date('d F Y', strtotime($tanggal)) ?></time></dd>
                        </div>
                        
                        <div class="detail-row">
                            <dt>Jam Mulai:</dt>
                            <dd><time datetime="<?= $jam_mulai ?>"><?= $jam_mulai ?></time></dd>
                        </div>
                        
                        <div class="detail-row">
                            <dt>Jam Selesai:</dt>
                            <dd><time datetime="<?= $jam_selesai ?>"><?= $jam_selesai ?></time></dd>
                        </div>
                        
                        <div class="detail-row">
                            <dt>Durasi:</dt>
                            <dd>
                                <?php
                                $durasi = (strtotime($jam_selesai) - strtotime($jam_mulai)) / 3600;
                                echo $durasi . " jam";
                                ?>
                            </dd>
                        </div>
                    </dl>
                </article>
                
            </div>

            <!-- SECTION: Informasi Pemesan -->
            <section aria-labelledby="customer-heading">
                <h3 id="customer-heading">👤 Informasi Pemesan</h3>
                
                <?php if ($user): ?>
                    <dl class="grid-container">
                        <div class="detail-row">
                            <dt>Nama:</dt>
                            <dd><?= htmlspecialchars($user['username']) ?></dd>
                        </div>
                        
                        <div class="detail-row">
                            <dt>Email:</dt>
                            <dd><a href="mailto:<?= htmlspecialchars($user['email']) ?>"><?= htmlspecialchars($user['email']) ?></a></dd>
                        </div>
                        
                        <?php if (!empty($user['no_hp'])): ?>
                        <div class="detail-row">
                            <dt>No. Telepon:</dt>
                            <dd><a href="tel:<?= htmlspecialchars($user['no_hp']) ?>"><?= htmlspecialchars($user['no_hp']) ?></a></dd>
                        </div>
                        <?php endif; ?>
                    </dl>
                <?php else: ?>
                    <aside class="warning" role="alert" style="margin: 0;">
                        <strong>⚠️ Anda belum login!</strong> Silakan login terlebih dahulu.
                    </aside>
                <?php endif; ?>
            </section>

            <!-- SECTION: Lokasi -->
            <section aria-labelledby="location-heading">
                <h3 id="location-heading">📍 Lokasi Pemotretan</h3>
                
                <fieldset>
                    <label for="location">Alamat Lengkap <abbr title="wajib diisi">*</abbr></label>
                    <textarea id="location" 
                              name="location" 
                              placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta"
                              required
                              aria-required="true"></textarea>
                </fieldset>
            </section>

            <!-- SECTION: Metode Pembayaran -->
            <section aria-labelledby="payment-heading">
                <h3 id="payment-heading">💳 Metode Pembayaran</h3>
                
                <fieldset>
                    <label for="metode_pembayaran">Pilih Metode Pembayaran <abbr title="wajib diisi">*</abbr></label>
                    <select id="metode_pembayaran" 
                            name="metode_pembayaran" 
                            required
                            aria-required="true">
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="Transfer Bank">Transfer Bank (BCA, Mandiri, BNI)</option>
                        <option value="E-Wallet">E-Wallet (GoPay, OVO, DANA)</option>
                        <option value="QRIS">QRIS</option>
                        <option value="Tunai">Tunai</option>
                    </select>
                </fieldset>
                
                <aside role="note">
                    ℹ️ <strong>Catatan:</strong> Setelah klik tombol "Konfirmasi & Bayar", pesanan Anda akan otomatis dinyatakan sudah dibayar dan masuk ke sistem.
                </aside>
            </section>

            <!-- SECTION: Ringkasan Pembayaran -->
            <section aria-labelledby="summary-heading">
                <h3 id="summary-heading">💰 Ringkasan Pembayaran</h3>
                
                <dl>
                    <div class="detail-row">
                        <dt>Harga Paket:</dt>
                        <dd>Rp <?= number_format($product['price'], 0, ',', '.') ?></dd>
                    </div>
                </dl>
                
                <div class="summary-box" role="status" aria-live="polite">
                    <span>TOTAL PEMBAYARAN</span>
                    <span class="total-amount">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                </div>
            </section>

            <!-- NAVIGATION: Tombol Aksi -->
            <nav class="button-group">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Kembali
                </button>
                <button type="submit" name="konfirmasi" class="btn-primary">
                    Konfirmasi & Bayar ✓
                </button>
            </nav>

        </form>
    </main>

    <!-- JAVASCRIPT -->
    <script>
        // Konfirmasi sebelum submit form
        document.querySelector('form').addEventListener('submit', function(e) {
            const metode = document.getElementById('metode_pembayaran').value;
            
            if (!metode) {
                e.preventDefault();
                alert('Silakan pilih metode pembayaran terlebih dahulu!');
                return false;
            }
            
            const konfirmasi = confirm(
                'Apakah Anda yakin ingin melanjutkan pembayaran dengan metode ' + metode + '?\n\n' +
                'Setelah konfirmasi, pesanan akan langsung dinyatakan SUDAH DIBAYAR.'
            );
            
            if (!konfirmasi) {
                e.preventDefault();
            }
        });
    </script>

</body>
</html>