<?php
require "connection.php";

function getAllProducts() {
    $conn = getDBConnection();
    $sql  = "SELECT * FROM products";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $conn->close();
    return $products;
}

function getCategories() {
    $conn = getDBConnection();
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    $conn->close();
    return $categories;
}

function getProductsByCategory($id_categories) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM products WHERE id_categories = ?");
    $stmt->bind_param("i", $id_categories);
    $stmt->execute();

    $result = $stmt->get_result();
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $products;
}
