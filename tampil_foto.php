<?php
require "database/connection.php";
$conn = getDBConnection();


$sql = "SELECT * FROM photo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Foto</title>
    <style>
        img {
            width: 200px;
            border-radius: 10px;
            margin: 10px;
        }
    </style>
</head>
<body>

<h2>Foto dari Database</h2>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<img src="photo/' . $row['image'] . '" alt="gambar">';
    }
} else {
    echo "Tidak ada foto.";
}
?>

</body>
</html>
