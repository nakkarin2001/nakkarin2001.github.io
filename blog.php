<?php
include('pages/pet_adoption_db/pet_adoption_db.php'); // ใช้ '/' แทน '\'

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$pdo) {
    die("การเชื่อมต่อล้มเหลว: " . $pdo->errorInfo());
}

$stmt = $pdo->prepare("SELECT * FROM blog_posts ORDER BY created_at DESC");
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>บล็อก - Pet Adoption Website</title>
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <div class="container1">
        <h1>บล็อก</h1>
        <div class="blog-grid">
            <?php foreach ($blogs as $blog): ?>
                <div class="blog-post">
                    <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
                    <?php if (!empty($blog['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($blog['image_path']); ?>" alt="Blog Image">
                    <?php else: ?>
                        <img src="assets/images/default-image.jpg" alt="Default Image">
                    <?php endif; ?>
                    <p><?php echo htmlspecialchars(substr($blog['content'], 0, 150)); ?>...</p>
                    <a href="view_blog.php?id=<?php echo htmlspecialchars($blog['id']); ?>" class="read-more">อ่านต่อ</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
