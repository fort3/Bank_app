<?php
    session_start();
    include("..//db_config.php");
    //include('authenticate.php');
    //authenticate();
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
        <p>Please enter your Firstname and Password</p>
        
        <?php
        
            if(array_key_exists('login',$_POST)){
                
                $error = array();
                
                if(empty($_POST['fname'])){
                    
                    $error[] = "Please enter your firstname";
                    
                }else{
                    
                    $fname = mysqli_real_escape_string($db,$_POST['fname']);
                    
                }
                
                if(empty($_POST['pword'])){
                    
                    $error[] = "Please enter your password";
                    
                }else{
                    
                    $pword = mysqli_real_escape_string($db,$_POST['pword']);
                    
                }
                
                if(empty($error)){
                    
                    $query = mysqli_query($db,"SELECT * FROM customer WHERE firstName = '".$fname."' AND password = '".$pword."'") or
                    die(mysqli_error($db));
                    
                    
                    if(mysqli_num_rows($query) == 1){
                        
                        $result = mysqli_fetch_array($query);
                        
                        $customer_name = $result['firstName'].' '.$result['lastName'];
          
                        $_SESSION['cust_id'] = $result['customer_id'];
                        $_SESSION['cust_acc'] = $result['account_number'];
                        $_SESSION['customer_name']= $customer_name;
                        
   
                  
                        header("location:customer_home.php");
                    }else{
                        $error_msg = "Invalid Firstname or Password";
                        header("location:customer_login.php?err_msg=$error_msg");
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
            <p>Firstname: <input type="text" name="fname"/></p>
            <p>Password: <input type="password" name="pword"/></p>
            <input type="submit" name="login" value="click to login"/>
        </form>
        
    </body>
</html>
<?php ob_end_flush(); ?>