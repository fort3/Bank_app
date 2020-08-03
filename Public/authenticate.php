<?php

    function authenticate(){
        
        if(!isset($_SESSION['cust_id']) && !isset($_SESSION['cust_acc'])){
            
            header("location:customer_login.php");
            
        }
    }
?>