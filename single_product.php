<?php
// session_start();
include './functions/userFunctions.php';
include './components/header.php';

if (isset($_GET['product'])) {
    $slug = $_GET['product'];
    $product = getSlug('products', $slug);
    $product_arr = mysqli_fetch_array($product);
    if ($product_arr) {
?>
        <div class="py-3 bg-primary">
            <div class="container">
                <h6 class="text-white">
                    <a class="text-white" href="index.php">
                        Home /
                    </a>
                    <a href="categories.php" class="text-white">
                        Collections /
                    </a>
                    <?= $product_arr['name']; ?>
                </h6>
            </div>
        </div>
        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="images/<?= $product_arr['image'] ?>" alt="product_image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3 class="fw-bold"><?= $product_arr['name']; ?>
                            <span class="float-end text-danger"><?php if ($product_arr['popular']) {echo "Trending";} ?></span>
                        </h3>
                        <hr>
                        <div class="col-md-6">
                            <h5 class="fw-bold">
                                Product Description:
                            </h5>
                            <p><?= $product_arr['description'] ?></p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Rs <s class="text-danger"><?= $product_arr['original_price'] ?></s></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>Rs <span class="text-success"><?= $product_arr['selling_price'] ?></span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width: 120px;">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control bg-white input-quantity text-center" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4 AddtoCart-Btn" value="<?=$product_arr['id'];?>"> <i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4"> <i class="fa fa-heart me-2"></i>Add to Wishlist</button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "Something went wrong";
    }
} else {
    echo "Something Went wrong";
}
include('./components/footer.php'); ?>