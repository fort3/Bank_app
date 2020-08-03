<?php ob_start(); ?>
<?php

session_start();
include('..//db_config.php');


?>
<html>
    <head>
        <title>
            Swap Space Bank
        </title>
    </head>
    <body>
        <h1>Swap Space Bank</h1>
        <h3>Welcome</h3>
        <p>Please enter your username and password</p>
        
        <?php
        
            if(array_key_exists('login',$_POST)){
                
                $error = array();
                
                if(empty($_POST['uname'])){
                    
                    $error[] = "Please enter your username";
                    
                }else{
                    
                    $uname = mysqli_real_escape_string($db,$_POST['uname']);
                    
                }
                
                if(empty($_POST['pword'])){
                    
                    $error[] = "Please enter your password";
                    
                }else{
                    
                    $pword = md5(mysqli_real_escape_string($db,$_POST['pword']));
                    
                }
                
                if(empty($error)){
                    
                    $query = mysqli_query($db,"SELECT * FROM admin WHERE admin_name = '".$uname."' AND secured_password = '".$pword."'") or
                    die(mysqli_error($db));
                    
                    //echo mysqli_num_rows($query);
                    if(mysqli_num_rows($query) == 1){
                        
                        $result = mysqli_fetch_array($query);
                        
                        $_SESSION['administrator_id'] = $result['admin_id'];
                        $_SESSION['administrator_name'] = $result['admin_name'];
                        
                        header("location:home.php");
                    }else{
                        $error_msg = "Invalid Username or Password";
                        header("location:admin_login.php?err_msg=$error_msg");
                    }
                    
                }else{ //if the error array is not empty
                    
                    foreach($error as $error){
                        
                        echo "<p>".$error."</p>";
                        
                    }
                    
                }
                
            }
            if(isset($_GET['err_msg'])){
                
                echo $_GET['err_msg'];
                
            }
        
        ?>
        
        <form action="" method="post">
            <p>Username: <input type="text" name="uname"/></p>
            <p>Password: <input type="password" name="pword"/></p>
            <input type="submit" name="login" value="click to login"/>
        </form>
        
    </body>
</html>
<?php ob_end_flush(); ?>