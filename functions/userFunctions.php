<?php
    session_start();
    include './config/db_connect.php';

    function getAllActiveCategories($table){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `status` = '0'";
        return mysqli_query($connection, $query);
    }

    function getSlug($table, $slug){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `slug` = '$slug' AND `status` = 0 LIMIT 1";
        return mysqli_query($connection, $query);
    }

    function getProductsByCategory($category_id){
        global $connection;
        $query = "SELECT * FROM `products` WHERE `category_id` = '$category_id' AND `status` = '0'";
        return mysqli_query($connection, $query);    
    }

    function getProducts($table, $id){
        global $connection;
        $query = "SELECT * FROM `$table` WHERE `id` = '$id' AND `status` = '0'";
        return mysqli_query($connection, $query);
    }
    
    function getUser($user_id){
        global $connection;
        $query = "SELECT * FROM `users` WHERE `u_id` = '$user_id';";
        return mysqli_query($connection, $query);
    }

    function getCartItems(){
        global $connection;
        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.product_id, c.product_quantity, p.id as pid, p.name, p.image,
                  p.selling_price FROM carts c, products p 
                  WHERE c.product_id = p.id AND c.user_id = '$user_id' ORDER BY c.id DESC;";
        return mysqli_query($connection, $query);
    }

    function getOrderById(){
        global $connection;
        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT * FROM `orders` WHERE `user_id` = '$user_id';";
        return mysqli_query($connection, $query);
    }

    function getOrderDetails($order_id){
        global $connection;
        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT * FROM `orders` WHERE `id` = '$order_id' AND `user_id` = '$user_id';";
        return mysqli_query($connection, $query);
    }
    
    function getProductsByOrderId($order_id){
        global $connection;
        $user_id = $_SESSION['auth_user']['user_id'];
        // echo($order_id);
        $query = "SELECT * FROM products where products.id IN (
                    SELECT order_products.product_id FROM `order_products` JOIN `orders`
                    WHERE order_products.order_id = $order_id AND orders.user_id = $user_id
                  );";
        return mysqli_query($connection, $query);
        // echo mysqli_num_rows($result);
        // $array = mysqli_fetch_all($result);
        // foreach($array as $item){
        //     echo "<pre>";
        //     print_r ($item) ;
        // }
        // die();
    }

    function getProductQuantity($order_id){
        global $connection;
        $user_id = $_SESSION['auth_user']['user_id'];

        $query = "SELECT * FROM order_products WHERE `user_id` = '$user_id' AND `order_id` = '$order_id'";
        return mysqli_query($connection, $query);
    }
?>