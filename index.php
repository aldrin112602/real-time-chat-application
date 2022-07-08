<?php
  session_start();
  if(!empty($_SESSION['id']) && !empty($_SESSION['name'])) {
   header("location: room.php");
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
</head>
<body>
  <div class="container">
    <h2>Real time chat application</h2><br>
    <div class="btn">
      <button class="b1">Create chat room</button>
      <p>-------- or --------</p>
      <button class="b2">Join chat room</button>
    </div>
    
    <form action="handler.php" method="POST">
      <span> &#8592 </span>
      <p>Enter ID</p>
      <input name="id" required type="number" placeholder="Enter room ID"><br>
      <p>Enter name</p>
      <input name="name" required type="text" placeholder="Enter your name"><br>
      <input id="hidden" type="hidden" name="joinChat">
      <button type="submit"></button>
    </form>
<div id="response_container"></div>
  </div>
  <script src="main.js"></script>
</body>
</html>