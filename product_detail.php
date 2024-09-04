<?php
// Include database connection
include('pages/pet_adoption_db/pet_adoption_db.php');

// Get product ID from the query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the product details
$query = "SELECT id, name, description, price, image_path FROM products WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "ไม่พบสินค้านี้.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>รายละเอียดสินค้า - <?php echo htmlspecialchars($product['name']); ?></title>
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
        .product-detail img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }
        .product-detail h1 {
            margin: 0;
            font-size: 2em;
            color: #333;
        }
        .product-detail p {
            color: #555;
            font-size: 1em;
        }
        .product-detail .price {
            font-weight: bold;
            color: #28a745;
            font-size: 1.5em;
        }
        .product-detail button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }
        .product-detail button:hover {
            background-color: #218838;
        }

        
    </style>
</head>
<body>
    <div class="container product-detail">
        <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="Product Image">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p class="price">ราคา: ฿<?php echo htmlspecialchars($product['price']); ?></p>
        <a href="cart.php?add=<?php echo htmlspecialchars($product['id']); ?>" class="button">เพิ่มลงในรถเข็น</a>
    </div>
</body>
</html>
