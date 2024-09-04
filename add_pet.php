<?php

 include('pages\pet_adoption_db\pet_adoption_db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id']; 

 
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = '../uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    } else {
        $image_path = ''; 
    }

    $sql = "INSERT INTO pets (name, breed, age, size, color, image_path, description, user_id) 
            VALUES (:name, :breed, :age, :size, :color, :image_path, :description, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':breed' => $breed,
        ':age' => $age,
        ':size' => $size,
        ':color' => $color,
        ':image_path' => $image_path,
        ':description' => $description,
        ':user_id' => $user_id
    ]);

    echo "Pet added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet</title>
    <link rel="stylesheet" href="assets/css/add_pet.css"> 
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include('includes/navbar.php'); ?>

    <div class="form-container">
        <h1>Add a New Pet</h1>
        <form method="POST" action="add_pet.php" enctype="multipart/form-data">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="breed">Breed:</label>
                <input type="text" id="breed" name="breed" required>
            </div>
            <div>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="1" max="20" required>
            </div>
            <div>
                <label for="size">Size:</label>
                <select id="size" name="size" required>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </div>
            <div>
                <label for="color">Color:</label>
                <input type="text" id="color" name="color" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
