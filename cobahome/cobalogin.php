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
    <title>Sign In - JashPhoto</title>
    
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
        }

        /* Sidebar Kiri */
        .sidebar {
            width: 360px;
            background: #5a5a5a;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .sidebar .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #5a5a5a;
        }

        .sidebar h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .sidebar h2 {
            font-size: 24px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .sidebar p {
            font-size: 14px;
            line-height: 1.6;
            color: #ddd;
        }

        /* Area Login Kanan */
        .login-area {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
            padding: 40px;
        }

        .login-box {
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 420px;
        }

        .login-box h3 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }

        .login-box .subtitle {
            color: #999;
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background: #fafafa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #7c5cdb;
            background: white;
        }

        /* Remember & Forgot */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #666;
        }

        .remember input {
            margin-right: 8px;
        }

        .forgot {
            color: #7c5cdb;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        /* Button Sign In */
        .btn-signin {
            width: 100%;
            padding: 14px;
            background: #7c5cdb;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-signin:hover {
            background: #6a4bc4;
        }

        /* Sign Up Link */
        .signup-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #999;
        }

        .signup-link a {
            color: #7c5cdb;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Error Message */
        .error-message {
            background: #ffe6e6;
            color: #cc0000;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        /* Back to Home */
        .back-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-home a {
            color: #999;
            text-decoration: none;
            font-size: 13px;
        }

        .back-home a:hover {
            color: #7c5cdb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 30px 20px;
            }

            .sidebar h1 {
                font-size: 24px;
            }

            .sidebar h2 {
                font-size: 18px;
            }

            .login-box {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri -->
    <div class="sidebar">
        <div class="logo">JP</div>
        <h1>JashPhoto</h1>
        <h2>Welcome to JashPhoto</h2>
        <p>Platform marketplace jasa fotografer profesional di Indonesia.</p>
    </div>

    <!-- Area Login Kanan -->
    <div class="login-area">
        <div class="login-box">
            <h3>Sign in</h3>
            <p class="subtitle">Masuk ke akun Anda</p>

            <?php if($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="john@example.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••" required>
                </div>

                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="#" class="forgot">Forgot Password</a>
                </div>

                <button type="submit" name="login" class="btn-signin">Sign in</button>
            </form>

            <div class="signup-link">
                Belum punya akun? <a href="register.php">Sign up</a>
            </div>

            <div class="back-home">
                <a href="homepage.php">← Kembali ke Homepage</a>
            </div>
        </div>
    </div>

</body>
</html>