<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bank_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $customerId = $_GET["id"];

    $customerSql = "SELECT * FROM customers WHERE id = $customerId";
    $customerResult = $conn->query($customerSql);

    if ($customerResult->num_rows > 0) {
        $customer = $customerResult->fetch_assoc();
    } else {
        die("Customer not found");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $customer["name"]; ?></title>
</head>
<body>
    <div class="container">
        <h2><?php echo $customer["name"]; ?></h2>
        <p>Email: <?php echo $customer["email"]; ?></p>
        <p>Balance: Rs.<?php echo $customer["balance"]; ?></p>
        <a href="transfer_money.php?sender=<?php echo $customer["id"]; ?>">Transfer Money</a>
        <a href="view_customers.php">Back to Customers</a>
    </div>
</body>
</html>

<?php
    $conn->close();
?>
