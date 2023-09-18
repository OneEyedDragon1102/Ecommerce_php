<?php
// session_start();
include './functions/userFunctions.php';
include './components/header.php';

$ciphering = 'AES-128-CTR';
$option = 0;
$iv_length = openssl_cipher_iv_length($ciphering);
$encryption_iv = '1234567891011121';
$encryption_key = "remo278139y8yWVWC";

?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white">
        <a class = "text-white" href="index.php">
            Home
        </a>    
            / Collections
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Collections</h1>
                <hr>
                <div class="row">
                    <?php
                    $category = getAllActiveCategories('categories');
                    if (mysqli_num_rows($category) > 0) {
                        foreach ($category as $val) {
                    ?>
                        <div class="col-md-3 mb-2">
                        <?php $encrytion = openssl_encrypt($val['slug'], $ciphering, $encryption_key, $option, $encryption_iv); ?>
                            <a href="products.php?category=<?=$encrytion?>">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <img src="images/<?= $val['image'] ?>" alt="Category Image" class = "w-100" >
                                        <h4 class="text-center"> <?= $val['name']; ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                        }
                    } else {
                        echo "No data available";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./components/footer.php'); ?>