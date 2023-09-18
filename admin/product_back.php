<?php
    // session_start();
    include '../config/db_connect.php';
    include '../functions/redirect.php';
    if(isset($_POST['add-product-btn'])){
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $original_price = $_POST['original_price'];
        $selling_price = $_POST['selling_price'];
        $quantity = $_POST['quantity'];
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';
        
        $image = $_FILES['image']['name'];
        $path = "../images";
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;
        
        $query = "INSERT INTO `products` (`category_id`, `name`, `slug`, `description`, `original_price`, `selling_price`, `image`, `quantity`, `status`, `popular`) 
        VALUES('$category_id', '$name', '$slug', '$description', '$original_price', '$selling_price', '$filename', '$quantity', '$status', '$popular');";

        $result = mysqli_query($connection, $query);
        if($result){
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            redirect('add_product.php','Product Added Successfully');
        }
        else{
            redirect('add_product.php', 'Internal Error');
        }
    }
    else if(isset($_POST['update-product-btn'])){
        $product_id = $_POST['product_id'];
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $original_price = $_POST['original_price'];
        $selling_price = $_POST['selling_price'];
        $quantity = $_POST['quantity'];
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';
        
        $path = "../images";
        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];

        if($new_image != ""){
            $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
            $update_filename = time().'.'.$image_ext;
        }
        else{
            $update_filename = $old_image;
        }

        $query = "UPDATE `products` SET `category_id` = '$category_id', `name` = '$name', `slug` = '$slug',
                 `description` = '$description', `original_price` = '$original_price', `selling_price` = '$selling_price',
                 `quantity` = '$quantity', `status` = '$status', `popular` = '$popular', `image` = '$update_filename'
                 WHERE `id` = '$product_id'";

        $result = mysqli_query($connection, $query);
        if($result){
            if($_FILES['image']['name'] != ""){
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
                if(file_exists("../images/.$old_image")){
                    unlink("../images/.$old_image");
                }
            }
            redirect("edit_product.php?id=$product_id", "Product Updated Successfully!");
        }
        else{
            redirect("edit_product.php?id=$product_id", "Something Went Wrong!");
        }
    }
    else if(isset($_POST['delete-product-btn'])){
        $id = $_POST['product_id'];
        $query = "DELETE FROM `products` WHERE `id` = $id";
        $result = mysqli_query($connection, $query);
        
        if($result){
            redirect("products.php", "deleted successfully");
        }
        else{
            redirect("products.php", "Error");
        }
    }
?>