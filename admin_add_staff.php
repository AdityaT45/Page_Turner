<?php
session_start();
include 'config.php'; // Database connection

// Check if the admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO staff (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_staff.php after successful insertion
        header("Location: manage_staff.php");
        exit();
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff - Page Turner</title>

    <!-- Lottie Animation Library -->
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
            background: #fdfce5;
        }

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
            width: 300px;
            height: 300px;
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

        .split-form input, select {
            width: 100%;
            padding: 1rem;
            margin: 0.5rem 0;
            border: none;
            border-bottom: 2px solid #eee;
            outline: none;
            transition: border-color 0.3s;
        }

        .split-form input:focus, .split-form select:focus {
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

        .error-message, .success-message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .error-message { color: red; }
        .success-message { color: green; }
    </style>
</head>

<body>

    <div class="split-form">
        <!-- Left Side with Lottie Animation -->
        <div class="image-side">
            <div id="lottie-animation"></div>
            <h1><span class="text-warning">PAGE</span><span>TURNER</span></h1>
        </div>

        <!-- Right Side -->
        <div class="form-side">
            <h2>Add Staff</h2>

            <!-- Display Success/Error Message -->
            <?php if (!empty($message)) { 
                echo "<p class='". (strpos($message, '✅') !== false ? 'success-message' : 'error-message') ."'>$message</p>"; 
            } ?>

<form method="post">
    <h2>Register Staff</h2>
    <input type="text" name="name" placeholder="Staff Name" required>
    <input type="email" name="email" placeholder="Staff Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Add Staff</button>
</form>
        </div>
    </div>

    <!-- JavaScript to Load Lottie Animation -->
    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'images/Animation - 1741021320383.json' // Your Lottie animation file
        });
    </script>

</body>
</html>
