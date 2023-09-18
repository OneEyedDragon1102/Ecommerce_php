<?php 

// include './functions/redirect.php';
include('./components/header.php'); 
if(isset($_SESSION['auth'])){
    redirect('index.php', 'You are already Logged In');
}
else{

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
                    <h4>Login Page</h4>
                </div>
                <div class="card-body">
                    <form action = "functions/authCode.php" method = "Post">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong>Email address</strong></label>
                            <input type="email" class="form-control" placeholder="Enter your Email" id="email" name = "email" >
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"><strong>Password</strong></label>
                            <input type="password" class="form-control" placeholder="Enter Password" id="password" name = "password">
                        </div>
                        <div class="check-box">
                            <h3>Signup As</h3>
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
                        <button type="submit" name = "login-btn"class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
}
include('./components/footer.php'); ?>