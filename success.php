<?php
session_start();
include 'db_connect.php';

// Check if purchase_order_id is passed
if (!isset($_GET['purchase_order_id'])) {
    echo "Invalid request!";
    exit();
}

$purchase_order_id = $_GET['purchase_order_id'];

// Fetch order details from the database
$stmt = $conn->prepare("SELECT * FROM orders WHERE purchase_order_id = ?");
$stmt->bind_param("s", $purchase_order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
$stmt->close();

if (!$order) {
    echo "No order found!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
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
                <li><a href="cart.php">Cart</a></li>

            </ul>
        </nav>
    </header>

    <section class="payment-success">
        <h1>Payment Successful!</h1>
        <p><strong>Order ID:</strong> <?php echo $order['purchase_order_id']; ?></p>
        <p><strong>Transaction ID:</strong> <?php echo $order['transaction_id']; ?></p>
        <p><strong>Total Amount:</strong> NPR <?php echo number_format($order['total_amount'], 2); ?></p>
        <p><strong>Payment Status:</strong> <?php echo $order['payment_status']; ?></p>
        <h3>PLEASE CONTACT US WITH YOUR ORDER DETAILS AND TRANSACTION ID </h3>
        <br>
        <a href="home.php" class="btn">Return to Home</a>
    </section>
</body>
</html>
