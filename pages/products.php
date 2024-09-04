<?php
include('pages/pet_adoption_db/pet_adoption_db.php');

// Fetch products from the database
$query = "SELECT * FROM products";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ขายสินค้า - Pet Adoption Website</title>
    <style>
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            max-width: 200px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1>ขายสินค้าเกี่ยวกับสัตว์</h1>
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <?php
                // Construct the full image path
                $imagePath = 'uploads/' . $product['image_path'];
                
                // Check if the file exists
                if (file_exists($imagePath)) {
                    $imageSrc = htmlspecialchars($imagePath);
                } else {
                    $imageSrc = 'path/to/default-image.jpg'; // Update with your default image path
                    // Debugging output
                    echo '<!-- Image Path Error: ' . htmlspecialchars($imagePath) . ' -->';
                }
                ?>
                <img src="<?php echo $imageSrc; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>ราคา: ฿<?php echo htmlspecialchars($product['price']); ?></p>
                <button onclick="addToCart(<?php echo $product['id']; ?>)">เพิ่มลงในรถเข็น</button>
                <a href="product_detail.php?id=<?php echo $product['id']; ?>">ดูรายละเอียด</a>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function addToCart(productId) {
            console.log('เพิ่มลงในรถเข็น: ' + productId);
            alert('เพิ่มสินค้าลงในรถเข็นเรียบร้อยแล้ว!');
        }
    </script>
</body>
</html>
