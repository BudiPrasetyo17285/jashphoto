<?php
include "database/koneksi.php";
session_start();

// CEK KONEKSI DATABASE
if (!$host) {
    die("ERROR: Koneksi database gagal! " . mysqli_connect_error());
}

// Ambil ID fotografer dari session
$id_photographer = $_SESSION['id_photographer'] ?? 0;

// Ambil ID paket dari URL dan simpan ke session
if (isset($_GET['paket'])) {
    $_SESSION['id_product'] = $_GET['paket'];
}

$id_product = $_SESSION['id_product'] ?? 0;

// Ambil data dari database
$tanggal_sekarang = date('Y-m-d');
$tanggal_dipilih = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

$data_booking = [];

if ($tanggal_dipilih) {
    $sql = "SELECT start_time, end_time FROM booking 
              WHERE id_photographer = '$id_photographer' AND date = '$tanggal_dipilih' ORDER BY start_time";
    
    $result = mysqli_query($host, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $data_booking[] = $row;
    }
}

// Proses form booking
if (isset($_POST['lanjutkan'])) {
    if ($id_product == 0) {
        echo "<script>
                alert('Anda belum memilih paket!\\n\\nAnda akan diarahkan ke halaman pilih paket.');
                window.location.href = 'lihat-paket.php?id=$id_photographer';
              </script>";
        exit;
    }
    
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    
    // Cek apakah jadwal bentrok dengan booking lain
    $cek = "SELECT COUNT(*) as total FROM booking 
                  WHERE id_photographer = '$id_photographer' AND date = '$tanggal' 
                  AND NOT (end_time <= '$jam_mulai' OR start_time >= '$jam_selesai')";

    $result_cek = mysqli_query($host, $cek);
    $row = mysqli_fetch_assoc($result_cek);

    if ($row['total'] > 0) {
        echo "<script>
                alert('Jadwal bentrok!'); history.back();
              </script>";
        exit;
    }
    
    // Simpan ke session
    $_SESSION['tanggal'] = $tanggal;
    $_SESSION['jam_mulai'] = $jam_mulai;
    $_SESSION['jam_selesai'] = $jam_selesai;
    
    // Redirect ke halaman checkout
    header("Location: checkout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Fotografer</title>
    <link rel="stylesheet" href="styles/schedule.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Jashphoto</h1>
        </header>

        <main>
            <section>
                <h2>Jadwal Fotografer</h2>
                <button onclick="history.back()">← Kembali</button>
            </section>

            <section>
                <form method="GET">
                    <label>Pilih Tanggal:</label>
                    <input type="date" name="tanggal" value="<?php echo $tanggal_dipilih; ?>" min="<?php echo $tanggal_sekarang; ?>" required>
                    <button type="submit">Lihat Jadwal</button>
                </form>
            </section>

            <?php if ($tanggal_dipilih): ?>
            <section class="kotak">
                <h3>Ketersediaan Jadwal</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for ($jam = 8; $jam <= 15; $jam++) {
                                $jam_mulai = sprintf("%02d:00:00", $jam);
                                $jam_selesai = sprintf("%02d:00:00", $jam + 1);
                                
                                // Default status tersedia
                                $status = "Tersedia";
                                $class = "tersedia";
                                
                                // Cek apakah jam ini sudah di-booking
                                foreach ($data_booking as $booking) {
                                    if ($jam_mulai >= $booking['start_time'] && $jam_mulai < $booking['end_time']) {
                                        $status = "Booked";
                                        $class = "booked";
                                        break;
                                    }
                                }
                                echo "
                                <tr>
                                    <td>$jam_mulai</td>
                                    <td>$jam_selesai</td>
                                    <td><span class='$class'>$status</span></td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </section>   
            
            <section class="kotak">
                <h3>Pilih Waktu Booking</h3>
                
                <div class="info-tanggal">
                    <h4>Tanggal: <?php echo date('d/m/Y', strtotime($tanggal_dipilih)); ?></h4>
                </div>

                <form method="POST" id="formBooking">
                    <input type="hidden" name="tanggal" value="<?php echo $tanggal_dipilih; ?>">
                    
                    <div class="baris-2">
                        <div>
                            <label for="jamMulai">Jam Mulai:</label>
                            <input type="time" name="jam_mulai" id="jamMulai" min="08:00:00" max="15:00:00" step="3600" required>
                        </div>
                        <div>
                            <label for="jamSelesai">Jam Selesai:</label>
                            <input type="time" name="jam_selesai" id="jamSelesai" min="09:00:00" max="16:00:00" step="3600" required>
                        </div>
                    </div>
                    <button type="submit" name="lanjutkan">Lanjut ke Checkout</button>
                </form>
            </section>
            <?php endif; ?>
        </main>
    </div>

    <script>
    // Ambil data booking dari PHP ke JS
    const dataBooking = <?php echo json_encode($data_booking); ?>;
    const idProduct = <?php echo $id_product; ?>;

    const semuaBaris = document.querySelectorAll('tbody tr');
    for (let i = 0; i < semuaBaris.length; i++) {
        semuaBaris[i].onclick = function() {
            const jamMulai = this.cells[0].textContent;    
            const jamSelesai = this.cells[1].textContent;  
            const status = this.cells[2].textContent;      

            if (status.includes('Tersedia')) {
                document.getElementById('jamMulai').value = jamMulai;
                document.getElementById('jamSelesai').value = jamSelesai;
            }
        };
    }

    // Validasi form sebelum submit
    document.getElementById('formBooking').onsubmit = function(e) {

        const jamMulai = document.getElementById('jamMulai').value;
        const jamSelesai = document.getElementById('jamSelesai').value;

        // --- Validasi 1: Jam selesai harus lebih besar ---
        if (jamSelesai <= jamMulai) {
            alert('Jam selesai harus lebih besar dari jam mulai!');
            e.preventDefault();
            return false;
        }
        
        // --- Validasi 2: Jam mulai minimal 08:00:00 ---
        if (jamMulai < '08:00:00' || jamMulai > '15:00:00') {
            alert('Jam mulai harus antara 08:00 - 15:00!');
            e.preventDefault();
            return false;
        }
        
        // --- Validasi 3: Jam selesai maksimal 16:00:00 ---
        if (jamSelesai < '09:00:00' || jamSelesai > '16:00:00') {
            alert('Jam selesai harus antara 09:00 - 16:00!');
            e.preventDefault();
            return false;
        }
        
        // --- Validasi 4: Cek bentrok dengan booking lain ---
        for (let i = 0; i < dataBooking.length; i++) {
            const booking = dataBooking[i];

            if (jamMulai < booking.end_time && jamSelesai > booking.start_time) {
                alert('Jadwal bentrok! Jam ' + booking.start_time + ' - ' + booking.end_time + ' sudah dibooking');
                e.preventDefault();
                return false;
            }
        }
        
        return true;
    };
            
    </script>
</body>
</html>