<?php
session_start();
include 'db_connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $user_id = $_SESSION['user_id'];

    // Delete item only if it belongs to the logged-in user
    $sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cart_id, $user_id);

    if ($stmt->execute()) {
        // Recalculate total price after deletion
        $sql_total = "SELECT SUM(products.price * cart.quantity) AS total FROM cart 
                      JOIN products ON cart.product_id = products.id 
                      WHERE cart.user_id = ?";
        $stmt_total = $conn->prepare($sql_total);
        $stmt_total->bind_param("i", $user_id);
        $stmt_total->execute();
        $result_total = $stmt_total->get_result();
        $row_total = $result_total->fetch_assoc();
        $new_total = number_format($row_total['total'] ?? 0, 2);

        echo json_encode(["success" => true, "new_total" => $new_total]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to remove item."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
