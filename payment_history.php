<?php 
session_start();
include 'db_connect.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect to login if not logged in or not an admin
    exit();
}

// Fetch all successful payments
$sql = "SELECT o.id AS order_id, o.user_id, o.total_amount, o.transaction_id, o.purchase_order_id, o.created_at, u.name AS username
        FROM orders o
        JOIN users u ON o.user_id = u.id
        WHERE o.payment_status = 'Paid'
        ORDER BY o.created_at DESC";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History - Admin Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
</head>
<body>
    <div class="container">
        <h1>Payment History</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total Amount</th>
                    <th>Transaction ID</th>
                    <th>Purchase Order ID</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['order_id']}</td>
                                <td>{$row['username']}</td>
                                <td>Rs. {$row['total_amount']}</td>
                                <td>{$row['transaction_id']}</td>
                                <td>{$row['purchase_order_id']}</td>
                                <td>{$row['created_at']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No payments found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
