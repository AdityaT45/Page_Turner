<?php
session_start();
include 'config.php'; // Database connection

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users_info WHERE Id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found!");
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            /* min-height: 100vh; */
            /* display: flex; */
            justify-content: center;
            align-items: center;
            background: #fdfce5;
            /* padding: 20px; */
        }

        .profile-card {
            background: white;
            width: 100%;
            max-width: 450px;
            padding: 30px;
            text-align: center;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin: 50px 0 50px 550px;

        }

        h2 {
            color: #0f3859;
            margin-bottom: 20px;
        }

        .details {
            text-align: left;
        }

        .details p {
            font-size: 16px;
            margin: 10px 0;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        .details p span {
            font-weight: bold;
            color: #333;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .edit-btn {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #0f3859;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s, background 0.3s;
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            background: #092a42;
        }

        @media (max-width: 500px) {
            .profile-card {
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }

            .details p {
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
<?php include 'index_header.php' ?>

<div class="profile-card">
    <h2><?= htmlspecialchars($user['name']) . " " . htmlspecialchars($user['surname']) ?></h2>

    <?php if (!empty($message)) { ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php } ?>

    <div class="details">
        <p><span>Username:</span> <?= htmlspecialchars($user['username']) ?></p>
        <p><span>Email:</span> <?= htmlspecialchars($user['email']) ?></p>
        <p><span>Address:</span> <?= htmlspecialchars($user['address']) ?></p>
        <p><span>District:</span> <?= htmlspecialchars($user['district']) ?></p>
        <p><span>Taluka:</span> <?= htmlspecialchars($user['taluka']) ?></p>
        <p><span>State:</span> <?= htmlspecialchars($user['state']) ?></p>
        <p><span>Country:</span> <?= htmlspecialchars($user['country']) ?></p>
        <p><span>Pincode:</span> <?= htmlspecialchars($user['pincode']) ?></p>
    </div>

    <button class="edit-btn" onclick="window.location.href='update_user_info.php'">Edit Profile</button>
</div>

<?php include 'index_footer.php' ?>

</body>
</html>
