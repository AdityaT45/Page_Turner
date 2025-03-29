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
        $book_quantity = $_POST['quantity'];
        $total_price = number_format($book_price * $book_quantity);

        $select_book = $conn->query("SELECT * FROM cart WHERE name= '$book_name' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_book) > 0) {
            $message[] = 'This Book is already in your cart';
        } else {
            $conn->query("INSERT INTO cart (`book_id`,`user_id`,`name`, `price`, `image`, `quantity`, `total`) 
            VALUES('$book_id','$user_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Book Added To Cart Successfully';
            
            // Redirect to cart.php after successful addition
            header("Location: cart.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="./css/index_book.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdfce5;
        }
        .details {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            flex-direction: column;
        }
        .row_box {
            display: flex;
            width: 60%;
            /* padding: 10px; */
            /* border: 1px solid #ddd; */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .col_box img {
            max-width: 300px;
            height: auto;
            border-radius: 5px;
        }
        .col_box {
            padding: 30px;
        }
        .book-title {
            font-size: 32px;
            font-weight: bold;
            color: red;
        }
        .book-author {
            font-size: 18px;
            color: #555;
        }
        .book-description {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }
        .book-price {
            font-size: 34px;
            font-weight: bold;
            color: black;
            margin: 10px 0;
        }
        .availability {
            font-size: 16px;
            color: green;
            margin-top: 10px;
        }
        .quantity-box {
            margin-top: 15px;
        }
        .btn {
            background: orange;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn:hover {
            background: darkorange;
        }

        /* Book Details Table */
        .book-details {
            width: 70%;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .book-details h3 {
            font-size: 24px;
            margin-bottom: 15px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
        .book-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .book-table th, .book-table td {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 18px;
            text-align: left;
        }
        .book-table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        .book-descriptiona {
            width: 70%;
    margin-top: 20px;
    padding: 20px;
    border-left: 5px solid #ff6600; /* Orange left border for highlight */
    background:rgb(253, 250, 244); /* Light orange background */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.book-descriptiona h3 {
    font-size: 22px;
    color: #d35400; /* Dark orange heading */
    margin-bottom: 10px;
}

.book-descriptiona p {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
}
.related-books {
    width: 70%;
    margin: 10px auto;
    text-align: center;
}

.related-books h3 {
    font-size: 24px;
    margin-bottom: 15px;
}

.carousel-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 800px;
    margin: auto;
}

.carousel {
    display: flex;
    gap: 20px;
    transition: transform 0.5s ease-in-out;
}

.carousel-item {
    flex: 0 0 calc(100% / 3);
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.carousel-item img {

    width: 180px;  /* Increased size */
    height: 250px; /* Increased size */
    object-fit: cover;
    margin: auto;
    display: block; /* Centered */
    border-radius: 5px;

}

.carousel-item h4 {
    font-size: 18px;
    margin: 10px 0;
}

.carousel-item .price {
    font-size: 16px;
    color: green;
    font-weight: bold;
}

.view-btn {
    display: block;
    background: orange;
    color: white;
    text-decoration: none;
    padding: 8px;
    margin-top: 10px;
    border-radius: 5px;
}

.view-btn:hover {
    background: darkorange;
}

.prev-btn, .next-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #ddd;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
}

.prev-btn { left: -30px; }
.next-btn { right: -30px; }

.prev-btn:hover, .next-btn:hover {
    background: #bbb;
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

.details h3 {
  /* margin: 20px 0; */
  font-size: 22px;
  font-weight: bold;
}

.details .col_box {
  padding: 30px;
}


    </style>
</head>
<body>

    <?php include 'index_header.php'; ?>

    <div class="details">
        <?php
        if (isset($_GET['details'])) {
            $get_id = $_GET['details'];
            $get_book = mysqli_query($conn, "SELECT * FROM `book_info` WHERE bid = '$get_id'") or die('query failed');

            if (mysqli_num_rows($get_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($get_book)) {
                    ?>
                    <div class="row_box ">
                        <form style="display: flex;" action="" method="POST">
                            <div class="col_box p-4">
                                <img src="./added_books/<?php echo $fetch_book['image']; ?>" alt="<?php echo $fetch_book['name']; ?>">
                            </div>
                            <div class="col_box">
                                <h1 class="book-title"><?php echo $fetch_book['name']; ?> (<?php echo $fetch_book['binding']; ?>) </h1>
                                <p class="book-author">By: <?php echo $fetch_book['author']; ?></p>
                               
                                <h1 class="book-price">₹<?php echo $fetch_book['price']; ?></h1>
                                <p class="availability">Available</p>
                                <p>Ships within 2-4 Business Days</p>
                                <p class="book-description"><strong>Description:</strong> <?php echo $fetch_book['description']; ?></p>

                                <div class="quantity-box">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" name="quantity" value="1" min="1" max="10" id="quantity" style="text-align: center;">
                                </div>

                                <div>
                                    <input type="hidden" name="book_name" value="<?php echo $fetch_book['name']; ?>">
                                    <input type="hidden" name="book_id" value="<?php echo $fetch_book['bid']; ?>">
                                    <input type="hidden" name="book_image" value="<?php echo $fetch_book['image']; ?>">
                                    <input type="hidden" name="book_price" value="<?php echo $fetch_book['price']; ?>">
                                    <input type="submit" name="add_to_cart" value="Add To Cart" class="btn">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Book Details Table -->
                    <div class="book-details">
    <h3>Book Details</h3>
    <table class="book-table">
        <tr>
            <th>Language</th>
            <th>Binding</th>
            <th>Number of Pages</th>
            <th>Weight</th>
            <th>Publication Date</th>
            <th>Dimensions (H x W x Spine)</th>
        </tr>
        <tr>
            <td><?php echo $fetch_book['language']; ?></td>
            <td><?php echo $fetch_book['binding']; ?></td>
            <td><?php echo $fetch_book['no_of_pages']; ?></td>
            <td><?php echo $fetch_book['weight']; ?> g</td>
            <td><?php echo $fetch_book['publisher_date']; ?></td>
            <td><?php echo $fetch_book['height']; ?> cm x <?php echo $fetch_book['width']; ?> cm x <?php echo $fetch_book['spine_width']; ?> cm</td>
        </tr>
    </table>
</div>

<div class="book-descriptiona">
    <h3>Description about this book</h3>
    <p><?php echo $fetch_book['description']; ?></p>
</div>


<!-- Related Books Carousel -->
<div class="related-books">
    <h3>Related Books</h3>
    <div class="carousel-container">
        <button class="prev-btn">&#10094;</button>
        <div class="carousel">
            <?php
            $book_category = $fetch_book['category']; // Get current book category
            $related_books = mysqli_query($conn, "SELECT * FROM `book_info` WHERE category='$book_category' AND bid != '$get_id' LIMIT 10");

            if (mysqli_num_rows($related_books) > 0) {
                while ($related = mysqli_fetch_assoc($related_books)) {
                    ?>
                    <div class="carousel-item">
                        <img src="./added_books/<?php echo $related['image']; ?>" alt="<?php echo $related['name']; ?>">
                        <h4><?php echo $related['name']; ?></h4>
                        <p>By <?php echo $related['author']; ?></p>
                        <p class="price">₹<?php echo $related['price']; ?></p>
                        <a href="book_details.php?details=<?php echo $related['bid']; ?>" class="view-btn">View Book</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No related books found.</p>";
            }
            ?>
        </div>
        <button class="next-btn">&#10095;</button>
    </div>
</div>


<!-- New Arrivals Carousel -->
<div class="related-books">
    <h3>New Arrivals</h3>
    <div class="carousel-container">
        <button class="prev-btn">&#10094;</button>
        <div class="carousel">
            <?php
            // Fetch new arrival books (latest added books)
            $new_arrivals = mysqli_query($conn, "SELECT * FROM `book_info` ORDER BY publisher_date DESC LIMIT 10");

            if (mysqli_num_rows($new_arrivals) > 0) {
                while ($new_book = mysqli_fetch_assoc($new_arrivals)) {
                    ?>
                    <div class="carousel-item">
                        <img src="./added_books/<?php echo $new_book['image']; ?>" alt="<?php echo $new_book['name']; ?>">
                        <h4><?php echo $new_book['name']; ?></h4>
                        <p class="price">₹<?php echo $new_book['price']; ?></p>
                        <a href="book_details.php?details=<?php echo $new_book['bid']; ?>" class="view-btn">View Details</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No new arrivals at the moment.</p>";
            }
            ?>
        </div>
        <button class="next-btn">&#10095;</button>
    </div>
</div>


<div class="banner"></div>


                    <?php
                }
            }
        }
        ?>
    </div>



    <?php include 'index_footer.php' ?>


    <script>document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.querySelector(".carousel");
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");

    let scrollAmount = 0;
    const itemWidth = document.querySelector(".carousel-item").offsetWidth + 20;

    nextBtn.addEventListener("click", function() {
        scrollAmount += itemWidth;
        carousel.style.transform = `translateX(-${scrollAmount}px)`;
    });

    prevBtn.addEventListener("click", function() {
        scrollAmount -= itemWidth;
        if (scrollAmount < 0) scrollAmount = 0;
        carousel.style.transform = `translateX(-${scrollAmount}px)`;
    });
});
</script>

</body>
</html>
