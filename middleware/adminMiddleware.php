<?php
    // session_start();
    include("../functions/redirect.php");
    
    
    if(isset($_SESSION['auth'])){
        if($_SESSION['role'] == 2){
            redirect('../index.php', 'Not authorised');
        }
    }
    else{
        redirect('../login.php', 'Login to continue');
    }
?>