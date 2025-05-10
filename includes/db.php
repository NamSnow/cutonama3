<?php
$host = 'localhost';
$dbname = 'lamcutoa3';
$username = 'root'; // Thay bằng username của bạn
$password = ''; // Thay bằng password của bạn

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); // Changed $conn to $pdo
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}
