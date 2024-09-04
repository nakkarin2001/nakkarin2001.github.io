<?php

include('pages\pet_adoption_db\pet_adoption_db.php'); 

if (!isset($_SESSION['username'])) {
    echo "กรุณาเข้าสู่ระบบ";
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username']; 

    
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        if ($_FILES['image']['error'] != 0) {
            echo "ข้อผิดพลาดในการอัปโหลดไฟล์: " . $_FILES['image']['error'];
        }
       
        $valid_extensions = array("jpg", "jpeg", "png", "gif", "webp");
        if (in_array($imageFileType, $valid_extensions) && $_FILES['image']['size'] < 5000000) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
              
            } else {
                echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์.";
                $image_path = '';
            }
        } else {
            echo "ไฟล์ไม่ถูกต้องหรือใหญ่เกินไป.";
            $image_path = '';
        }
    } elseif ($_FILES['image']['error'] != 0) {
        echo "ข้อผิดพลาดในการอัปโหลดไฟล์: " . $_FILES['image']['error'];
    }

    $stmt = $pdo->prepare("INSERT INTO blog_posts (title, content, author, image_path, created_at) VALUES (:title, :content, :author, :image_path, NOW())");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':image_path', $image_path);

    if ($stmt->execute()) {
        echo "โพสต์บล็อกสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการสร้างโพสต์บล็อก.";
    }
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>เขียนบล็อก - Pet Adoption Website</title>
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <div class="container">
        <h1>เขียนบล็อกใหม่</h1>
        <form action="write_blog.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">หัวข้อ:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">เนื้อหา:</label>
                <textarea id="content" name="content" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">รูปภาพ:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit">โพสต์</button>
        </form>
    </div>

</body>
</html>
