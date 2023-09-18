<?php 

session_start();
include ('../config/db_connect.php');

if(isset($_SESSION['auth'])){
    if(isset($_POST['place-order-btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pincode = $_POST['pincode'];
        $address = $_POST['address'];
        $user_id = $_SESSION['auth_user']['user_id'];
        $total_price = $_POST['price'];

        if($name == "" || $email == "" || $pincode == "" || $address == "" || $phone == ""){
            $_SESSION['message'] = "All fields Required";
            header('Location: '."../place_order.php");
            exit();
        }

        $query = "INSERT INTO `orders` (`user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`)
                  VALUES ('$user_id', '$name', '$email', '$phone', '$address', '$pincode', '$total_price');";
        $result = mysqli_query($connection, $query);
        
        if($result){
            $order_id = mysqli_insert_id($connection);
            $query = "SELECT c.id as cid, c.product_id, c.product_quantity, p.id as pid, p.name, p.image,
                      p.selling_price FROM carts c, products p 
                      WHERE c.product_id = p.id AND c.user_id = '$user_id' ORDER BY c.id DESC;";
            $result =  mysqli_query($connection, $query);
            // echo "Here";
            // exit();
            foreach($result as $product){
                $product_id = $product['product_id'];    
                $quantity = $product['quantity'];    
                $selling_price = $product['selling_price'];    
                
                $query_order = "INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`, `price`) 
                          VALUES ('$order_id', '$product_id', '$quantity', '$selling_price')";
                $result_order = mysqli_query($connection, $query_order);    
            }
            
            $delete_cart_query = "DELETE FROM `carts` WHERE `user_id` = '$user_id'";
            $result_delete = mysqli_query($connection, $delete_cart_query);

            $_SESSION['message'] = "Order placed successfully";
            header('Location: ../user_orders.php');
            die();
        }
    }
}
else{
    header("Location: ../index.php");
}  

?>