<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
      body {
         font-family: Arial, sans-serif;
         background: #fdfce5;
         text-align: center;
      }
      h1 {
         margin-top: 20px;
      }
      .table-container {
         width: 80%;
         margin: 20px auto;
         overflow-x: auto;
      }
      table {
         width: 100%;
         border-collapse: collapse;
         background: white;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }
      th, td {
         padding: 10px;
         border: 1px solid #ddd;
         text-align: center;
      }
      th {
         background: #0f3859;
         color: white;
      }
      .track-btn {
         background-color: dimgray;
         padding: 8px 12px;
         border-radius: 10px;
         color: white;
         text-transform: uppercase;
         cursor: pointer;
         text-decoration: none;
      }
      .track-btn:hover {
         background-color: #333;
      }
   </style>
</head>

<body>
   <?php include 'index_header.php'; ?>
   <h1>My Orders</h1>
   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>Order Date</th>
               <th>Order ID</th>
               <th>Books Ordered</th>
               <th>Total Price</th>
               <th>Payment Status</th>
               <th>Track My Order</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $query = "SELECT order_date, id AS order_id, total_books, total_price, payment_status FROM confirm_order WHERE user_id = '$user_id' ORDER BY order_date DESC";
            $result = mysqli_query($conn, $query) or die('Query failed');

            if (mysqli_num_rows($result) > 0) {
               while ($order = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
               <td><?php echo $order['order_date']; ?></td>
               <td>#<?php echo $order['order_id']; ?></td>
               <td><?php echo $order['total_books']; ?></td>
               <td>₹<?php echo $order['total_price']; ?>/-</td>
               <td style="color:<?php echo ($order['payment_status'] == 'pending') ? 'orange' : 'green'; ?>;">
                  <?php echo $order['payment_status']; ?>
               </td>
               <td>
                  <a class="track-btn" href="track_order.php?order_id=<?php echo $order['order_id']; ?>">Track</a>
               </td>
            </tr>
            <?php
               }
            } else {
               echo '<tr><td colspan="6">No orders found!</td></tr>';
            }
            ?>
         </tbody>
      </table>
   </div>
</body>

</html>
