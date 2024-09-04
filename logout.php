<?php
session_start();
session_unset();
session_destroy();

// ป้องกันการแคชของเบราว์เซอร์
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// เปลี่ยนเส้นทางไปยังหน้า login.php
header("Location: login_main.php");
exit;
?>