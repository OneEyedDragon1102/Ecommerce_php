<?php
include('../middleware/adminMiddleware.php');
include('./components/header.php');
include ('../config/db_connect.php');

$ciphering = 'AES-128-CTR';
$option = 0;
$iv_length = openssl_cipher_iv_length($ciphering);
$encryption_iv = '1234567891011121';
$encryption_key = "Geui@4*&)12nsifv";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Products</h4>
                        </div>
                        <form action="" method = "POST" class = "col-md-5">
                            <div class="row">
                                <div class = "col-md-5">
                                    <select name = "cid" class="form-select">
                                    <option selected>Select Category</option>
                                    <?php
                                        $categories = getAllCategories('categories');
                                        if (mysqli_num_rows($categories) > 0) {
                                            foreach ($categories as $val) {
                                        ?>
                                            <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo "no data found";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type = "submit" class = "btn btn-primary" name = "search-products-btn">View</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-3">
                            <a class="btn btn-primary float-end" href="add_product.php">Add Product</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_POST['cid'])){
                                $category_id = $_POST['cid'];
                                $products = getProductsByCategory($category_id);
                                if (mysqli_num_rows($products) > 0) {
                                    foreach ($products as $val) {
                                        ?>
                                    <tr>
                                        <td> <?= $val['id'] ?></td>
                                        <td> <?= $val['name'] ?></td>
                                        <td>
                                            <img src="../images/<?= $val['image']; ?>" height="80px" alt="<?= $val['name']; ?>">
                                        </td>
                                        <td> <?= $val['status'] == "0" ? "Visible" : "Hidden" ?> </td>
                                        <?php $encrytion = openssl_encrypt($val['id'], $ciphering, $encryption_key, $option, $encryption_iv); ?>
                                        
                                        <td>
                                            <a href="edit_product.php?id=<?= $encrytion; ?>" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                        <form action="product_back.php" method="post">
                                                <input type="hidden" name="product_id" value = "<?=$val['id']?>">   
                                                <button type="submit" class = "btn btn-danger" name = "delete-product-btn">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                    }
                                }
                            } 
                            else {
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