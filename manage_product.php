<?php
session_start();
include('db_connect.php'); // Ensure this connects to your database

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Handle product addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageUrl = $_POST['image_url']; // Get the image URL from the form

    if (!empty($name) && !empty($price) && !empty($description) && !empty($imageUrl)) {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image_url, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $price, $description, $imageUrl]);
        $message = "Product added successfully!";
    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        /* Styles */
        body {
            background: #fafafa;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #222;
            color: #fff;
        }
        header .logo {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        nav ul {
            list-style: none;
            display: flex;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            color: #222;
        }
        .form-container {
            margin-bottom: 30px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: 0 auto;
        }
        .form-container label {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .form-container input, .form-container textarea {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        .form-container button {
            padding: 10px;
            background-color: #ff6600;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">Admin Panel</div>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_product.php">Manage Products</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><a href="payment_history.php">Payment History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="dashboard-container">
    <h1>Manage Products</h1>
    
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    
    <div class="form-container">
        <form method="POST" action="">
            <label>Product Name:</label>
            <input type="text" name="name" required>
            <label>Price:</label>
            <input type="number" step="0.01" name="price" required>
            <label>Description:</label>
            <textarea name="description" required></textarea>
            <label>Product Image URL:</label>
            <input type="text" name="image_url" placeholder="Enter image URL" required>
            <button type="submit">Add Product</button>
        </form>
    </div>
</div>
</body>
</html>
