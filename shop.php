<?php
session_start();
include 'db_connect.php';

$isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwooshX - Shop</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
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
                <?php if ($isLoggedIn): ?>
                    <li><a href="logout.php" class="login-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.html" class="login-btn">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <section class="shop">
        <h1>Our Collection</h1>
        <div class="product-gallery">
            <?php
            // Fetch products from the database
            $sql = "SELECT * FROM products ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="product-item">
                        <img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">
                        <h3>' . $row['name'] . '</h3>
                        <p>' . $row['price'] . '</p>
                        ';
                    if ($isLoggedIn) {
                        echo '<button class="add-to-cart" data-product-id="' . $row['id'] . '" data-product-name="' . $row['name'] . '" data-product-price="' . $row['price'] . '">Add to Cart</button>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function() {
                var productId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                var productPrice = $(this).data('product-price');

                $.ajax({
                    url: "add_to_cart.php",
                    method: "POST",
                    data: {
                        product_id: productId,
                        product_name: productName,
                        product_price: productPrice,
                        quantity: 1
                    },
                    success: function(response) {
                        alert(response);
                    }
                });
            });
        });
    </script>

    <script src="script.js"></script>
</body>
</html>
