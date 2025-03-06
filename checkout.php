<?php
include 'config.php';
session_start();

require('vendor/autoload.php'); // Include Razorpay SDK
use Razorpay\Api\Api;

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users_info WHERE Id = '$user_id'";
$result = $conn->query($query);
$user = mysqli_fetch_assoc($result);

$full_name = $user['name'] . ' ' . $user['surname'];

if (isset($_POST['checkout'])) {
    $name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $country = "India";
    $full_address = "$address, $city, $state, $country - $pincode";
    $placed_on = date('d-m-Y');
    
    $cart_total = 0;
    $cart_products = [];
    
    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('Query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' #' . $cart_item['book_id'] . ',(' . $cart_item['quantity'] . ')';
            $sub_total = $cart_item['price'] * $cart_item['quantity'];
            $cart_total += $sub_total;
        }
    }
    
    $total_books = implode(' ', $cart_products);
    
    $order_check_query = "SELECT * FROM confirm_order WHERE name = '$name' AND email = '$email' AND number = '$number' AND address = '$full_address' AND total_books = '$total_books' AND total_price = '$cart_total'";
    $order_query = mysqli_query($conn, $order_check_query) or die('Query failed');
    
    if (mysqli_num_rows($order_query) > 0) {
        echo '<script>alert("Order already placed!");</script>';
    } else {
        mysqli_query($conn, "INSERT INTO confirm_order (user_id, name, number, email, address, total_books, total_price, order_date) VALUES ('$user_id', '$name', '$number', '$email', '$full_address', '$total_books', '$cart_total', '$placed_on')") or die('Query failed');
        
        $conn_oid = $conn->insert_id;
        
        $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('Query failed');
        if (mysqli_num_rows($cart_query) > 0) {
            while ($cart_item = mysqli_fetch_assoc($cart_query)) {
                $cart_books = $cart_item['name'];
                $quantity = $cart_item['quantity'];
                $unit_price = $cart_item['price'];
                $sub_total = $cart_item['price'] * $cart_item['quantity'];
                
                mysqli_query($conn, "INSERT INTO orders (user_id, id, address, city, state, country, pincode, book, quantity, unit_price, sub_total) VALUES ('$user_id', '$conn_oid', '$address', '$city', '$state', '$country', '$pincode', '$cart_books', '$quantity', '$unit_price', '$sub_total')") or die('Query failed');
            }
        }
        
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'") or die('Query failed');
        echo '<script>alert("Order placed successfully!");</script>';
    }
}




// Fetch cart details
$grand_total = 0;
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Cart query failed');
$cart_items = [];

if (mysqli_num_rows($cart_query) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
        $grand_total += $total_price;
        $cart_items[] = $fetch_cart;
    }
}

// Razorpay API details (Use Test Keys for Testing)
$api_key = 'rzp_test_wcit1OfpfPhyX8';  // Replace with Razorpay Key ID
$api_secret = 'YF68mFDwSnH5IFp8zaeJ9qcF'; // Replace with Razorpay Key Secret
$api = new Api($api_key, $api_secret);

// Create Razorpay Order
$order = $api->order->create([
    'receipt' => uniqid(),
    'amount' => $grand_total * 100, // Convert amount to paise
    'currency' => 'INR',
    'payment_capture' => 1
]);

$order_id = $order['id'];
?>




<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout</title>
  <style>
    body {
      font-family: Arial;
      font-size: 17px;
      padding: 8px;
      overflow-x: hidden;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      display: -ms-flexbox;
      /* IE10 */
      display: flex;
      -ms-flex-wrap: wrap;
      /* IE10 */
      flex-wrap: wrap;
      margin: 0 -16px;
      padding: 30px;
    }

    .col-25 {
      -ms-flex: 25%;
      /* IE10 */
      flex: 25%;
    }

    .col-50 {
      -ms-flex: 50%;
      /* IE10 */
      flex: 50%;
    }

    .col-75 {
      -ms-flex: 75%;
      /* IE10 */
      flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
      padding: 0 16px;
    }

    .container {
      width: 80%;
      background-color:rgb(255, 255, 255);
      padding: 5px 20px 15px 20px;
      /* border: 1px solid lightgrey; */
      border-radius: 3px;
      justify-self: center;
    }

    input[type=text],
    select {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    label {
      margin-bottom: 10px;
      display: block;
      color: black;
    }

    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    .btn {
      background-color: #0f3859;
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }

    .btn:hover {
      background-color: rgb(6 157 21);
      letter-spacing: 1px;
      font-weight: 600;
    }

    a {
      color: #rgb(28 146 197);
    }

    hr {
      border: 2px solid lightgrey;
    }

    span.price {
      float: right;
      color: grey;
    }

    @media (max-width: 800px) {
      .row {
        flex-direction: column-reverse;
        padding: 0;
      }

      .col-25 {
        margin-bottom: 20px;
      }
    }

    .message {
      position: sticky;
      top: 0;
      margin: 0 auto;
      width: 61%;
      background-color: #fff;
      padding: 6px 9px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      z-index: 100;
      gap: 0px;
      border: 2px solid rgb(68, 203, 236);
      border-top-right-radius: 8px;
      border-bottom-left-radius: 8px;
    }

    .message span {
      font-size: 22px;
      color: rgb(240, 18, 18);
      font-weight: 400;
    }

    .message i {
      cursor: pointer;
      color: rgb(3, 227, 235);
      font-size: 15px;
    }
  </style>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/493af71c35.js" crossorigin="anonymous"></script>

</head>

<body style="background-color:#fdfce5">
  <?php include 'index_header.php'; ?>

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

  <h1 style="text-align: center; margin-top:15px;  color:#0f3859;">Place Your Order Here</h1>
  <p style="text-align: center; ">Just One Step away from getting your books</p>
  <div class="row">
    <div class="col-75">
      <div class="container">
        <form action="" method="POST">

          <div class="row">
          
<div class="col-50">
    <h3>Billing Address</h3><br>
    
    <label for="fname"><i class="fa fa-user"></i> Full Name <span style="color:red;">*</span></label>
    <input type="text" id="fname" name="firstname" value="<?php echo htmlspecialchars($user['name'] . ' ' . $user['surname']); ?>" pattern="[A-Za-z\s]+" title="Please enter text only" required>

    <label for="email"><i class="fa fa-envelope"></i> Email <span style="color:red;">*</span></label>
    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

    <label for="number"><i class="fa fa-envelope"></i> Number <span style="color:red;">*</span></label>
    <input type="text" id="number" name="number" placeholder="+91xxxxxxxxxx" require maxlength="10" required>

    <label for="adr"><i class="fa fa-address-card-o"></i> Address <span style="color:red;">*</span></label>
    <input type="text" id="adr" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

    <label for="city"><i class="fa fa-institution"></i> City <span style="color:red;">*</span></label>
    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>

    <label for="state"><i class="fa fa-institution"></i> State <span style="color:red;">*</span></label>
    <select name="state" id="state" required>
        <option value="">---Select---</option>
        <?php
        $states = ["Andhra Pradesh", "Andaman and Nicobar Islands", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadar and Nagar Haveli", "Daman and Diu", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Puducherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"];

        foreach ($states as $state) {
            $selected = ($state == $user['state']) ? 'selected' : '';
            echo "<option value='$state' $selected>$state</option>";
        }
        ?>
    </select>

    <div style="padding: 0px;" class="row">
        <div class="col-50">
            <label for="country">Country <span style="color:red;">*</span></label>
            <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($user['country']); ?>" disabled>
        </div>
        <div class="col-50">
            <label for="zip">Pincode <span style="color:red;">*</span></label>
            <input type="text" id="zip" name="pincode" value="<?php echo htmlspecialchars($user['pincode']); ?>" maxlength="6" required>
        </div>
    </div>
</div>

    

<div class="col-50">
<div class="container">
    <h4>Order Summary</h4>
    <?php if (!empty($cart_items)) : ?>
        <?php foreach ($cart_items as $item) : ?>
            <p><?php echo htmlspecialchars($item['name']); ?> 
                <span class="price">(₹<?php echo htmlspecialchars($item['price']); ?>/-
                x <?php echo htmlspecialchars($item['quantity']); ?>)</span>
            </p>
        <?php endforeach; ?>
        <hr>
        <p>Total Amount: <b>₹<?php echo $grand_total; ?>/-</b></p>

        <!-- Razorpay Payment Button -->
        <!-- <button id="rzp-button1" class="btn btn-primary">Pay Now</button> -->
        <button id="rzp-button1"  type="submit" class="btn">Pay with Razorpay</button>

       
    <?php else : ?>
        <p class="empty">Your cart is empty</p>
    <?php endif; ?>
</div>
    

 
</div>
          <!-- <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label> -->
          <input type="submit" name="checkout" value="Continue to checkout" class="btn">
        </form>
      </div>
    </div>
  </div>
  <!-- <php include 'index_footer.php'; ?> -->
  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');

      // 👇️ hides element (still takes up space on page)
      box.style.display = 'none';
    }, 5000);
  </script>

   <!-- Razorpay Payment Script -->
   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    var options = {
        "key": "rzp_test_wcit1OfpfPhyX8", // Replace with your Razorpay Key ID
        "amount": "<?php echo $grand_total * 100; ?>", 
        "currency": "INR",
        "name": "Your Company Name",
        "description": "Order Payment",
        "image": "https://yourwebsite.com/logo.png",
        "order_id": "<?php echo $order_id; ?>",
        "handler": function (response) {
            alert("Payment Successful. Payment ID: " + response.razorpay_payment_id);
            window.location.href = "payment_success.php?payment_id=" + response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo $user['name']; ?>",
            "email": "<?php echo $user['email']; ?>",
            "contact": "<?php echo $user['number']; ?>"
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    
    var rzp = new Razorpay(options);
    
    document.getElementById('rzp-button1').onclick = function (e) {
        rzp.open();
        e.preventDefault();
    };
</script>



</body>

</html>