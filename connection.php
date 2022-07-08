<?php
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "My_web_db";
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    # checking connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

