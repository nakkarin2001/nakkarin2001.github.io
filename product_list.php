<?php


// Fetch products from the database
$query = "SELECT id, name, SUBSTRING(description, 1, 100) AS preview, price, image_path FROM products ORDER BY id DESC";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>รายการสินค้า - Pet Adoption Website</title>
    <style>
        
        .container2 {
    max-width: 1500px; /* Adjusted for better responsiveness */
    margin: auto;
    padding: 20px;
}

.product-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
    justify-content: space-between; /* Adjusts spacing between items */
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    width: calc(20% - 20px); /* Adjust to fit 5 items per row */
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    flex: 1 1 calc(20% - 20px); /* Flex-grow and flex-shrink properties for equal width */
    cursor: pointer;
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column; /* Ensures vertical alignment of elements */
}

.product-card:hover {
    transform: scale(1.02);
}

.product-card img {
    width: 100%;
    height: 200px; /* Fixed height to maintain equal card height */
    object-fit: cover;
}

.product-card .info {
    padding: 15px;
    text-align: center;
    flex-grow: 1; /* Allows the info section to expand and fill available space */
}

.product-card h3 {
    margin: 0;
    font-size: 1.2em;
    color: #333;
}

.product-card p {
    margin: 5px 0;
    color: #555;
    font-size: 0.9em;
}

.product-card .price {
    font-weight: bold;
    color: #28a745;
}

@media screen and (max-width: 1200px) {
    .product-card {
        width: calc(25% - 20px); /* 4 items per row for smaller screens */
    }
}

@media screen and (max-width: 768px) {
    .product-card {
        width: calc(33.33% - 20px); /* 3 items per row for mobile screens */
    }
}

@media screen and (max-width: 480px) {
    .product-card {
        width: calc(50% - 20px); /* 2 items per row for very small screens */
    }
}
  
    </style>
</head>
<body>
    <div class="container2">
        <h1>รายการสินค้า</h1>
        <div class="product-list">
    <?php foreach ($products as $product): ?>
        <div class="product-card" onclick="window.location.href='product_detail.php?id=<?php echo htmlspecialchars($product['id']); ?>'">
            <?php if (!empty($product['image_path'])): ?>
                <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="Product Image">
            <?php else: ?>
                <img src="assets/images/default-image.jpg" alt="Default Image">
            <?php endif; ?>
            <div class="info">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['preview']); ?>...</p>
                <p class="price">ราคา: ฿<?php echo htmlspecialchars($product['price']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </div>
</body>
</html>
