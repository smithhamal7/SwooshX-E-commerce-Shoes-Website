<?php 
session_start();
include 'db_connect.php';
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwooshX - Cart</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <li><a href="logout.php" class="logout-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.html" class="login-btn">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <section class="cart">
        <h1>Your Cart</h1>

        <?php if ($isLoggedIn): ?>
            <div class="cart-items">
                <?php
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT cart.id, cart.quantity, products.name, products.price, products.image_url FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                $totalPrice = 0;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $subtotal = $row['price'] * $row['quantity'];
                        $totalPrice += $subtotal;
                        ?>
                        <div class="cart-item" data-cart-id="<?php echo $row['id']; ?>">
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                            <div class="item-details">
                                <h3><?php echo $row['name']; ?></h3>
                                <p>Price: <?php echo number_format($row['price'], 2); ?></p>
                                <p>Quantity: <span class="quantity"><?php echo $row['quantity']; ?></span></p>
                                <p>Subtotal: <span class="subtotal"><?php echo number_format($subtotal, 2); ?></span></p>
                            </div>
                            <button class="remove-item">Remove</button>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>Your cart is empty.</p>';
                }
                ?>
            </div>

            <div class="cart-summary">
                <p>Total: <span id="total-price"><?php echo number_format($totalPrice, 2); ?></span></p>
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <div class="login-message">
                <p>Please <a href="login.html">log in</a> to view your cart.</p>
            </div>
        <?php endif; ?>
    </section>

    <script>
        $(document).ready(function() {
            $(".remove-item").click(function() {
                var cartItem = $(this).closest('.cart-item');
                var cartId = cartItem.data("cart-id");

                $.ajax({
                    url: "remove.php",
                    method: "POST",
                    data: { cart_id: cartId },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            cartItem.remove();
                            $("#total-price").text(response.new_total);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert("Error removing item.");
                    }
                });
            });
        });
    </script>
</body>
</html>