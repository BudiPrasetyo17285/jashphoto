<?php
// login.php - Halaman Login SIMPEL
session_start();

// Include koneksi database
include '../database/connection.php';

// Variable untuk pesan
$pesan = "";

// CEK: Apakah form di-submit?
if (isset($_POST['login'])) {
    
    // 1. AMBIL DATA DARI FORM
    $email    = $_POST['email'];
    $password = $_POST['password'];
    
    // 2. CARI USER DI DATABASE
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    // 3. CEK: Apakah user ditemukan?
    if (mysqli_num_rows($result) > 0) {
        
        // Ambil data user
        $user = mysqli_fetch_assoc($result);
        
        // 4. CEK PASSWORD
        if (password_verify($password, $user['password'])) {
            
            // LOGIN BERHASIL!
            // Simpan data ke session
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['email']     = $user['email'];
            $_SESSION['fullname']  = $user['fullname'];
            
            // Redirect ke homepage
            header("Location: index.php");
            exit();
            
        } else {
            // Password salah
            $pesan = "Password salah!";
        }
        
    } else {
        // Email tidak ditemukan
        $pesan = "Email tidak terdaftar!";
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
    
    <div class="auth-container">
        
        <!-- Sidebar Kiri -->
        <aside class="auth-sidebar">
            <div class="sidebar-content">
                <div class="logo-large">
                <img src="JPPP.png" alt="JashPhoto Logo">
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
                    <h2>Sign in</h2>
                    <p>Masuk ke akun Anda</p>
                </header>
                
                <!-- Pesan (jika ada) -->
                <?php if ($pesan != ""): ?>
                    <div class="alert alert-error">
                        <?= $pesan ?>
                    </div>
                <?php endif; ?>
                
                <!-- FORM LOGIN -->
                <form method="POST" class="auth-form">
                    
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
                    
                    <!-- Remember & Forgot -->
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot Password</a>
                    </div>
                    
                    <!-- Button Submit -->
                    <button type="submit" name="login" class="btn-submit">Sign in</button>
                    
                </form>
                
                <!-- Link ke Register -->
                <footer class="form-footer">
                    <p>Belum punya akun? <a href="register.php">Sign up</a></p>
                </footer>
                
            </div>
        </main>
        
    </div>
    
</body>
</html>