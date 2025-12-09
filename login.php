<?php
require_once "database/user.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = getUserByUsername($username);

    if ($user && password_verify($password, $user["password"])) {
        // berhasil login
        $_SESSION["user_id"] = $user["id"];
        header("Location: profil.php");
        exit;
    } else {
        $message = "Username atau password salah!";
    }
}
?>

<h2>Login</h2>

<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<p><?= $message ?></p>
<p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>