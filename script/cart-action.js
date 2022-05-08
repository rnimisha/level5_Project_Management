$('.action-success').hide();
$(document).ready(function(){

    var minimum_val=1;
    $('.plus').click(function(){
        var stock=$('#stock-amount').val();
        if(stock > minimum_val)
        {
            minimum_val++;
            $('#real-quantity').val(minimum_val);
            $('.quantity').text(minimum_val);
        }
        else{

            alert('There are no further quantity in stock to add in cart');
        }
        
    })

    $('.minus').click(function(){
        var current_val=$('#real-quantity').val();
        if(current_val > 1){
            current_val--;
            $('#real-quantity').val(current_val);
            $('.quantity').text(current_val);
        }
        else{
            alert('Quantity cannot be less than 1');
        }
    })

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

    
});

