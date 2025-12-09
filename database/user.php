<?php

define('TABLE', 'user');
require_once 'connection.php';

function getUserProfile($userId) {
    $conn = getDBConnection();
    
    $stmt = $conn->prepare("SELECT id, username FROM " . TABLE . " WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $profile = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();
    
    return $profile;
}

function getUserByUsername($username) {
    $conn = getDBConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE . " WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $user;
}

function createUser($username, $password) {
    $conn = getDBConnection();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO " . TABLE . " (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    $success = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $success;
}


