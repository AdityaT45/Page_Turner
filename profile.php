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

// Success message after update
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']); // Clear message after displaying
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Arial', sans-serif; }
        body { background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        
        .profile-card {
            background: white; width: 400px; padding: 25px; text-align: center;
            border-radius: 12px; box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
            position: relative; overflow: hidden;
        }

        .profile-card::before {
           
        }

        .profile-image {
            width: 100px; height: 100px; border-radius: 50%; background: #ddd;
            display: block; margin: 70px auto 10px; border: 5px solid white;
        }

        h2 { color: #0a3d62; margin-bottom: 10px; }

        .details { 
            display: flex; flex-direction: column; align-items: center;
            margin-top: 10px; 
        }

        .details p { 
            width: 100%; padding: 8px; font-size: 16px;
            border-bottom: 1px solid #ddd; text-align: left;
        }

        .details p span { font-weight: bold; color: #333; }

        .message {
            text-align: center; color: green; font-weight: bold; 
            margin-bottom: 10px;
        }

        .edit-btn {
            display: block; width: 100%; padding: 12px;
            background: #0a3d62; color: white; border: none;
            border-radius: 8px; font-size: 16px; cursor: pointer;
            transition: 0.3s; margin-top: 15px;
        }

        .edit-btn:hover { background: #07538f; }
    </style>
</head>
<body>

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

</body>
</html>