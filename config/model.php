<?php

/**
 * You can create database manualy >> from my admin
 *  DB name >> ems >> that refer to Empolyee Management System
 * 
 * or can create it with php and SQL as this file
 */

 
 //========================================
 //               CREATE DATABASE        ||
 //========================================
 // 
 
 $connect = mysqli_connect('localhost', 'root', '','ems');
 
 // Check connection
 if (!$connect) {
     die("Connection failed: " . mysqli_connect_error());
 }
 echo "Connected successfully". '<br>';
 
 // SQL query to create database
 $sql = "CREATE DATABASE IF NOT EXISTS ems";
 
 // Execute query
 if (mysqli_query($connect, $sql)) {
     echo "Database created successfully" . '<br>';
 } else {
     echo "Error creating database: " . mysqli_error($connect);
 }
 
 // Close connection
 mysqli_close($connect);
 
 
 
  
 //========================================
 //               CRAETE TASKS  TABLE    ||
 //========================================
 //              open connection
 $connect = mysqli_connect("localhost","root","","ems");
 
 if(!$connect){
     echo "connect error" . mysqli_error($connect);
 }
 
 
 // create table
 $sql = "CREATE TABLE IF NOT EXISTS employee (
     id INT PRIMARY KEY AUTO_INCREMENT,
     name VARCHAR(200) NOT NULL'
     email VARCHAR(200) NOT NULL'
     phone VARCHAR(200) NOT NULL'
     password VARCHAR(200) 
 )";
 
 if( mysqli_query($connect, $sql)){
     echo "the tasks table created successfully". '<br>';
 }
 else {
     echo "Error creating database: " . mysqli_error($connect);
 }
 // close connection
 mysqli_close($connect);
 
 
 
 
 