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
            $message[] = 'This Book is already in your cart';
        } else {
            $conn->query("INSERT INTO cart (`user_id`,`book_id`,`name`, `price`, `image`,`quantity` ,`total`) VALUES('$user_id','$book_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Book Added To Cart Successfully';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <!-- <link rel="stylesheet" href="css/hello.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    
    <style>
        * {
            text-decoration: none;
        }

        body {

            background-color:#fdfce5
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
            border: 2px solid #44cbec;
            border-top-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .message span {
            font-size: 22px;
            color: #f01212;
            font-weight: 500;
        }

        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
            margin: 30px auto;
            max-width: 1200px;
        }

        .box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
            transition: 0.3s;
            width: 255px;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .box img {
            height: 200px;
            width: 125px;
            margin: auto;
            display: block;
        }

        .name {
            font-size: 18px;
            font-weight: 600;
            margin-top: 10px;
        }

        .price {
            font-size: 16px;
            margin: 8px 0;
            color:rgb(0, 0, 0);
        }

        .box form {
            margin-top: 8px;
        }

        .box button {
            background-color:  #0f3859;
            border: none;
            padding: 6px 12px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .box .update_btn {
            margin-left: 10px;
            color: #00a7f5;
            font-weight: 600;
        }

        .empty {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #ff4d4d;
            background: #ffecec;
            padding: 15px 20px;
            border-radius: 8px;
            width: fit-content;
            margin: 40px auto;
            border: 2px solid #ff9999;
            box-shadow: 0px 4px 8px rgba(255, 77, 77, 0.2);
        }
    </style>
</head>
<body>

<?php include 'index_header.php' ?>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message" id="messages"><span>' . $msg . '</span></div>';
    }
}
?>

<section id="AllBooks">
    <div class="container px-5 mx-auto">
        <h2 class="m-8 font-extrabold text-4xl text-center" style="color:rgb(245, 0, 0);">
            All Books
        </h2>
    </div>
</section>

<section class="show-products">
    <div class="box-container">

        <?php
        $select_book = mysqli_query($conn, "SELECT * FROM book_info") or die('query failed');
        if (mysqli_num_rows($select_book) > 0) {
            while ($fetch_book = mysqli_fetch_assoc($select_book)) {
        ?>
            <div class="box">
                <a href="book_details.php?details=<?php echo $fetch_book['bid'] . '-name=' . $fetch_book['name']; ?>">
                    <img src="added_books/<?php echo $fetch_book['image']; ?>" alt="">
                </a>
                <div class="name"><?php echo $fetch_book['name']; ?></div>
                <div class="price">Price: ₹<?php echo $fetch_book['price']; ?>/-</div>
                <form action="" method="POST">
                    <input type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                    <input type="hidden" name="book_id" value="<?php echo $fetch_book['bid'] ?>">
                    <input type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                    <input type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                    <button name="add_to_cart">Add to Cart</button>
                    <a href="book_details.php?details=<?php echo $fetch_book['bid'] . '-name=' . $fetch_book['name']; ?>" class="update_btn">Know More</a>
                </form>
            </div>
        <?php
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
</section>

<?php include 'index_footer.php' ?>

<script>
    setTimeout(() => {
        const box = document.getElementById('messages');
        if (box) box.style.display = 'none';
    }, 2000);
</script>

</body>
</html>
