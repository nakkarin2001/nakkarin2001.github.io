<?php
include('pages/pet_adoption_db/pet_adoption_db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

        $valid_extensions = array("jpg", "jpeg", "png", "gif", "webp");
        if (in_array($imageFileType, $valid_extensions) && $_FILES['image']['size'] < 5000000) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                // Successfully uploaded image
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

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_path, category, stock) VALUES (:name, :description, :price, :image_path, :category, :stock)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':stock', $stock);

    if ($stmt->execute()) {
        echo "สินค้าเพิ่มสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มสินค้า.";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า - Pet Adoption Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .form-group button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>เพิ่มสินค้าใหม่</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">ชื่อสินค้า</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">รายละเอียด</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">ราคา</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="category">หมวดหมู่</label>
                <input type="text" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="stock">จำนวน</label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <div class="form-group">
                <label for="image">อัปโหลดภาพ</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="form-group">
                <button type="submit">เพิ่มสินค้า</button>
            </div>
        </form>
    </div>
</body>
</html>
