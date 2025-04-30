<?php
session_start();
include 'config.php'; // Include database connection

$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

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

// Handle profile update
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $taluka = mysqli_real_escape_string($conn, $_POST['taluka']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);

    // Handle password update separately
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $update_query = "UPDATE users_info SET 
            name = '$name', surname = '$surname', username = '$username', 
            email = '$email', password = '$hashed_password', address = '$address', 
            district = '$district', taluka = '$taluka', state = '$state', 
            country = '$country', pincode = '$pincode' WHERE Id = '$user_id'";
    } else {
        $update_query = "UPDATE users_info SET 
            name = '$name', surname = '$surname', username = '$username', 
            email = '$email', address = '$address', 
            district = '$district', taluka = '$taluka', state = '$state', 
            country = '$country', pincode = '$pincode' WHERE Id = '$user_id'";
    }

    if ($conn->query($update_query)) {
        $_SESSION['message'] = "Profile Updated Successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $message = "Update Failed!";
    }
}

$maharashtraData = [
    "Ahmednagar" => ["Akole", "Jamkhed", "Karjat", "Kopargaon", "Nevasa", "Parner", "Pathardi", "Rahata", "Rahuri", "Sangamner", "Shevgaon", "Shrigonda", "Shrirampur"],
    "Akola" => ["Akola", "Akot", "Balapur", "Murtizapur", "Telhara"],
    "Amravati" => ["Amravati", "Achalpur", "Anjangaon", "Bhatkuli", "Chandur", "Daryapur", "Dhamangaon", "Morshi", "Nandgaon-Khandeshwar", "Teosa", "Warud"],
    "Aurangabad" => ["Aurangabad", "Kannad", "Khuldabad", "Paithan", "Phulambri", "Sillod", "Soyegaon", "Vaijapur"],
    "Beed" => ["Ambejogai", "Ashti", "Beed", "Dharur", "Georai", "Kaij", "Majalgaon", "Parli", "Patoda", "Shirur", "Wadwani"],
    "Bhandara" => ["Bhandara", "Lakhandur", "Lakhani", "Mohadi", "Pauni", "Sakoli", "Tumsar"],
    "Buldhana" => ["Buldhana", "Chikhli", "Deulgaon Raja", "Jalgaon-Jamod", "Khamgaon", "Lonar", "Mehkar", "Malkapur", "Motala", "Nandura", "Shegaon"],
    "Chandrapur" => ["Brahmapuri", "Chandrapur", "Chimur", "Mul", "Nagbhid", "Pombhurna", "Rajura", "Sawali", "Sindewahi", "Warora"],
    "Dhule" => ["Dhule", "Sakri", "Shindkheda", "Shirpur"],
    "Gadchiroli" => ["Aheri", "Armori", "Bhamragad", "Chamorshi", "Dhanora", "Etapalli", "Gadchiroli", "Kurkheda", "Mulchera", "Sironcha"],
    "Gondia" => ["Amgaon", "Arjuni Morgaon", "Deori", "Gondia", "Goregaon", "Sadak Arjuni", "Tirora"],
    "Hingoli" => ["Aundha", "Basmath", "Hingoli", "Kalamnuri", "Sengaon"],
    "Jalgaon" => ["Amalner", "Bhadgaon", "Bhusawal", "Bodwad", "Chalisgaon", "Chopda", "Dharangaon", "Erandol", "Jalgaon", "Jamner", "Muktainagar", "Pachora", "Parola", "Raver", "Yawal"],
    "Jalna" => ["Ambad", "Badnapur", "Bhokardan", "Ghansawangi", "Jafferabad", "Jalna", "Mantha", "Partur"],
    "Kolhapur" => ["Ajara", "Bavda", "Bhudargad", "Chandgad", "Gaganbawda", "Hatkanangale", "Kagal", "Karveer", "Panhala", "Radhanagari", "Shahuwadi", "Shirol"],
    "Latur" => ["Ahmedpur", "Ausa", "Chakur", "Deoni", "Jalkot", "Latur", "Nilanga", "Renapur", "Shirur Anantpal", "Udgir"],
    "Mumbai" => ["Andheri", "Borivali", "Dadar", "Kurla", "Chembur", "Goregaon", "Malad", "Mulund", "Sion", "Vikhroli"],
    "Nagpur" => ["Hingna", "Kalmeshwar", "Kamptee", "Katol", "Kuhi", "Mauda", "Nagpur City", "Narkhed", "Parseoni", "Ramtek", "Savner", "Umred"],
    "Nanded" => ["Ardhapur", "Bhokar", "Biloli", "Deglur", "Hadgaon", "Himayatnagar", "Kandhar", "Kinwat", "Loha", "Mahur", "Mudkhed", "Mukhed", "Nanded"],
    "Nandurbar" => ["Akkalkuwa", "Akrani", "Nandurbar", "Navapur", "Shahada", "Taloda"],
    "Nashik" => ["Baglan", "Chandwad", "Deola", "Dindori", "Igatpuri", "Kalwan", "Malegaon", "Manmad", "Nandgaon", "Nashik City", "Niphad", "Peth", "Sinnar", "Trimbak", "Yeola"],
    "Osmanabad" => ["Bhum", "Kalamb", "Lohara", "Osmanabad", "Paranda", "Tuljapur", "Umarga", "Washi"],
    "Palghar" => ["Dahanu", "Jawhar", "Mokhada", "Palghar", "Talasari", "Vada", "Vasai", "Vikramgad"],
    "Parbhani" => ["Gangakhed", "Jintur", "Manwath", "Palam", "Parbhani", "Pathri", "Purna", "Sailu", "Sonpeth"],
    "Pune" => ["Baramati", "Bhor", "Daund", "Haveli", "Indapur", "Junnar", "Khed", "Maval", "Mulshi", "Pune City", "Shirur", "Velhe"],
    "Raigad" => ["Alibag", "Karjat", "Khalapur", "Mahad", "Mangaon", "Mhasla", "Murud", "Panvel", "Pen", "Poladpur", "Roha", "Shrivardhan", "Sudhagad", "Uran"],
    "Ratnagiri" => ["Chiplun", "Dapoli", "Guhagar", "Khed", "Lanja", "Mandangad", "Rajapur", "Ratnagiri", "Sangameshwar"],
    "Sangli" => ["Atpadi", "Jath", "Kadegaon", "Kavathe Mahankal", "Khanapur", "Miraj", "Palus", "Shirala", "Tasgaon", "Walwa"],
    "Satara" => ["Jaoli", "Karad", "Khandala", "Khatav", "Mahabaleshwar", "Man", "Patan", "Phaltan", "Satara", "Wai"],
    "Sindhudurg" => ["Devgad", "Dodamarg", "Kankavli", "Malvan", "Sawantwadi", "Vengurla"],
    "Solapur" => ["Akkalkot", "Barshi", "Karmala", "Madha", "Malshiras", "Mangalvedhe", "Mohol", "Pandharpur", "Sangola", "Solapur"],
    "Thane" => ["Ambarnath", "Bhiwandi", "Kalyan", "Murbad", "Shahapur", "Thane", "Ulhasnagar"],
    "Wardha" => ["Arvi", "Ashti", "Deoli", "Hinganghat", "Karanja", "Samudrapur", "Seloo", "Wardha"],
    "Washim" => ["Karanja", "Malegaon", "Mangrulpir", "Manora", "Risod", "Washim"],
    "Yavatmal" => ["Arni", "Babhulgaon", "Darwha", "Digras", "Ghatanji", "Kalamb", "Mahagaon", "Ner", "Pandharkawada", "Pusad", "Ralegaon", "Umarkhed", "Wani", "Yavatmal"]
];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
body { 
    display: block; 
    justify-content: center; 
    align-items: center; 
    background: #fdfce5; 
    min-height: 100vh; 
}

.split-form { 
    display: flex; 
    background: white; 
    border-radius: 20px; 
    overflow: hidden; 
    max-width: 1000px; 
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); 
    margin-left:300px
}

.image-side { 
    flex: 1; 
    background: #0f3859; 
    padding: 2rem; 
    display: flex; 
    flex-direction: column; 
    justify-content: center; 
    align-items: center; 
    color: white; 
    text-align: center; 
}

#lottie-animation { 
    width: 350px; 
    height: 350px; 
}

.form-side { 
    flex: 1; 
    padding: 3rem; 
    display: flex;
    flex-direction: column;
}

h1 { 
    text-align: center; 
    margin-bottom: 1rem; 
    color: #333; 
}

.input-group { 
    display: flex; 
    justify-content: space-between; 
    gap: 20px;
}

input, select { 
    width: 200px; 
    padding: 10px; 
    margin-bottom: 15px; 
    border: 2px solid #ddd; 
    border-radius: 5px; 
    outline: none; 
    transition: border-color 0.3s; 
}

input:focus, select:focus { 
    border-color: #0f3859; 
}

button { 
    width: 100%; 
    padding: 12px; 
    background: #0f3859; 
    color: white; 
    border: none; 
    border-radius: 25px; 
    cursor: pointer; 
    font-size: 16px; 
    font-weight: bold; 
    transition: transform 0.3s, background 0.3s; 
}

button:hover { 
    transform: translateY(-2px); 
    background: #092a42; 
}

.error-message { 
    text-align: center; 
    color: red; 
    font-weight: bold; 
    margin-bottom: 1rem; 
}

.link { 
    text-decoration: none; 
    color: #FF6B6B; 
    font-weight: bold; 
    display: block; 
    text-align: center; 
    margin-top: 1rem; 
}

.link:hover { 
    text-decoration: underline; 
}

  </style>
</head>
<body>
<?php include 'index_header.php' ?>

<h2>Update Profile</h2>

<!-- Split Form Layout -->
<!-- Split Form Layout -->
<div class="split-form">
    <!-- Left Side Image (can be Lottie or static image) -->
    <div class="image-side">
        <div id="lottie-animation"></div> <!-- Lottie Animation Placeholder -->
        <h1>Update Your Details</h1>
    </div>

    <!-- Right Side Form -->
    <div class="form-side">
        <form action="" method="post">
            <div class="input-group">
                <div>
                    <label>Name:</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br>

                    <label>Surname:</label>
                    <input type="text" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required><br>

                    <label>Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

                    <label>Password (Leave blank to keep old password):</label>
                    <input type="password" name="password"><br>
                </div>

                <div>
                    <label>Username:</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br>

                    <label>Address:</label>
                    <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>"><br>

                    <label>State:</label>
                    <input type="text" name="state" value="<?= htmlspecialchars($user['state']) ?>" required ><br>

                    <label>Country:</label>
                    <input type="text" name="country" value="<?= htmlspecialchars($user['country']) ?>" required><br>
                </div>
            </div>

            <div class="input-group">
                <div>
                    <label>District:</label>
                    <select name="district" id="district" onchange="updateTalukas()" required>
                        <option value="">Select District</option>
                        <?php foreach ($maharashtraData as $district => $talukas): ?>
                            <option value="<?= $district ?>" <?= $user['district'] == $district ? 'selected' : '' ?>><?= $district ?></option>
                        <?php endforeach; ?>
                    </select><br>
                </div>

                <div>
                    <label>Taluka:</label>
                    <select name="taluka" id="taluka" required>
                        <option value="<?= htmlspecialchars($user['taluka']) ?>" selected><?= htmlspecialchars($user['taluka']) ?></option>
                    </select><br>

                    <label>Pincode:</label>
                    <input type="text" name="pincode" value="<?= htmlspecialchars($user['pincode']) ?>"><br>
                </div>
            </div>

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</div>


<script>
    var maharashtraData = {
    "Ahmednagar": ["Akole", "Jamkhed", "Karjat", "Kopargaon", "Nevasa", "Parner", "Pathardi", "Rahata", "Rahuri", "Sangamner", "Shevgaon", "Shrigonda", "Shrirampur"],
    "Akola": ["Akola", "Akot", "Balapur", "Murtizapur", "Telhara"],
    "Amravati": ["Amravati", "Achalpur", "Anjangaon", "Bhatkuli", "Chandur", "Daryapur", "Dhamangaon", "Morshi", "Nandgaon-Khandeshwar", "Teosa", "Warud"],
    "Aurangabad": ["Aurangabad", "Kannad", "Khuldabad", "Paithan", "Phulambri", "Sillod", "Soyegaon", "Vaijapur"],
    "Beed": ["Ambejogai", "Ashti", "Beed", "Dharur", "Georai", "Kaij", "Majalgaon", "Parli", "Patoda", "Shirur", "Wadwani"],
    "Bhandara": ["Bhandara", "Lakhandur", "Lakhani", "Mohadi", "Pauni", "Sakoli", "Tumsar"],
    "Buldhana": ["Buldhana", "Chikhli", "Deulgaon Raja", "Jalgaon-Jamod", "Khamgaon", "Lonar", "Mehkar", "Malkapur", "Motala", "Nandura", "Shegaon"],
    "Chandrapur": ["Brahmapuri", "Chandrapur", "Chimur", "Mul", "Nagbhid", "Pombhurna", "Rajura", "Sawali", "Sindewahi", "Warora"],
    "Dhule": ["Dhule", "Sakri", "Shindkheda", "Shirpur"],
    "Gadchiroli": ["Aheri", "Armori", "Bhamragad", "Chamorshi", "Dhanora", "Etapalli", "Gadchiroli", "Kurkheda", "Mulchera", "Sironcha"],
    "Gondia": ["Amgaon", "Arjuni Morgaon", "Deori", "Gondia", "Goregaon", "Sadak Arjuni", "Tirora"],
    "Hingoli": ["Aundha", "Basmath", "Hingoli", "Kalamnuri", "Sengaon"],
    "Jalgaon": ["Amalner", "Bhadgaon", "Bhusawal", "Bodwad", "Chalisgaon", "Chopda", "Dharangaon", "Erandol", "Jalgaon", "Jamner", "Muktainagar", "Pachora", "Parola", "Raver", "Yawal"],
    "Jalna": ["Ambad", "Badnapur", "Bhokardan", "Ghansawangi", "Jafferabad", "Jalna", "Mantha", "Partur"],
    "Kolhapur": ["Ajara", "Bavda", "Bhudargad", "Chandgad", "Gaganbawda", "Hatkanangale", "Kagal", "Karveer", "Panhala", "Radhanagari", "Shahuwadi", "Shirol"],
    "Latur": ["Ahmedpur", "Ausa", "Chakur", "Deoni", "Jalkot", "Latur", "Nilanga", "Renapur", "Shirur Anantpal", "Udgir"],
    "Mumbai": ["Andheri", "Borivali", "Dadar", "Kurla", "Chembur", "Goregaon", "Malad", "Mulund", "Sion", "Vikhroli"],
    "Nagpur": ["Hingna", "Kalmeshwar", "Kamptee", "Katol", "Kuhi", "Mauda", "Nagpur City", "Narkhed", "Parseoni", "Ramtek", "Savner", "Umred"],
    "Nanded": ["Ardhapur", "Bhokar", "Biloli", "Deglur", "Hadgaon", "Himayatnagar", "Kandhar", "Kinwat", "Loha", "Mahur", "Mudkhed", "Mukhed", "Nanded"],
    "Nandurbar": ["Akkalkuwa", "Akrani", "Nandurbar", "Navapur", "Shahada", "Taloda"],
    "Nashik": ["Baglan", "Chandwad", "Deola", "Dindori", "Igatpuri", "Kalwan", "Malegaon", "Manmad", "Nandgaon", "Nashik City", "Niphad", "Peth", "Sinnar", "Trimbak", "Yeola"],
    "Osmanabad": ["Bhum", "Kalamb", "Lohara", "Osmanabad", "Paranda", "Tuljapur", "Umarga", "Washi"],
    "Palghar": ["Dahanu", "Jawhar", "Mokhada", "Palghar", "Talasari", "Vada", "Vasai", "Vikramgad"],
    "Parbhani": ["Gangakhed", "Jintur", "Manwath", "Palam", "Parbhani", "Pathri", "Purna", "Sailu", "Sonpeth"],
    "Pune": ["Baramati", "Bhor", "Daund", "Haveli", "Indapur", "Junnar", "Khed", "Maval", "Mulshi", "Pune City", "Shirur", "Velhe"],
    "Raigad": ["Alibag", "Karjat", "Khalapur", "Mahad", "Mangaon", "Mhasla", "Murud", "Panvel", "Pen", "Poladpur", "Roha", "Shrivardhan", "Sudhagad", "Uran"],
    "Ratnagiri": ["Chiplun", "Dapoli", "Guhagar", "Khed", "Lanja", "Mandangad", "Rajapur", "Ratnagiri", "Sangameshwar"],
    "Sangli": ["Atpadi", "Jath", "Kadegaon", "Kavathe Mahankal", "Khanapur", "Miraj", "Palus", "Shirala", "Tasgaon", "Walwa"],
    "Satara": ["Jaoli", "Karad", "Khandala", "Khatav", "Mahabaleshwar", "Man", "Patan", "Phaltan", "Satara", "Wai"],
    "Sindhudurg": ["Devgad", "Dodamarg", "Kankavli", "Malvan", "Sawantwadi", "Vengurla"],
    "Solapur": ["Akkalkot", "Barshi", "Karmala", "Madha", "Malshiras", "Mangalvedhe", "Mohol", "Pandharpur", "Sangola", "Solapur"],
    "Thane": ["Ambarnath", "Bhiwandi", "Kalyan", "Murbad", "Shahapur", "Thane", "Ulhasnagar"],
    "Wardha": ["Arvi", "Ashti", "Deoli", "Hinganghat", "Karanja", "Samudrapur", "Seloo", "Wardha"],
    "Washim": ["Karanja", "Malegaon", "Mangrulpir", "Manora", "Risod", "Washim"],
    "Yavatmal": ["Arni", "Babhulgaon", "Darwha", "Digras", "Ghatanji", "Kalamb", "Mahagaon", "Ner", "Pandharkawada", "Pusad", "Ralegaon", "Umarkhed", "Wani", "Yavatmal"]
};


    function updateTalukas() {
        var district = document.getElementById("district").value;
        var talukaDropdown = document.getElementById("taluka");

        talukaDropdown.innerHTML = "<option value=''>Select Taluka</option>";
        
        if (district in maharashtraData) {
            maharashtraData[district].forEach(function(taluka) {
                var option = document.createElement("option");
                option.value = taluka;
                option.text = taluka;
                talukaDropdown.appendChild(option);
            });
        }
    }
</script>

<script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'images/Animation - 1741021320383.json'
        });
    </script>

</body>
</html>
