<?php
  session_start();
  include_once('connection.php');
  if(empty($_SESSION['id']) && empty($_SESSION['name'])) {
   header("location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Real time chat application</title>
  <link rel="stylesheet" href="style.css">
  <style>
    form {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 320px;
      padding: 0;
    }
    textarea {
      width: 260px;
      height: 40px;
      border: 1px solid rgba(0,0,0,0.1);
      padding: 10px;
      border-radius: 3px;
    }
    div#messages {
      height: 200px;
      width: auto;
      border: 1px solid rgba(0,0,0,0.1);
      margin-bottom: 20px;
      padding: 20px;
      overflow-y: auto;
    }
    form button {
      width: 50px;
      height: 40px;
      background: #222;
    }
    #messages div {
      margin: 10px 0;
      padding-top: 15px;
      position: relative;
      width: 100%;
      display: flex;
      justify-content: flex-start;
    }
    #messages div small {
      padding: 5px;
      background-color: rgba(0,0,0,0.1);
      border-radius:0 5px 5px 5px;
      max-width: 80%; 
      word-wrap: break-word;
      overflow-wrap: break-word;
      hyphens: auto;
    }
    #messages div p {
      font-size: 13px;
      position: absolute;
      display: inline-block;
      top: 0;
      left: 0;
    }
  </style>
  <?php 
  echo "
  <style>
  div.".$_SESSION['name']." p {
     text-align: right;
     right: 0;
  }

div.".$_SESSION['name']." {
     flex-direction: row-reverse;
  }
  
  
  div > small#".$_SESSION['name']." {
      background-color: #002;
      color: #fff;
      border-radius:5px 0px 5px 5px; 
  }
 </style>
  ";
  ?>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js" integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <div class="container">
    <h2>Real time chat application</h2><br>
    <div id="messages">
      <?php
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
                echo "<script> alert(' Congratulations, joined successfully'); </script>";
                echo("<center>Start Conversation..</center>");
              }
         } else {
           echo "<script> 
           alert('`".$_SESSION['id'] . "` not found, make sure that you type correct ID number before Join or just create a new Chat room');
           
             location.href = 'index.php';
          
           </script>";
           session_destroy();
           
         }
     ?>
     </div>
    <form method="POST">
      <textarea required placeholder="Write message.." name="message"></textarea>
      <button type="submit">send</button>
    </form>
  </div>
  <script>
   var form = document.querySelector('form') 
   form.onsubmit = function(e) {
     e.preventDefault()
     var msg = form.querySelector('textarea');
     
     axios.post('post message.php', 'message=' + msg.value.trim())
     .then(function(res) {
       msg.value = '';
       axios.get('get message.php')
       .then(function(dat) {
     document.getElementById('messages').innerHTML = dat.data
       });
     });
   }
   setInterval(function() {
     axios.get('get message.php')
     .then(function(dat) {
         document.getElementById('messages').innerHTML = dat.data
       });
   }, 1000)
  </script>
</body>
</html>