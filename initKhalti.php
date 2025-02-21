<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['amount']) || !isset($_POST['order_id'])) {
        die("Error: Amount or Order ID is missing.");
    }

    $amount = (int) $_POST['amount'] * 100; // Convert NPR to paisa safely
    $order_id = uniqid('order_'); // Order ID

    $khalti_secret_key = "c54d590299d843a788b6bd49ff6da91d"; // Use a valid key
    $return_url = "http://localhost/Final/verifyKhalti.php"; // Redirect URL after payment

    $data = [
        "return_url" => $return_url,
        "website_url" => "http://localhost/",
        "amount" => $amount,
        "purchase_order_id" => $order_id,
        "purchase_order_name" => "Shopping Cart Order"
    ];

    $headers = [
        "Authorization: Key $khalti_secret_key",
        "Content-Type: application/json; charset=UTF-8"
    ];

    $ch = curl_init("https://a.khalti.com/api/v2/epayment/initiate/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    
    if ($response === false) {
        echo "cURL Error: " . curl_error($ch);
    }
    
    curl_close($ch);

    $decoded_response = json_decode($response, true);
    if (isset($decoded_response['payment_url'])) {
        header("Location: " . $decoded_response['payment_url']);
        exit();
    } else {
        echo "<pre>";
        print_r($decoded_response); // Show actual error
        echo "</pre>";
    }
}
?>
