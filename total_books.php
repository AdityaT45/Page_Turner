<?php
session_start();
include 'config.php'; // Database connection

if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

// DELETE book
// DELETE book
if (isset($_GET['delete'])) {
    $bid = intval($_GET['delete']); // Ensure ID is an integer

    // Fetch book image before deleting
    $query = "SELECT image FROM book_info WHERE bid=$bid";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && !empty($row['image'])) {
        $imagePath = "added_books/" . $row['image']; // Corrected path
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image
        }
    }

    // Delete book from database
    $deleteQuery = "DELETE FROM book_info WHERE bid=$bid";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: manage_books.php");
        exit();
    } else {
        echo "Error deleting book: " . mysqli_error($conn);
    }
}


// UPDATE book
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $bid = intval($_POST['update_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        $sql = "UPDATE book_info SET name=?, author=?, price=?, category=?, description=?, image=? WHERE bid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisssi", $name, $author, $price, $category, $description, $imageName, $bid);
    } else {
        $sql = "UPDATE book_info SET name=?, author=?, price=?, category=?, description=? WHERE bid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissi", $name, $author, $price, $category, $description, $bid);
    }
    $stmt->execute();
    header("Location: manage_books.php?msg=Book updated successfully");
    exit();
}

// ADD book
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $imageName = "";
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
    }

    $sql = "INSERT INTO book_info (name, author, price, category, description, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $name, $author, $price, $category, $description, $imageName);
    $stmt->execute();
    header("Location: manage_books.php?msg=Book added successfully");
    exit();
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


<?php
$categoryQuery = "SELECT DISTINCT category FROM book_info";
$categoryResult = mysqli_query($conn, $categoryQuery);
?>
<h2>Manage Books</h2>

<label for="categoryFilter"><strong>Filter by Category:</strong></label>
<select id="categoryFilter" onchange="filterBooks()">
    <option value="all">All Categories</option>
    <?php while ($categoryRow = mysqli_fetch_assoc($categoryResult)) { ?>
        <option value="<?= $categoryRow['category']; ?>"><?= $categoryRow['category']; ?></option>
    <?php } ?>
</select>



<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Author</th>
        <th>Price</th>
        <th>Category</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['bid']; ?></td>
            <td>
                <?php if (!empty($row['image'])) { ?>
                    <img src="added_books/<?= $row['image']; ?>" alt="Book Image">
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['author']; ?></td>
            <td><?= $row['price']; ?></td>
            <td><?= $row['category']; ?></td>
            <td><?= substr($row['description'], 0, 50) . '...'; ?></td>
            <td>
                <button class="edit" onclick="editBook(<?= $row['bid']; ?>, '<?= $row['name']; ?>', '<?= $row['author']; ?>', '<?= $row['price']; ?>', '<?= $row['category']; ?>', '<?= $row['description']; ?>')">Edit</button>
                <a href="manage_books.php?delete=<?= $row['bid']; ?>" class="delete" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<button class="add" onclick="document.getElementById('addForm').style.display='block'">Add Book</button>

<script>
    function editBook(id, name, author, price, category, description) {
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('update_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_author').value = author;
        document.getElementById('edit_price').value = price;
        document.getElementById('edit_category').value = category;
        document.getElementById('edit_description').value = description;
    }
</script>
<script>
    function filterBooks() {
        let selectedCategory = document.getElementById("categoryFilter").value.toLowerCase();
        let rows = document.querySelectorAll("table tr:not(:first-child)");

        rows.forEach(row => {
            let category = row.cells[5].textContent.toLowerCase(); // Get category from 6th column
            if (selectedCategory === "all" || category === selectedCategory) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>


</body>
</html>
