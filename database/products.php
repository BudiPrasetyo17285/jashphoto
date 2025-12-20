<?php
require "connection.php";

function getAllProducts($categoryslug = null, $search = null) {
    $conn = getDBConnection();

    $where = $categoryslug && $search ? "WHERE categories.slug = '$categoryslug' AND products.name LIKE '%$search%'" : ($categoryslug ? "WHERE categories.slug ='$categoryslug'" : ($search ? "WHERE products.name LIKE '%$search%'" : ""));
    $sql  = "
    select *, products.name product_name, products.id as id_product
    from products
    left join categories
    on categories.id = products.id_category
    left join (
        select 
        photographer.id id_result_photographer,
        photographer.name, 
        photographer.lokasi, 
        photographer.rating, 
        photographer.foto_profil, 
        json_arrayagg(porto.image) images
        from photographer
        left join (
            select portofolio.id_photographer id_photographer, photo.image image
            from portofolio
            left join photo
                on photo.id=portofolio.id_photo
        ) as porto on porto.id_photographer=photographer.id
        group by photographer.id
    ) as result_photographer
        on result_photographer.id_result_photographer=products.id_photographer 
    $where;
    "; 

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
    $stmt = $conn->prepare("SELECT * FROM products WHERE id_category = ?");
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

function getProductById($id) {
    $conn = getDBConnection();
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function getPortfolioByPhotographer($photographerId) {
    $conn = getDBConnection();
    $sql = "SELECT * FROM products WHERE id_photographer = $photographerId";
    return $conn->query($sql);
}


