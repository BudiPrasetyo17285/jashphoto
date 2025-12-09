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

function createUser($username, $password) {
    $conn = getDBConnection();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Insert user
    $stmt = $conn->prepare("INSERT INTO " . TABLE . " (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    $stmt->execute();
    
    // Ambil ID terakhir
    $userId = $stmt->insert_id;

    $stmt->close();
    $conn->close();

    // Kembalikan ID saja
    return $userId;
}

function getAllUsers() {
    $conn = getDBConnection();
    
    $result = $conn->query("SELECT id, username FROM " . TABLE);
    $users = [];
    
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    
    $conn->close();
    
    return $users;
}
