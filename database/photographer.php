<?php
require_once "connection.php";

function getPhotographerById($id) {
    $conn = getDBConnection();
    $sql = "SELECT * FROM photographer WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

