<?php
session_start();
include('db.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO payments (user_id, amount, created_at) VALUES (?, ?, NOW())";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$user_id, $amount])) {
        $_SESSION['success'] = "Payment added successfully.";
    } else {
        $_SESSION['error'] = "Failed to add payment.";
    }

    header("Location: admin_dashboard.php");
    exit();
}
?>
