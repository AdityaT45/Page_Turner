<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id='$remove_id'") or die('query failed');
    $_SESSION['message'] = 'Removed Successfully';
    header('location:cart.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/hello.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0; }
        .cart-container { width: 80%; margin: 30px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .cart-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .cart-table thead { background-color: #0f3859; color: white; }
        .cart-table th, .cart-table td { padding: 15px; text-align: center; border-bottom: 1px solid #ddd; }
        .cart-table img { height: 120px; width: auto; border-radius: 5px; }
        .quantity-buttons { display: flex; justify-content: center; align-items: center; }
        .quantity-buttons button { background-color: #0f3859; color: white; border: none; padding: 10px 15px; font-size: 18px; cursor: pointer; border-radius: 5px; margin: 0 5px; }
        .quantity-buttons button:hover { background-color: #09293d; }
        .remove-link { color: red; text-decoration: none; font-weight: bold; }
        .total-row { font-size: 18px; font-weight: bold; background: #e3e3e3; }
        .message { text-align: center; padding: 10px; background: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; margin-bottom: 20px; border-radius: 5px; }
        .checkout-btn {
            background-color: #ffa41c;
            color: black;
            padding: 8px;
            
        }
        .addBook-btn {
            background-color:rgb(0, 158, 66);
            color: black;
            padding: 8px;
            
        }
    </style>
</head>
<body style="background-color:#fdfce5">
    <?php include 'index_header.php'; ?>
    <div class="cart-container">
        <?php if (isset($_SESSION['message'])) { 
            echo '<div class="message" id="alert-message">'.$_SESSION['message'].'</div>'; 
            unset($_SESSION['message']);
        } ?>
        <table class="cart-table mb-5">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total (₹)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $select_book = $conn->query("SELECT id, name, price, image, quantity FROM cart WHERE user_id=$user_id");
                if ($select_book->num_rows > 0) {
                    while ($row = $select_book->fetch_assoc()) {
                        $sub_total = $row['price'] * $row['quantity'];
                        $total += $sub_total;
                        echo "<tr>
                            <td><img src='./added_books/{$row['image']}' alt=''></td>
                            <td>{$row['name']}</td>
                            <td>₹{$row['price']}</td>
                            <td>
                                <div class='quantity-buttons'>
                                    <button class='decrease' data-id='{$row['id']}' data-price='{$row['price']}'>-</button>
                                    <span class='quantity' data-id='{$row['id']}'>{$row['quantity']}</span>
                                    <button class='increase' data-id='{$row['id']}' data-price='{$row['price']}'>+</button>
                                </div>
                            </td>
                            <td class='subtotal' data-id='{$row['id']}'>₹{$sub_total}</td>
                            <td><a class='remove-link' href='cart.php?remove={$row['id']}'>Remove</a></td>
                        </tr>";
                    }
                } else {
                    echo '<tr><td colspan="6" style="text-align:center; font-weight:bold;">Your cart is empty!</td></tr>';
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4">Total</td>
                    <td colspan="2" id="grand-total">₹<?php echo $total; ?>/-</td>
                </tr>
            </tfoot>
        </table>
        <div style="margin-top: 20px;">
        <a href="checkout.php" class="checkout-btn btn mt-5 py-5">Proceed to Checkout</a>
        <a href="index.php" class="addBook-btn btn mt-5 px-5">Add More Book </a>
        </div>
        

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const cartContainer = document.querySelector(".cart-container");

                cartContainer.addEventListener("click", function (event) {
                    if (event.target.classList.contains("increase") || event.target.classList.contains("decrease")) {
                        let button = event.target;
                        let cartId = button.dataset.id;
                        let bookPrice = parseFloat(button.dataset.price);
                        let quantitySpan = document.querySelector(`.quantity[data-id='${cartId}']`);
                        let subtotalTd = document.querySelector(`.subtotal[data-id='${cartId}']`);
                        let currentQuantity = parseInt(quantitySpan.innerText);
                        
                        if (button.classList.contains("increase")) {
                            currentQuantity++;
                        } else if (button.classList.contains("decrease") && currentQuantity > 1) {
                            currentQuantity--;
                        }

                        quantitySpan.innerText = currentQuantity;
                        let newSubtotal = bookPrice * currentQuantity;
                        subtotalTd.innerText = `₹${newSubtotal}`;

                        // Update total price
                        updateTotalPrice();

                        // Send AJAX request to update quantity in the database
                        fetch("update_cart.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                            body: `cart_id=${cartId}&update_quantity=${currentQuantity}&book_price=${bookPrice}`
                        }).then(response => response.text()).then(data => {
                            console.log("Cart updated:", data);
                        }).catch(error => console.error("Error:", error));
                    }
                });

                function updateTotalPrice() {
                    let total = 0;
                    document.querySelectorAll(".subtotal").forEach(td => {
                        total += parseFloat(td.innerText.replace("₹", ""));
                    });
                    document.getElementById("grand-total").innerText = `₹${total}/-`;
                }
            });
        </script>
    </div>
</body>
</html>
