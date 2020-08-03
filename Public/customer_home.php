<?php

session_start();
include('..//db_config.php');
include('authenticate.php');
authenticate();

$customer_id = $_SESSION['cust_id'];
$account_number = $_SESSION['cust_acc'];
$cus_name = $_SESSION['customer_name'];

$query = mysqli_query($db,"SELECT * FROM customer") or die(mysqli_error($db));

?>
<html>
    <head>
        <title>
            Swap Space Bank ~ Home
        </title>
    </head>
    <body>
        <h1>Welcome!!!</h1>
        
        <?php
        
        echo "<p>Customer ID: <strong>$customer_id</strong></p>";
        echo "<p>Account Number: <strong>$account_number</strong></p>";
        echo "<p>Customer Name: <strong>$cus_name</strong></p>";
        
        ?>
        <hr>
        
        <a href="customer_home.php">Home</a>
        <a href="customer_acc.php">Account</a>
        <a href= "customer_trans.php">Transactions</a>
        <a href = "customer_logout.php">Click To Logout</a>
        
        <hr>
        <table>
            <tr>
                <th></th>
            </tr>
        <?php
        $row1 = mysqli_fetch_array($query);
        ?>
            
        </table>
        
    </body>
</html>