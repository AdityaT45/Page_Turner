<?php
include 'config.php';
session_start();

// Redirect if managing staff not logged in
if (!isset($_SESSION['ms_id'])) {
    header('location: ms_login.php');
    exit();
}

$message = "";

// Handle form submission
if (isset($_POST['add_books'])) {
    $bname = mysqli_real_escape_string($conn, $_POST['bname']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $binding = mysqli_real_escape_string($conn, $_POST['binding']);
    $no_of_pages = $_POST['no_of_pages'];
    $weight = $_POST['weight'];
    $publisher_date = $_POST['publisher_date'];
    $height = $_POST['height'];
    $spine_width = $_POST['spine_width'];
    $width = $_POST['width'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = date("Y-m-d");

    // Image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = 'added_books/' . $image_name;

    if (move_uploaded_file($image_tmp, $image_folder)) {
        $insert = mysqli_query($conn, "INSERT INTO book_info 
            (name, author, price, category, language, publisher, binding, no_of_pages, weight, publisher_date, height, spine_width, width, image, description, date) 
            VALUES 
            ('$bname', '$author', '$price', '$category', '$language', '$publisher', '$binding', '$no_of_pages', '$weight', '$publisher_date', '$height', '$spine_width', '$width', '$image_name', '$description', '$date')");

        if ($insert) {
            $message = "Book added successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Add Books - Page Turner</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <style>
        /* Include your CSS styles from original reference code */
    </style>
</head>
<body>
    <div class="split-form">
        <div class="image-side">
            <div id="lottie-animation"></div>
            <h1><span class="text-warning">PAGE</span> TURNER</h1>
        </div>
        <div class="form-side">
            <h2>Add a New Book</h2>
            <?php if ($message) echo "<p class='error-message'>$message</p>"; ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="bname" placeholder="Book Name" required>
                    <input type="text" name="author" placeholder="Author Name" required>
                </div>
                <div class="form-group">
                    <input type="number" name="price" placeholder="Price" required>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Magical">Magical</option>
                        <option value="Knowledge">Knowledge</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="Love">Love</option>
                        <option value="Health">Health</option>
                        <option value="Novel">Novel</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="language" placeholder="Language" required>
                    <input type="text" name="publisher" placeholder="Publisher" required>
                </div>
                <div class="form-group">
                    <input type="text" name="binding" placeholder="Binding Type" required>
                    <input type="number" name="no_of_pages" placeholder="Pages" required>
                </div>
                <div class="form-group">
                    <input type="number" name="weight" placeholder="Weight (grams)" required>
                    <input type="date" name="publisher_date" required>
                </div>
                <div class="form-group">
                    <input type="number" name="height" placeholder="Height (cm)" required>
                    <input type="number" name="spine_width" placeholder="Spine Width (cm)" required>
                </div>
                <div class="form-group">
                    <input type="number" name="width" placeholder="Width (cm)" required>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <textarea name="description" placeholder="Book Description" required></textarea>
                <button type="submit" name="add_books">Add Book</button>
            </form>
        </div>
    </div>

    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'images/Animation - 1741021320383.json'
        });
    </script>
</body>
</html>
