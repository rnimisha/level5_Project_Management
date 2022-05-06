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
                    $('.action-success').html("<strong>Item added to cart!</strong>");
                    $('.action-success').show();
                }
            }
        });
    });
});