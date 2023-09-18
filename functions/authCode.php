<?php
    include('redirect.php');

    // echo"holla";
    if(isset($_POST['register-btn'])){
        // echo "<pre>";
        // print_r ($_POST) ;
        // die();

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contact = $_POST['contact'];
        $confirmPassword = $_POST['confirmPassword'];
        $role;
        foreach($_POST['list'] as $val){
            $role = $val;
        }
        // $role = implode(",",$_POST['list']);

        for($i = 0; $i < strlen($name); $i++){
            if($name[$i] < 'A' || ($name[$i] > 'Z' && $name[$i] < 'a') || $name[$i] > 'z'){
                redirect('../register.php', 'Usename can`t contain special Characters');
            }
        }

        if(strlen($password) < 8){
            redirect('../register.php', 'Password must contain atleast 8 characters');
        }
        //regex
        $flag_uppercase = false;
        $flag_lowercase = false;
        $flag_specialChar = false;
        $flag_number = false;
        $specialChar = array('@', '#', '!', '$', '%', '^', '~', '&', '*', '(', ')', '-', '_', '+', '=', ';', ':', '>', '<', '/', '?', '|');
        
        for($i = 0; $i < strlen($password);$i++){
            if($password[$i] >= 'a' && $password[$i] <= 'z'){
                $flag_lowercase = true;
            }
            if($password[$i] >= 'A' && $password[$i] <= 'Z'){
                $flag_uppercase = true;
            }
            if(in_array($password[$i], $specialChar)){
                $flag_specialChar = true;
            }
            if($password[$i] >= '0' && $password[$i] <= '9'){
                $flag_number = true;
            }
        }

        if($flag_lowercase && $flag_number && $flag_specialChar && $flag_uppercase){
            if($password == $confirmPassword){
                $query = "SELECT * FROM `users` WHERE `email` = '$email';";
                $result = mysqli_query($connection, $query);
                
                if(mysqli_num_rows($result) > 0){
                    redirect('../register.php', 'Email already Registered!');    
                }
                else{
                    $query = "INSERT INTO `users` (`name`, `email`, `password`, `phone`, `role`) VALUES ('$name', '$email', '$password', '$contact', '$role');";
                    $result = mysqli_query($connection, $query);
                    
                    if($result){
                        redirect('../register.php', 'Registered Successfully!!');
                    }
                    else{
                        redirect('../register.php','Server Error!');
                    }
                }
            }
            else{
                redirect('../register.php', 'Passwords do not match.');
            }
        }
        else{
            redirect("../register.php","Password Not Strong");
        }
    }
    else if(isset($_POST['login-btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role;
        foreach($_POST['list'] as $val){
            $role = $val;
        }

        $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' AND `role` = '$role'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['auth'] = true;

            $userdata = mysqli_fetch_array($result);
            $user_id = $userdata['u_id'];
            $username = $userdata['name']; // field same as column name in sql table
            $useremail = $userdata['email'];
            $role = $userdata['role'];

            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'name' => $username,
                'email' => $useremail
            ];
            
            $_SESSION['role'] = $role;
            if($role == 1){
                redirect('../admin/index.php', 'Admin Login Successful');
            }
            else{
                redirect('../index.php','Logged In successfully');
            }
        }
        else{
            redirect('../login.php', 'Email or passwords do not match..!!');
        }
    }
    else if(isset($_POST['admin-register-user-btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $role;
        $password = generatePassword();
        foreach($_POST['list'] as $val){
            $role = $val;
        }

        $query = "INSERT INTO `users` (`name`, `email`, `password`, `phone`, `role`) VALUES ('$name', '$email', '$password', '$phone', '$role');";
        $result = mysqli_query($connection, $query);
        if($result){
            redirect('../admin/users_CRUD.php', 'User Created Successfully');
        }
        else{
            redirect('../admin/addUsers/php', 'Internal Server Error');
        }
    }
    
?>