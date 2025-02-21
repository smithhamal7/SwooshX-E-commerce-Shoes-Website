<?php
session_start();
include('db_connect.php'); // Ensure this connects to your database using MySQLi

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch total orders
$totalOrdersQuery = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
$totalOrders = $totalOrdersQuery->fetch_assoc()['total_orders'];

// Fetch total sales (ensuring that only "Paid" orders are considered)
$totalSalesQuery = $conn->query("SELECT SUM(total_amount) AS total_sales FROM orders WHERE payment_status = 'Paid'");
$totalSales = $totalSalesQuery->fetch_assoc()['total_sales'] ?? 0.00;

// Fetch new users count (users created in the last 30 days)
$newUsersQuery = $conn->query("SELECT COUNT(*) AS new_users FROM users WHERE created_at >= NOW() - INTERVAL 30 DAY");
$newUsers = $newUsersQuery->fetch_assoc()['new_users'];

// Fetch recent contact messages
$messagesQuery = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC LIMIT 10");
$messages = $messagesQuery->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body style="background: #fafafa; color: #333; font-family: Arial, sans-serif; margin: 0; padding: 0;">
<header style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background-color: #222; color: #fff;">
    <div class="logo" style="font-size: 28px; font-weight: bold; letter-spacing: 1px;">Admin Panel</div>
    <nav>
        <ul style="list-style: none; display: flex;">
            <li style="margin: 0 15px;"><a href="admin_dashboard.php" style="text-decoration: none; color: #fff; font-size: 16px;">Dashboard</a></li>
            <li style="margin: 0 15px;"><a href="manage_product.php" style="text-decoration: none; color: #fff; font-size: 16px;">Manage Products</a></li>
            <li style="margin: 0 15px;"><a href="order.php" style="text-decoration: none; color: #fff; font-size: 16px;">Orders</a></li>
            <li style="margin: 0 15px;"><a href="payment_history.php" style="text-decoration: none; color: #fff; font-size: 16px;">Payment History</a></li>
            <li style="margin: 0 15px;"><a href="logout.php" style="text-decoration: none; color: #fff; font-size: 16px;">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="dashboard-container" style="max-width: 1200px; margin: 40px auto; padding: 20px; background: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;">
    <h1 style="text-align: center; margin-bottom: 20px; font-size: 28px; color: #222;">Admin Dashboard</h1>
    
    <div class="stats" style="display: flex; justify-content: space-around; margin-bottom: 30px;">
        <div style="padding: 20px; background: #ff6600; color: #fff; font-size: 20px; font-weight: bold; border-radius: 8px; text-align: center; width: 200px;">Total Orders: <?php echo $totalOrders; ?></div>
        <div style="padding: 20px; background: #ff6600; color: #fff; font-size: 20px; font-weight: bold; border-radius: 8px; text-align: center; width: 200px;">Total Sales: Rs. <?php echo number_format($totalSales, 2); ?></div>
        <div style="padding: 20px; background: #ff6600; color: #fff; font-size: 20px; font-weight: bold; border-radius: 8px; text-align: center; width: 200px;">New Users: <?php echo $newUsers; ?></div>
    </div>

    <div class="messages-container" style="margin-top: 30px; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; font-size: 24px; color: #222;">Recent Contact Messages</h2>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background: #ff6600; color: #fff;">
                    <th style="padding: 10px; text-align: left;">Name</th>
                    <th style="padding: 10px; text-align: left;">Email</th>
                    <th style="padding: 10px; text-align: left;">Message</th>
                    <th style="padding: 10px; text-align: left;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;"> <?php echo htmlspecialchars($message['name']); ?> </td>
                    <td style="padding: 10px;"> <?php echo htmlspecialchars($message['email']); ?> </td>
                    <td style="padding: 10px;"> <?php echo htmlspecialchars($message['message']); ?> </td>
                    <td style="padding: 10px;"> <?php echo htmlspecialchars($message['created_at']); ?> </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
