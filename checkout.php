<?php 
session_start();
include 'db_connect.php';

$isLoggedIn = isset($_SESSION['user_id']);
if (!$isLoggedIn) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.id, cart.quantity, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$totalPrice = 0;
$items = [];
while ($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    $totalPrice += $subtotal;
    $items[] = $row;
}
$stmt->close();

// Create order in the database
$order_id = uniqid("order_"); // Unique Order ID
$purchase_order_id = ""; // This will be filled after Khalti processes payment
$status = 'Pending'; // Initial status before payment

$stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, payment_status, purchase_order_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $user_id, $totalPrice, $status, $purchase_order_id);
$stmt->execute();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">SwooshX</div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>

    <section class="checkout">
        <h1>Checkout</h1>
        <p>Total Amount: <strong><?php echo number_format($totalPrice, 2); ?></strong></p>
        
        <!-- Form for Khalti payment -->
        <form action="initKhalti.php" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"> <!-- The order_id to link it to the database later -->
            <input type="hidden" name="amount" value="<?php echo $totalPrice * 100; ?>"> <!-- Convert amount to paisa -->
            <button type="submit">Pay with Khalti</button>
        </form>
    </section>
</body>
</html>
