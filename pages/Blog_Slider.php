<?php


$query = "SELECT id, title, SUBSTRING(content, 1, 100) AS preview, created_at, image_path FROM blog_posts ORDER BY created_at DESC LIMIT 4";
$stmt = $pdo->query($query);
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>บล็อกล่าสุด - Pet Adoption Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .home {
            padding: 20px;
            position: relative;
        }
        .view-all {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .view-all:hover {
            background-color: #218838;
        }
        .blog-slider {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding: 20px 0;
            white-space: nowrap;
        }
        .blog-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: 300px; 
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 0 0 auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .blog-card:hover {
            transform: scale(1.02);
        }
        .blog-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .blog-card .info {
            padding: 15px;
            text-align: center;
        }
        .blog-card h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }
        .blog-card p {
            margin: 5px 0;
            color: #555;
            font-size: 0.9em;
        }
        @media screen and (max-width: 768px) {
            .blog-card {
                width: 250px; 
            }
        }
        @media screen and (max-width: 480px) {
            .blog-card {
                width: 200px; 
            }
        }
        .view-all {
            background-color: #bb8339; 
        }
        .view-all:hover {
            background-color: #865d26; 
            transform: scale(1.05); 
        }
    </style>
</head>
<body>
    <div class="home">
        <a href="blog.php" class="view-all">ดูบล็อกทั้งหมด</a>
        <h1>บล็อกล่าสุด</h1>
        <div class="blog-slider">
            <?php foreach ($blogs as $blog): ?>
                <div class="blog-card" onclick="window.location.href='view_blog.php?id=<?php echo htmlspecialchars($blog['id']); ?>'">
                    <?php if (!empty($blog['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($blog['image_path']); ?>" alt="Blog Image">
                    <?php else: ?>
                        <img src="assets/images/default-image.jpg" alt="Default Image">
                    <?php endif; ?>
                    <div class="info">
                        <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
                        <p><?php echo htmlspecialchars($blog['preview']); ?>...</p>
                        <small>เมื่อ <?php echo htmlspecialchars($blog['created_at']); ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
