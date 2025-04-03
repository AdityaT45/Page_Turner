<?php
include 'config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

// Fetch all books from the database
$books = mysqli_query($conn, "SELECT * FROM book_info");

// Delete Book Functionality
if (isset($_GET['delete'])) {
    $bid = $_GET['delete'];

    // Fetch book image path
    $get_image = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM book_info WHERE bid = '$bid'"));
    if ($get_image && file_exists("uploads/" . $get_image['image'])) {
        unlink("uploads/" . $get_image['image']); // Delete the image file
    }

    // Delete book from database
    mysqli_query($conn, "DELETE FROM book_info WHERE bid = '$bid'");
    header('location: admin_manage_books.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto; /* Fix table overflow issue */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table-wrapper {
            width: 100%;
            overflow-x: auto; /* Add horizontal scroll if needed */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap; /* Prevent text from wrapping */
            table-layout: fixed; /* Fix column width issue */
        }
        th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 14px;
    word-wrap: break-word; /* Allows text to wrap */
    max-width: 150px; /* Adjust this to fit your design */
    overflow: hidden;
    text-overflow: ellipsis; /* Adds '...' for overflow text */
    white-space: normal; /* Allows wrapping instead of a single line */
}
        th {
            background-color: #007bff;
            color: white;
        }
        td:nth-child(3), /* Name */
td:nth-child(16) { /* Description */
    max-width: 200px; /* Limit width */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    word-wrap: break-word;
}

        img {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
        }
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }
        .edit-btn {
            background-color: #28a745;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #b32a37;
        }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Manage Books</h2>
    <div class="table-wrapper">
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
            <?php while ($row = mysqli_fetch_assoc($books)) { ?>
            <tr>
                <td><?php echo $row['bid']; ?></td>
                <td><img src="added_books/<?= $row['image']; ?>" width="100"></td>
                </td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td>₹<?php echo number_format($row['price'], 2); ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['language']; ?></td>
                <td><?php echo $row['publisher']; ?></td>
                <td><?php echo $row['binding']; ?></td>
                <td><?php echo $row['no_of_pages']; ?></td>
                <td><?php echo $row['weight']; ?> kg</td>
                <td><?php echo $row['publisher_date']; ?></td>
                <td><?php echo $row['height']; ?> cm</td>
                <td><?php echo $row['spine_width']; ?> cm</td>
                <td><?php echo $row['width']; ?> cm</td>
                <td><?php echo substr($row['description'], 0, 50) . '...'; ?></td>
                <td>
                    <a href="admin_edit_book.php?bid=<?php echo $row['bid']; ?>" class="action-btn edit-btn">Edit</a>
                    <a href="admin_manage_books.php?delete=<?php echo $row['bid']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
