<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$error_message = "";
$khalti_public_key = "c54d590299d843a788b6bd49ff6da91d";

if (!isset($_GET['amount'])) {
    die("Invalid amount.");
}

$amount = (float)$_GET['amount'];
$uniqueProductId = "order-" . $_SESSION['user_id'];
$uniqueUrl = "http://localhost/cart.php";
$uniqueProductName = "SwooshX Purchase";
$successRedirect = "order_success.php";

function checkValid($data)
{
    global $amount;
    return ((float) $data["amount"] == $amount * 100) ? 1 : 0;
}

$token = "";
$price = $amount;
$mpin = "";

if (isset($_POST["mobile"]) && isset($_POST["mpin"])) {
    try {
        $mobile = $_POST["mobile"];
        $mpin = $_POST["mpin"];
        $amount *= 100;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://khalti.com/api/v2/payment/initiate/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                "public_key" => $khalti_public_key,
                "mobile" => $mobile,
                "transaction_pin" => $mpin,
                "amount" => $amount,
                "product_identity" => $uniqueProductId,
                "product_name" => $uniqueProductName,
                "product_url" => $uniqueUrl
            ]),
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $parsed = json_decode($response, true);

        if (isset($parsed["token"])) {
            $token = $parsed["token"];
        } else {
            $error_message = "Incorrect mobile or MPIN.";
        }
    } catch (Exception $e) {
        $error_message = "Payment initiation failed.";
    }
}

if (isset($_POST["otp"]) && isset($_POST["token"]) && isset($_POST["mpin"])) {
    try {
        $otp = $_POST["otp"];
        $token = $_POST["token"];
        $mpin = $_POST["mpin"];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://khalti.com/api/v2/payment/confirm/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                "public_key" => $khalti_public_key,
                "transaction_pin" => $mpin,
                "confirmation_code" => $otp,
                "token" => $token
            ]),
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $parsed = json_decode($response, true);

        if (isset($parsed["token"]) && checkValid($parsed)) {
            $user_id = $_SESSION['user_id'];
            $insert_order = "INSERT INTO orders (user_id, amount, status, payment_method) VALUES (?, ?, 'Paid', 'Khalti')";
            $stmt = $conn->prepare($insert_order);
            $stmt->bind_param("id", $user_id, $amount);
            $stmt->execute();

            $clear_cart = "DELETE FROM cart WHERE user_id = ?";
            $stmt = $conn->prepare($clear_cart);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            echo "<script>window.location.href='$successRedirect';</script>";
            exit();
        } else {
            $error_message = "Transaction failed.";
        }
    } catch (Exception $e) {
        $error_message = "Could not process the transaction.";
    }
}
?>

<div class="khalticontainer">
    <center><img src="khalti.png" alt="khalti" width="200"></center>
    <?php if ($token == "") { ?>
    <form action="pay.php?amount=<?php echo $price; ?>" method="post">
        <small>Mobile Number:</small>
        <input type="number" name="mobile" placeholder="98xxxxxxxx" required>
        <small>Khalti Mpin:</small>
        <input type="password" name="mpin" placeholder="xxxx" required>
        <small>Price:</small>
        <input type="text" value="Rs. <?php echo $price; ?>" disabled>
        <br><span style="color:red;"><?php echo $error_message; ?></span>
        <button>Pay Rs. <?php echo $price; ?></button>
    </form>
    <?php } else { ?>
    <form action="pay.php?amount=<?php echo $price; ?>" method="post">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="hidden" name="mpin" value="<?php echo $mpin; ?>">
        <small>OTP:</small>
        <input type="number" name="otp" placeholder="xxxx" required>
        <br><span style="color:red;"><?php echo $error_message; ?></span>
        <button>Confirm Payment</button>
    </form>
    <?php } ?>
</div>
