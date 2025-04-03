<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

// Date Filter Logic
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

// Fetch Total Earnings from Delivered Orders within Date Range
$total_earnings_query = "
    SELECT SUM(total_price) AS total_earnings 
    FROM confirm_order 
    WHERE order_status = 'delivered' AND order_date BETWEEN '$start_date' AND '$end_date'
";
$total_earnings_result = mysqli_query($conn, $total_earnings_query) or die(mysqli_error($conn));
$total_earnings = mysqli_fetch_assoc($total_earnings_result)['total_earnings'] ?? 0;

// Fetch Earnings by Taluka & District
$earnings_query = "
    SELECT district, taluka, SUM(total_price) AS earnings, COUNT(id) AS orders_count
    FROM confirm_order 
    WHERE order_status = 'delivered' AND order_date BETWEEN '$start_date' AND '$end_date'
    GROUP BY district, taluka
    ORDER BY earnings DESC
";
$earnings_result = mysqli_query($conn, $earnings_query) or die(mysqli_error($conn));

$districts = [];
$earnings = [];
while ($row = mysqli_fetch_assoc($earnings_result)) {
    $districts[] = $row['district'] . " - " . $row['taluka'];
    $earnings[] = $row['earnings'];
}

// Fetch Top Performing District & Taluka
$top_query = "
    SELECT district, taluka, SUM(total_price) AS earnings
    FROM confirm_order 
    WHERE order_status = 'delivered' AND order_date BETWEEN '$start_date' AND '$end_date'
    GROUP BY district, taluka
    ORDER BY earnings DESC LIMIT 1
";
$top_result = mysqli_query($conn, $top_query);
$top_data = mysqli_fetch_assoc($top_result);
$top_district = $top_data['district'] ?? 'N/A';
$top_taluka = $top_data['taluka'] ?? 'N/A';
$top_earnings = $top_data['earnings'] ?? 0;

// Export CSV
if (isset($_GET['export'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="earnings_report.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['District', 'Taluka', 'Total Orders', 'Earnings']);
    $export_query = mysqli_query($conn, $earnings_query);
    while ($row = mysqli_fetch_assoc($export_query)) {
        fputcsv($output, [$row['district'], $row['taluka'], $row['orders_count'], $row['earnings']]);
    }
    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings Report</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 95%; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); }
        h2 { text-align: center; }
        .total-earnings { font-size: 24px; text-align: center; margin-bottom: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007bff; color: white; }
        .btn { padding: 7px 15px; border: none; cursor: pointer; background: green; color: white; }
        .btn:hover { opacity: 0.8; }
        .filter-box { display: flex; gap: 10px; justify-content: center; margin-bottom: 20px; }
        .top-box { text-align: center; font-size: 18px; margin-bottom: 20px; background: #ffcc00; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Earnings Report</h2>

    <!-- Date Filter -->
    <div class="filter-box">
        <form method="GET">
            <input type="date" name="start_date" value="<?php echo $start_date; ?>">
            <input type="date" name="end_date" value="<?php echo $end_date; ?>">
            <button type="submit" class="btn">Filter</button>
        </form>
        <a href="?export=1&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="btn">Download CSV</a>
    </div>

    <!-- Total Earnings Display -->
    <div class="total-earnings">Total Earnings: ₹<?php echo number_format($total_earnings, 2); ?></div>

    <!-- Top Performing District -->
    <div class="top-box">
        <strong>Top Performing Location:</strong> <?php echo $top_district . ' - ' . $top_taluka; ?>  
        <br> <strong>Earnings:</strong> ₹<?php echo number_format($top_earnings, 2); ?>
    </div>

    <!-- Earnings Breakdown Table -->
    <table>
        <tr>
            <th>District</th>
            <th>Taluka</th>
            <th>Total Orders</th>
            <th>Earnings (₹)</th>
        </tr>
        <?php
        $earnings_result = mysqli_query($conn, $earnings_query);
        while ($row = mysqli_fetch_assoc($earnings_result)) { ?>
            <tr>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['taluka']; ?></td>
                <td><?php echo $row['orders_count']; ?></td>
                <td>₹<?php echo number_format($row['earnings'], 2); ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Chart Representation -->
    <canvas id="earningsChart" width="400" height="200"></canvas>
</div>

<script>
    const ctx = document.getElementById('earningsChart').getContext('2d');
    const earningsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($districts); ?>,
            datasets: [{
                label: 'Earnings (₹)',
                data: <?php echo json_encode($earnings); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

</body>
</html>
