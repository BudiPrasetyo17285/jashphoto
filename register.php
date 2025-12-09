<?php
require_once "database/user.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek username sudah ada atau belum
    if (getUserByUsername($username)) {
        $message = "Username sudah dipakai!";
    } else {
        if (createUser($username, $password)) {
            $message = "Registrasi berhasil! Silakan." . "<a href='login.php'>Login di sini</a>";
        } else {
            $message = "Terjadi kesalahan saat registrasi.";
        }
    }
}
?>

<h2>Register</h2>

<form action="register.php" method="POST">
    <input type="text" name="username" required placeholder="Username"><br><br>
    <input type="password" name="password" required placeholder="Password"><br><br>
    <button type="submit">Daftar</button>
</form>

<p><?= $message ?></p>
