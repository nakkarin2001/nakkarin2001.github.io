<?php
include('pages/pet_adoption_db/pet_adoption_db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ตรวจสอบว่าผู้ใช้เป็นแอดมินหรือไม่
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];  // ตั้งค่า session สำหรับแอดมิน
        $_SESSION['user_type'] = 'admin';  // กำหนดประเภทผู้ใช้เป็นแอดมิน
        header("Location: admin/dashboard/index.php");  // เปลี่ยนเส้นทางไปยังหน้าแดชบอร์ด
        exit;
    }

    // ตรวจสอบว่าผู้ใช้เป็นผู้ใช้ทั่วไป
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];  // ตั้งค่า session สำหรับผู้ใช้ทั่วไป
        $_SESSION['user_type'] = 'user';  // กำหนดประเภทผู้ใช้เป็นผู้ใช้ทั่วไป
        header("Location: index.php");  // เปลี่ยนเส้นทางไปยังหน้าโฮมเพจ
        exit;
    }

    // หากไม่พบผู้ใช้ในตาราง Admin หรือ User
    echo "ข้อมูลการล็อกอินไม่ถูกต้อง";
}
?>
