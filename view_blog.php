<?php

session_start();

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



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$blog) {
        echo "โพสต์ไม่พบ";
        exit;
    }
} else {
    echo "โพสต์ไม่พบ";
    exit;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$pdo = null;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/blog-detail.css"> 
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>รายละเอียดบล็อก - Pet Adoption Website</title>
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <div class="container">
        <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
        <?php if (!empty($blog['image_path'])): ?>
            <img src="<?php echo htmlspecialchars($blog['image_path']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
        <?php else: ?>
     
            <img src="assets/images/default-image.jpg" alt="Default Image" style="max-width:100%; height:auto;">
        <?php endif; ?>
        <p><?php echo htmlspecialchars($blog['content']); ?></p>
        <small>เขียนโดย: <?php echo htmlspecialchars($blog['author']); ?> เมื่อ <?php echo htmlspecialchars($blog['created_at']); ?></small>
    </div>
    
    <?php include('includes/footer.php'); ?>
</body>
</html>
