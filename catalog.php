<?php

include('pages/pet_adoption_db/pet_adoption_db.php'); 


$search = $_GET['search'] ?? '';
$size = $_GET['size'] ?? '';
$color = $_GET['color'] ?? '';
$age = $_GET['age'] ?? '';

$query = "SELECT id, name, breed, age, size, color, image_path FROM pets WHERE name LIKE :search";
$params = [':search' => "%$search%"];

if ($size) {
    $query .= " AND size = :size";
    $params[':size'] = $size;
}

if ($color) {
    $query .= " AND color = :color";
    $params[':color'] = $color;
}

if ($age) {
    $query .= " AND age = :age";
    $params[':age'] = $age;
}

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    $pets = [];
}


$sizes = ['small', 'medium', 'large'];
$colors = ['black', 'white', 'brown', 'golden', 'gray', 'spotted']; 
$ages = range(1, 20); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Catalog</title>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/catalog.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
<?php include('includes/navbar.php'); ?>

    <div class="catalog-container">
        <div class="filters">
            <h2>Filter Pets</h2>
            <form method="GET" action="catalog.php">
                <div>
                    <label for="search">Search by Name:</label>
                    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <div>
                    <label for="size">Size:</label>
                    <select id="size" name="size">
                        <option value="">All Sizes</option>
                        <?php foreach ($sizes as $s): ?>
                            <option value="<?php echo htmlspecialchars($s); ?>" <?php echo $size === $s ? 'selected' : ''; ?>><?php echo ucfirst($s); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="color">Color:</label>
                    <select id="color" name="color">
                        <option value="">All Colors</option>
                        <?php foreach ($colors as $c): ?>
                            <option value="<?php echo htmlspecialchars($c); ?>" <?php echo $color === $c ? 'selected' : ''; ?>><?php echo ucfirst($c); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="age">Age:</label>
                    <select id="age" name="age">
                        <option value="">All Ages</option>
                        <?php foreach ($ages as $a): ?>
                            <option value="<?php echo htmlspecialchars($a); ?>" <?php echo $age == $a ? 'selected' : ''; ?>><?php echo htmlspecialchars($a); ?> years</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit">Filter</button>
            </form>
        </div>

        <div class="catalog">
            <?php if (!empty($pets)): ?>
                <?php foreach ($pets as $pet): ?>
                    <div class="pet-card" onclick="window.location.href='pet_details.php?id=<?php echo $pet['id']; ?>'">
                        <img src="uploads/<?php echo htmlspecialchars($pet['image_path']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                        <div class="info">
                            <h3><?php echo htmlspecialchars($pet['name']); ?></h3>
                            <p>Breed: <?php echo htmlspecialchars($pet['breed']); ?></p>
                            <p>Age: <?php echo htmlspecialchars($pet['age']); ?> years</p>
                            <p>Size: <?php echo htmlspecialchars($pet['size']); ?></p>
                            <p>Color: <?php echo htmlspecialchars($pet['color']); ?></p>
                            <button onclick="addToCart(<?php echo $pet['id']; ?>); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No pets found matching your criteria.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>

    <script>
        function addToCart(petId) {
            console.log('Add to cart: ' + petId);
        }
    </script>
</body>
</html>
