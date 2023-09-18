<?php
// session_start();
include('./functions/userFunctions.php');
include('./components/header.php');

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="shopping_cart.php" class="text-white">
                Cart
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <!-- <div class=""> -->
        <div class="row">
            <div class="col-md-12">
                <div id="user_cart">

                
                <?php
                $items = getCartItems();
                if (mysqli_num_rows($items)) {
                ?>
                    <div class="row align-items-center">
                        <div class="col-md-5 ">
                            <h6>Product</h6>
                        </div>
                        <div class="col-md-3">
                            <h6>Price</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Quantity</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Action</h6>
                        </div>
                    </div>
                    
                        <?php
                        foreach ($items as $product) {
                        ?>
                            <div class="card shadow-sm mb-3 product_data">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="images/<?= $product['image']; ?>" alt="<?= $product['name']; ?>" width="100px">
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?= $product['name']; ?></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?= $product['selling_price']; ?></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" class="product_Id" value="<?= $product['product_id']; ?>">
                                        <div class="input-group mb-3" style="width: 120px;">
                                            <button class="input-group-text decrement-btn update_quantity">-</button>
                                            <input type="text" class="form-control bg-white input-quantity text-center" value="<?= $product['product_quantity']; ?>" disabled>
                                            <button class="input-group-text increment-btn update_quantity">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm delete_product_item" value="<?= $product['cid']; ?>">
                                            <i class="fa fa-trash me-2"></i>Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    
                    <div class="float-end">
                        <a href="place_order.php" class="btn btn-outline-primary">Place Order</a>
                    </div>

                <?php
                } else {
                    ?>
                    <div class="card card-body text-center">
                        <h4 class="py-3">Empty Cart</h4>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>

<?php include('./components/footer.php'); ?>