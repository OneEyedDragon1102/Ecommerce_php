<?php
include('../middleware/adminMiddleware.php');
include('./components/header.php');

$ciphering = 'AES-128-CTR';
$option = 0;
$iv_length = openssl_cipher_iv_length($ciphering);
$decryption_iv = '1234567891011121';
$decryption_key = "Sfinvn%31@";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $decrypt_id = openssl_decrypt($_GET['id'], $ciphering, $decryption_key, $option, $decryption_iv);
                $id = $decrypt_id;
                $category = getCategoryById('categories', $id);

                if(mysqli_num_rows($category) > 0){
                    $category_arr = mysqli_fetch_array($category);
                ?>
                    <div class="card mt-5">
                        <div class="card-header">
                            <h4>Edit Category
                                <a href="category.php" class = "btn btn-primary float-end">BACK</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="./category_back.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value = "<?=$category_arr['id'];?>">
                                        <label for="">Name</label>
                                        <input type="text" name="name" value = "<?=$category_arr['name'];?>" placeholder="Add Category Name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Slug</label>
                                        <input type="text" name="slug" value = "<?=$category_arr['slug'];?>" placeholder="Enter slug" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Description</label>
                                        <textarea rows="3" name="description"  placeholder="Enter Description" class="form-control"><?=$category_arr['description'];?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label for="">Currect Image :</label>
                                        <input type="hidden" name="old_image" value = "<?=$category_arr['image'];?>">
                                        <img class = "mt-3" src="../images/<?=$category_arr['image'];?>" height = "80px" alt="">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Title</label>
                                        <input type="text" name="meta_title" value = "<?=$category_arr['meta_title'];?>" placeholder="Enter Meta Title" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Description</label>
                                        <textarea rows="3" name="meta_description" placeholder="Enter Meta Description" class="form-control"><?=$category_arr['meta_description'];?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Keywords</label>
                                        <textarea rows="3" name="meta_keywords" placeholder="Enter Meta keywords" class="form-control"><?=$category_arr['meta_keywords'];?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <input type="checkbox" <?=$category_arr['status'] ? "checked" : "" ?>name="status">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Popular</label>
                                        <input type="checkbox" <?=$category_arr['popular'] ? "checked" : "" ?> name="popular">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update-category-btn">Save Changes</button>
                                    </div>
    
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                else{
                    echo "Category Not Found";
                }
            }
            else{
                echo"Error! Something went wrong";
            }
            ?>

        </div>
    </div>
</div>

<?php include('./components/footer.php'); ?>