<?php
include('../middleware/adminMiddleware.php');
include('./components/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Add Products
                        <a href="products.php" class = "btn btn-primary float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="./product_back.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mt-2">Select Category</label>
                                <select name = "category_id" class="form-select">
                                    <option selected>Select Category</option>
                                    <?php
                                        $categories = getAllCategories('categories');
                                        if(mysqli_num_rows($categories) > 0){

                                            foreach($categories as $val){
                                                ?>
                                                <option value="<?=$val['id']?>"><?=$val['name']?></option>
                                                <?php
                                            }
                                        }
                                        else{
                                            echo "no data found";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mt-2">Name</label>
                                <input type="text" required name="name" placeholder="Add Product Name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="mt-2">Slug</label>
                                <input type="text" required name="slug" placeholder="Enter slug" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="mt-2">Description</label>
                                <textarea rows="3" required name="description" placeholder="Enter Description" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mt-2">Original Price</label>
                                <input type="text" required name="original_price" placeholder="Enter original price" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="mt-2">Selling Price</label>
                                <input type="text" required name="selling_price" placeholder="Enter selling price" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="mt-2">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mt-2">Quantity</label>
                                    <input type="number" required name="quantity" placeholder="Enter quantity" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="mt-2">Status</label><br>
                                    <input type="checkbox" name="status">
                                </div>
                                <div class="col-md-3">
                                    <label class="mt-2">Popular</label><br>
                                    <input type="checkbox" name="popular">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="add-product-btn">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./components/footer.php'); ?>