<?php


$servername = "db";  // ใช้ชื่อ service จาก docker-compose.yml
$username = "example_user"; // ชื่อผู้ใช้
$password = "example_password"; // รหัสผ่าน
$dbname = "pet_adoption_db"; // ชื่อฐานข้อมูล

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "การเชื่อมต่อสำเร็จ";
} catch (PDOException $e) {
    echo "การเชื่อมต่อล้มเหลว: " . $e->getMessage();
    exit;
}
?>
