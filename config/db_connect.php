<?php
    // echo "\n db here";
    $servername = "localhost";
    $username = "root";
    $database = "php_ecommerce";
    $pass = "";

    $connection = mysqli_connect($servername, $username, $pass, $database);
    if(!$connection){
        die("Error :". mysqli_connect_error());
    }
?>