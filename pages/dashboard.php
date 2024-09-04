<?php


$queryPets = "SELECT COUNT(*) as total_pets FROM pets";
$stmtPets = $pdo->query($queryPets);
$totalPets = $stmtPets->fetchColumn();

$queryUsers = "SELECT COUNT(*) as total_users FROM users";
$stmtUsers = $pdo->query($queryUsers);
$totalUsers = $stmtUsers->fetchColumn();

$queryRevenue = "SELECT SUM(price) as total_revenue FROM products";
$stmtRevenue = $pdo->query($queryRevenue);
$totalRevenue = $stmtRevenue->fetchColumn();
?>


    <style>

.container {
    max-width: 1200px;
    width: 100%; 
    padding: 20px;
    box-sizing: border-box;
    
}

.dashboard {
    display: flex;
    justify-content: center; 
    gap: 60px; 
}

.dashboard-item {
    flex: 1;
    min-width: 300px; 
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    box-sizing: border-box;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-left: 5px solid;
}
        .dashboard-item i {
            font-size: 2rem;
            color: #000000;
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .dashboard-item h2 {
            margin: 40px 0 10px;
            color: #333;
        }
        .dashboard-item p {
            font-size: 1.5rem;
            margin: 0;
            color: #666;
        }
        /* สีพื้นหลังของแต่ละช่อง */
        .dashboard-item.pets {
            border-color: #6dbd63;
            background: #ffffff;
        }
        .dashboard-item.users {
            border-color: #3399ff;
            background: #ffffff;
        }
        .dashboard-item.revenue {
            border-color: #ff9933;
            background: #ffffff;
        }
        .dashboard-item.adoptions {
            border-color: #ff3333;
            background: #ffffff;
        }
    </style>

    <div class="container">
        <div class="dashboard">
            <div class="dashboard-item pets">
                <i class="fas fa-paw"> </i>
                <h2>สุนัขที่รอการรับเลี้ยง</h2>
                <p><?php echo number_format($totalPets); ?> ตัว</p>
            </div>
            <div class="dashboard-item users">
                <i class="fas fa-users"></i>
                <h2>สมาชิก</h2>
                <p><?php echo number_format($totalUsers); ?> คน</p>
            </div>
            <div class="dashboard-item revenue">
                <i class="fas fa-money-bill-wave"></i>
                <h2>เงินบริจาค</h2>
                <p><?php echo number_format($totalRevenue, 2); ?> บาท</p>
            </div>
            <div class="dashboard-item adoptions">
                <i class="fas fa-hand-holding-heart"></i>
                <h2>สุนัขรับไปเลี้ยงแล้ว</h2>
                <p><?php // แทรกข้อมูลเกี่ยวกับจำนวนการอุปการะ ?></p>
            </div>
        </div>
    </div>

