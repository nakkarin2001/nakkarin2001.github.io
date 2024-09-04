<?php

include('pages/pet_adoption_db/pet_adoption_db.php'); 



$id = $_GET['id'];
$query = "SELECT * FROM pets WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$pet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pet) {
    echo "Pet not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดสัตว์เลี้ยง</title>
    <style>
     
        .details {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .details .image {
            flex: 1;
            padding: 10px;
        }
        .details .image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .details .info {
            flex: 2;
            padding: 10px;
        }
        .details h1 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #333;
        }
        .details p {
            font-size: 1.2em;
            margin: 10px 0;
            color: #555;
        }
        .details .description {
            margin-top: 20px;
        }
        .details button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .details button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="details">
        <div class="image">
            <img src="uploads/<?php echo htmlspecialchars($pet['image_path']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
        </div>
        <div class="info">
            <h1><?php echo htmlspecialchars($pet['name']); ?></h1>
            <p>สายพันธุ์: <?php echo htmlspecialchars($pet['breed']); ?></p>
            <p>สี: <?php echo htmlspecialchars($pet['color']); ?></p>
            <p>อายุ: <?php echo htmlspecialchars($pet['age']); ?> ปี</p>
            <p>เพศ: <?php echo htmlspecialchars($pet['gender']); ?></p>
            <p>วันที่ประกาศ: <?php echo htmlspecialchars(date("d/m/Y", strtotime($pet['date_posted']))); ?></p>
            <p>จังหวัด: <?php echo htmlspecialchars($pet['province']); ?></p>
            <p>อำเภอ: <?php echo htmlspecialchars($pet['district']); ?></p>
            <p>ตำบล: <?php echo htmlspecialchars($pet['sub_district']); ?></p>
            <p>ขนาด: <?php echo htmlspecialchars($pet['size']); ?></p>
            <p>ประเภท: <?php echo htmlspecialchars($pet['type']); ?></p>
            <div class="description">
                <p>คำอธิบาย: <?php echo nl2br(htmlspecialchars($pet['description'])); ?></p>
            </div>
            <button onclick="addToCart(<?php echo $pet['id']; ?>)">รับเลี้ยง</button>
        </div>
    </div>

    <script>
        function addToCart(petId) {
            
            console.log('เพิ่มลงในรถเข็น: ' + petId);

            alert('เพิ่มสัตว์เลี้ยงลงในรถเข็นเรียบร้อยแล้ว!');
        }
    </script>
</body>
</html>
