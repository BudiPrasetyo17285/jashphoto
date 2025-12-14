<?php
include 'database/koneksi.php';

$booked = [];

$sql = "SELECT date, start_time, end_time FROM booking";
$result = mysqli_query($host, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $tanggal = $row['date'];
    $jamMulai   = (int) date('H', strtotime($row['start_time']));
    $jamSelesai = (int) date('H', strtotime($row['end_time']));

    for ($jam = $jamMulai; $jam < $jamSelesai; $jam++) {
        $booked[$tanggal][] = sprintf('%02d:00', $jam);
    }
}

if (isset($_POST['booking'])) {
    header("Location: checkout.php?date=".$_POST['tanggal']."&jam=".$_POST['jam']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <title>Jadwal Ketersediaan Fotografer</title>
    <link rel="stylesheet" href="styles/schedule.css">
</head>

<body>
    <header>
        <h2>Jashphoto</h2>
    </header>

    <main>
        <article class="container">
            <header>
                <h1>Jadwal Ketersediaan Fotografer</h1>
            </header>

            <section class="layout">
                <section class="calendar">
                    <label for="tanggal">Pilih Tanggal</label>
                    <input type="date" id="tanggal" min="<?= date('Y-m-d') ?>">
                </section>
                <section class="time-slots">
                    <div class="status-info">
                        <span><i class="dot available"></i>Tersedia</span>
                        <span><i class="dot selected"></i>Dipilih</span>
                        <span><i class="dot booked"></i>Sudah dibooking</span>
                    </div>
                    <div id="slots"></div>
                    <form method="post">
                        <label for="tanggal_pilih">Tanggal Dipilih</label>
                        <input type="text" name="tanggal" id="tanggal_pilih" readonly>
                        <label for="jam_pilih">Jam Dipilih</label>
                        <input type="text" name="jam" id="jam_pilih" readonly>
                        <button name="booking" id="booking">Booking</button>
                    </form>
                </section>
            </section>
        </article>

    </main>
    <script>
        const bookedData = <?php echo json_encode($booked); ?>;
        const daftarJam = ['08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00'];
        const tanggalInput = document.getElementById('tanggal');
        const slotsDiv = document.getElementById('slots');
        const inputTanggal = document.getElementById('tanggal_pilih');
        const inputJam = document.getElementById('jam_pilih');
        const tombolBooking = document.getElementById('booking');

        tombolBooking.disabled = true;

        tanggalInput.value = tanggalInput.min;
        tampilkanJam(tanggalInput.value);

        // Jika tanggal diganti
        tanggalInput.addEventListener('change', function () {
            tampilkanJam(this.value);
        });
         
        // Menampilkan jam
        function tampilkanJam(tanggal) {

            slotsDiv.innerHTML = '';

            for (let i = 0; i < daftarJam.length; i++) {

                const jam = daftarJam[i];
                const kotak = document.createElement('div');
                kotak.textContent = jam;

                if (bookedData[tanggal] && bookedData[tanggal].includes(jam)) {
                    kotak.className = 'slot booked';
                } else {
                    kotak.className = 'slot available';
                    kotak.onclick = function () {
                        pilihJam(tanggal, jam, kotak);
                    };
                }

                slotsDiv.appendChild(kotak);
            }
        }

        // Memilih jam
        function pilihJam(tanggal, jam, elemen) {

            const semuaSlot = document.querySelectorAll('.slot');
            semuaSlot.forEach(function (s) {
                s.classList.remove('selected');
            });

            elemen.classList.add('selected');
            inputTanggal.value = tanggal;
            inputJam.value = jam;

            document.getElementById('booking').disabled = false;
        }
    </script>
</body>
</html>
