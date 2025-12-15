<?php
require_once "database/user.php";

$cookie = $_COOKIE["token"] ?? "";
$user = $cookie != "" ? json_decode(base64_decode($cookie)) : false;

if (!$user) {
    header("Location: login.php");
    exit;
}

$user = getUserProfile($user->id);
?>

<h2>Profil</h2>
<p>ID: <?= $user["id"] ?></p>
<p>Username: <?= $user["username"] ?></p>

<a href="logout.php">Logout</a>
