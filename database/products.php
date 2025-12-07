<?php
define('TABLE', 'product');
require "connection.php";

function getAllProducts() {
    $conn = getDBConnection();
    
    $result = $conn->query("SELECT * FROM " . TABLE);
    $products = [];
    
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    $conn->close();
    
    return $products;
}