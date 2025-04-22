<?php
  $hostname = "localhost";
  $username = "u955456464_chat_user";
  $password = "P@55word#C";
  $dbname = "u955456464_chat";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
