<?php

    session_start(); //start session

    include("db_config.php");
    include("Admin/authenticate.php");

    authenticate();

    $customer_id = $_SESSION['customer_id'];
    $account_number = $_SESSION['account_number'];
    $customer_name = $_SESSION['customer_name'];


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Public || Funds Transfer</title>
	</head>


    <body>

        <hr/>

        <a href = "public_home.php">Home</a>
        <a href = "funds_transfer.php">Funds Transfer</a>
        <a href = "view_statement.php">View Statement</a>
        <a href = "public_logout.php">Logout</a>

        <?php

            //here we write a query to select the sender's account balance
            $query = mysqli_query($db, "SELECT account_balance FROM customer WHERE
                                        account_number = '".$account_number."'
                                        ") or die(mysqli_error($db));

            $result = mysqli_fetch_array($query);

            $sender_acc_balance = $result['account_balance'];

        ?>

        <h2 align = "center">Funds Transfer</h2>
        
        <?php

            echo "<h3>Welcome to Morgan Felix Bank, Customer $customer_name with account number $account_number. Your ID is $customer_id</h3>";

            echo "<h3>Account Balance: ". $sender_acc_balance."</h3>";

        ?>

        <?php

            if(array_key_exists('transfer', $_POST)) {

                if(empty($_POST['rec_acc_num']) || empty($_POST['amount'])) {

                    $msg = "Some fields are missing";
                    header("location:funds_transfer.php?msg=$msg");

                } elseif (!is_numeric($_POST['amount'])) { //if amount is not numeric

                    $msg = "Please enter a correct value for amount";
                    header("location:funds_transfer.php?msg=$msg");

                } elseif($_POST['rec_acc_num'] == $account_number) { //

                    $msg = "You cannot send money from your account to your account";
                    header("location:funds_transfer.php?msg=$msg");

                } else {

                    $recipient_acc_num = mysqli_real_escape_string($db, $_POST['rec_acc_num']) ;

                    $transfer_amount = mysqli_real_escape_string($db, $_POST['amount']);

                    //here we select recipient's details from the customer table

                    $query = mysqli_query($db, "SELECT customer_id, firstname, lastname, account_balance
                                            FROM customer WHERE
                                            account_number = '".$recipient_acc_num."'") or die(mysqli_error($db));

                    if(mysqli_num_rows($query) == 1) {

                        $recipient = mysqli_fetch_array($query);

                        $recipient_customer_id = $recipient['customer_id'];
                        $recipient_name = $recipient['firstname']. ' '. $recipient['lastname'];
                        $recipient_current_balance = $recipient['account_balance'];

                        //here we perform the mathematical transactions

                        if($sender_acc_balance < $transfer_amount) {

                            $msg = "Insufficient funds. Operations Failed";
                            header("location:funds_transfer.php?msg =$msg");

                        } else {

                            $sender_new_balance = ($sender_acc_balance - $transfer_amount);
                            $recipient_new_balance = ($transfer_amount + $recipient_current_balance);

                            //we update the sender's account balance

                            $sender_update = mysqli_query($db, "UPDATE customer SET 
                                                            account_balance = '".$sender_new_balance."'
                                                            WHERE account_number = '".$account_number."'") or die (mysqli_error($db));

                            //we update the receiver's account number

                            $recipient_update = mysqli_query($db, "UPDATE customer SET
                                                                account_balance = '".$recipient_new_balance."'
                                                                WHERE account_number = '".$recipient_acc_num."'") or die (mysqli_error($db));

                            //we insert for sender
                            $sender_insert = mysqli_query($db, "INSERT INTO transaction
                                                            VALUES(NULL,
                                                            NOW(),
                                                            'debit',
                                                            'self',
                                                            '".$recipient_name."',
                                                            '".$transfer_amount."',
                                                            '".$sender_acc_balance."',
                                                            '".$sender_new_balance."',
                                                            '".$customer_id."')
                                                            ") or die(mysqli_error($db));

                            //we insert for recipient
                            $recipient_insert = mysqli_query($db, "INSERT INTO transaction
                                                            VALUES (NULL,
                                                            NOW(),
                                                            'credit',
                                                            '".$customer_name."',
                                                            'self',
                                                            '".$transfer_amount."',
                                                            '".$recipient_current_balance."',
                                                            '".$recipient_new_balance."',
                                                            '".$recipient_customer_id."')
                                                            ") or die(mysqli_error($db));

                            $success = "Transaction Successful";
                            header("location:funds_transfer.php?success=$success");

                        }
                        
                    } else {

                        $msg = "Operations Failed. Please Try again";
                        header("location:funds_transfer.php?msg=$msg");
                    }
                }
            } //end of main IF

            if (isset($_GET['msg'])) {

                echo "<p>".$_GET['msg']."</p>";

            }

            if (isset($_GET['success'])) {

                echo "<h3><em>".$_GET['success']."</em><h3>";

            }

        ?>

        <form action = "" method = "post">

            <p>Enter Recipient Account Number: <input type = "text" name = "rec_acc_num"/></p>

            <p>Enter Amount to be transferred: <input type = "text" name = "amount"/></p>

            <input type = "submit" name = "transfer" value = "Click to Transfer"/>

        </form>

        

        

    </body>

</html>
