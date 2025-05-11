<?php
if (!isset($_SESSION['staff_id'])) {
    header('location: ms_login.php');
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
    <title>Staff Panel</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="ms_dashboard.php"><span class="text-warning">Page</span> <span class="text-light">Turner</span></a>
        </div>

        <div class="nav">
            <a href="ms_dashboard.php" class="<?php echo ($current_page == 'ms_dashboard.php') ? 'active' : ''; ?>">Dashboard</a>
            <a href="ms_manage_orders.php" class="<?php echo ($current_page == 'ms_manage_orders.php') ? 'active' : ''; ?>">Orders</a>
            <a href="ms_pending_orders.php" class="<?php echo ($current_page == 'ms_pending_orders.php') ? 'active' : ''; ?>">Pending</a>
            <a href="ms_assigned_orders.php" class="<?php echo ($current_page == 'ms_assigned_orders.php') ? 'active' : ''; ?>">Assigned</a>
            <a href="ms_delivered_orders.php" class="<?php echo ($current_page == 'ms_delivered_orders.php') ? 'active' : ''; ?>">Delivered</a>
            <a href="ms_manage_users.php" class="<?php echo ($current_page == 'ms_manage_users.php') ? 'active' : ''; ?>">Users</a>
        </div>

        <div class="admin-info">
            <p>Hello, <?php echo $_SESSION['staff_name']; ?></p>
            <a href="logout.php?logout=<?php echo $_SESSION['staff_name']; ?>">
                <img src="images/logout.png" class="admin-avatar" alt="Logout"/>
            </a>
        </div>
    </header>
</body>
</html>
