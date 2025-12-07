<?php

require "database/users.php";

$isSuccess = false;
$message = "";

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = createUser($username, $password);

    if ($userId) {
        $message = "User created successfully with ID: " . $userId;
    } else {
        $message = "Error creating user.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (!$isSuccess) {?> 
    <h1>Registrasi</h1>
    <form action="profile2.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>
    <?php } else { ?>
    <h1>Registrasi Berhasil</h1>
    <p><?php echo $message; ?></p>
    <?php } ?>
</body>
</html>