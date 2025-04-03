<?php
session_start();
include 'config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $district = $_POST['district'];
    $taluka = implode(", ", $_POST['taluka']); // Convert selected talukas to comma-separated string

    // Check if email already exists
    $check_email = $conn->prepare("SELECT * FROM delivery_staff WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        $message = "Email already exists!";
    } else {
        $sql = "INSERT INTO delivery_staff (name, email, phone, password, district, taluka) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $email, $phone, $password, $district, $taluka);

        if ($stmt->execute()) {
            header("Location: admin_manage_delivery_staff.php");
            exit;
        } else {
            $message = "Error: " . $stmt->error;
        }
    }

    $check_email->close();
    $stmt->close();
    $conn->close();
}

$maharashtraData = [
    "Ahmednagar" => ["Akole", "Jamkhed", "Karjat", "Kopargaon", "Nevasa", "Parner", "Pathardi", "Rahata", "Rahuri", "Sangamner", "Shevgaon", "Shrigonda", "Shrirampur"],
    "Akola" => ["Akola", "Akot", "Balapur", "Murtizapur", "Telhara"],
    "Amravati" => ["Amravati", "Achalpur", "Anjangaon", "Bhatkuli", "Chandur", "Daryapur", "Dhamangaon", "Morshi", "Nandgaon-Khandeshwar", "Teosa", "Warud"],
    "Aurangabad" => ["Aurangabad", "Kannad", "Khuldabad", "Paithan", "Phulambri", "Sillod", "Soyegaon", "Vaijapur"],
    "Beed" => ["Ambejogai", "Ashti", "Beed", "Dharur", "Georai", "Kaij", "Majalgaon", "Parli", "Patoda", "Shirur", "Wadwani"],
    "Pune" => ["Baramati", "Bhor", "Daund", "Haveli", "Indapur", "Junnar", "Khed", "Maval", "Mulshi", "Pune City", "Shirur", "Velhe"],
    "Mumbai" => ["Andheri", "Borivali", "Dadar", "Kurla", "Chembur", "Goregaon", "Malad", "Mulund", "Sion", "Vikhroli"],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Delivery Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .taluka-container div {
            display: inline-block;
            margin-right: 10px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        .error-message {
            text-align: center;
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
    <script>
        var maharashtraData = <?php echo json_encode($maharashtraData); ?>;
        
        function updateTalukaOptions() {
            var districtSelect = document.getElementById("district");
            var talukaContainer = document.getElementById("taluka-container");
            talukaContainer.innerHTML = ""; // Clear previous checkboxes

            var selectedDistrict = districtSelect.value;
            if (selectedDistrict in maharashtraData) {
                maharashtraData[selectedDistrict].forEach(function(taluka) {
                    var checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "taluka[]"; // Allow multiple selection
                    checkbox.value = taluka;
                    checkbox.id = taluka;

                    var label = document.createElement("label");
                    label.htmlFor = taluka;
                    label.textContent = taluka;

                    var div = document.createElement("div");
                    div.appendChild(checkbox);
                    div.appendChild(label);
                    talukaContainer.appendChild(div);
                });
            }
        }
    </script>
</head>
<body>



<div class="container">
    <h2>Add Delivery Staff</h2>
    <?php if (isset($message)) { echo "<p class='error-message'>$message</p>"; } ?>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Enter Full Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="text" name="phone" placeholder="Enter Phone Number" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        
        <label for="district">District:</label>
        <select name="district" id="district" onchange="updateTalukaOptions()" required>
            <option value="">Select District</option>
            <?php foreach ($maharashtraData as $district => $talukas) { ?>
                <option value="<?php echo $district; ?>"><?php echo $district; ?></option>
            <?php } ?>
        </select>

        <label>Taluka:</label>
        <div id="taluka-container" class="taluka-container">
            <!-- Taluka checkboxes will be added dynamically here -->
        </div>

        <button type="submit">Add Staff</button>
    </form>
</div>

</body>
</html>
