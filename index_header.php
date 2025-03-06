<!DOCTYPE html>
<html lang="en">
<head>
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

        .user-search {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            position: relative;
            border: 2px solid transparent;
        }

        .search-icon img {
            width: 25px;
            transition: transform 0.3s;
        }

        .search-icon:hover {
            border-color: #00c6ff;
            box-shadow: 0 0 15px #00c6ff;
        }

        .search-icon:hover img {
            transform: scale(1.2);
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid white;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        .user-avatar:hover {
            border-color: #00c6ff;
            box-shadow: 0 0 15px #00c6ff;
            transform: scale(1.1);
        }

        .sub-menu-wrap {
            position: fixed;
            top: 9%;
            right: 2%;
            width: 320px;
            max-height: 0px;
            overflow: hidden;
            transition: max-height 0.5s;
            z-index: 100;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 198, 255, 0.5);
        }

        .sub-menu-wrap.open-menu {
            max-height: 400px;
        }

        .sub-menu {
            background: transparent;
            padding: 20px;
            margin: 10px;
            border-bottom-right-radius: 16px;
            border-bottom-left-radius: 16px;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff;
            margin: 12px 0;
            transition: 0.3s;
        }

        .sub-menu-link:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .sub-menu-link p {
            width: 100%;
        }

        .user-name {
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            padding: 5px 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <header>
    <div class="logo">
            <a href="admin_index.php"><span class="text-warning">Page</span> <span class="me text-light">Turner</span></a>
        </div>

        <div class="nav">
            <a href="index.php">Home</a>
            <div class="dropdown">
                <button class="dropbtn">Category</button>
                <div class="dropdown-content">
                    <a href="index.php#New">New Arrived</a>
                    <a href="index.php#Adventure">Adventure</a>
                    <a href="index.php#Magical">Magical</a>
                    <a href="index.php#Knowledge">Knowledge</a>
                    <a href="all_books.php">All Books</a>
                    <a href="update_user_info.php">update info</a>
                </div>
            </div>
            <a href="submit_query.php">Contact Us</a>
            <a href="cart.php">Cart</a>
            <a href="orders.php">Orders</a>
        </div>

        <div class="user-search">
            <a href="search_books.php" class="search-icon bg-light">
                <img src="./images/search.png" alt="Search">
            </a>

            <?php

    if (isset($_SESSION['user_name'])) {
        echo '<div class="user-name" onclick="toggleMenu()">' . $_SESSION['user_name'] . '</div>';
    } else {
        echo '<img src="images/user.png" class="user-avatar" onclick="redirectToLogin()" />';
    }
    ?>
        </div>
    </header>

    <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
            <a href="cart.php" class="sub-menu-link"><p>Cart</p></a>
            <a href="contact-us.php" class="sub-menu-link"><p>Contact Us</p></a>
            <a href="orders.php" class="sub-menu-link"><p>Order History</p></a>
            <a href="logout.php" class="sub-menu-link"><p style="background:red;color:white;text-align:center;">Logout</p></a>
        </div>
    </div>

    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }

        function redirectToLogin() {
            window.location.href = "login.php";
        }
    </script>
</body>
</html>
