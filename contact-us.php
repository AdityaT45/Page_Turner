<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)) {
  header('location:login.php');
}

if (isset($_POST['back'])) {
  header('location:index.php');
}

if (isset($_POST['send_msg'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $msg = mysqli_real_escape_string($conn, $_POST['msg']);

  if (empty($name) || empty($email) || empty($phone) || empty($msg)) {
    $message[] = 'Please Fill all Fields';
  } else {
    mysqli_query($conn, "INSERT INTO msg (`user_id`,`name`,`email`, `number`, `msg`) VALUES('$user_id','$name','$email','$phone','$msg')") or die('Mesage send Query failed');
    $message[] = 'Message Sent Successfully';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Contact-Us</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/hello.css">
</head>

<body>

  <?php include 'index_header.php'; ?>

  <div class="contact-section">
    <?php
    if (isset($message)) {
      foreach ($message as $message) {
        echo '
        <div class="message" id="messages"><span>' . $message . '</span>
        </div>
        ';
      }
    }
    ?>
    <h1>Contact Us</h1>
    <br>
    <h3 style="text-align:center;">Hello <span id="span">
        <?php echo $user_name.','; ?>
      </span>&nbsp;how we can help you ?</h3>
    <div class="border"></div>
    <form class="contact-form" action="" method="post">
      <input type="text" class="contact-form-text" name="name" placeholder="Your name">
      <input type="email" class="contact-form-text" name="email" placeholder="Your email">
      <input type="int" class="contact-form-text" name="phone" placeholder="Your phone">
      <textarea class="contact-form-text" name="msg" placeholder="Your message"></textarea>
      <input type="submit" class="contact-form-btn" id="send" name="send_msg" value="Send">&nbsp;
      <input type="submit" class="contact-form-btn" id="back" name="back" value="Back">&nbsp;
    </form>
  </div>

  <!-- <php include 'index_footer.php'; ?> -->

  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');

      // hides element (still takes up space on page)
      box.style.display = 'none';
    }, 3000);
  </script>
</body>

</html>