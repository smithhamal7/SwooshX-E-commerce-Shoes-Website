<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['pidx']) && isset($_GET['purchase_order_id'])) {
    $pidx = $_GET['pidx']; // Khalti Payment ID
    $purchase_order_id = $_GET['purchase_order_id']; // The purchase_order_id passed from Khalti

    // Step 1: Update purchase_order_id in the database
    $stmt = $conn->prepare("UPDATE orders SET purchase_order_id = ? WHERE payment_status = 'Pending' LIMIT 1");
    $stmt->bind_param("s", $purchase_order_id);
    $stmt->execute();
    $stmt->close();

    // Step 2: Verify payment with Khalti
    $khalti_secret_key = "c54d590299d843a788b6bd49ff6da91d"; // Replace with your Khalti secret key
    $data = ["pidx" => $pidx];
    $headers = [
        "Authorization: Key $khalti_secret_key",
        "Content-Type: application/json"
    ];

    $ch = curl_init("https://a.khalti.com/api/v2/epayment/lookup/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $decoded_response = json_decode($response, true);

    if (isset($decoded_response['status']) && $decoded_response['status'] == 'Completed') {
        $transaction_id = $decoded_response['transaction_id'];
        $amount = $decoded_response['total_amount'] / 100; // Convert from paisa to NPR

        // Step 3: Update payment status in the database
        $stmt = $conn->prepare("UPDATE orders SET payment_status = 'Paid', transaction_id = ? WHERE purchase_order_id = ?");
        $stmt->bind_param("ss", $transaction_id, $purchase_order_id);
        if ($stmt->execute()) {
            header("Location: success.php?purchase_order_id=" . urlencode($purchase_order_id));
exit();
        } else {
            echo "Error updating database: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Payment Verification Failed!";
    }
} else {
    echo "Invalid Request! Make sure parameters are passed correctly.";
}
?>
