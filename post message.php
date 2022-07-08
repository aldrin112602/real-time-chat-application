<?php
  session_start();
  include_once('connection.php');
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $msg = $_POST['message'];
      $name = htmlentities($_SESSION['name']);
      $table = $_SESSION['id'];
     
       if(!empty($msg)) {
           $msg = htmlentities($msg); 
           $sql = "INSERT INTO ". $table ." (name, message) values('$name', '$msg')";
           if($conn -> query($sql)) {
               // echo "Success";
            }
        }

    }
   
  
?>