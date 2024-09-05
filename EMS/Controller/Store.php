<?php

session_start();
// open connectio
$connect = mysqli_connect('localhost','root','','ems');

// check connection 
if(!$connect){
    echo "connection faild" . mysqli_connect_error($connect);
}

if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['save']) ){
        // some validaiotn and sanitzation 
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //      insert query
    $sql = "INSERT INTO employee (name , email , phone , password) VALUES ('$name','$email' ,'$phone' ,'$password' )";
    $result = mysqli_query($connect, $sql);
    //          to make sure transaction
    if(mysqli_affected_rows($connect) == 1){
        $_SESSION['add'] = $name . "  Added Successfully";
    }

    
      // Close the connection
      mysqli_close($connect);
     
      // redirection
      header("location:../index.php");
      exit(); // Ensure no further code is executed after redirection

}