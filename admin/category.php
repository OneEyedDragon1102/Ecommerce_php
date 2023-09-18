<?php
include('../middleware/adminMiddleware.php');
include('./components/header.php');

$ciphering = 'AES-128-CTR';
$option = 0;
$iv_length = openssl_cipher_iv_length($ciphering);
$encryption_iv = '1234567891011121';
$encryption_key = "Sfinvn%31@";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Categories</h4>
                        </div>
                        <div class="col-md-6">
                            <a class = "btn btn-primary float-end" href="add_category.php">Add Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $category = getAllCategories("categories");
                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $val) {
                            ?>
                                    <tr>
                                        <td> <?= $val['id'] ?></td>
                                        <td> <?= $val['name'] ?></td>
                                        <td>
                                            <img src="../images/<?= $val['image']; ?>" height="80px" alt="<?= $val['name']; ?>">
                                        </td>
                                        <td> <?= $val['status'] == "0" ? "Visible" : "Hidden" ?> </td>
                                        <td> 
                                        <?php $encrytion = openssl_encrypt($val['id'], $ciphering, $encryption_key, $option, $encryption_iv); ?>
                                            <a href="edit-category.php?id=<?= $encrytion; ?>" class="btn btn-primary">Edit</a>
                                            <form action="category_back.php" method="post">
                                                <input type="hidden" name="category_id" value = "<?=$val['id']?>">   
                                                <button type="submit" class = "btn btn-danger" name = "delete-category-btn">DELETE</button>
                                            </form>
                                        </td>

                                    </tr>
                            <?php
                                }
                            } else {
                                echo "No record found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./components/footer.php'); ?>