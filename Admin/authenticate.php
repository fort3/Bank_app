<?php

    function authenticate(){
        
        if(!isset($_SESSION['administrator_id']) && !isset($_SESSION['administrator_name'])){
            
            header("location:admin_login.php");
            
        }
        
    }

?>