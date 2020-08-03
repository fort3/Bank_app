<?php

session_start();
include('..//db_config.php');
include('authenticate.php');
authenticate();

$admin_id = $_SESSION['administrator_id'];
$admin_name = $_SESSION['administrator_name'];

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
        
        echo "<p>Admin ID: <strong>$admin_id</strong></p>";
        echo "<p>Admin Name: <strong>$admin_name</strong></p>";
        
        ?>
        <hr>
        
        <a href="home.php">Home</a>
        <a href="add_customers.php">Add Customers</a>
        <a href= "view_customers.php">View Customers</a>
        <a href = "logout.php">Click To Logout</a>
        
    </body>
</html>