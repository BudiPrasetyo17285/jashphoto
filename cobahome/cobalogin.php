<?php
session_start();
include "../database/koneksi.php";

// Jika sudah login, redirect ke homepage
if(isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}

$error = "";

// Proses login
if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($host, $_POST['email']);
    $password = $_POST['password'];
    
    // Cek user di database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($host, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if(password_verify($password, $user['password'])) {
            // Login berhasil
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            header("Location: homepage.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JashPhoto</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }

        .logo {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 15px;
        }

        .back-home a {
            color: #999;
            text-decoration: none;
            font-size: 14px;
        }

        .back-home a:hover {
            color: #667eea;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo">JashPhoto</div>
        <p class="subtitle">Login ke akun Anda</p>

        <?php if($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email Anda" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password Anda" required>
            </div>

            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>

        <div class="back-home">
            <a href="homepage.php">← Kembali ke Homepage</a>
        </div>
    </div>

</body>
</html>