<?php
session_start();

$servername = "db";  // เปลี่ยนเป็นชื่อ service ของ MySQL จาก docker-compose.yml
$username = "example_user"; // เปลี่ยนเป็นชื่อผู้ใช้ที่ถูกต้อง
$password = "example_password"; // เปลี่ยนเป็นรหัสผ่านที่ถูกต้อง
$dbname = "pet_adoption_db"; // ชื่อฐานข้อมูลที่ถูกต้อง

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "การเชื่อมต่อสำเร็จ"; // เพิ่มข้อความนี้เพื่อทดสอบการเชื่อมต่อ
} catch (PDOException $e) {
    echo "การเชื่อมต่อล้มเหลว: " . $e->getMessage();
    exit;
}
?>
