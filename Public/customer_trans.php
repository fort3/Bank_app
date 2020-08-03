<?php
    session_start();
    include('..//db_config.php');
    include('authenticate.php');
    authenticate();
    
    $customer_id = $_SESSION['cust_id'];
    $account_number = $_SESSION['cust_acc'];
    $cus_name = $_SESSION['customer_name'];
    
?>
<html>
    <header>
        <title>
            Swap Space Bank ~ Transfer
        </title>
    </header>
    <body>
        <h1>Funds Transfer</h1>
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
        
        
        <?php

            //here we write a query to select the sender's account balance
            $query = mysqli_query($db, "SELECT account_balance FROM customer WHERE
                                        account_number = '".$account_number."'
                                        ") or die(mysqli_error($db));

            $result = mysqli_fetch_array($query);

            $sender_acc_balance = $result['account_balance'];

        ?>

        <?php

            if(array_key_exists('transfer', $_POST)) {

                if(empty($_POST['rec_acc_num']) || empty($_POST['amount'])) {

                    $msg = "Some fields are missing";
                    header("location:customer_trans.php?msg=$msg");

                } elseif (!is_numeric($_POST['amount'])) { //if amount is not numeric

                    $msg = "Please enter a correct value for amount";
                    header("location:customer_trans.php?msg=$msg");

                } elseif($_POST['rec_acc_num'] == $account_number) { //

                    $msg = "You cannot send money from your account to your account";
                    header("location:customer_trans.php?msg=$msg");

                } else {

                    $recipient_acc_num = mysqli_real_escape_string($db, $_POST['rec_acc_num']) ;

                    $transfer_amount = mysqli_real_escape_string($db, $_POST['amount']);

                    //here we select recipient's details from the customer table

                    $query = mysqli_query($db, "SELECT customer_id, firstname, lastname, account_balance
                                            FROM customer WHERE
                                            account_number = '".$recipient_acc_num."'") or die(mysqli_error($db));
                                echo mysqli_num_rows($query);
                    if(mysqli_num_rows($query) == 1) {

                        $recipient = mysqli_fetch_array($query);

                        $recipient_customer_id = $recipient['customer_id'];
                        $recipient_name = $recipient['firstname']. ' '. $recipient['lastname'];
                        $recipient_current_balance = $recipient['account_balance'];

                        //here we perform the mathematical transactions

                        if($sender_acc_balance < $transfer_amount) {

                            $msg = "Insufficient funds. Operations Failed";
                            header("location:customer_trans.php?msg =$msg");

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
                                                            '".$cus_name."',
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
                                                            '".$cus_name."',
                                                            '".$recipient_name."',
                                                            '".$transfer_amount."',
                                                            '".$recipient_current_balance."',
                                                            '".$recipient_new_balance."',
                                                            '".$recipient_customer_id."')
                                                            ") or die(mysqli_error($db));

                            $success = "Transaction Successful";
                            header("location:customer_acc.php?success=$success");

                        }
                        
                    } else {

                        $msg = "Operations Failed. Please Try again";
                        header("location:customer_trans.php?msg=$msg");
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
            <p>Recipient Account Number: <input type = "number" name ="rec_acc_num"/></p>
            <p>Transfer Amount: <input type= "number" name="amount"/></p>
            <input type="submit" name="transfer" value="Click to Proceed"/>
        </form>
        
    </body>
</html>