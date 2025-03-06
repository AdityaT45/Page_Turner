<?php
session_start();
include 'config.php'; // Database connection

if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $bid = intval($_POST['delete_id']); // Ensure it's an integer

    // Fetch book image before deleting
    $query = "SELECT image FROM book_info WHERE bid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && !empty($row['image'])) {
        $imagePath = "added_books/" . $row['image']; // Corrected path
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image
        }
    }

    // Delete book from database
    $deleteQuery = "DELETE FROM book_info WHERE bid = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $bid);

    if ($stmt->execute()) {
        header("Location: manage_books.php?msg=Book deleted successfully");
        exit();
    } else {
        echo "Error deleting book: " . $conn->error;
    }
}


// FETCH books
$result = mysqli_query($conn, "SELECT * FROM book_info");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            text-align: center;
        }
        h2 {
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #0f3859;
            color: white;
        }
        td {
            text-align: center;
        }
        .edit, .delete, .add {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }
        .edit { background: #007bff; color: white; }
        .delete { background: #dc3545; color: white; }
        .add { background: #28a745; color: white; }
        form {
            background: white;
            padding: 15px;
            width: 50%;
            margin: 20px auto;
            border-radius: 10px;
            display: none;
        }
        textarea {
            width: 90%;
            height: 60px;
        }
        img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        #categoryFilter {
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background: white;
        cursor: pointer;
        width: 200px; /* Increase width */
    }

    label[for="categoryFilter"] {
        font-size: 18px;
        font-weight: bold;
        margin-right: 10px;
    }
    </style>
</head>
<body style="background-color:#fdfce5">
<?php include 'admin_header.php'; ?>
<h2>Manage Books</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Author</th>
        <th>Price</th>
        <th>Category</th>
        <th>Language</th>
        <th>Publisher</th>
        <th>Binding</th>
        <th>No. of Pages</th>
        <th>Weight</th>
        <th>Publisher Date</th>
        <th>Height</th>
        <th>Spine Width</th>
        <th>Width</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['bid']; ?></td>
            <td><img src="added_books/<?= $row['image']; ?>" width="100"></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['author']; ?></td>
            <td><?= $row['price']; ?></td>
            <td><?= $row['category']; ?></td>
            <td><?= $row['language']; ?></td>
            <td><?= $row['publisher']; ?></td>
            <td><?= $row['binding']; ?></td>
            <td><?= $row['no_of_pages']; ?></td>
            <td><?= $row['weight']; ?></td>
            <td><?= $row['publisher_date']; ?></td>
            <td><?= $row['height']; ?></td>
            <td><?= $row['spine_width']; ?></td>
            <td><?= $row['width']; ?></td>
            <td><?= substr($row['description'], 0, 50) . '...'; ?></td>
            <td>
    <button class="edit" onclick="editBook(<?= $row['bid']; ?>, '<?= $row['name']; ?>', '<?= $row['author']; ?>', '<?= $row['price']; ?>', '<?= $row['category']; ?>', '<?= $row['description']; ?>')">Edit</button>
    
    <form method="POST" action="manage_books.php" onsubmit="return confirm('Are you sure?');" style="display:inline;">
        <input type="hidden" name="delete_id" value="<?= $row['bid']; ?>">
        <button type="submit" name="delete_book" class="delete">Delete</button>
    </form>
</td>


        </tr>
    <?php } ?>
</table>
</body>
</html>
