<?php
include 'database/koneksi.php';
session_start();

<<<<<<< HEAD
$user_id = $_SESSION['user_id'] ?? 0;
$query = mysqli_query($host, "SELECT * FROM user WHERE user_id='$user_id'");
$data  = mysqli_fetch_assoc($query);

$id     = $_POST['user_id']; 
$email  = $_POST['email'];
$phone  = $_POST['phone'];
$alamat = $_POST['alamat'];
=======
/* CEK APAKAH USER SUDAH LOGIN */
if(!isset($_SESSION['id'])){
    echo "<script>
            alert('❌ Anda harus login terlebih dahulu!');
            window.location='login/index.php';
          </script>";
    exit();
}
>>>>>>> 3b8fa1fef72479e56db5cb3cd29a72a611af25f9

/* CEK APAKAH FORM DISUBMIT */
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location: profile.php");
    exit();
}

/* AMBIL ID DARI SESSION (BUKAN DARI POST UNTUK KEAMANAN) */
$user_id = $_SESSION['id'];

/* AMBIL DAN ESCAPE DATA DARI FORM */
$email  = mysqli_real_escape_string($host, trim($_POST['email']));
$phone  = mysqli_real_escape_string($host, trim($_POST['phone']));
$alamat = mysqli_real_escape_string($host, trim($_POST['alamat']));

/* VALIDASI EMAIL */
if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<script>
            alert('❌ Format email tidak valid!');
            window.history.back();
          </script>";
    exit();
}

/* CEK APAKAH EMAIL SUDAH DIGUNAKAN USER LAIN */
$check_email = mysqli_query($host, "SELECT id FROM user WHERE email='$email' AND id != '$user_id'");
if(mysqli_num_rows($check_email) > 0){
    echo "<script>
            alert('❌ Email sudah digunakan oleh user lain!');
            window.history.back();
          </script>";
    exit();
}

/* CEK APAKAH ADA UPLOAD FOTO */
if (!empty($_FILES['foto']['name'])) {

    $nama_file = $_FILES['foto']['name'];
    $tmp       = $_FILES['foto']['tmp_name'];
    $ukuran    = $_FILES['foto']['size'];
    $error     = $_FILES['foto']['error'];
    
    /* CEK ERROR UPLOAD */
    if($error !== UPLOAD_ERR_OK){
        $error_message = '';
        switch($error){
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $error_message = 'File terlalu besar!';
                break;
            case UPLOAD_ERR_PARTIAL:
                $error_message = 'File tidak terupload sempurna!';
                break;
            case UPLOAD_ERR_NO_FILE:
                $error_message = 'Tidak ada file yang diupload!';
                break;
            default:
                $error_message = 'Terjadi kesalahan saat upload!';
        }
        echo "<script>
                alert('❌ $error_message');
                window.history.back();
              </script>";
        exit();
    }
    
    /* AMBIL EKSTENSI FILE */
    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

<<<<<<< HEAD
    // Nama file baru agar tidak bentrok
    $foto_baru = 'user_id'.$id.'_'.time().'.'.$ext;
=======
    /* VALIDASI EKSTENSI FILE */
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
    if(!in_array($ext, $allowed_ext)){
        echo "<script>
                alert('❌ Format file tidak valid! Gunakan JPG, PNG, atau GIF');
                window.history.back();
              </script>";
        exit();
    }
>>>>>>> 3b8fa1fef72479e56db5cb3cd29a72a611af25f9

    /* VALIDASI UKURAN FILE (MAX 2MB) */
    if($ukuran > 2097152){
        $size_mb = round($ukuran / 1048576, 2);
        echo "<script>
                alert('❌ Ukuran file terlalu besar ($size_mb MB)! Maksimal 2MB');
                window.history.back();
              </script>";
        exit();
    }

    /* VALIDASI MIME TYPE (KEAMANAN TAMBAHAN) */
    $allowed_mime = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $tmp);
    finfo_close($finfo);
    
    if(!in_array($mime, $allowed_mime)){
        echo "<script>
                alert('❌ File yang diupload bukan gambar yang valid!');
                window.history.back();
              </script>";
        exit();
    }

    /* NAMA FILE BARU AGAR TIDAK BENTROK */
    $foto_baru = 'user_' . $user_id . '_' . time() . '.' . $ext;

    /* PASTIKAN FOLDER PHOTO ADA */
    if(!is_dir('photo')){
        if(!mkdir('photo', 0755, true)){
            echo "<script>
                    alert('❌ Gagal membuat folder photo!');
                    window.history.back();
                  </script>";
            exit();
        }
    }

    /* HAPUS FOTO LAMA JIKA ADA */
    $query_old = mysqli_query($host, "SELECT foto FROM user WHERE id='$user_id'");
    $old_data = mysqli_fetch_assoc($query_old);
    
    if(!empty($old_data['foto']) && file_exists("photo/".$old_data['foto'])){
        @unlink("photo/".$old_data['foto']);
    }

    /* UPLOAD FOTO BARU */
    if(move_uploaded_file($tmp, "photo/".$foto_baru)){
        /* UPDATE DATABASE DENGAN FOTO */
        $query = "UPDATE user SET 
                    email='$email',
                    no_hp='$phone',
                    alamat='$alamat',
                    foto='$foto_baru'
                  WHERE id='$user_id'";
    } else {
        echo "<script>
                alert('❌ Gagal upload foto! Periksa permission folder photo/');
                window.history.back();
              </script>";
        exit();
    }

} else {
    /* UPDATE TANPA FOTO */
    $query = "UPDATE user SET 
                email='$email',
                no_hp='$phone',
                alamat='$alamat'
              WHERE id='$user_id'";
}

/* EKSEKUSI QUERY UPDATE */
$update = mysqli_query($host, $query);

if ($update) {
    /* UPDATE SESSION EMAIL JUGA */
    $_SESSION['email'] = $email;
    
    /* REDIRECT KE PROFILE DENGAN PESAN SUKSES */
    echo "<script>
            alert('✅ Profil berhasil diperbarui!');
            window.location='profile.php';
          </script>";
} else {
    /* TAMPILKAN ERROR JIKA GAGAL */
    $error_msg = mysqli_error($host);
    echo "<script>
            alert('❌ Profil gagal diperbarui!\\n\\nError: $error_msg');
            window.history.back();
          </script>";
}
?>
