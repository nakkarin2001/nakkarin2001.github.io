<?php


$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

if ($username) {
    $sql = "SELECT id, username, email, profile_pic FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['profile_pic'] = $user['profile_pic']; 
    } else {
        
        echo "User not found.";
    }
} 
?>



    <div class="top-bar">
        <div class="contact-info">
            <span><i class="fas fa-phone"></i> 096 779 1822</span>
            <span><i class="fas fa-envelope"></i> adopt.th@email.com</span>
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-dribbble"></i></a>
        </div>
    </div>

    <nav class="navbar">
        <div class="navbar-logo">
            <a href="index.php"><i class="fas fa-paw"></i> Pet Sitting</a>
        </div>
        <ul class="navbar-menu">
            <li><a href="index.php">หน้าหลัก</a></li>
            <li><a href="catalog.php">รับเลี้ยง</a></li>
            <li><a href="blog.php">บล็อค</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="user-menu">
    <a href="#" id="user-icon">
        <img src="<?php echo htmlspecialchars($_SESSION['profile_pic']); ?>" alt="Profile Picture" class="profile-pic" />
    </a>
    <div class="dropdown-content">
        <div class="profile-header">
            
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
        <a href="profile.php">โปรไฟล์</a>
        <a href="#">ตั้งค่า</a>
        <a href="write_blog.php">เขียนบล็อกใหม่</a>
        <a href="add_pet.php">หาเจ้าของให้สนุข</a>
        <a href="logout.php">ออกจากระบบ</a>
    </div>
</li>

            <?php else: ?>
                <li><a href="login_main.php">เข้าสู่ระบบ</a></li>
            <?php endif; ?>
        </ul>
    </nav>

