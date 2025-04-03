<?php
session_start();
include 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

// Get order ID from URL
if (!isset($_GET['order_id'])) {
    die("Order ID is required.");
}

$order_id = intval($_GET['order_id']);

// Fetch order details
$query = "SELECT * FROM confirm_order WHERE id = $order_id";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    die("Order not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Order #<?= $order['id']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .invoice-box { width: 80%; margin: auto; background: white; padding: 20px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2); }
        h2 { text-align: center; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #0f3859; color: white; }
        .total { font-size: 18px; font-weight: bold; }
        .print-btn { display: block; margin: 20px auto; background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer; font-size: 16px; }
        .print-btn:hover { background: #1e7e34; }
    </style>
</head>
<body>

<div class="max-w-4xl mx-auto p-4 border border-gray-300">
    <h2 class="text-4xl font-bold"><span class="text-red-500">Page</span> <span class=" text-gray-900">Turner</span></h2>

    <div class="flex justify-between items-center mb-4">
        <div>
            <p>Contact us: 1800 288 9898 | cs@pageturner.com</p>
        </div>
        <div class="text-right">
            <p class="font-bold">Tax Invoice # FDPY/2017/1-0242186</p>
        </div>
    </div>

    <div class="mb-4">
        <p class="font-bold">Page Turner Retail Private Limited,</p>
        <p>Warehouse Address: Plot no. 50, 63, 64 & 65,</p>
        <p>Sector-18, Narhe,</p>
        <p>Pune, Maharashtra, India - 411041</p>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <p><span class="font-bold">Order ID:</span> <?= $order['id']; ?></p>
            <p><span class="font-bold">Order Date:</span> <?= $order['order_date']; ?></p>
            <p><span class="font-bold">Invoice Date:</span> <?= date('d-m-Y'); ?></p>
        </div>
        <div>
            <p class="font-bold">Billing Address</p>
            <p><?= htmlspecialchars($order['name']); ?></p>
            <p><?= htmlspecialchars($order['address']); ?></p>
            <p><span class="font-bold">Taluka:</span> <?= htmlspecialchars($order['taluka']); ?></p>
            <p><span class="font-bold">District:</span> <?= htmlspecialchars($order['district']); ?></p>
            <p>Phone: <?= htmlspecialchars($order['number']); ?></p>
        </div>
    </div>

    <table class="w-full border-collapse border border-gray-300 mb-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2 text-left">Books Ordered</th>
                <th class="border border-gray-300 p-2 text-left">Total Books</th>
                <th class="border border-gray-300 p-2 text-left">Price(₹)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 p-2">Book Order</td>
                <td class="border border-gray-300 p-2"><?= $order['total_books']; ?></td>
                <td class="border border-gray-300 p-2">₹<?= $order['total_price']; ?></td>
            </tr>
        </tbody>
    </table>

    <div class="flex justify-end mb-4">
        <div class="text-right">
            <p class="font-bold text-xl">Grand Total</p>
            <p class="text-xl">₹<?= $order['total_price']; ?></p>
        </div>
    </div>

    <div class="text-center mb-4">
        <p>This is a computer-generated invoice, no signature required.</p>
    </div>

    <button class="print-btn bg-blue-500 text-white px-4 py-2" onclick="window.print()">Print Invoice</button>
</div>

</body>
</html>
