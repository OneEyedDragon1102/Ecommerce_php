<?php 
    // session_start();
    include '../config/db_connect.php';

    function getUsers($table){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `role` = '2'";
        return mysqli_query($connection, $query);
    }
    
    function getAdmin($table){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `role` = '1'";
        return mysqli_query($connection, $query);
    }

    function getUserById($table, $u_id){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `u_id` = '$u_id'";
        return mysqli_query($connection, $query);
    }
?>