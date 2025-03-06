<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./css/admin.css"> -->
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
            padding: 10px 20px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        .nav a::before {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            background: #00c6ff;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            transition: 0.3s ease-in-out;
        }

        .nav a:hover::before {
            width: 100%;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            font-weight: bold;
        }

        .admin-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid white;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .admin-avatar:hover {
            border-color: #00c6ff;
            box-shadow: 0 0 15px #00c6ff;
            transform: scale(1.1);
        }
    </style>
    <title>Admin Panel</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin_index.php"><span class="text-warning">Page</span> <span class="me text-light">Turner</span></a>
        </div>

        <div class="nav">
            <a href="admin_index.php">Home</a>
            <a href="add_books.php">Add Books</a>
            <a href="admin_orders.php">Orders</a>
            <a href="message_admin.php">Messages</a>
            <a href="users_detail.php">Users</a>
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
