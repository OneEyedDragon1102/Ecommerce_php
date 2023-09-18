<?php
    include '../middleware/adminMiddleware.php';
    include './components/header.php';
    include '../functions/get_users.php';
    $users = getUsers('users');
    $admin = getAdmin('users');
    
    $ciphering = 'AES-128-CTR';
    $option = 0;
    $iv_length = openssl_cipher_iv_length($ciphering);
    $encryption_iv = '1234567891011121';
    $encryption_key = "H@v#12*d";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>User Details</h4>
                        </div>
                        <div class="col-md-6">
                            <a class = "btn btn-primary float-end" href="addUsers.php">Add Users</a>
                        </div>
                    </div>

                    <h5>Admins : <?= mysqli_num_rows($admin)?> </h5>
                    <h5>Users : <?= mysqli_num_rows($users)?> </h5>
                </div>
                <div class="card-body">
                    <table id = "userTable" class = "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM `users`";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0){
                                    foreach($result as $user){
                                        ?>
                                            <tr>
                                                <td><?= $user['u_id']?></td>
                                                <td><?= $user['name']?></td>
                                                <td><?= $user['email']?></td>
                                                <td><?= $user['password']?></td>
                                                <td><?= $user['phone']?></td>
                                                <td><?= $user['role']?></td>
                                                <td>
                                                    <?php $encrytion = openssl_encrypt($user['u_id'], $ciphering, $encryption_key, $option, $encryption_iv); ?>
                                                    <a href = "user-edit.php?u_id=<?=$encrytion;?>" class = "editUserbtn btn btn-success">EDIT</a>
                                                    <form action="user_back.php" method="post">
                                                        <input type="hidden" name="delete_u_id" value = "<?=$user['u_id']?>">
                                                        <button type = "submit" class = "btn btn-danger" name = "delete-user-btn">DELETE</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php          
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './components/footer.php'; ?>