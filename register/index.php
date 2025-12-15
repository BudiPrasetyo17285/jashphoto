<?php
require_once "../database/user.php";

$cookie = $_COOKIE["token"] ?? "";
$user = $cookie != "" ? json_decode(base64_decode($cookie)) : false;

if($user) {
    header("Location: /homepage.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try{
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Check if username already registered
        $result = getUserByUsername($username);
        
        if($result) {
            $message = "<p class='danger'>Username already registered. Click <a href='/login.php'>login</a> for login your account.</p>";
        }
    
        // input new user
        if(!$result) {
            $result = createUser($username, $password, $fullname);
            $user = getUserByUsername($username);

            $userencoded = json_encode($user);

            setcookie("token", base64_encode($userencoded), time() + (86400 * 30), "/"); 
            header("Location: /homepage.php");
        };
    } catch  (Throwable $e) {
        $message = "<p>Failed to register user.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | JashPhoto</title>
    <link rel="stylesheet" href="./register.css?v=<?= time()?>">
</head>
<body>

    <main class="container">
        <div class="register_card">
            <form class="form" action="/register/index.php" method="POST">
                <div class="input_container">
                    <label for="fullname">Full Name</label>
                    <div class="input">
                        <input type="text" id="fullname" name="fullname" placeholder="John Doe">
                    </div>
                </div>
                <div class="input_container">
                    <label for="username">Username</label>
                    <div class="input">
                        <input type="text" id="username" name="username" placeholder="johndoe">
                    </div>
                </div>
                <div class="wrapper">
                    <div class="input_container">
                        <label for="password">Password</label>
                        <div class="input">
                            <input type="password" id="password" name="password">
                            <div class="icon_password">
                                <span class="icon melek">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                </span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-closed-icon lucide-eye-closed"><path d="m15 18-.722-3.25"/><path d="M2 8a10.645 10.645 0 0 0 20 0"/><path d="m20 15-1.726-2.05"/><path d="m4 15 1.726-2.05"/><path d="m9 18 .722-3.25"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="input_container">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="input">
                            <input type="password" id="confirm_password" name="confirm_password">
                            <div class="icon_password">
                                <span class="icon melek">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                </span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-closed-icon lucide-eye-closed"><path d="m15 18-.722-3.25"/><path d="M2 8a10.645 10.645 0 0 0 20 0"/><path d="m20 15-1.726-2.05"/><path d="m4 15 1.726-2.05"/><path d="m9 18 .722-3.25"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action">
                    <button type="submit">Register</button>
                    <div class="suggest">
                        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
                    </div>
                    <?= $message ?>
                </div>
            </div>
        </div>
    </main>

    <!-- <h2>Register</h2>
    
    <form action="register.php" method="POST">
        <input type="text" name="username" required placeholder="Username"><br><br>
        <input type="password" name="password" required placeholder="Password"><br><br>
        <button type="submit">Daftar</button>
    </form>
    
    
    <p><?= $message ?></p> -->
    <script src="./register.js?v=<?= time() ?>"></script>
</body>
</html>
