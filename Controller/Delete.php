<?php
session_start();
// open connectio
$connect = mysqli_connect('localhost','root','','ems');

// check connection 
if(!$connect){
    echo "connection faild" . mysqli_connect_error($connect);
}

if($_SERVER['REQUEST_METHOD']== 'GET' && isset($_GET['id']) ){
     // fetch id 
     $id =$_GET['id'];
     $name = $_GET['name'];
     // delete query
     $sql = "DELETE FROM employee  WHERE id='$id'";
     
     mysqli_query($connect, $sql);
     // make sure query is implemented
     if(mysqli_affected_rows($connect) == 1){
         $_SESSION['delete'] = $name ." Deleted Succesfully";
     }

     // Close the connection
     mysqli_close($connect);
     
    // redirection
    header("location:../index.php");
    exit(); // Ensure no further code is executed after redirection

}