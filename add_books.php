<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:login.php');
}

if (isset($_POST['add_books'])) {
  $bname = mysqli_real_escape_string($conn, $_POST['bname']);
  $author = mysqli_real_escape_string($conn, $_POST['author']);
  $category = mysqli_real_escape_string($conn, $_POST['Category']);
  $price = $_POST['price'];
  $img = $_FILES["image"]["name"];
  $img_temp_name = $_FILES["image"]["tmp_name"];
  $img_file = "./added_books/" . $img;
  $description=$_POST['description'];


  if (empty($bname)) {
    $message[] = 'Please Enter Book Name';
  } elseif (empty($author)) {
    $message[] = 'Please Enter Book Author';
  } elseif (empty($price)) {
    $message[] = 'Please Enter Book Price';
  } elseif (empty($category)) {
    $message[] = 'Please Choose a Category';
  } elseif (empty($img)) {
    $message[] = 'Please Choose Image';
  } elseif (empty($description)) {
    $message[] = 'Please Enter description of books';
  }else {
    $add_book = mysqli_query($conn, "INSERT INTO book_info(`name`, `author`, `price`, `category`, `image`, `description`) 
                                VALUES('$bname','$author','$price','$category','$img','$description')") or die('Query failed');

    if ($add_book) {
      move_uploaded_file($img_temp_name, $img_file);
      $message[] = 'New Book Added Successfully';
    } else {
      $message = 'Book Not Added';
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
  <link rel="stylesheet" href="./css/register.css">
  <!-- <author>Add Books</author> -->
  <style>
    body {
      justify-content: center;
      background-image: linear-gradient(45deg,
          rgba(0, 0, 3, 0.2),
          rgba(0, 0, 0, 0.5)),
        url(./bgimg/4.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      height: 100vh;
    }
  </style>
</head>

<body>
  <?php
  include './admin_header.php'
    ?>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<div class="message" id="messages"><span>' . $message . '</span></div>';
    }
  }
  ?>

  <a class="update_btn" style="position:fixed ; z-index:100; margin:5px 10px" href="total_books.php">See All Books</a>

  <div class="container_box">
    <form action="" method="POST" enctype="multipart/form-data"><br>
      <h3>Add Books To <a><span>Page  </span><span>Turner</span></a></h3>
      <input type="text" name="bname" placeholder="Enter Book Name" class="text_field ">
      <input type="text" name="author" placeholder="Enter Author Name" class="text_field">
      <input type="number" min="0" name="price" class="text_field" placeholder="Enter Product Price">
      <select name="Category" id="" required class="text_field">
        <option value="None">None</option>
        <option value="Adventure">Adventure</option>
        <option value="Magical">Magical</option>
        <option value="Knowledge">Knowledge</option>
        <option value="Sci-Fi">Sci-Fi</option>
        <option value="Love">Love</option>
        <option value="Health">Health</option>
        <option value="Novel">Novel</option>
      </select>
      <input type="file" name="image" class="text_field" style="background-color: #fff9f9;">
      <br>
      <input type="text" name="description" placeholder="Enter books description here" class="text_field">
      <input type="submit" value="Add Book" name="add_books" class="btn text_field"
        style="background: rgba(0, 167, 245,0.7);">
    </form>
  </div>

  <script src="./js/admin.js"></script>
  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');

      // hides element (still takes up space on page)
      box.style.display = 'none';
    }, 2500);
  </script>
</body>

</html>