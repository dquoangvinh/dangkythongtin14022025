<?php
// Kết nối đến cơ sở dữ liệu
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'News';

$conn = mysqli_connect($hostname, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thiết lập UTF-8
mysqli_query($conn, "SET NAMES 'utf8'");
?>