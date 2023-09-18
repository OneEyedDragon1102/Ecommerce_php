<?php

session_start();
include '../config/db_connect.php';

if (isset($_SESSION['auth'])) {
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case "add":
                $product_id = $_POST['product_id'];
                $product_quantity = $_POST['product_quantity'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $check_cart_query = "SELECT * FROM `carts` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id';";
                $check_cart_result = mysqli_query($connection, $check_cart_query);
                if (mysqli_num_rows($check_cart_result)) {
                    echo 204;
                } else {
                    $query = "INSERT INTO `carts` (`user_id`, `product_id`, `product_quantity`) VALUES ('$user_id', '$product_id', '$product_quantity');";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        echo 201;
                    } else {
                        echo 500;
                    }
                }
                break;
            
            case "update":
                $product_id = $_POST['product_id'];        
                $product_quantity = $_POST['product_quantity'];
                $user_id = $_SESSION['auth_user']['user_id'];
                
                $search_query = "SELECT * FROM `carts` WHERE `product_id` = '$product_id' AND `user_id` = '$user_id'";
                $search_result = mysqli_query($connection, $search_query);
                if(mysqli_num_rows($search_result)){
                    $query = "UPDATE `carts` SET `product_quantity` = '$product_quantity' 
                              WHERE `product_id` = '$product_id' AND `user_id` = '$user_id';";
                    $result = mysqli_query($connection, $query);
                    if($result){
                        echo 200;
                    }
                    else{
                        echo 500;
                    }
                }
                else{
                    echo "something went wrong";
                }
                break;
            
            case "delete":
                $cart_id = $_POST['cart_id'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $search_query = "SELECT * FROM `carts` WHERE `id` = '$cart_id' AND `user_id` = '$user_id'";
                $search_result = mysqli_query($connection, $search_query);
                if($search_query){
                    $query = "DELETE FROM `carts` WHERE `id` = '$cart_id';";
                    $result = mysqli_query($connection, $query);
                    if($result){
                        echo 200;
                    }
                    else{
                        echo "something went wrong";
                    }
                }
                else{
                    echo "something went wrong";
                }
                break;
            default:
                echo 500;
        }
    } else {
        echo 500;
    }
} else {
    echo 401;
}
