<?php

unset($_SESSION['administrator_id']);

unset($_SESSION['administrator_name']);

header("location:admin_login.php");

?>