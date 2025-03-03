<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        $message[] = 'Please Enter Username';
    } elseif (empty($password)) {
        $message[] = 'Please Enter Password';
    } else {
        $select_users = $conn->query("SELECT * FROM users_info WHERE username = '$username' and password = '$password'") or die('query failed');
    }

    if (mysqli_num_rows($select_users) == 1) {

        $row = mysqli_fetch_assoc($select_users);

        if ($row['user_type'] == 'Admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['Id'];
            header('location:admin_index.php');

        } elseif ($row['user_type'] == 'User') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['Id'];
            header('location:all_books.php');
        }
    } else {
        echo '<script>alert("Incorrect Credentials...");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/register.css" />
    <title>Login</title>
    <style>
        .container form .link {
            text-decoration: none;
            color: white;
            border-radius: 17px;
            padding: 8px 18px;
            margin: 0px 10px;
            background: rgb(0, 0, 0);
            font-size: 20px;
        }

        .container form .link:hover {
            background: rgb(0, 167, 245);
        }

        hr {
            margin: auto;
            width: 80%;
            height: 10px;
            border: 2px;
        }
    </style>
</head>

<body>
    <!-- <php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
        <div class="message" id="messages"><span>' . $message . '</span>
        </div>
        ';
        }
    }
    ?> -->
    <div class="container">
        <form action="" method="post">
            <h3 style="color:white;">Login to <a href="index.php"><span>Page </span><span>Turner</span></a></h3>
            <hr>
            <input type="text" name="username" placeholder="Enter Username" required class="text_field">
            <input type="password" name="password" placeholder="Enter Password" required class="text_field">
            <hr>
            <hr>
            <input type="submit" value="Login" name="login" class="btn text_field"
                style="background: rgba(0, 167, 245,0.7);">
            <p>Don't have an Account?<br>
                <a class="link" href="register.php">Register</a>
                <a class="link" href="index.php">Back</a>
            </p>
        </form>
    </div>
    
    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // hides element (still takes up space on page)
            box.style.display = 'none';
        }, 2000);
    </script>
</body>

</html>