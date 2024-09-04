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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading file: " . $file['error'];
        exit;
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo "Invalid file type.";
        exit;
    }

    if ($file['size'] > 5 * 1080 * 720) {
        echo "File is too large.";
        exit;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $ext;
    $uploadDir = 'uploads/';
    $uploadPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        echo "Error saving file. File path: " . $uploadPath;
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO images (image_path) VALUES (:image_path)");
    $stmt->bindParam(':image_path', $newFileName);

    if (!$stmt->execute()) {
        echo "Error saving file path to database.";
    }
    
    header("Location: index.php");
    exit;
}

// Handle image deletion
if (isset($_GET['delete'])) {
    $imageId = (int) $_GET['delete'];

    $stmt = $pdo->prepare("SELECT image_path FROM images WHERE id = :id");
    $stmt->bindParam(':id', $imageId);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $imagePath = 'uploads/' . $image['image_path']; // แก้ไขเส้นทางให้ถูกต้อง

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $stmt = $pdo->prepare("DELETE FROM images WHERE id = :id");
        $stmt->bindParam(':id', $imageId);

        if (!$stmt->execute()) {
            echo "Error deleting image from database.";
        }
    }

    header("Location: index.php");
    exit;
}


$query = "SELECT id, image_path FROM images";
$stmt = $pdo->query($query);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Management</title>
    <link rel="stylesheet" href="css\upload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>ข่าวสารประชาสัมพันธ์</h1>
        
        <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="image" accept="image/*" required>
            <button type="submit">Upload</button>
        </form>

        <div id="previewContainer" class="preview-container">
            
        </div>

        <div class="image-container">
            <?php foreach ($images as $image): ?>
                <div class="image-item">
                    <img src="uploads\<?php echo htmlspecialchars($image['image_path']); ?>" alt="Uploaded Image">
                    <a href="upload.php?delete=<?php echo $image['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this image?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="js/upload.js"></script>
</body>
</html>
