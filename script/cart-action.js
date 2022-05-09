$('.action-success').hide();
$(document).ready(function(){

   
    //add to cart on click
    $('.add-to-cart').click(function(){
        var product_id=$(this).attr('value');
        $(this).removeClass('bx-cart-alt');
        $(this).addClass('bx-loader-circle bx-spin');
        $.ajax({
            type: "POST",
            url: 'cart-action.php',
            data: {
                product_id:product_id,
                action:'add-to-cart'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                $('.add-to-cart').removeClass('bx-loader-circle');
                $('.add-to-cart').removeClass('bx-spin');
                $('.add-to-cart').addClass('bx-cart-alt');
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


    //cart with quantity
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

    //save to wishlist
    $('.save-to-wishlist').click(function(){
        var current=$(this);
        var product_id=$(this).attr('value');

        $.ajax({
            type: "POST",
            url: 'cart-action.php',
            data: {
                product_id:product_id,
                action:'save-to-wishlist'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                if(resp.valid == false) {
                    window.location.href = 'loginform.php?msg=wishlistaccess';
                }
                else{  
                    current.removeClass('bx-heart');
                    current.addClass('bxs-heart');
                    current.addClass('remove-from-wishlist');
                    current.removeClass('save-to-wishlist');
                    $("#item-saved-modal").click();
                }
            }
        });
    });

    //remove from wishlist
    $('.remove-from-wishlist').click(function(){
        var current=$(this);
        var product_id=$(this).attr('value');
        
        $.ajax({
            type: "POST",
            url: 'cart-action.php',
            data: {
                product_id:product_id,
                action:'remove-from-wishlist'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                if(resp.valid == false) {
                    window.location.href = 'loginform.php?msg=wishlistaccess';
                }
                else{
                    current.removeClass('bxs-heart');
                    current.addClass('bx-heart');
                    current.addClass('save-to-wishlist');
                    current.removeClass('remove-from-wishlist');
                }
            }
        });
    });

    //remove from cart
    $('.remove-cart-item').click(function(){
       
        var current=$(this);
        var product_id=$(this).attr('value');
        
        $.ajax({
            type: "POST",
            url: 'cart-action.php',
            data: {
                product_id:product_id,
                action:'remove-cart-item'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                if(resp.valid == true) {
                    current.closest('.cart-items').hide();
                }
                $('.cart-success').html('<h5><strong><i class="fa-regular fa-circle-check"></i></i> Sucess! </strong> <br />Removed from Cart.</h5>');
                $('.action-success').show().delay(3000).fadeOut();
            }
        });
    });

    //trigger remove from cart
    $('.remove-all-cart-btn').click(function(){
        
        $('#confirm-remove-all-cart').click();
    });

    $('#remove-all-cart-items').click(function(){
        var current=$(this);

        $.ajax({
            type: "POST",
            url: 'cart-action.php',
            data: {
                action:'remove-all-cart-items'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                console.log(response);
                if(resp.valid == true) {
                    location.reload();
                    $('.cart-success').html('<h5><strong><i class="fa-regular fa-circle-check"></i></i> Sucess! </strong> <br />Removed from Cart.</h5>');
                    $('.action-success').show().delay(3000).fadeOut();
                }
            }
        });
    });
});
