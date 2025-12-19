<?php
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require "database/user.php";

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
            header("refresh:2;url=login.php");
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
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <!-- Sidebar Kiri -->
        <aside class="auth-sidebar">
            <div class="sidebar-content">
                <div class="logo-large">
                    <img src="assets/images/JPPP.png" alt="JashPhoto Logo">
                    <h1>JashPhoto</h1>
                </div>
                <h2 class="sidebar-title">Bergabung dengan JashPhoto</h2>
                <p class="sidebar-text">Platform marketplace jasa fotografer profesional di Indonesia.</p>
            </div>
        </aside>

        <!-- Form Section Kanan -->
        <section class="auth-form-section">
            <div class="form-container">
                <!-- Logo Mobile -->
                <div class="logo-small">
                    <h2>JashPhoto</h2>
                </div>

                <!-- Form Header -->
                <div class="form-header">
                    <h2>Daftar Akun</h2>
                    <p>Buat akun baru untuk memulai</p>
                </div>

                <!-- Alert Message -->
                <?php if (!empty($message)): ?>
                    <div class="alert <?php echo $isSuccess ? 'alert-success' : 'alert-error'; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <!-- Form Register -->
                <form method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" 
                               value="<?php echo htmlspecialchars($username ?? ''); ?>" 
                               placeholder="Masukkan username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo htmlspecialchars($email ?? ''); ?>" 
                               placeholder="john@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" 
                               placeholder="Minimal 6 karakter" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" 
                               placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="btn-submit">Daftar Sekarang</button>
                </form>

                <!-- Form Footer -->
                <div class="form-footer">
                    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>