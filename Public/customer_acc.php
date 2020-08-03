<?php
session_start();
include('..//db_config.php');
include('authenticate.php');
authenticate();

$customer_id = $_SESSION['cust_id'];
$account_number = $_SESSION['cust_acc'];
$cus_name = $_SESSION['customer_name'];

$query = mysqli_query($db,"SELECT * FROM transaction  WHERE customer_id = '".$customer_id."'") or die(mysqli_error($db));
?>
<html>
    <head>
        <title>
            Swap Space Bank ~ Account Details
        </title>
    </head>
    <body>
        <h1>Account Details</h1>
        
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
        
        <table border="2px">
          <tr>
            <th class="ta1">Transaction Type</th>
            <th class="ta1">Transaction Date and Time</th>
            <th class="ta1">Previous Balance</th>
            <th class="ta1">New Balance</th>
            <th class="ta1">Account Name</th>
            <th class="ta1">Amount</th>
          </tr>
            <?php
               while($row = mysqli_fetch_array($query)){;
            ?>
          <tr>
            <td>
                <?php
               echo $row['transaction_type'];
                ?>
            </td>
            <td>
                <?php
                echo $row['transaction_date'];
                ?>
            </td>
            <td>
                <?php
                echo $row['previous_balance'];
                ?>
            </td>
            <td>
                <?php
                echo $row['new_balance'];
                ?>
            </td>
            <td>
                <?php
                echo $row['recipient_name'];
                ?>
            </td>
            <td>
                <?php
                echo $row['transaction_amount'];
                ?>
            </td>
            <?php } ?>
          </tr>
        </table>
        
    </body>
</html>