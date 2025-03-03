<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/hello.css">
    <style>
        * {
            text-decoration: none;
        }

        .sub-menu-wrap {
            position: fixed;
            top: 9%;
            right: -1%;
            width: 320px;
            max-height: 0px;
            overflow: hidden;
            transition: max-height 0.5s;
            z-index: 100;
        }

        .sub-menu-wrap.open-menu {
            max-height: 400px;
        }

        .sub-menu {
            background: #fff;
            padding: 20px;
            margin: 10px;
            border-bottom-right-radius: 16px;
            border-bottom-left-radius: 16px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info h3 {
            font-weight: 500;
        }

        .user-info img {
            width: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .user-pic {
            height: 52px;
            width: 52px;
            border-radius: 30px;
            margin-left: 2px;
            cursor: pointer;
        }

        .sub-menu hr {
            border: 0;
            height: 2px;
            width: 90%;
            margin: 12px 10px;
            color: red;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px e;
        }

        .sub-menu-link p {
            width: 100%;
        }

        .sub-menu-link img {
            width: 40px;
            background: #e5e5e5;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
        }

        .sub-menu-link span {
            font-size: 22px;
            transition: transform 0.5s;
        }

        .sub-menu-link:hover span {
            transform: translateX(15px);
        }

        .sub-menu-link:hover p {
            font-weight: 600;
        }

        .link_btn {
            background-color: brown;
            padding: 6px;
            border-radius: 10px;
            margin-left: 10px;
            color: white;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php"><span>Page</span>
                <span class="me">Turner</span></a>
        </div>
        <!--  -->
        <!-- <nav>
            <ul>
                <li><a href="#"> Home </a></li>
                <li>
                    Category
                    <ul class="drop-down">
                        <li><a href="index.php#New"> New Arrived </a></li>
                        <li><a href="index.php#Adventure"> Adventure </a></li>
                        <li><a href="index.php#Magical"> Magical </a></li>
                        <li><a href="index.php#Knowledge"> Knowledge </a></li>
                        <li><a href="all_books.php"> All Books </a></li>
                    </ul>
                </li>
                <li><a href="contact-us.php"> Contact US </a></li>
                <li><a href="cart.php"> Cart </a></li>
                <li><a href="orders.php"> Orders </a></li>
            </ul>
        </nav> -->
        <!--  -->
        <div class="nav">
            <a href="index.php">Home</a>
            <div class="dropdown">
                <button class="dropbtn" style="font-weight: 600;">Category</button>
                <div class="dropdown-content">
                    <a href="index.php#New">New Arrived</a>
                    <a href="index.php#Adventure">Adventure</a>
                    <a href="index.php#Magical">Magical</a>
                    <a href="index.php#Knowledge">Knowledge</a>
                    <a href="all_books.php">All Books</a>
                </div>
            </div>
            <a href="contact-us.php">Contact US</a>
            <a href="cart.php">Cart</a>
            <a href="orders.php">Orders</a>
        </div>
        <div class="user-box" style="display: flex; align-items:center;">
            <a class="Btn" href="search_books.php"><img style="height:30px; border:none;" src="./images/search.png"
                    alt=""></a>&nbsp;&nbsp;
            <?php
            if (isset($_SESSION['user_name'])) {
                echo '<img style="" src="images/user.png" class="user-pic" onclick="toggleMenu()" />';
            } else {
                echo '<img style="" src="images/user.png" class="user-pic" onclick="toggleMenu2()" />';
            }
            ?>
        </div>
    </header>
    <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
            <div class="user-info">
                <img src="images/user.png" />
                <div class="user-info" style="display: block;">
                    <h3>Hello,
                        <?php echo $_SESSION['user_name'] ?>
                    </h3>
                    <h6>
                        <?php echo $_SESSION['user_email'] ?>
                    </h6>
                </div>
            </div>
            <hr />
            <a href="cart.php" class="sub-menu-link">
                <p>Cart</p>
                <span>></span>
            </a>
            <a href="contact-us.php" class="sub-menu-link">
                <p>Contact Us</p>
                <span>></span>
            </a>
            <a href="orders.php" class="sub-menu-link">
                <p>Order history</p>
                <span>></span>
            </a>
            <a href="logout.php" class="sub-menu-link">
                <p
                    style="background-color: red; border-radius:8px; text-align:center; color:white; font-weight:600; margin-top:5px; padding:5px;">
                    Logout</p>
            </a>
        </div>
    </div>
    <!-- ------------------------------------------------------------------------------------------------------- -->
    <div class="sub-menu-wrap" id="subMenu2">
        <div class="sub-menu">
            <a href="login.php" class="sub-menu-link">
                <p>Login</p>
                <span>></span>
            </a>
            <a href="register.php" class="sub-menu-link">
                <p>Register</p>
                <span>></span>
            </a>
        </div>
    </div>


    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }

        let subMenu2 = document.getElementById("subMenu2");
        function toggleMenu2() {
            subMenu2.classList.toggle("open-menu");
        }
    </script>
</body>

</html>