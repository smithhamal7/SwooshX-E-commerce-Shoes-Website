<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwooshX - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">SwooshX</div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.php" class="cart-btn">Cart</a></li>

                <!-- Display Login/Logout buttons based on session -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php" class="logout-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.html" class="login-btn">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <section class="hero">
        <h1>Step Into Style with SwooshX</h1>
        <p>Find the best shoes for every occasion.</p>
        <a href="shop.html" class="cta-button">Shop Now</a>
    </section>

    <script src="script.js"></script>
</body>
</html>
