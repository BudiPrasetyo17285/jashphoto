<?php

define('TABLE', 'customers');
require_once 'connection.php';

function getUserProfile($userId) {
    $conn = getDBConnection();
    
    $stmt = $conn->prepare("SELECT * FROM " . TABLE . " WHERE id = ?");
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

    $password = password_hash($password, PASSWORD_BCRYPT);
    
    $stmt = $conn->prepare("INSERT INTO " . TABLE . " (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $userId = $stmt->insert_id;

    $stmt->close();
    $conn->close();

    return getUserProfile($userId);
}

function getAllUsers() {
    $conn = getDBConnection();
    
    $result = $conn->query("SELECT * FROM " . TABLE);
    $users = [];
    
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    
    $conn->close();
    
    return $users;
}