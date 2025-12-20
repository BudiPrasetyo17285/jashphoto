<?php
require_once "connection.php";

function getPhotographerById($id) {
    $conn = getDBConnection();
    $sql = "SELECT * FROM photographer WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function getPhotographerByName($name) {
    $conn = getDBConnection();

    $sql = "SELECT * FROM photographer WHERE name LIKE '%$name%'";

    $result = $conn->query($sql);
    $photographer = [];
    while ($row = $result->fetch_assoc()) {
        $photographer[] = $row;
    }

    $conn->close();
    return $photographer;
}

function getAllPhotographer() {
    $conn = getDBConnection();

    $sql = "select * from photographer";

    $result = $conn->query($sql);

    $photographer = [];
    while ($row = $result->fetch_assoc()) {
        $photographer[] = $row;
    }

    $conn->close();
    return $photographer;
}

