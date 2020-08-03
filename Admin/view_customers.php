<?php

session_start();
include('..//db_config.php');
include('authenticate.php');
include('function.php');

authenticate();

$admin_id = $_SESSION['administrator_id'];
$admin_name = $_SESSION['administrator_name'];

$query = mysqli_query($db,"SELECT * FROM customer") or die(mysqli_error($db));

?>


<html>
    <head>
        <title>
            Swap Space Bank ~ View Customers
        </title>
    </head>
    <body>
        <h1>Welcome!!!</h1>
        
        <?php
        
        echo "<p>Admin ID: <strong>$admin_id</strong></p>";
        echo "<p>Admin Name: <strong>$admin_name</strong></p>";
        
        ?>
        <hr>
        
        <a href="home.php">Home</a>
        <a href="add_customers.php">Add Customers</a>
        <a href= "view_customers.php">View Customers</a>
        <a href = "logout.php">Click To Logout</a>
        <hr>
        
        <table border = "2" id = "ta">
            
          <tr>
            <th class="ta1">ID </th>
            <th class="ta1">Firstname </th>
            <th class="ta1">Lastname </th>
            <th class="ta1">Address </th>
            <th class="ta1">Date Of Birth</th>
            <th class="ta1">Sex</th>
            <th class="ta1">Account type</th>
            <th class="ta1">Opening Balance</th>
            <th class="ta1">Account Balance</th>
            <th class="ta1">Account Number</th>
            <th class="ta1">Password</th>
          </tr>
               <?php
                    $response = displayCustomers($query);
                    echo $response;
               ?>
        </table>
    </body>
</html>