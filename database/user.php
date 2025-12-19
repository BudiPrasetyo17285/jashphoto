<?php

define('TABLE', 'user');
require_once 'connection.php';

function verifyLogin($email) {
    $conn = getDBConnection();

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $profile = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();
    
    return $profile;
}

function getUserByUsername($username, $removepassword = true) {
    $conn = getDBConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE . " WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($removepassword) {
        unset($user["password"]);
    }

    $stmt->close();
    $conn->close();

    return $user;
}

function createUser($username, $Email, $password) {
    $conn = getDBConnection();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO " . TABLE . " (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $Email);

    $success = $stmt->execute();

    if ($success) {
        // --- THIS IS HOW YOU GET THE INSERTED ID ---
        $result = $conn->insert_id; 
    } else {
        // Handle the error case (e.g., return false or throw exception)
        throw new Exception("User creation failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

    return $result;
}


