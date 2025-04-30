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
   <title>Search Page</title>

   <link rel="stylesheet" href="css/hello.css">
   <!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" /> -->

   <style>
      img {
         border: none;
         cursor: pointer;
      }

      .search-form form {
         max-width: 1200px;
         margin: 30px auto;
         display: flex;
         gap: 15px;
      }

      .search-form form .search_btn {
         margin-top: 0;
      }

      .search-form form .box {
         width: 100%;
         padding: 12px 14px;
         border: 2px solid rgb(0, 167, 245);
         font-size: 20px;
         color: black;
         border-radius: 5px;
      }

      .search_btn {
         display: inline-block;
         padding: 10px 25px;
         cursor: pointer;
         color: white;
         font-size: 18px;
         border-radius: 5px;
         text-transform: capitalize;
         background-color:  #0f3859;
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

      .end {
         margin: auto;
         width: 80%;
         border: 1px solid rgb(68, 203, 236);
      }

      .cart-btn {
         display: inline-block;
         background: transparent;
      }
   </style>
</head>

<body style="background-color:#fdfce5">
   <?php include 'index_header.php'; ?>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
        <div class="message" id="messages"><span>' . $message . '</span>
        </div>
        ';
      }
   }
   ?>

   <section class="search-form">
      <form action="" method="POST">
         <input type="text" class="box" name="search_box" placeholder="Search Books...">
         <input type="submit" name="search_btn" value="search" class="search_btn">
      </form>
   </section>

   <div class="msg">
      <?php
      if (isset($_POST['search_btn'])) {
         $search_box = $_POST['search_box'];
         echo '<h4 style="text-align:center;font-weight: bold;">Search Result for "' . $search_box . '" is:</h4>';
      }
      ?>
   </div>

   <section class="show-products">
      <div class="box-container">

         <?php
         if (isset($_POST['search_btn'])) {
            $search_box = $_POST['search_box'];

            $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
            $select_products = mysqli_query($conn, "SELECT * FROM `book_info` WHERE name LIKE '%$search_box%' OR author LIKE '%$search_box%' OR category LIKE '%$search_box%'");
            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_book = mysqli_fetch_assoc($select_products)) {
                  ?>

                  <div class="box" style="width: 255px;height: 375px;">
                     <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                     echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;"
                           class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>

                     <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                        <?php echo $fetch_book['name']; ?>
                     </div>
                     <div class="name" style="font-size: 12px;">
                        <?php echo $fetch_book['author']; ?>
                     </div>
                     <div class="price">Price: ₹
                        <?php echo $fetch_book['price']; ?>/-
                     </div>
                     <form action="" method="POST">
                        <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                        <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                        <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                        <button name="add_to_cart" class="cart-btn"><img src="./images/cart.png" alt="Add to cart"
                              class="cart-btn"></button>&nbsp;&nbsp;|
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                        echo '-name=', $fetch_book['name']; ?>" class="update_btn">Know More</a>
                     </form>
                  </div>
                  <?php
               }
            } else {
               // echo '<p class="empty">no products added yet!</p>';
               echo '<h4 style="text-align:center;font-weight: bold;">No Products Added yet...</h4>';
            }
         }
         ?>
      </div>
   </section>
   <div>
      <br>
      <hr class="end">
      <br>
      <br>
   </div>
   <script>
      setTimeout(() => {
         const box = document.getElementById('messages');
         // hides element (still takes up space on page)
         box.style.display = 'none';
      }, 2000);
   </script>

   <script src="./js/script.js"></script>
   <!-- <php include 'index_footer.php'; ?> -->

</body>

</html>