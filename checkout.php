<?php
include 'config.php';
session_start();
require('vendor/autoload.php'); // Include Razorpay SDK
use Razorpay\Api\Api;

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users_info WHERE Id = '$user_id'";
$result = $conn->query($query);
$user = mysqli_fetch_assoc($result);

$full_name = $user['name'] . ' ' . $user['surname'];

$create_orders_table = "CREATE TABLE IF NOT EXISTS confirm_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    number VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    total_books TEXT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    order_date DATE NOT NULL,
    payment_id VARCHAR(255) NOT NULL,
    payment_status ENUM('pending', 'success', 'failed') NOT NULL DEFAULT 'pending'
)";
$conn->query($create_orders_table);

$grand_total = 0;
$cart_items = [];
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");

if (mysqli_num_rows($cart_query) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
        $grand_total += $total_price;
        $cart_items[] = $fetch_cart;
    }
}

// Razorpay API details
$api_key = 'rzp_test_wcit1OfpfPhyX8';  // Replace with your Razorpay Key ID
$api_secret = 'YF68mFDwSnH5IFp8zaeJ9qcF'; // Replace with your Razorpay Key Secret
$api = new Api($api_key, $api_secret);

// Create Razorpay Order
$order = $api->order->create([
    'receipt' => uniqid(),
    'amount' => $grand_total * 100,
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
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body style="background-color:#fdfce5">
  <?php include 'index_header.php'; ?>

  <?php if (isset($message)) {
    foreach ($message as $msg) {
      echo '<div class="message" id="messages"><span>' . $msg . '</span></div>';
    }
  } ?>

  <h1 style="text-align: center; margin-top:15px; color:#0f3859;">Place Your Order Here</h1>
  <p style="text-align: center;">Just One Step away from getting your books</p>

  <div class="row">
    <div class="col-75">
      <div class="container">
        <form id="orderForm" method="POST">
          <div class="row">
            <div class="col-50">
              <h3>Billing Address</h3><br>
              <label for="fname"><i class="fa fa-user"></i> Full Name *</label>
              <input type="text" id="fname" name="firstname" value="<?php echo htmlspecialchars($full_name); ?>" required>
              
              <label for="email"><i class="fa fa-envelope"></i> Email *</label>
              <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
              
              <label for="number"><i class="fa fa-phone"></i> Number *</label>
              <input type="text" id="number" name="number" maxlength="10" required>
              
              <label for="adr"><i class="fa fa-address-card-o"></i> Address *</label>
              <input type="text" id="adr" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

              <label for="zip"><i class="fa fa-institution"></i> Pincode *</label>
              <input type="text" id="zip" name="pincode" value="<?php echo htmlspecialchars($user['pincode']); ?>" required>
            </div>

            <div class="col-50">
              <div class="container">
                <h4>Order Summary</h4>
                <?php foreach ($cart_items as $item) : ?>
                  <p><?php echo htmlspecialchars($item['name']); ?> <span class="price">(₹<?php echo htmlspecialchars($item['price']); ?> x <?php echo htmlspecialchars($item['quantity']); ?>)</span></p>
                <?php endforeach; ?>
                <hr>
                <p>Total Amount: <b>₹<?php echo $grand_total; ?>/-</b></p>

                <button id="rzp-button1" type="button" class="btn">Pay with Razorpay</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('rzp-button1').addEventListener("click", function (e) {

        var options = {
    "key": "<?php echo $api_key; ?>",
    "amount": "<?php echo $grand_total * 100; ?>",
    "currency": "INR",
    "name": "Page Turner",
    "description": "Book Purchase",
    "order_id": "<?php echo $order_id; ?>",
    "handler": function (response) {
        console.log("Payment Success: ", response);
        
        fetch("update_order.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "razorpay_payment_id=" + response.razorpay_payment_id
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") {
                alert("Payment Successful! Order Confirmed.");
                window.location.href = "thankyou.php";
            } else {
                alert("Error saving order: " + data);
            }
        })
        .catch(error => console.error("Error:", error));
    },
    "theme": {
        "color": "#0f3859"
    }
};

        var rzp = new Razorpay(options);
        rzp.open();
        e.preventDefault();
    });
</script>


  <script>
    setTimeout(() => { document.getElementById('messages').style.display = 'none'; }, 5000);
  </script>
</body>
</html>
