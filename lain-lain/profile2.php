<?php

require "database/user.php";

$isSuccess = false;
$message = "";

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($username === "" || $password === "") {
        $message = "Username dan password tidak boleh kosong!";
    } else {
        $userId = createUser($username, $password);

        if ($userId) {
            $isSuccess = true;
            $message = "User created successfully with ID: " . $userId;
        } else {
            $message = "Error creating user.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>

<?php if (!$isSuccess) { ?> 

    <h1>Registrasi</h1>
    <form action="profile2.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Submit</button>
    </form>

    <?php if ($message !== "") { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

<?php } else { ?>

    <h1>Registrasi Berhasil</h1>
    <p><?php echo $message; ?></p>

<?php } ?>

</body>
</html>
