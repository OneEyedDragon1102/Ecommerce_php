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
            <a href="place_order.php" class="text-white">
                Place Order
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/place_orders.php" method="post">
                    <div class="row">
                        <div class="col-md-7">
                            <?php
                            $user_id = $_SESSION['auth_user']['user_id'];
                            $user = getUser($user_id);
                            $userInfo = mysqli_fetch_array($user);
                            ?>
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Name</label>
                                    <input type="text" name="name" placeholder="Enter your full name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Email</label>
                                    <input type="email" name="email" value="<?= $userInfo['email']; ?>" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Phone</label>
                                    <input type="number" name="phone" value="<?= $userInfo['phone']; ?>" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Pin Code</label>
                                    <input type="number" name="pincode" placeholder="Enter your Pincode" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Address</label>
                                    <textarea name="address" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>

                            <?php $items = getCartItems();
                            $sum = 0;
                            foreach ($items as $product) {
                            ?>
                                <div class="mb-1 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="images/<?= $product['image']; ?>" alt="<?= $product['name']; ?>" width="60px">
                                        </div>
                                        <div class="col-md-5">
                                            <label><?= $product['name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><?= $product['selling_price']; ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>x<?= $product['product_quantity']; ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $sum += ($product['selling_price'] * $product['product_quantity']);
                            }
                            ?>
                            <hr>
                            <!-- <h5>Total Price : <span class = "float-end me-2">< ?=$sum;?></span></h5> -->
                            <div class="row">
                                <h5>Total Price :
                                    <input class="text-center float-end" type="text" name="price" value="<?=$sum;?>" readonly>
                                </h5>
                            </div>
                            <div>
                                <button class="btn btn-primary w-100 mt-3" name="place-order-btn" type="submit">Confirm and Place Order</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('./components/footer.php'); ?>