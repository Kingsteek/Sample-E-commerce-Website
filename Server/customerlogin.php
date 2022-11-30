<?php
  session_start();

  $host = "localhost";
  $user = "X34378285";
  $password = "X34378285";
  $database = "X34378285";

  $formEmail = $_POST['lEmail'];
  $formPassword = $_POST['lPassword'];

  $conn = mysqli_connect($host, $user, $password, $database); //connect to sql database

  if(mysqli_connect_errno()) 
  {
    die("DB connection error: " . mysqli_connect_error()); //die if connection is not successful
  }

  if (!isset($formEmail, $formPassword))
  {
    exit('Email and Password fields can not be empty!');
  }  

  $sql = "SELECT CustomerID, Password FROM CUSTOMER WHERE Email= '$formEmail' OR FirstName='$formEmail' OR LastName = '$formEmail'";  
  $result = mysqli_query($conn, $sql);  
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
  $count = mysqli_num_rows($result);  
    
  if($count == 1){  
    session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
    header('Location: session.php');
  }  
  else{  
    echo "<h1><center>Login failed. Invalid username or password. <br/><a href='../index.html#customerlogin'>Back to login</a></center></h1>";  
  }     
?>