<?php 
 session_start();
 include_once("connection.php");
 if($_SERVER["REQUEST_METHOD"] == "POST") {
   $id = 'chat' . $_POST['id'];
   $name = $_POST['name'];
   $joinChat = $_POST['joinChat'];
   
   if($joinChat == 'true') {
     //Join chat room
     $_SESSION['id'] = $id;
     $_SESSION['name'] = $name;
     header('location: room.php');
   } else {
     //Create new chat room
     // sql code to create table
     $sql = "CREATE TABLE ".$id." (
           id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
           name VARCHAR(30) NOT NULL,
           message VARCHAR(100),
           reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          )";
     if ($conn->query($sql) === TRUE) {
        echo "<script>
                     alert('New chat room successfully created')
                      location.href = 'index.php';
                   </script>";
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        
     } else {
       session_destroy();
        echo "<script>
        alert('Error creating chat room " . $_POST['id'] . " already exist!') </script>";
        echo("<script>
          
            location.href = 'index.php';
          
          
        </script>");
        $conn->close();
     }
     
   }
 }
?>