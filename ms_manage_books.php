<?php
include 'config.php';
session_start();

// Check if staff is logged in
if (!isset($_SESSION['staff_id'])) {
    header('location: ms_login.php');
    exit();
}

// Fetch all books
$books = mysqli_query($conn, "SELECT * FROM book_info");

// Delete Book (if staff has delete access)
if (isset($_GET['delete'])) {
    $bid = $_GET['delete'];

    // Fetch book image
    $get_image = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM book_info WHERE bid = '$bid'"));
    if ($get_image && file_exists("added_books/" . $get_image['image'])) {
        unlink("added_books/" . $get_image['image']);
    }

    // Delete from DB
    mysqli_query($conn, "DELETE FROM book_info WHERE bid = '$bid'");
    header('location: ms_manage_books.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Manage Books</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 95%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
        }
       th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 14px;
    word-wrap: break-word;
    white-space: normal;       /* Allow wrapping */
    overflow-wrap: break-word; /* Break long words */
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 150px;
}
        th {
            background-color: #007bff;
            color: white;
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
<body style="background-color:#fdfce5">

<?php include 'ms_header.php'; ?>

<div class="container">
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
        <?php while ($row = mysqli_fetch_assoc($books)) { ?>
        <tr>
            <td><?= $row['bid']; ?></td>
            <td><img src="added_books/<?= $row['image']; ?>"></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['author']; ?></td>
            <td>₹<?= number_format($row['price'], 2); ?></td>
            <td><?= $row['category']; ?></td>
            <td><?= $row['language']; ?></td>
            <td><?= $row['publisher']; ?></td>
            <td><?= $row['binding']; ?></td>
            <td><?= $row['no_of_pages']; ?></td>
            <td><?= $row['weight']; ?> kg</td>
            <td><?= $row['publisher_date']; ?></td>
            <td><?= $row['height']; ?> cm</td>
            <td><?= $row['spine_width']; ?> cm</td>
            <td><?= $row['width']; ?> cm</td>
            <td><?= substr($row['description'], 0, 6) . '...'; ?></td>
            <td>
                <!-- Uncomment below line if you want staff to edit -->
                <a href="ms_edit_book.php?bid=<?= $row['bid']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="ms_manage_books.php?delete=<?= $row['bid']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
