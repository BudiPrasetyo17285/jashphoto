<?php
include 'database/koneksi.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 0;
$query = mysqli_query($host, "SELECT * FROM user WHERE user_id='$user_id'");
$data  = mysqli_fetch_assoc($query);

$id     = $_POST['user_id']; 
$email  = $_POST['email'];
$phone  = $_POST['phone'];
$alamat = $_POST['alamat'];

/* CEK FOTO */
if (!empty($_FILES['foto']['name'])) {

    $nama_file = $_FILES['foto']['name'];
    $tmp       = $_FILES['foto']['tmp_name'];
    $ext       = pathinfo($nama_file, PATHINFO_EXTENSION);

    // Nama file baru agar tidak bentrok
    $foto_baru = 'user_id'.$id.'_'.time().'.'.$ext;

    // Upload foto
    move_uploaded_file($tmp, "photo/".$foto_baru);

    // Update dengan foto
    $query = "UPDATE user SET 
                email='$email',
                no_hp='$phone',
                alamat='$alamat',
                foto='$foto_baru'
              WHERE id='$id'";

} else {

    // Update tanpa foto
    $query = "UPDATE user SET 
                email='$email',
                no_hp='$phone',
                alamat='$alamat'
              WHERE id='$id'";
}

$update = mysqli_query($host, $query);

if ($update) {
    echo "<script>
            alert('Profil berhasil diperbarui');
            window.location='profile.php';
          </script>";
} else {
    echo "<script>
            alert('Profil gagal diperbarui');
            window.history.back();
          </script>";
}
?>
