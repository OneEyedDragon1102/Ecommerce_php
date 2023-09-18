<?php
    session_start();
    include '../config/db_connect.php';
    // include 'userFunctions.php';

    function generatePassword(){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        return substr( str_shuffle( $chars ), 0, 10);
    }
    
    function redirect($url, $message){
        $_SESSION['message'] = $message;
        header('Location: '.$url);
        exit();
    }

    function getAllCategories($table){
        global $connection;
        $query = "SELECT * FROM `$table`;";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    function getAllProducts($table){
        global $connection;
        $query = "SELECT * FROM `$table`;";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    function getProductsByCategory($category_id){
        global $connection;
        $query = "SELECT * FROM `products` WHERE `category_id` = '$category_id' AND `status` = '0'";
        return mysqli_query($connection, $query);    
    }
    
    function getAllActive($table){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `status` = '0'";
        return mysqli_query($connection, $query);
    }

    function getCategoryById($table, $id){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `id`='$id';";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    function getProductById($table, $id){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `id`='$id';";
        $result = mysqli_query($connection, $query);
        return $result;
    }

    function getCartItems(){
        global $connection;
        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.product_id, c.product_quantity, p.id as pid, p.name, p.image,
                  p.selling_price FROM carts c, products p 
                  WHERE c.product_id = p.id AND c.user_id = '$user_id' ORDER BY c.id DESC;";
        return mysqli_query($connection, $query);
    }
?>