<?php

if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

// Get the current page name to highlight active link
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            text-decoration: none;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        header {
            background: #0f3859;
            padding: 15px 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .logo a {
            font-size: 28px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
        }

        .nav {
            display: flex;
            align-items: center;
        }

        .nav a {
            color: white;
            padding: 10px 18px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        .nav a.active, .nav a:hover {
            color: #00c6ff;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            font-weight: bold;
        }

        .admin-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid white;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .admin-avatar:hover {
            border-color: #00c6ff;
            box-shadow: 0 0 10px #00c6ff;
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 10px 20px;
            }
            .nav {
                flex-wrap: wrap;
                justify-content: center;
                margin-top: 10px;
            }
            .nav a {
                padding: 8px 12px;
                font-size: 14px;
            }
        }
    </style>
    <title>Admin Panel</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin_dashboard.php"><span class="text-warning">Page</span> <span class="text-light">Turner</span></a>
        </div>

        <div class="nav">
            <a href="admin_dashboard.php" class="<?php echo ($current_page == 'admin_dashboard.php') ? 'active' : ''; ?>">Dashboard</a>
            <a href="admin_orders.php" class="<?php echo ($current_page == 'admin_orders.php') ? 'active' : ''; ?>">Orders</a>
            <a href="admin_pending_orders.php" class="<?php echo ($current_page == 'admin_pending_orders.php') ? 'active' : ''; ?>">Pending Orders</a>
            <a href="admin_delivered_orders.php" class="<?php echo ($current_page == 'admin_delivered_orders.php') ? 'active' : ''; ?>">Delivered Orders</a>
            <a href="admin_delivery_staff.php" class="<?php echo ($current_page == 'admin_delivery_staff.php') ? 'active' : ''; ?>">Delivery Staff</a>
            <a href="admin_earnings.php" class="<?php echo ($current_page == 'admin_earnings.php') ? 'active' : ''; ?>">Earnings</a>
  
            <a href="admin_manage_users.php" class="<?php echo ($current_page == 'admin_manage_users.php') ? 'active' : ''; ?>">Users</a>
        </div>

        <div class="admin-info">
            <p>Hello, <?php echo $_SESSION['admin_name']; ?></p>
            <a href="logout.php?logout=<?php echo $_SESSION['admin_name']; ?>">
                <img src="images/logout.png" class="admin-avatar" alt="Logout"/>
            </a>
        </div>
    </header>
</body>
</html>
