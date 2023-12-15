<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bank_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $senderId = $_GET["sender"];

    $customersSql = "SELECT * FROM customers";
    $customersResult = $conn->query($customersSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Transfer Money</title>
</head>
<body>
    <div class="container">
        <h2>Transfer Money</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
            <div class="success-message">
                Transaction Successful!
            </div>
        <?php endif; ?>
        <form action="process_transfer.php" method="post">
            <input type="hidden" name="sender_id" value="<?php echo $senderId; ?>">
            <label for="receiver">Select Customer to Transfer to:</label>
            <select name="receiver_id" id="receiver" required>
                <?php
                    if ($customersResult->num_rows > 0) {
                        while($row = $customersResult->fetch_assoc()) {
                            echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                        }
                    } else {
                        echo "<option>No customers found</option>";
                    }
                ?>
            </select>
            <label for="amount">Amount:</label>
            <input type="number" step="0.01" name="amount" id="amount" required>
            <button type="submit" class="styled-button" >Transfer</button>
            
        </form>
        <a href="view_customer.php?id=<?php echo $senderId; ?>">Back to Customer</a><br><br>
        <button class="styled-button" onclick="goToHome()">Back to Home</button>
    </div>

    <script>
        function goToHome() {
            window.location.href = 'index.html';
        }
    </script>
</body>
</html>

<?php
    $conn->close();
?>



