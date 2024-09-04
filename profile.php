<?php
include('pages\pet_adoption_db\pet_adoption_db.php');
// Get user information from the database
$username = $_SESSION['username'];
$sql = "SELECT username, email, profile_pic FROM users WHERE username = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $profilePic = $_FILES['profile_pic']['name'];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($profilePic);
    $uploadOk = 1;

    // Check if file is an image
    $check = getimagesize($_FILES['profile_pic']['tmp_name']);
    if ($check === false) {
        $uploadOk = 0;
        echo "File is not an image.";
    }

    // Check file size (5MB maximum)
    if ($_FILES['profile_pic']['size'] > 5000000) {
        $uploadOk = 0;
        echo "Sorry, your file is too large.";
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
            // Update profile picture in database
            $sqlUpdate = "UPDATE users SET email = ?, profile_pic = ? WHERE username = ?";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute([$email, $targetFile, $username]);
            $_SESSION['profile_pic'] = $targetFile; // Update session
            header('Location: profile.php');
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="index.php"><i class="fas fa-paw"></i> Pet Sitting</a>
        </div>
        <ul class="navbar-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="catalog.php">Adopt</a></li>
            <li><a href="blog.php">Blog</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="user-menu">
                    <a href="profile.php">
                        <img src="<?php echo htmlspecialchars($_SESSION['profile_pic']); ?>" alt="Profile Picture" class="profile-pic" />
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                </li>
            <?php else: ?>
                <li><a href="login_main.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <div class="profile-container">
        <h1>Profile</h1>
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="profile_pic">Profile Picture:</label>
                <input type="file" id="profile_pic" name="profile_pic">
                <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" class="profile-pic-preview">
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
