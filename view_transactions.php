<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$transactionsSql = "SELECT * FROM transfers";
$transactionsResult = $conn->query($transactionsSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View Transactions</title>
</head>
<body>
    <div class="container">
        <h2>Transaction History</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Sender ID</th>
                <th>Receiver ID</th>
                <th>Amount</th>
                <th>Timestamp</th>
            </tr>
            <?php
                if ($transactionsResult->num_rows > 0) {
                    while($row = $transactionsResult->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row["id"]."</td>
                                <td>".$row["sender_id"]."</td>
                                <td>".$row["receiver_id"]."</td>
                                <td>".$row["amount"]."</td>
                                <td>".$row["timestamp"]."</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No transactions found</td></tr>";
                }
            ?>
        </table>
        </form>
        <a href="view_customers.php">Back to Customers</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
