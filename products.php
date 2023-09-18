<?php
// session_start();
include './functions/userFunctions.php';
include './components/header.php';

$ciphering = 'AES-128-CTR';
$option = 0;
$iv_length = openssl_cipher_iv_length($ciphering);
$decryption_iv = '1234567891011121';
$decryption_key = "remo278139y8yWVWC";

if (isset($_GET['category'])) {
    $decrypt_id = openssl_decrypt($_GET['category'], $ciphering, $decryption_key, $option, $decryption_iv);
    $slug = $decrypt_id;
    $category = getSlug('categories', $slug);
    $category_arr = mysqli_fetch_array($category);
    if (mysqli_num_rows($category) > 0) {

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
                    <?= $category_arr['name']; ?>
                </h6>
            </div>
        </div>
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?= $category_arr['name']; ?></h1>
                        <hr>
                        <div class="row">
                            <?php
                            $products = getProductsByCategory($category_arr['id']);
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                            ?>
                                    <div class="col-md-3 mb-2">
                                        <a href="single_product.php?product=<?= $item['slug'] ?>">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <img src="images/<?= $item['image'] ?>" alt="Product Image" class="w-100">
                                                    <h4 class="text-center"> <?= $item['name']; ?></h4>
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

<?php
    } else {
        echo "Something went wrong here ";
    }
} else {
    echo "Something Went wrong";
}
include('./components/footer.php'); ?>