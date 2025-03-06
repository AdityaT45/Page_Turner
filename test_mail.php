i will provide you code off header and index
when i am logged in that time show messege -welcome {name} start your book shopping on index page after carsole bookCarousel
header.php
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
            <a href="index.php"><span class="text-warning">Page</span> <span class="me text-light">Turner</span></a>
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
                </div>
            </div>
            <a href="contact-us.php">Contact Us</a>
            <a href="cart.php">Cart</a>
            <a href="orders.php">Orders</a>
        </div>

        <div class="user-search">
            <a href="search_books.php" class="search-icon bg-light">
                <img src="./images/search.png" alt="Search">
            </a>

            <?php
            session_start();
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

index.php
<?php
include 'config.php';

error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your books';
    } else {
        $book_name = $_POST['book_name'];
        $book_id = $_POST['book_id'];
        $book_image = $_POST['book_image'];
        $book_price = $_POST['book_price'];
        $book_quantity = '1';

        $total_price = number_format($book_price * $book_quantity);

        $select_book = $conn->query("SELECT * FROM cart WHERE book_id= '$book_id' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_book) > 0) {
            $message[] = 'This Book is alredy in your cart';
        } else {
            $conn->query("INSERT INTO cart (`user_id`,`book_id`,`name`, `price`, `image`,`quantity` ,`total`) VALUES('$user_id','$book_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Book Added To Cart Successfully';
            // header('location:index.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/hello.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <title>Page Turner</title>

    <style>
        * {
            text-decoration: none;
        }

        img {
            border: none;
        }

        .message {
            position: sticky;
            top: 0;
            margin: 0 auto;
            width: 61%;
            background-color: #fff;
            padding: 6px 9px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
            gap: 0px;
            border: 2px solid rgb(68, 203, 236);
            border-top-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .message span {
            font-size: 22px;
            color: rgb(240, 18, 18);
            font-weight: 400;
        }

        .message i {
            cursor: pointer;
            color: rgb(3, 227, 235);
            font-size: 15px;
        }
        .carousel-inner img {
        height: 50vh; /* 60% of the viewport height */
        object-fit: cover; /* Ensures the image fills the area */
    }
    .banner {
    width: 70%; /* Set width to 70% */
    height: 200px; /* Adjust height as needed */
    background: #f0f0f0; /* Light gray background */
    margin: 20px auto; /* Center it horizontally */
    border: 2px dashed #ccc; /* Dashed border to indicate an empty box */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #888;
}
.empty {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #ff4d4d;  /* Red color to highlight the message */
    background: #ffecec; /* Light red background */
    padding: 15px 20px;
    border-radius: 8px;
    width: fit-content;
    margin: 40px auto;
    border: 2px solid #ff9999; /* Soft border for visibility */
    box-shadow: 0px 4px 8px rgba(255, 77, 77, 0.2);
}


/* //authors  */
.featured-authors {
    width: 90%;
    margin: auto;
    padding: 40px 0;
    text-align: center;
}


.swiper {
    width: 100%;
    padding-bottom: 50px;
}

.swiper-slide {
    background: #fff;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 15px;
    transition: 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    
}

.swiper-slide:hover {
    transform: scale(1.05);
}

.author-img {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 0px;
    border: 3px solid #0f3859;
    /* height: 430px; */
}

.author-name {
    font-size: 18px;
    font-weight: 800;
    color: #333;
    margin-top: 10px;
}


    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .carousel-container {
            width: 90%;
            margin: auto;
            padding: 10px 0;
            position: relative;
         
        }

        .swiper {
            width: 100%;
            padding-bottom: 30px;
        }

        .swiper-slide {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #fff;
    padding: 15px;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.02);
    transition: transform 0.3s ease-in-out;
    width: 220px; /* Adjusted for better spacing */
    height: 430px; /* Increased card height */
    position: relative;
}


        .swiper-slide:hover {
            transform: scale(1.05);
        }

        .book-img {
    width: 180px;  /* Increased size */
    height: 250px; /* Increased size */
    object-fit: cover;
    margin: auto;
    display: block; /* Centered */
    border-radius: 5px;
}

        .book-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .author {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .stars {
            color: #FFD700;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .price {
    font-size: 22px; /* Increased size */
    font-weight: bold;
    color: red; /* Changed to red */
}


        .old-price {
            text-decoration: line-through;
            color: gray;
            font-size: 14px;
            margin-left: 8px;
        }

        .discount-badge {
            position: absolute;
            background: red;
            color: white;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 5px;
            top: 10px;
            left: 10px;
        }

        .swiper-button-next, .swiper-button-prev {
            color: #0f3859;
        }
    </style>
</head>

<body style="background-color:#fdfce5" >
    <?php include 'index_header.php' ?>

    <!-- Carousel Section -->
    <div id="bookCarousel" class="carousel slide container-fluid" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://wowslider.com/sliders/demo-77/data1/images/road220058.jpg" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="https://wowslider.com/sliders/demo-77/data1/images/idaho239691_1920.jpg" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="https://wowslider.com/sliders/demo-77/data1/images/idaho239691_1920.jpg" class="d-block w-100" alt="Slide 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- ✅ Empty Banner Box -->
<div class="banner"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message" id="messages"><span>' . $message . '</span></div>';
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

    

    <section id="New">
        <div class="container-fluid mx-auto  ">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 bg-light p-1" style="color:#0f3859;">
            
            New Arrived
            </h2>
        </div>
    </section>
    <section class="carousel-container ">
        <div class="swiper ">
            <div class="swiper-wrapper">
                <?php
                $select_book = mysqli_query($conn, "SELECT * FROM `book_info` ORDER BY date DESC LIMIT 12") or die('Query failed');
                if (mysqli_num_rows($select_book) > 0) {
                    while ($fetch_book = mysqli_fetch_assoc($select_book)) {
                        $discount = rand(10, 30); // Random discount percentage
                        $discounted_price = $fetch_book['price'] - ($fetch_book['price'] * ($discount / 100));
                ?>
                        <div class="swiper-slide">
    <span class="discount-badge"><?php echo $discount; ?>% OFF</span>
    <a href="login.php?details=<?php echo $fetch_book['bid']; ?>">
        <img src="added_books/<?php echo $fetch_book['image']; ?>" alt="Book Image" class="book-img">
    </a>
    <div class="book-name"><?php echo $fetch_book['name']; ?></div>
    <div class="author">by <?php echo $fetch_book['author']; ?></div>
    <div class="stars">⭐⭐⭐⭐⭐</div>
    <div class="price">₹<?php echo number_format($discounted_price, 2); ?>
        <span class="old-price">₹<?php echo number_format($fetch_book['price'], 2); ?></span>
    </div>
</div>
                <?php
                    }
                } else {
                    echo '<p class="empty">No Books Available!</p>';
                }
                ?>
            </div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
 
   

    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // hides element (still takes up space on page)
            box.style.display = 'none';
        }, 2000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper", {
            slidesPerView: 6,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                1024: { slidesPerView: 6 },
                768: { slidesPerView: 4 },
                480: { slidesPerView: 2 }
            }
        });
    </script>


</body>

</html>

so give your 200 % and give me updated full index code