<?php
include 'config.php';
session_start();

if (isset($_SESSION['staff_id'])) {
    header('location: ms_dashboard.php');
    exit();
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM staff WHERE email = '$email'";
    $result = mysqli_query($conn, $query) or die('Query failed');

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['staff_id'] = $row['id'];
            $_SESSION['staff_name'] = $row['name'];
            header('location: ms_dashboard.php');
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Staff account not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Managing Staff Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>
    <style>
        /* Same CSS from your reference... */
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
        .image-side {
            flex: 1;
            background: #0f3859;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        #lottie-animation {
            width: 300px;
            height: 300px;
        }
        .form-side {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-side h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #333;
        }
        .error-message {
            text-align: center;
            color: red;
            font-weight: bold;
            margin-bottom: 1rem;
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
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 12px;
            background: #0f3859;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background: #092a42;
        }
        h1 span.text-warning {
            color: #ffce00;
        }
        h1 span:not(.text-warning) {
            color: #fff;
        }
    </style>
</head>
<body>

<div class="split-form">
    <div class="image-side">
        <div id="lottie-animation"></div>
        <h1><span class="text-warning">PAGE</span><span>TURNER</span></h1>
    </div>

    <div class="form-side">
        <h2>Managing Staff Login</h2>
        <?php if (isset($error)) echo "<div class='error-message'>$error</div>"; ?>

        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>

<script>
    lottie.loadAnimation({
        container: document.getElementById('lottie-animation'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: 'images/Animation - 1746869453678.json'
    });
</script>

</body>
</html>
