<?php
$host = mysqli_connect("localhost","root","","db_jashphoto");
if($host->connect_error){ 
    die("Koneksi gagal"); 
}
?>