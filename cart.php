<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwooshX - Cart</title>
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

                <!-- If the user is logged in, show Logout -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php" class="logout-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.html" class="login-btn">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <section class="cart">
        <h1>Your Shopping Cart</h1>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <p class="login-message">You must <a href="login.html">login</a> to add items to the cart.</p>
        <?php else: ?>
            <div class="cart-items">
                <div class="cart-item">
                    <img src="https://via.placeholder.com/100x100?text=Product+1" alt="Product 1">
                    <div class="item-details">
                        <h3>Product Name 1</h3>
                        <p>$120.00</p>
                        <input type="number" value="1" min="1" class="item-quantity">
                    </div>
                    <button class="remove-item">Remove</button>
                </div>
                <div class="cart-item">
                    <img src="https://via.placeholder.com/100x100?text=Product+2" alt="Product 2">
                    <div class="item-details">
                        <h3>Product Name 2</h3>
                        <p>$140.00</p>
                        <input type="number" value="1" min="1" class="item-quantity">
                    </div>
                    <button class="remove-item">Remove</button>
                </div>
            </div>
            <div class="cart-summary">
                <p>Total: $260.00</p>
                <a href="checkout.html" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </section>

    <script src="script.js"></script>
</body>
</html>
