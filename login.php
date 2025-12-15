<?php
require_once "database/user.php";
$cookie = $_COOKIE["token"] ?? "";
$user = $cookie != "" ? json_decode(base64_decode($cookie)) : false;

if($user) {
    header("Location: /homepage.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = getUserByUsername($username, false);

    if ($user && password_verify($password, $user["password"])) {
        // berhasil login
        $userencoded = json_encode($user);

        setcookie("token", base64_encode($userencoded), time() + (86400 * 30), "/"); 
        header("Location: /homepage.php");
        exit;
    } else {
        $message = "Username atau password salah!";
    }
}
?>

<?php
// Cek jika sudah login, redirect ke homepage
session_start();
if(isset($_SESSION['user'])) {
    header("Location: ../homepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JashPhoto</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <!-- Logo -->
            <div class="logo-section">
                <img src="logo.png" alt="JashPhoto Logo" class="logo-img">
            </div>

            <!-- Title -->
            <h1 class="login-title">Login</h1>
            <p class="login-subtitle">Welcome back! Please login to your account</p>

            <!-- Form -->
            <form id="loginForm" class="login-form" method="POST" action="process-login.php">
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="johndoe" 
                        required
                        autocomplete="username"
                    >
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••" 
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-password" id="togglePassword">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="forgot-password.php" class="forgot-link">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    Login
                </button>

                <!-- Register Link -->
                <p class="register-text">
                    Don't have an account? <a href="register/index.php" class="register-link">Register here</a>
                </p>
            </form>

            <!-- Alert Messages -->
            <div id="alertMessage" class="alert" style="display: none;"></div>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>