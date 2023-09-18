<?php 
    session_start();
    include '../config/db_connect.php';
    include '../functions/redirect.php';
    // echo "here";
    
    if(isset($_POST['add-category-btn'])){
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keywords = $_POST['meta_keywords'];
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';

        $image = $_FILES['image']['name'];
        $path = "../images";
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;
    
        $query = "INSERT INTO `categories` (`name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `popular`, `image`) 
                  VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename');";
        
        $result  = mysqli_query($connection, $query);
        if($result){
            // echo "success";
            // exit();
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            redirect("category.php", "Category added successfully");
        }    
        else{
            // echo "fail";
            // exit();
            redirect("add-category.php", "Something went wrong");
        }
    }
    else if(isset($_POST['update-category-btn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $description = $_POST['description'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keywords = $_POST['meta_keywords'];
        $status = isset($_POST['status']) ? '1' : '0';
        $popular = isset($_POST['popular']) ? '1' : '0';
        
        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];
        $filename = $old_image;
        $path = "../images";
        
        if($new_image != ""){
            $filename = $new_image;
        }

        $query = "UPDATE `categories` SET `name`='$name', `slug`='$slug', `description`='$description', `meta_title`='$meta_title',
                 `meta_description` = '$meta_description', `meta_keywords` = '$meta_keywords', `status` = '$status', 
                 `popular` = '$popular', `image` = '$filename' WHERE `id` = '$id';";
        
        $result = mysqli_query($connection, $query);
        if($result){
            if($_FILES['image']['name'] != ""){
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/'. $filename);
                if(file_exists("../images/".$old_image)){
                    unlink("../images/".$old_image);
                }
            }
            
            redirect("edit-category.php?id=$id", "Update Successful");
        }
        else{
            redirect("category.php", "Something Went Wrong");
        }
    }
    else if(isset($_POST["delete-category-btn"])){
        $id = $_POST['category_id'];
        $query = "DELETE FROM `categories` WHERE `id` = $id";
        $result = mysqli_query($connection, $query);
        
        if($result){
            redirect("category.php", "deleted successfully");
        }
        else{
            redirect("category.php", "Error");
        }
    }
    
?>