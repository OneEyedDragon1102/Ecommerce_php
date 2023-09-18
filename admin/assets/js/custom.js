$(document).ready(function(){
    $('.delete-product-btn').click(function(e){
        e.preventDefault();
        const id = $(this).val();
        alert(id);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: "POST",
                    url: "product_back.php",
                    data: {
                        'product_id': id,
                        'delete-product-btn': true
                    },
                    success: function(response){

                    }
                })
                
            }
            else {
              swal("Your imaginary file is safe!");
            }
          });
    })
})