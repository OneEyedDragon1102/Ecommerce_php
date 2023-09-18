<?php
include '../middleware/adminMiddleware.php';
include './components/header.php';
include '../functions/get_users.php';

$ciphering = 'AES-128-CTR';
$option = 0;
$iv_length = openssl_cipher_iv_length($ciphering);
$decryption_iv = '1234567891011121';
$decryption_key = "H@v#12*d";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['u_id'])) {
                $decrypt_id = openssl_decrypt($_GET['u_id'], $ciphering, $decryption_key, $option, $decryption_iv);
                $u_id = $decrypt_id;
                $user = getUserById('users', $u_id);
                if (mysqli_num_rows($user) > 0) {
                    $user_arr = mysqli_fetch_array($user);
            ?>
                    <div class="card mt-5">
                        <div class="card-header">
                            <h4>Edit User
                                <a href="users_CRUD.php " class = "btn btn-primary float-end">BACK</a>
                            </h4>

                        </div>
                        <div class="card-body">
                            <form action="user_back.php" method="post">
                                <div class="mb-3">
                                    <input type="hidden" value = "<?=$user_arr['u_id']?>" name="u_id">
                                    <label>UserName</label>
                                    <input type="text" name="name" value="<?=$user_arr['name']?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?=$user_arr['email']?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Phone</label>
                                    <input type="number" name="phone" value="<?=$user_arr['phone']?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="text" name="password" value="<?=$user_arr['password']?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Role : User / Admin</label>
                                    <input type="text" name="role" value="<?=$user_arr['role']  == '1' ? 'Admin' : 'User'?>" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary" name="update-user-btn">Save Changes</button>
                            </form>
                        </div>
                    </div>
            <?php
                }
                else{
                    echo "Invalid User Id";
                }
            }
            else{
                echo "Error";
            }
            ?>

        </div>
    </div>
</div>

<?php include './components/footer.php'; ?>