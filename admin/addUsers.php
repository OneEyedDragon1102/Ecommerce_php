<?php 
    include '../middleware/adminMiddleware.php';
    include './components/header.php';
?> 

<div class="container" >
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5" >
                <div class="card-header">
                    <h4>Add User
                        <a href="users_CRUD.php" class = "btn btn-primary float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="../functions/authCode.php" method="post">
                        <div class="mb-3">
                            <label>UserName</label>
                            <input type="text" name="name" id="" class = "form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="" class = "form-control">
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="number" name="phone" id="" class = "form-control">
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
                        <button type="submit" class = "btn btn-primary" name = "admin-register-user-btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './components/footer.php';?>