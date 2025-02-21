<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to add items to the cart.']);
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = 1; // Default quantity

// Check if the product is already in the cart
$check_cart = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($check_cart);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update quantity if the product already exists
    $update_cart = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($update_cart);
    $stmt->bind_param("iii", $quantity, $user_id, $product_id);
} else {
    // Insert new item into the cart
    $insert_cart = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_cart);
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
}

if ($stmt->execute()) {
    // Recalculate total
    $total_sql = "SELECT SUM(products.price * cart.quantity) AS total 
                  FROM cart 
                  JOIN products ON cart.product_id = products.id 
                  WHERE cart.user_id = ?";
    $stmt = $conn->prepare($total_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $new_total = isset($row['total']) ? number_format($row['total'], 2) : "0.00";

    echo json_encode(['success' => true, 'new_total' => $new_total]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error adding product to cart.']);
}

$stmt->close();
$conn->close();
?>
