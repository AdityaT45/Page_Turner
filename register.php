<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Page Turner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { min-height: 100vh; display: flex; justify-content: center; align-items: center; background: #fdfce5; }
        .split-form { display: flex; background: white; border-radius: 20px; overflow: hidden; max-width: 800px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .image-side { flex: 1; background: #0f3859; padding: 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center; }
        #lottie-animation { width: 350px; height: 350px; }
        .form-side { flex: 1; padding: 3rem; }
        h1 { text-align: center; margin-bottom: 1rem; color: #333; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 2px solid #ddd; border-radius: 5px; outline: none; transition: border-color 0.3s; }
        input:focus { border-color: #0f3859; }
        button { width: 100%; padding: 12px; background: #0f3859; color: white; border: none; border-radius: 25px; cursor: pointer; font-size: 16px; font-weight: bold; transition: transform 0.3s, background 0.3s; }
        button:hover { transform: translateY(-2px); background: #092a42; }
        .error-message { text-align: center; color: red; font-weight: bold; margin-bottom: 1rem; }
        .link { text-decoration: none; color: #FF6B6B; font-weight: bold; display: block; text-align: center; margin-top: 1rem; }
        .link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="split-form">
        <div class="image-side">
            <div id="lottie-animation"></div>
            <h1><span class="text-warning">PAGE</span><span>TURNER</span></h1>
        </div>
        <div class="form-side">
            <h1>Sign Up</h1>
            
            <!-- Show error message if any -->
            <?php if (isset($_SESSION['message'])) { echo "<p class='error-message'>{$_SESSION['message']}</p>"; unset($_SESSION['message']); } ?>

            <!-- Send OTP Form -->
            <form action="send_otp.php" method="post">
                <input type="text" name="Name" placeholder="First Name" required value="<?php echo isset($_SESSION['form_data']['Name']) ? $_SESSION['form_data']['Name'] : ''; ?>">
                <input type="text" name="Sname" placeholder="Surname" required value="<?php echo isset($_SESSION['form_data']['Sname']) ? $_SESSION['form_data']['Sname'] : ''; ?>">
                <input type="text" name="username" placeholder="Username" required value="<?php echo isset($_SESSION['form_data']['username']) ? $_SESSION['form_data']['username'] : ''; ?>">
                
                <input type="email" id="email-input" name="email" placeholder="Email" required value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>">

                <input type="password" name="password" placeholder="Password" required minlength="6" maxlength="8">
                <input type="password" name="cpassword" placeholder="Confirm Password" required minlength="6" maxlength="8">
                <button type="submit" name="send_otp">Send OTP</button>
            </form>

            <!-- OTP Verification Form -->
            <form action="verify_otp.php" method="post">
                <!-- Use session email value to auto-fill the hidden field -->
                <input type="hidden" name="email" value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>"> 
                <input type="text" name="otp" placeholder="Enter OTP" required>
                <button type="submit" name="verify_otp">Verify OTP</button>
            </form>

            <a class="link" href="login.php">Already have an account? Login</a>
        </div>
    </div>

    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'images/Animation - 1741021320383.json'
        });

        // Auto-fill email for OTP verification
        document.addEventListener("DOMContentLoaded", function() {
    const emailInput = document.getElementById("email-input");
    const otpEmailInput = document.getElementById("otp-email");

    // Ensure the otp-email input exists before setting the value
    if (otpEmailInput && emailInput) {
        emailInput.addEventListener("input", function() {
            otpEmailInput.value = emailInput.value;
        });

        otpEmailInput.value = emailInput.value; // Auto-fill on page load
    }
});

    </script>
</body>
</html>
