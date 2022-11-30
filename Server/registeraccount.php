<?php
    $host = "localhost";
	$user = "X34378285";
	$password = "X34378285";
	$database = "X34378285";

    // get the post records
    $formID = mt_rand(); //assign random ID to customer.
    $formFirstName = $_POST['rFirstName'];
    $formLastName = $_POST['rLastName'];
    $formEmail = $_POST['rEmail'];
    $formPassword = $_POST['rPassword'];

    var_dump($formFirstName, $formLastName, $formEmail, $formPassword); //print out variables for debug.

    $conn = mysqli_connect($host, $user, $password, $database); //connect to sql database

    if(mysqli_connect_errno()) 
    {
        die("DB connection error: " . mysqli_connect_error()); //die if connection is not successful
    }

    echo "DB Connection successful.";

    $sql = "INSERT INTO CUSTOMER (CustomerID, FirstName, LastName, Email, Password) VALUES (?, ?, ?, ?, ?)"; //sql statament with placeholders for security reasons.

    $stmt = mysqli_stmt_init($conn); //prepare statement to replace placeholders

    if(!mysqli_stmt_prepare($stmt, $sql)) //if there are any issues with this.
    {
        die(msqli_error($conn)); //kill exectution.
    }

    mysqli_stmt_bind_param($stmt, "issss", $formID, $formFirstName, $formLastName, $formEmail, $formPassword); //bind parameters to placeholders

    mysqli_stmt_execute($stmt); //execute input.

    mysqli_close($conn); //close connection.
?>