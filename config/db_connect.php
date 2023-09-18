<?php
    // echo "\n db here";
    $servername = "localhost";
    $username = "root";
    $database = "database_name";
    $pass = "password_here";

    $connection = mysqli_connect($servername, $username, $pass, $database);
    if(!$connection){
        die("Error :". mysqli_connect_error());
    }
?>
