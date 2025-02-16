<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Get product price
    $sql = "SELECT price FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();

    $price = $product['price'];
    $total_price = $price * $quantity;

    // Add to cart logic can be saved in the session or database

    echo "Product added to cart!";
} else {
    echo "You must be logged in to add products to your cart!";
}
?>
