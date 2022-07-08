<?php
        session_start();
        include_once('connection.php');
        
        $sql = "SELECT * FROM ".$_SESSION['id'];
        if($result = mysqli_query($conn, $sql)) {
             if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)){
                  echo '
                     <div class="'.$row['name'].'">
                      <p>'.$row['name']. '</p><br>
                      <small id="'.$row['name'].'">'.$row['message'].'</small>
                   </div>';
                 }
                mysqli_free_result($result);
              } 
              else {
                echo("<center>Start Conversation..</center>");
              }
         } else {
           echo "<script> 
           alert('`".$_SESSION['id'] . "` not found, make sure that you type correct ID number before Join or just create a new Chat room');
           setTimeout(function() {
             location.href = 'index.php';
           }, 100);
           </script>";
           session_destroy();
           
         }
     ?>