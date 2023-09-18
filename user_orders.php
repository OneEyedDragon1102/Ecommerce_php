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
            <a href="user_orders.php" class="text-white">
                My Orders
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $orders = getOrderById();
                        if (mysqli_num_rows($orders) > 0) {
                            foreach ($orders as $order) {
                        ?>
                                <tr>
                                    <td><?= $order['id']; ?></td>
                                    <td><?= $order['total_price']; ?></td>
                                    <td><?= $order['created_at']; ?></td>
                                    <td>
                                        <a href="view_order.php?id=<?=$order['id'];?>" class = "btn btn-primary">View Details</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <tr>
                                <td>No Orders Placed</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('./components/footer.php'); ?>