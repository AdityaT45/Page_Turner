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

    $sql = "INSERT INTO delivery_staff (name, email, phone, password, district, taluka) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $password, $district, $taluka);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

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
    <title>Delivery Staff Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fdfce5;
        }

        .split-form {
            display: flex;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .split-form .image-side {
            flex: 1;
            background: #0f3859;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
        }

        #lottie-animation {
            width: 300px;
            height: 300px;
        }

        .split-form .form-side {
            flex: 1;
            padding: 3rem;
        }

        .split-form h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #333;
        }

        .split-form input, select {
            width: 100%;
            padding: 1rem;
            margin: 0.5rem 0;
            border: none;
            border-bottom: 2px solid #eee;
            outline: none;
            transition: border-color 0.3s;
        }

        .split-form input:focus, .split-form select:focus {
            border-bottom-color: #0f3859;
        }

        .split-form button {
            width: 100%;
            padding: 1rem;
            margin-top: 1.5rem;
            background: #0f3859;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.3s;
        }

        .split-form button:hover {
            transform: translateY(-2px);
        }

        .error-message, .success-message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .error-message { color: red; }
        .success-message { color: green; }
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
    <h2>Delivery Staff Registration</h2>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

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

            <button type="submit">Register</button>
        </form>
</body>
</html>
