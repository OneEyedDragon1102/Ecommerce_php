<?php
    include '../config/db_connect.php';
    include '../functions/redirect.php';
    if(isset($_POST['update-user-btn'])){
        $u_id = $_POST['u_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        if($role == 'Admin'){
            $role = 1;
        }
        else if($role == "User"){
            $role = 2;
        }
        else{
            redirect("user-edit.php", "Undefined Role");
        }

        $query = "UPDATE `users` SET `name` = '$name', `email` = '$email', `phone` = '$phone', 
                  `password` = '$password', `role` = '$role' WHERE `u_id` = '$u_id';";
        $result = mysqli_query($connection, $query);
        if($result){
            redirect("user-edit.php?u_id=$u_id", 'User Edit Success');
        }
        else{
            redirect("user-edit.php?u_id=$u_id", 'Error');
        }
    }
    else if(isset($_POST['delete-user-btn'])){
        $u_id = $_POST['delete_u_id'];
        $query = "DELETE FROM `users` WHERE `u_id` = '$u_id'";
        $result = mysqli_query($connection, $query);
        if($result){
            redirect("users_CRUD.php", "Deletion Successful");
        }
        else{
            redirect("users_CRUD.php", "Internal Error");
        }
    }
?>