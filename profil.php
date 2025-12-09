<?php
session_start();
require_once "database/user.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user = getUserProfile($_SESSION["user_id"]);
?>

<h2>Profil</h2>
<p>ID: <?= $user["id"] ?></p>
<p>Username: <?= $user["username"] ?></p>

<a href="logout.php">Logout</a>
