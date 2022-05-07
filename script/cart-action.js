$('.action-success').hide();
$(document).ready(function(){

    $('.add-to-cart').click(function(){
        var product_id=$(this).attr('value');
        $.ajax({
            type: "POST",
            url: 'cart-action.php',
            data: {
                product_id:product_id,
                action:'add-to-cart'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                if(resp.valid == false) {
                    window.location.href = 'loginform.php?msg=cartaccess';
                }
                else{
                    if(resp.stocklimit == true)
                    {

                        $('.action-success').show().delay(3000).fadeOut();
                    }
                    else{
                        $("#item-added-modal").click();
                    }
                }
            }
        });
    });


    $('#add-cart-with-quantity').click(function(){
        var product_id=$(this).attr('value');
        var quantity=$('#real-quantity').val();
        // alert(quantity);
        $.ajax({
            type: "POST",
            url: 'cart-action.php',
            data: {
                product_id:product_id,
                quantity:quantity,
                action:'add-to-cart'
            },
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.valid == false) {
                    window.location.href = 'loginform.php?msg=cartaccess';
                }
                else{
                    if(resp.stocklimit == true)
                    {

                        $('.action-success').show().delay(3000).fadeOut();
                    }
                    else{
                        $("#item-added-modal").click();
                    }
                }
            }
        });
    });
});