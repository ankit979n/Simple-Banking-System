<?php
    $servername = "localhost";
    $username = "root"; // Replace with your actual database username
    $password = ""; // Replace with your actual database password
    $dbname = "bank_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM customers";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View Customers</title>
</head>
<body>
    <div class="container">
        <h2>Customers</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row["id"]."</td>
                                <td>".$row["name"]."</td>
                                <td>".$row["email"]."</td>
                                <td>".$row["balance"]."</td>
                                <td><a href='view_customer.php?id=".$row["id"]."'>View</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No customers found</td></tr>";
                }
            ?>
        </table>
        <button class="styled-button" onclick="goToHome()">Back to Home</button>
        <button class="styled-button" onclick="goToTransactions()">View Transactions</button>

    </div>

    <script>
        function goToHome() {
            window.location.href = 'index.html';
        }

        function goToTransactions() {
            window.location.href = 'view_transactions.php';
        }
    </script>
</body>
</html>



<?php
    $conn->close();
?>

