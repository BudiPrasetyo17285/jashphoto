<?php
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: cobahome/cobasatu.php");
    exit();
}

require "../database/user.php";

$isSuccess = false;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    // Validasi input
    if (empty($username) || empty($email) || empty($password)) {
        $message = "Semua field harus diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format email tidak valid!";
    } elseif (strlen($password) < 6) {
        $message = "Password minimal 6 karakter!";
    } elseif ($password !== $confirmPassword) {
        $message = "Password dan konfirmasi password tidak cocok!";
    } else {
        $userId = createUser($username, $email, $password);

        if ($userId) {
            $isSuccess = true;
            $message = "Registrasi berhasil! Silakan login.";
            // Redirect ke login setelah 2 detik
            header("Location: /login");
            exit();
        } else {
            $message = "Username atau email sudah digunakan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - JashPhoto</title>
    <link rel="stylesheet" href="register.css?v=<?= time() ?>">
</head>
<body>
    <div class="auth-container">
        <!-- Sidebar Kiri -->
        <aside class="auth-sidebar">
            <div class="sidebar-content">
                <div class="logo-large">
                <img src="/images/JPPP.png" alt="JashPhoto Logo">
                <h1>JashPhoto</h1>
            </div>
        <h2 class="sidebar-title">Welcome to JashPhoto</h2>
        <p class="sidebar-text">Platform marketplace jasa fotografer profesional di Indonesia.</p>
        </div>
        </aside>
        
        <!-- Form Kanan -->
        <main class="auth-form-section">
            <div class="form-container">
                
                <!-- Logo Mobile -->
                <div class="logo-small">
                    <h2>JashPhoto</h2>
                </div>
                
                <!-- Header -->
                <header class="form-header">
                    <h2>Register New User</h2>
                    <p>Masuk data anda</p>
                </header>

                <!-- Alert Message -->
                <?php if (!empty($message)): ?>
                    <div class="alert <?php echo $isSuccess ? 'alert-success' : 'alert-error'; ?>">
                        <!-- <?php echo htmlspecialchars($message); ?> -->
                    </div>
                <?php endif; ?>
                
            
                <!-- FORM LOGIN -->
                <form method="POST" class="auth-form">
                    
                    <!-- Username -->
                    <div class="form-group">
                        <label>Username</label>
                        <input type="username" name="username" placeholder="jonosaja_bro" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" required>
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="••••••" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="••••••" required>
                    </div>
                    
                    <!-- Button Submit -->
                    <button type="submit" name="login" class="btn-submit">Register</button>
                    
                </form>
                
                <!-- Link ke Register -->
                <footer class="form-footer">
                    <p>Sudah punya akun? <a href="/login">Sign In</a></p>
                </footer>
                
            </div>
        </main>
        
    </div>
</body>
</html>