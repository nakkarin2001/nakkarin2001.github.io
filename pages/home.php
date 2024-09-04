<?php

$query = "SELECT id, name, breed, age, image_path FROM pets LIMIT 6"; // Show only 6 pets
$stmt = $pdo->query($query);
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
        .featured-pets {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding: 20px 0;
            white-space: nowrap;
        }
        .pet-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: 200px; 
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 0 0 auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .pet-card:hover {
            transform: scale(1.02);
        }
        .pet-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .pet-card .info {
            padding: 15px;
            text-align: center;
        }
        .pet-card h3 {
            margin: 0;
            font-size: 1em;
            color: #333;
        }
        .pet-card p {
            margin: 5px 0;
            color: #555;
        }
        @media screen and (max-width: 768px) {
            .pet-card {
                width: 150px; 
            }
        }
        @media screen and (max-width: 480px) {
            .pet-card {
                width: 120px; 
            }
        }

.view-all {
    background-color: #fac86b; 
}

.view-all:hover {
    background-color: #f3a921; 
    transform: scale(1.05); 
}

    </style>
</head>
<body>
    <div class="home">
        <a href="catalog.php" class="view-all">สุนัขทั้งหมด</a>
        <h1>หมาที่รอการอุปการะ</h1>
        <div class="featured-pets">
            <?php foreach ($pets as $pet): ?>
                <div class="pet-card" onclick="window.location.href='pet_details.php?id=<?php echo $pet['id']; ?>'">
                    <img src="uploads/<?php echo htmlspecialchars($pet['image_path']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                    <div class="info">
                        <h3><?php echo htmlspecialchars($pet['name']); ?></h3>
                        <p>Breed: <?php echo htmlspecialchars($pet['breed']); ?></p>
                        <p>Age: <?php echo htmlspecialchars($pet['age']); ?> years</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
