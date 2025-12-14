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

<h2>Login</h2>

<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<p><?= $message ?></p>
<p>Belum punya akun? <a href="/register">Daftar di sini</a></p>