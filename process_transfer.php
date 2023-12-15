<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$senderId = $_POST["sender_id"];
$receiverId = $_POST["receiver_id"];
$amount = $_POST["amount"];

// Check if the sender has sufficient balance
$checkBalanceQuery = "SELECT balance FROM customers WHERE id = $senderId";
$balanceResult = $conn->query($checkBalanceQuery);
$senderBalance = $balanceResult->fetch_assoc()['balance'];

if ($senderBalance >= $amount) {
    // Perform the transfer
    $updateSenderQuery = "UPDATE customers SET balance = balance - $amount WHERE id = $senderId";
    $updateReceiverQuery = "UPDATE customers SET balance = balance + $amount WHERE id = $receiverId";
    $insertTransferQuery = "INSERT INTO transfers (sender_id, receiver_id, amount) VALUES ($senderId, $receiverId, $amount)";


    $conn->query($updateSenderQuery);
    $conn->query($updateReceiverQuery);
    $conn->query($insertTransferQuery);


    // Show success message using JavaScript
    echo '<script>';
    echo 'alert("Transaction Successful!");';
    echo 'window.location.href = "transfer_money.php?sender=' . $senderId . '";'; // Redirect back to transfer_money.php
    echo '</script>';
} else {
    // Handle insufficient balance
    echo '<script>';
    echo 'alert("Insufficient balance for the transfer.");';
    echo 'window.location.href = "transfer_money.php?sender=' . $senderId . '";'; // Redirect back to transfer_money.php
    echo '</script>';
}

$conn->close();
?>

