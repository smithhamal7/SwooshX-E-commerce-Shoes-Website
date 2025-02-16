<?php
session_start();

// Assuming you have stored the OTP in a session after sending it
if (!isset($_SESSION['otp'])) {
    die('OTP session expired. Please try again.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userOtp = $_POST['otp'];
    $storedOtp = $_SESSION['otp'];

    // Verify OTP
    if ($userOtp === $storedOtp) {
        // OTP is correct, proceed to password reset
        header("Location: reset_password.php");
        exit();
    } else {
        // OTP is incorrect
        $error = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwooshX - OTP Verification</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">SwooshX</div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.html" class="cart-btn">Cart</a></li>
                <li><a href="login.html" class="login-btn">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="otp-section">
        <h1>Enter the OTP Sent to Your Email</h1>

        <?php
        // Display error message if OTP is incorrect
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <form action="otp_verification.php" method="POST" class="otp-form">
            <div class="form-group">
                <label for="otp">OTP</label>
                <input type="text" id="otp" name="otp" placeholder="Enter OTP" required maxlength="6">
            </div>
            <button type="submit" class="submit-btn">Verify OTP</button>
        </form>

        <p><a href="forgot_password.html">Resend OTP</a></p>
        <p><a href="login.html">Back to Login</a></p>
    </section>
</body>
</html>
