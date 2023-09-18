$(document).ready(function(){

    $('.increment-btn').click(function(e){
        e.preventDefault();

        let quantity = $(this).closest('.product_data').find('.input-quantity').val();
        // let quantity = $('.input-quantity').val();
        // alert(quantity);
        let num = parseInt(quantity, 10);
        num = isNaN(num) ? 0 : num;
        if(num < 10){
            num++;
            // $('.input-quantity').val(num);
            $(this).closest('.product_data').find('.input-quantity').val(num);
        }
    });

    $('.decrement-btn').click(function(e){
        e.preventDefault();

        let quantity = $(this).closest('.product_data').find('.input-quantity').val();
        // let quantity = $('.input-quantity').val();
        // alert(quantity);
        let num = parseInt(quantity, 10);
        num = isNaN(num) ? 0 : num;
        if(num > 1 ){
            num--;
            // $('.input-quantity').val(num);
            $(this).closest('.product_data').find('.input-quantity').val(num);
        }
    });

    $('.AddtoCart-Btn').click(function(e) {
        e.preventDefault();
        // console.log("here");
        let quantity = $(this).closest('.product_data').find('.input-quantity').val();
        // let quantity = $('.input-quantity').val();
        let product_id = $(this).val();

        $.ajax({
            method : "POST",
            url: "functions/cart.php",
            data : {
                "product_id" : product_id,
                "product_quantity" : quantity,
                "scope" : "add"
            },
            success: function (response){
                console.log(response);
                if(response == 201){
                    alertify.success('Product Added to Cart');
                }
                else if(response == 204){
                    alertify.success("Product already Added to Cart");
                }
                else if(response == 401){
                    alertify.success("Login to continue");
                }
                else if(response == 500){
                    alertify.success("Something went wrong");
                }
            }
        });
    })
    
    $(document).on('click', '.update_quantity', function () {
        let quantity = $(this).closest('.product_data').find('.input-quantity').val();
        // let product_id = $(this).val();
        let product_id = $(this).closest('.product_data').find('.product_Id').val();
        $.ajax({
            method : 'POST',
            url: "functions/cart.php",
            data : {
                "product_id" : product_id,
                "product_quantity" : quantity,
                "scope" : "update"
            },
            success : function(response){
                // alert(response);
            }
        })
    });
    
    $(document).on('click','.delete_product_item', function () {
        cart_id = $(this).val();
        
        $.ajax({
            method : 'POST',
            url: "functions/cart.php",
            data : {
                "cart_id" : cart_id,
                "scope" : "delete"
            },
            success : function(response){
                if(response == 200){
                    alertify.success("Item removed Successfully");
                    $('#user_cart').load(location.href + " #user_cart");
                }
                else{
                    alertify.success(response);
                }
            }
        })
        // alert(cart_id);
        
    })
});