<?php
include 'config.php';
session_start();

$message = ''; // Initialize error message

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email)) {
        $message = 'Please Enter Email';
    } elseif (empty($password)) {
        $message = 'Please Enter Password';
    } else {
        $select_users = $conn->query("SELECT * FROM users_info WHERE email = '$email'") or die('Query Failed');

        if (mysqli_num_rows($select_users) == 1) {
            $row = mysqli_fetch_assoc($select_users);

            // If password is NOT hashed
            if ($password == $row['password']) {
                if (strtolower($row['user_type']) == 'admin') {
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['Id'];
                    header('location:admin_dashboard.php');
                    exit();
                } elseif (strtolower($row['user_type']) == 'user') {
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['Id'];
                    header('location:index.php');
                    exit();
                } else {
                    $message = "Invalid user type.";
                }
            } else {
                $message = "Incorrect Email or Password!";
            }
        } else {
            $message = "Incorrect Email or Password!";
        }
    }
}

?>

<!-- HTML STARTS -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Page Turner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background:#fdfce5;
        }

        /* Split Layout Form */
        .split-form {
            display: flex;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .split-form .image-side {
            flex: 1;
            background: #0f3859;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
        }

        /* Lottie Animation */
        #lottie-animation {
            width: 350px;
            height: 350px;
        }

        .split-form .form-side {
            flex: 1;
            padding: 3rem;
        }

        .split-form h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #333;
        }

        .split-form input {
            width: 100%;
            padding: 1rem;
            margin: 0.5rem 0;
            border: none;
            border-bottom: 2px solid #eee;
            outline: none;
            transition: border-color 0.3s;
        }

        .split-form input:focus {
            border-bottom-color: #0f3859;
        }

        .split-form button {
            width: 100%;
            padding: 1rem;
            margin-top: 1.5rem;
            background: #0f3859;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.3s;
        }

        .split-form button:hover {
            transform: translateY(-2px);
        }

        .error-message {
            text-align: center;
            color: red;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .link {
            text-decoration: none;
            color: #FF6B6B;
            font-weight: bold;
        }

        .link:hover {
            text-decoration: underline;
        }
        form {
            width: 100%;
            max-width: 350px;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            color: #0f3859;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #0f3859;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #0f3859;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.3s, background 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            background: #092a42;
        }
    </style>
</head>

<body>
    <div class="split-form">
        <!-- Lottie Side -->
        <div class="image-side">
            <div id="lottie-animation"></div>
            <h1><span class="text-warning">PAGE</span><span>TURNER</span></h1>
        </div>

        <!-- Login Form Side -->
        <div class="form-side">
            <h1>Sign In</h1>

            <?php if (!empty($message)) { echo "<p class='error-message'>$message</p>"; } ?>

            <form action="" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>

                <button type="submit" name="login">Login</button>
            </form>

            <p style="text-align: center; margin-top: 1rem;">
                Don't have an account? <a class="link" href="register.php">Register</a>
            </p>

            <a class="link" href="ds_login.php">ds login</a>
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
