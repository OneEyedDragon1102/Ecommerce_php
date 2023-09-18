<?php
// session_start();
    include('./functions/userFunctions.php');
    include('./components/header.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $order = getOrderDetails($id);
        if (mysqli_num_rows($order) < 0) {
?>
        <h4>Something Went Wrong</h4>
<?php
        die();
        }
    $orderData = mysqli_fetch_array($order);
    } 
    else {
?>
    <h4>Something went wrong</h4>
<?php
    die();
    }
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="user_orders.php" class="text-white">
                My Orders /
            </a>
            <a href="#" class="text-white">
                View Order
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        View Order
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Delivery Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label class="fw-bold">Name</label>
                                        <div class="border p-1">
                                            <?= $orderData['name'] ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="fw-bold">Email</label>
                                        <div class="border p-1">
                                            <?= $orderData['email'] ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="fw-bold">Phone</label>
                                        <div class="border p-1">
                                            <?= $orderData['phone'] ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="fw-bold">Address</label>
                                        <div class="border p-1">
                                            <?= $orderData['address'] ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="fw-bold">Pincode</label>
                                        <div class="border p-1">
                                            <?= $orderData['pincode'] ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class = "table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $product_details = getProductsByOrderId($id);
                                        foreach($product_details as $product){
                                            ?>
                                            <tr>
                                                <td>
                                                    <img src="images/<?=$product['image'];?>" alt="<?=$product['name'];?>" width="50px" height="50px">
                                                    <?=$product['name']?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./components/footer.php'); ?>