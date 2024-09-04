
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets\css\login.css">
    <title>หน้าล็อกอินทันสมัย | AsmrProg</title>
</head>

<body>

    <video autoplay muted loop id="background-video">
        <source src="imgbody\2849936-uhd_3840_2160_24fps.mp4" type="video/mp4">
    </video>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>สร้างบัญชี</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>หรือใช้ email ของคุณในการลงทะเบียน</span>
                <input type="text" placeholder="ชื่อ">
                <input type="email" placeholder="อีเมล">
                <input type="password" placeholder="รหัสผ่าน">
                <button>สมัครสมาชิก</button>
            </form>
        </div>
        <div class="form-container sign-in">
    <form action="login.php" method="post">
        <h1>เข้าสู่ระบบ</h1>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <span>หรือใช้ email และรหัสผ่านของคุณ</span>
        <input type="email" name="email" placeholder="อีเมล" required>
        <input type="password" name="password" placeholder="รหัสผ่าน" required>
        <a href="#">ลืมรหัสผ่าน?</a>
        <button type="submit">เข้าสู่ระบบ</button>
    </form>
</div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>ยินดีต้อนรับกลับมา!</h1>
                    <p>กรอกข้อมูลส่วนตัวของคุณเพื่อใช้ฟีเจอร์ทั้งหมดในเว็บไซต์</p>
                    <button class="hidden" id="login">เข้าสู่ระบบ</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>สวัสดี, เพื่อน!</h1>
                    <p>ลงทะเบียนด้วยข้อมูลส่วนตัวของคุณเพื่อใช้ฟีเจอร์ทั้งหมดในเว็บไซต์</p>
                    <button class="hidden" id="register">สมัครสมาชิก</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets\js\login.js"></script>
</body>

</html>
