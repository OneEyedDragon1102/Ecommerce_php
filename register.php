<?php 
session_start();
include('./components/header.php'); 

if(isset($_SESSION['auth'])){
    $_SESSION['message'] = "You are already logged In";
    header('Location: index.php');
    exit();
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php
            if(isset($_SESSION['message'])){
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Message : </strong><?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                unset($_SESSION['message']);
            }
        ?>
            <div class="card">
                <div class="card-header">
                    <h4>Registration Page</h4>
                </div>
                <div class="card-body">
                    <form action = "functions/authCode.php" method = "Post" name = "register-form">
                        <div class="mb-3" id = "name">
                            <label  class="form-label"><strong>Name</strong></label>
                            <input type="text" required class="form-control" placeholder="Enter your Name" name = "name" >
                            <span class = "error-message"></span>
                        </div>
                        
                        <div class="mb-3" id="email">
                            <label class="form-label"><strong>Email address</strong></label>
                            <input type="email" required class="form-control" placeholder="Enter your Email" name = "email" >
                            <span class = "error-message"></span>
                        </div>
                        
                        <div class="mb-3" id="contact">
                            <label class="form-label"><strong>Contact</strong></label>
                            <input type="number" required class="form-control" placeholder="Contact Details" name = "contact" >
                            <span class = "error-message"></span>
                        </div>
                        
                        <div class="mb-3" id="password">
                            <label class="form-label"><strong>Password</strong></label>
                            <input type="password" required class="form-control" placeholder="Enter Password" name = "password">
                            <span class = "error-message"></span>
                        </div>
                        
                        <div class="mb-3" id="confirmPassword">
                            <label class="form-label"><strong>Confirm Password</strong></label>
                            <input type="password" required class="form-control" placeholder="Confirm Password" name = "confirmPassword">
                            <span class = "error-message"></span>
                        </div>
                        <div class="check-box">
                            <h4>Signup As</h4>
                            <ul>    
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="radio" name="list[]" value="1" id="firstRadio" checked>
                                    <label class="form-check-label" for="firstRadio">Admin</label>
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="radio" name="list[]" value="2" id="secondRadio">
                                    <label class="form-check-label" for="secondRadio">User</label>
                                </li>
                            </ul>
                        </div>
                        <button type="submit" name = "register-btn" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./components/footer.php'); ?>