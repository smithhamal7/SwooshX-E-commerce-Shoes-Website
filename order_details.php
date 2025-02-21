<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect to login if not logged in or not an admin
    exit();
}

// Get the order ID from the URL
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

// Fetch the order details
$sql = "SELECT o.id AS order_id, o.user_id, o.total_price, o.payment_method, o.status, o.created_at, u.username
        FROM orders o
        JOIN users u ON o.user_id = u.id
        WHERE o.id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}
$stmt->bind_param('i', $order_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the order exists
if ($result->num_rows == 0) {
    echo "Order not found!";
    exit();
}

$order = $result->fetch_assoc();

// Fetch the products in the order
$sql_products = "SELECT op.product_id, p.name, op.quantity, op.price
                 FROM order_products op
                 JOIN products p ON op.product_id = p.id
                 WHERE op.order_id = ?";
$stmt_products = $conn->prepare($sql_products);
if (!$stmt_products) {
    die("SQL Error: " . $conn->error); // Show error if SQL fails to prepare
}
$stmt_products->bind_param('i', $order_id);
$stmt_products->execute();
$result_products = $stmt_products->get_result();
if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_assoc()) {
        $total = $row['quantity'] * $row['price'];
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['quantity']}</td>
                <td>\${$row['price']}</td>
                <td>\${$total}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No products found for this order.</td></tr>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Admin Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
</head>
<body>
    <div class="container">
        <h1>Order Details - Order #<?php echo $order['order_id']; ?></h1>
        <h2>User: <?php echo $order['username']; ?></h2>
        <p><strong>Total Price:</strong> $<?php echo $order['total_price']; ?></p>
        <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
        <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
        <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>

        <h3>Products in this Order</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_products->num_rows > 0) {
                    while ($row = $result_products->fetch_assoc()) {
                        $total = $row['quantity'] * $row['price'];
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>\${$row['price']}</td>
                                <td>\${$total}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found for this order.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
