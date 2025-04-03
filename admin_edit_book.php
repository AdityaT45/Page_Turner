<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

if (!isset($_GET['bid'])) {
    header('location: admin_manage_books.php');
    exit();
}

$bid = $_GET['bid'];
$book_query = mysqli_query($conn, "SELECT * FROM book_info WHERE bid = '$bid'");
if (mysqli_num_rows($book_query) == 0) {
    header('location: admin_manage_books.php');
    exit();
}
$book = mysqli_fetch_assoc($book_query);

if (isset($_POST['update_book'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $binding = mysqli_real_escape_string($conn, $_POST['binding']);
    $no_of_pages = mysqli_real_escape_string($conn, $_POST['no_of_pages']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $publisher_date = mysqli_real_escape_string($conn, $_POST['publisher_date']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $spine_width = mysqli_real_escape_string($conn, $_POST['spine_width']);
    $width = mysqli_real_escape_string($conn, $_POST['width']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_folder = 'uploads/' . $image;
        move_uploaded_file($image_tmp, $image_folder);
        $update_query = "UPDATE book_info SET name='$name', author='$author', price='$price', category='$category',
                        language='$language', publisher='$publisher', binding='$binding', no_of_pages='$no_of_pages',
                        weight='$weight', publisher_date='$publisher_date', height='$height', spine_width='$spine_width',
                        width='$width', image='$image', description='$description' WHERE bid='$bid'";
    } else {
        $update_query = "UPDATE book_info SET name='$name', author='$author', price='$price', category='$category',
                        language='$language', publisher='$publisher', binding='$binding', no_of_pages='$no_of_pages',
                        weight='$weight', publisher_date='$publisher_date', height='$height', spine_width='$spine_width',
                        width='$width', description='$description' WHERE bid='$bid'";
    }

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = "Book updated successfully!";
        header("Location: admin_manage_books.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update book. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .container {
            width: 60%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-group {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .form-group div {
            width: 50%;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        button:hover {
            background: #0056b3;
        }
        .preview-img {
            width: 100px;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Edit Book</h2>

    <?php if (isset($_SESSION['success'])) { ?>
        <p style="color:green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php } ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <div><label>Name:</label><input type="text" name="name" value="<?php echo $book['name']; ?>" ></div>
            <div><label>Author:</label><input type="text" name="author" value="<?php echo $book['author']; ?>" ></div>
        </div>

        <div class="form-group">
            <div><label>Price:</label><input type="number" name="price" value="<?php echo $book['price']; ?>" ></div>
            <div><label>Category:</label><input type="text" name="category" value="<?php echo $book['category']; ?>" ></div>
        </div>

        <div class="form-group">
            <div><label>Language:</label><input type="text" name="language" value="<?php echo $book['language']; ?>" ></div>
            <div><label>Publisher:</label><input type="text" name="publisher" value="<?php echo $book['publisher']; ?>" ></div>
        </div>

        <div class="form-group">
            <div><label>Binding:</label><input type="text" name="binding" value="<?php echo $book['binding']; ?>" ></div>
            <div><label>No. of Pages:</label><input type="number" name="no_of_pages" value="<?php echo $book['no_of_pages']; ?>" ></div>
        </div>

        <div class="form-group">
            <div><label>Weight:</label><input type="text" name="weight" value="<?php echo $book['weight']; ?>" ></div>
            <div><label>Publisher Date:</label><input type="date" name="publisher_date" value="<?php echo $book['publisher_date']; ?>" ></div>
        </div>

        <div class="form-group">
            <div><label>Height:</label><input type="text" name="height" value="<?php echo $book['height']; ?>" ></div>
            <div><label>Spine Width:</label><input type="text" name="spine_width" value="<?php echo $book['spine_width']; ?>" ></div>
        </div>

        <label>Width:</label>
        <input type="text" name="width" value="<?php echo $book['width']; ?>" >

        <label>Image:</label>
        <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
        <img src="uploads/<?php echo $book['image']; ?>" class="preview-img" id="preview">

        <label>Description:</label>
        <textarea name="description" rows="3" ><?php echo $book['description']; ?></textarea>

        <button type="submit" name="update_book">Update Book</button>
    </form>
</div>

<script>
    function previewImage(event) {
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
