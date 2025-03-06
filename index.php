<?php
session_start(); // Start session to access session variables
?>

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
<?php


if (isset($_SESSION['user_name'])) {
    echo '<div>
             <h2 class="m-8 font-extrabold text-4xl text-center bg-light p-1" style="color:#0f3859;">
                 Welcome ' . $_SESSION['user_name'] . ', start your book shopping!
             </h2>
             <i class="fas fa-times" onclick="this.parentElement.style.display=\'none\'"></i>
          </div>';
} else {
    echo '<div>
             <h2 class=" m-8 font-extrabold text-4xl text-center bg-red-600 text-white p-2">
                 Please log in to start shopping.
             </h2>
          </div>';
}
?>

<!-- ✅ Empty Banner Box -->
<div class="banner"></div>

<!-- Welcome Message Section -->



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
            <h2 class="m-8 font-extrabold text-4xl text-center bg-light p-1" style="color:#0f3859;">
            
            New Arrived
            </h2>
        </div>
    </section>
    <section class="carousel-container ">
        <div class="swiper ">
            <div class="swiper-wrapper">
            <?php
session_start(); // Start the session

$select_book = mysqli_query($conn, "SELECT * FROM `book_info` ORDER BY date DESC LIMIT 12") or die('Query failed');
if (mysqli_num_rows($select_book) > 0) {
    while ($fetch_book = mysqli_fetch_assoc($select_book)) {
        $discount = rand(10, 30);
        $discounted_price = $fetch_book['price'] - ($fetch_book['price'] * ($discount / 100));
?>
        <div class="swiper-slide">
            <span class="discount-badge"><?php echo $discount; ?>% OFF</span>
            <a href="<?php echo isset($_SESSION['user_id']) ? 'book_details.php?details=' . $fetch_book['bid'] : 'login.php'; ?>">
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
    <section id="Best Sellers">
        <div class="container-fluid mx-auto  ">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 bg-light p-1" style="color:#0f3859;">
            
            Best Sellers
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


    <div class="banner"></div>


    <section id="Magical">
        <div class="container-fluid mx-auto  ">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 bg-light p-1" style="color:#0f3859;">
            
            Magical
            </h2>
        </div>
    </section>
    <section class="carousel-container">

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` WHERE category='Magical' ORDER BY date DESC LIMIT 12") or die('Query failed');
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

<section id="Knowledge">
        <div class="container-fluid mx-auto  ">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 bg-light p-1" style="color:#0f3859;">
            
            Knowledge
            </h2>
        </div>
    </section>
    <section class="carousel-container">

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` WHERE category='Knowledge' ORDER BY date DESC LIMIT 12") or die('Query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
                    $discount = rand(10, 30); // Random discount
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
                        <form action="" method="POST">
                            <input type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart.png" alt="Add to cart"></button>
                            &nbsp; | 
                            <a href="login.php?details=<?php echo $fetch_book['bid']; ?>" class="update_btn">Know More</a>
                        </form>
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

<div class="banner"></div>

<section id="Box Set">
        <div class="container-fluid mx-auto  ">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 bg-light p-1" style="color:#0f3859;">
            
            Box Set
            </h2>
        </div>
    </section>
<section class="carousel-container">
   
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php
            $select_box_sets = mysqli_query($conn, "SELECT * FROM `book_info` WHERE category='Box Set' ORDER BY date DESC LIMIT 10") or die('Query failed');
            if (mysqli_num_rows($select_box_sets) > 0) {
                while ($fetch_set = mysqli_fetch_assoc($select_box_sets)) {
                    $discount = rand(15, 40); // Random discount
                    $discounted_price = $fetch_set['price'] - ($fetch_set['price'] * ($discount / 100));
            ?>
                    <div class="swiper-slide">
                        <span class="discount-badge"><?php echo $discount; ?>% OFF</span>
                        <a href="login.php?details=<?php echo $fetch_set['bid']; ?>">
                            <img src="added_books/<?php echo $fetch_set['image']; ?>" alt="Box Set Image" class="book-img">
                        </a>
                        <div class="book-name"><?php echo $fetch_set['name']; ?></div>
                        <div class="author">by <?php echo $fetch_set['author']; ?></div>
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <div class="price">₹<?php echo number_format($discounted_price, 2); ?>
                            <span class="old-price">₹<?php echo number_format($fetch_set['price'], 2); ?></span>
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" name="book_name" value="<?php echo $fetch_set['name'] ?>">
                            <input type="hidden" name="book_image" value="<?php echo $fetch_set['image'] ?>">
                            <input type="hidden" name="book_price" value="<?php echo $fetch_set['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart.png" alt="Add to cart"></button>
                            &nbsp; | 
                            <a href="login.php?details=<?php echo $fetch_set['bid']; ?>" class="update_btn">Know More</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No Box Sets Available!</p>';
            }
            ?>
        </div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

<section class="featured-authors">
<section id="Magical">
        <div class="container-fluid mx-auto  ">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 bg-light p-1" style="color:#0f3859;">
            
            Featured Author
            </h2>
        </div>
    </section>
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">N. H. Apte</div>
            </div>
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">Author Name 2</div>
            </div>
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">Author Name 2</div>
            </div>
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">Author Name 2</div>
            </div>
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">Author Name 2</div>
            </div>
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">Author Name 2</div>
            </div>
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">Author Name 2</div>
            </div>
            <div class="swiper-slide">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/cf/NH_Apte.jpg/168px-NH_Apte.jpg" 
                     alt="Author Image" class="author-img">
                <div class="author-name">Author Name 2</div>
            </div>
            <!-- Add more authors dynamically later -->
        </div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>



    <?php include 'index_footer.php' ?>
    

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