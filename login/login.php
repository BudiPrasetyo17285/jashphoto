<?php
// login.php
session_start();

// Cek jika sudah login, redirect ke homepage
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Validasi sederhana (nanti diganti dengan database)
    // Contoh user: admin / admin123
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = 'Username atau password salah';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JashPhoto</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <!-- Container utama -->
    <div class="login-container">
        
        <!-- Bagian kanan: Form -->
        <div class="login-form-container">
            <div class="login-form-wrapper">
                
                <!-- Header form -->
                <div class="form-header">
                    <h2>LOGIN</h2>
                    <p>Masuk ke akun Anda</p>
                </div>
                
                <!-- Error message -->
                <?php if ($error): ?>
                    <div class="error-message">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                
                <!-- Form login -->
                <form method="POST" action="login.php" class="login-form">
                    
                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            placeholder="Masukkan username"
                            required
                        >
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password"
                            required
                        >
                    </div>
                    
                    <!-- Remember me -->
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>
                        <a href="#" class="forgot-link">Lupa password?</a>
                    </div>
                    
                    <!-- Submit button -->
                    <button type="submit" class="btn-submit">MASUK</button>
                    
                    <!-- Register link -->
                    <div class="form-footer">
                        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                    </div>
                    
                </form>
                
                <!-- Demo info -->
                <div class="demo-info">
                    <p><strong>Demo Login:</strong></p>
                    <p>Username: <code>admin</code></p>
                    <p>Password: <code>admin123</code></p>
                </div>
                
            </div>
        </div>
        
    </div>
    
    <script src="login/login.js"></script>
</body>
</html>