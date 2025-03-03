<?php
include 'config.php';

function containsOnlyText($input) {
    // Regular expression to match only alphabetic characters and spaces
    $pattern = '/^[a-zA-Z\s]+$/';

    // Check if the input matches the pattern
    return preg_match($pattern, $input);
}

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['Name']);
  $Sname = mysqli_real_escape_string($conn, $_POST['Sname']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, ($_POST['password']));
  $cpassword = mysqli_real_escape_string($conn, ($_POST['cpassword']));
  $user_type = 'User';

  $select_users = $conn->query("SELECT * FROM users_info WHERE email = '$email'") or die('query failed');

  if (mysqli_num_rows($select_users) != 0) {
    echo '<script>alert("User Already Exists !!!");</script>';
  } else {
    if ($password != $cpassword) {
      echo '<script>alert("Please Check your Passwords AGAIN !!!\nConfirm Password not Matched...");</script>';
    } else {
      if (empty($name)) {
        $message[] = 'Please Enter Your Name';
      } elseif (!containsOnlyText($name)) {
        $message[] = 'Name should contain only text';
      } elseif (empty($Sname)) {
        $message[] = 'Please Enter Your Surname';
      } elseif (empty($username)) {
        $message[] = 'Please Enter Username';
      } elseif (empty($email)) {
        $message[] = 'Please Enter Your Email';
      } elseif (empty($password)) {
        $message[] = 'Please Enter a Password';
      } else {
        mysqli_query($conn, "INSERT INTO users_info(`name`, `surname`, `username`, `email`, `password`, `user_type`) VALUES('$name','$Sname','$username','$email','$password','$user_type')") or die('Query failed');
        echo '<script>alert("Registration Successfull !!!");</script>';
        header("Location: login.php"); // Fix for redirection
        exit(); // Added to prevent further execution
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/register.css  " />
  <title>Registration</title>

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
      height: 8px;
      border: 2px;
    }
  </style>
</head>

<body>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '
        <div class="message" id= "messages"><span>' . $message . '</span>
        </div>
        ';
    }
  }
  ?>
  <div class="container">
    <form action="" method="post">
      <h3 style="color:white;">Register to Use <a href="index.php"><span>Bookflix & </span><span>Chill</span></a>
      </h3>
      <hr>
      <hr>
      <input type="text" name="Name" placeholder="Enter Name" id="name" required class="text_field" pattern="[A-Za-z\s]+" title="Please enter text only">
      <input type="text" name="Sname" placeholder="Enter Surname" required class="text_field" pattern="[A-Za-z\s]+" title="Please enter text only">
      <input type="email" name="email" placeholder="Enter Email Id" required class="text_field">
      <input type="text" name="username" placeholder="Enter Username" required class="text_field">
      <input type="password" name="password" placeholder="Enter password" required class="text_field" maxlength="8" minlength="6">
      <input type="password" name="cpassword" placeholder="Confirm password" required class="text_field" maxlength="8" minlength="6">
      <hr>
      <hr>
      <input type="submit" value="Register" name="submit" class="btn text_field"
        style="background: rgba(0, 167, 245,0.7);">
      <p>Already have a Account?<br>
        <a class="link" href="login.php">Login</a>
        <a class="link" href="index.php">Back</a>
      </p>
    </form>
  </div>
  <?php include 'index_footer.php' ?>

  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');

      // hides element (still takes up space on page)
      box.style.display = 'none';
    }, 2000);
  </script>
</body>

</html>