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
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $binding = mysqli_real_escape_string($conn, $_POST['binding']);
    $no_of_pages = $_POST['no_of_pages'];
    $weight = $_POST['weight'];
    $publisher_date = $_POST['publisher_date'];
    $height = $_POST['height'];
    $spine_width = $_POST['spine_width'];
    $width = $_POST['width'];
    $price = $_POST['price'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = date('Y-m-d');
    
    $img = $_FILES['image']['name'];
    $img_temp_name = $_FILES['image']['tmp_name'];
    $img_file = "./added_books/" . $img;
    
    if (empty($bname) || empty($author) || empty($price) || empty($category) || empty($language) || empty($publisher) || empty($binding) || empty($no_of_pages) || empty($weight) || empty($publisher_date) || empty($height) || empty($spine_width) || empty($width) || empty($img) || empty($description)) {
        $message = 'All fields are required!';
    } else {
        $add_book = mysqli_query($conn, "INSERT INTO book_info(name, author, price, category, language, publisher, binding, no_of_pages, weight, publisher_date, height, spine_width, width, image, description, date) VALUES('$bname', '$author', '$price', '$category', '$language', '$publisher', '$binding', '$no_of_pages', '$weight', '$publisher_date', '$height', '$spine_width', '$width', '$img', '$description', '$date')") or die('Query failed');
        
        if ($add_book) {
            move_uploaded_file($img_temp_name, $img_file);
            header("Location: total_books.php");
            exit;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books - Page Turner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { min-height: 100vh; display: flex; justify-content: center; align-items: center; background: #fdfce5; }
        .split-form { display: flex; background: white; border-radius: 20px; overflow: hidden; width: 100%; max-width: 900px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .image-side { flex: 1; background: #0f3859; padding: 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center; position: relative; }
        #lottie-animation { width: 300px; height: 300px; }
        .form-side { flex: 1; padding: 2rem; }
        .form-side h2 { text-align: center; margin-bottom: 1rem; color: #333; }
        .form-group { display: flex; justify-content: space-between; gap: 1rem; }
        .form-group input, .form-group select { flex: 1; padding: 0.8rem; margin: 0.5rem 0; border: none; border-bottom: 2px solid #eee; outline: none; transition: border-color 0.3s; }
        input:focus, select:focus { border-bottom-color: #0f3859; }
        button { width: 100%; padding: 1rem; margin-top: 1.5rem; background: #0f3859; color: white; border: none; border-radius: 25px; cursor: pointer; font-weight: bold; transition: transform 0.3s; }
        button:hover { transform: translateY(-2px); }
        .error-message { text-align: center; color: red; font-weight: bold; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="split-form">
        <div class="image-side">
            <div id="lottie-animation"></div>
            <h1><span class="text-warning">PAGE</span><span>TURNER</span></h1>
        </div>
        <div class="form-side">
            <h2>Add a New Book</h2>
            <?php if (isset($message)) { echo "<p class='error-message'>$message</p>"; } ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="bname" placeholder="Enter Book Name" required>
                    <input type="text" name="author" placeholder="Enter Author Name" required>
                </div>
                <div class="form-group">
                    <input type="number" min="0" name="price" placeholder="Enter Book Price" required>
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
                    <input type="text" name="language" placeholder="Enter Language" required>
                    <input type="text" name="publisher" placeholder="Enter Publisher" required>
                </div>
                <div class="form-group">
                    <input type="text" name="binding" placeholder="Enter Binding Type" required>
                    <input type="number" name="no_of_pages" placeholder="Enter Number of Pages" required>
                </div>
                <div class="form-group">
                    <input type="number" name="weight" placeholder="Enter Weight (grams)" required>
                    <input type="date" name="publisher_date" required>
                </div>
                <div class="form-group">
                    <input type="number" name="height" placeholder="Enter Height" required>
                    <input type="number" name="spine_width" placeholder="Enter Spine Width" required>
                </div>
                <div class="form-group">
                    <input type="number" name="width" placeholder="Enter Width" required>
                    <input type="file" name="image" required>
                </div>
                <input type="text" name="description" placeholder="Enter Book Description" required>
                <button type="submit" name="add_books">Add Book</button>
            </form>
        </div>
    </div>
    <script>
        lottie.loadAnimation({ container: document.getElementById('lottie-animation'), renderer: 'svg', loop: true, autoplay: true, path: 'images/Animation - 1741021320383.json' });
    </script>
</body>
</html>

