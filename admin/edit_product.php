<?php
include('../middleware/adminMiddleware.php');
include('./components/header.php');

$ciphering = 'AES-128-CTR';
$option = 0;
$iv_length = openssl_cipher_iv_length($ciphering);
$decryption_iv = '1234567891011121';
$decryption_key = "Geui@4*&)12nsifv";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $decrypt_id = openssl_decrypt($_GET['id'], $ciphering, $decryption_key, $option, $decryption_iv);
                $product = getProductById('products', $decrypt_id);
                if (mysqli_num_rows($product) > 0) {
                    $data = mysqli_fetch_array($product);
            ?>
                    <div class="card mt-5">
                        <div class="card-header">
                            <h4>Update Products
                                <a href="products.php" class = "btn btn-primary float-end">BACK</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="./product_back.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mt-2">Select Category</label>
                                        <select name="category_id" class="form-select">
                                            <option selected>Select Category</option>
                                            <?php
                                            $categories = getAllCategories('categories');
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $val) {
                                            ?>
                                                    <option value="<?= $val['id'] ?>" <?= $data['category_id'] == $val['id'] ? 'selected' : '' ?>><?= $val['name'] ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "no data found";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                    <div class="col-md-6">
                                        <label class="mt-2">Name</label>
                                        <input type="text" required value="<?= $data['name']; ?>" name="name" placeholder="Add Category Name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Slug</label>
                                        <input type="text" required name="slug" value="<?= $data['slug']; ?>" placeholder="Enter slug" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mt-2">Description</label>
                                        <textarea rows="3" required name="description" placeholder="Enter Description" class="form-control"><?= $data['description']; ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Original Price</label>
                                        <input type="text" required name="original_price" value="<?= $data['original_price']; ?>" placeholder="Enter original price" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Selling Price</label>
                                        <input type="text" required name="selling_price" value="<?= $data['selling_price']; ?>" placeholder="Enter selling price" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <label class="mt-2">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label class="mb-0">Current Image</label>
                                        <img src="../images/<?= $data['image'] ?>" height="80px" width="100px">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mt-2">Quantity</label>
                                            <input type="number" required value="<?= $data['quantity']; ?>" name="quantity" placeholder="Enter quantity" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mt-2">Status</label><br>
                                            <input type="checkbox" <?= $data['status'] == '0' ? '' : 'checked' ?> name="status">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mt-2">Popular</label><br>
                                            <input type="checkbox" <?= $data['popular'] == '0' ? '' : 'checked' ?> name="popular">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary" name="update-product-btn">Save</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    echo "Product Not found";
                }
            } else {
                echo "Id missing";
            }
            ?>
        </div>
    </div>
</div>
<?php include('./components/footer.php'); ?>