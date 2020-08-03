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
            Swap Space Bank ~ Add Customers
        </title>
    </head>
    <body>
        <h1>New Customers</h1>
        
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
        
        <h3>Customer Registration Form</h3>
        <p>Please fill the form fields below</p>
        <?php
        
            if(isset($_POST['create'])){
                
                $error = array();
                if(empty($_POST['fname'])){
                    
                    $error[] = "Please enter firstname";
                    
                }else{
                    
                    $fname = mysqli_real_escape_string($db,$_POST['fname']);
                    
                }
                if(empty($_POST['lname'])){
                    
                    $error[] = "Please enter lastname";
                    
                }else{
                    
                    $lname = mysqli_real_escape_string($db,$_POST['lname']);
                    
                }
                if(empty($_POST['address'])){
                    
                    $error[] = "Please enter address";
                    
                }else{
                    
                    $address = mysqli_real_escape_string($db,$_POST['address']);
                    
                }
                if(empty($_POST['dob'])){
                    
                    $error[] = "Please enter Date of Birth";
                    
                }else{
                    
                    $dob = mysqli_real_escape_string($db,$_POST['dob']);
                    
                }
                if(empty($_POST['sex'])){
                    
                    $error[] = "Please enter Gender";
                    
                }else{
                    
                    $sex = mysqli_real_escape_string($db,$_POST['sex']);
                    
                }
                if(empty($_POST['acc_type'])){
                    
                    $error[] = "Please enter Account Type";
                    
                }else{
                    
                    $acc_type = mysqli_real_escape_string($db,$_POST['acc_type']);
                    
                }
                if(empty($_POST['o_bal'])){
                    
                    $error[] = "Please enter opening balance";
                    
                }else{
                    
                    $o_bal = mysqli_real_escape_string($db,$_POST['o_bal']);
                    
                }
                if(empty($_POST['pword'])){
                    
                    $error[] = "Please enter password";
                    
                }else{
                    
                    $pword = mysqli_real_escape_string($db,$_POST['pword']);
                    
                }
                if(empty($error)){
                    
                    $query = mysqli_query($db,"INSERT into customer VALUES(NULL,'".$fname."','".$lname."','".$address."','".$dob."','".$sex."',
                                        '".$acc_type."','".$o_bal."','".$o_bal."','".rand(10000000000,9999999999)."','".$pword."','".$admin_id."')") or die(mysqli_error($db));      
                    
                }
                
            }
        
        ?>
        <form action="" method="post">
            <p>Firstname: <input type="text" name= "fname"/></p>
            <p>Lastname: <input type="text" name = "lname"/></p>
            <p>Address: <textarea name="address"></textarea></p>
            <p>Date Of Birth: <input type= "date" name = "dob"/></p>
            <p>Sex: Male<input type="radio" name="sex" value="M"/>
                    Female<input type= "radio" name="sex" value="F"/></p>
            <p>Account Type: Savings<input type="radio" name="acc_type" value= "savings"/>
                             Current<input type="radio" name="acc_type" value="current"/>
                             Fixed Deposit<input type="radio" name="acc_type" value="fixed"/></p>
            <p>Opening Account Balance: <input type="number" name="o_bal"/></p>
            <p>Password: <input type="password" name="pword"/></p>
            <input type="submit" name="create" value="Click to Add Customer"/>
            
        </form>
    </body>
</html>