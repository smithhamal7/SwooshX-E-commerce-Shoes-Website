<?php
include('db_connect.php');  // Include the MySQLi connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // SQL query to insert form data into the contact_messages table
    $sql = "INSERT INTO contact_messages (name, email, message, phone, address) VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the statement
        $stmt->bind_param("sssss", $name, $email, $message, $phone, $address);

        // Execute the statement
        if ($stmt->execute()) {
            // If insertion is successful, show success message and redirect
            echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
        } else {
            // If there is an error during insertion, show error message
            echo "<script>alert('Error sending message. Please try again.'); window.location.href='contact.html';</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // If the statement couldn't be prepared, show an error
        echo "<script>alert('Error preparing statement.'); window.location.href='contact.html';</script>";
    }
}

// Close the connection
$conn->close();
?>
