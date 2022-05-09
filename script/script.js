$(document).ready(function(){

    //show quick view modal on clicking icon
    var click_count=0;
    $('.quick-view-product').click(function(){
        click_count++;
        var product_id=$(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'quick-view.php',
            data: {
               product_id:product_id,
               type: 'quick-view'
            },
            success: function(response){
                $('.quick-view-body').html(response);
                $('#quick-view').click();
            }
        });
        //prevent protocol stack overload
        if(click_count>6){
            location.reload();
            // $('#submit-filter').click();
        }
    });


    //change product detail image shown
    $('.mini-img').click(function(){
        $imgname=$(this).attr('src');
        $('.bigger-img').attr('src',$imgname);
        $('.mini-img-container').removeClass('active-img');
        $(this).parent().addClass('active-img');
    });

    $("#sort-review-option").change(function(){
        $review_option=$("#sort-review-option").val();
        if($review_option == 'top')
        {
                showTopReviews();
        }
        if($review_option == 'recent')
        {
        
                showRecentReviews();
                
        }
    });

    $('.description-nav').click(function(){

        if($('.prod-descp-div').hasClass('d-none'))
        {
            $('.prod-descp-div').removeClass('d-none');
        }

        if(!$('.prod-allergy-div').hasClass('d-none'))
        {
            $('.prod-allergy-div').addClass('d-none');
        }

        if(!$('.prod-review-div').hasClass('d-none'))
        {
            $('.prod-review-div').addClass('d-none');
        }

        $('.detail-nav').removeClass('active-detail-nav');
        if(!$('.description-nav').hasClass('active-detail-nav'))
        {
            $('.description-nav').addClass('active-detail-nav');
        }
    });

    $('.allergy-nav').click(function(){

        if($('.prod-allergy-div').hasClass('d-none'))
        {
            $('.prod-allergy-div').removeClass('d-none');
        }

        if(!$('.prod-descp-div').hasClass('d-none'))
        {
            $('.prod-descp-div').addClass('d-none');
        }

        if(!$('.prod-review-div').hasClass('d-none'))
        {
            $('.prod-review-div').addClass('d-none');
        }

        $('.detail-nav').removeClass('active-detail-nav');
        if(!$('.allergy-nav').hasClass('active-detail-nav'))
        {
            $('.allergy-nav').addClass('active-detail-nav');
        }
    });

    $('.review-nav').click(function(){

        if($('.prod-review-div').hasClass('d-none'))
        {
            $('.prod-review-div').removeClass('d-none');
        }

        if(!$('.prod-descp-div').hasClass('d-none'))
        {
            $('.prod-descp-div').addClass('d-none');
        }

        if(!$('.prod-allergy-div').hasClass('d-none'))
        {
            $('.prod-allergy-div').addClass('d-none');
        }
        
        $('.detail-nav').removeClass('active-detail-nav');
        if(!$('.review-nav').hasClass('active-detail-nav'))
        {
            $('.review-nav').addClass('active-detail-nav');
        }
    });

    $('.cat-product-container').click(function(e){
        if ($(e.target).hasClass('quick-view-product')) return;
        if ($(e.target).hasClass('add-to-cart')) return;
        if ($(e.target).hasClass('save-to-wishlist')) return;
        if ($(e.target).hasClass('remove-from-wishlist')) return;
        var product_id=$(this).attr('value');
        window.location.href = 'product-detail-page.php?pid='+product_id;
    });

    //show cartand wishlist option on hover
    $(".cat-product").hover(function(){
        $(this).find('.option-container').css("visibility", "visible");
        $(this).find('.option-container').css("transform", "scale(1.4)");
        $(this).find('.product-pic').css("padding", "25px");

    }, function(){
        $(this).find('.option-container').css("transform", "scale(0)");
        $(this).find('.product-pic').css("padding", "15px");
        $(this).find('.option-container').css("visibility", "hidden");

    });

    $(".list-view-container").hover(function(){
        $(this).find('.product-pic').css("padding", "25px");

    }, function(){
        $(this).find('.product-pic').css("padding", "15px");
    });

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

    
    $('.plus-cart').click(function(e){

        var stock= parseInt($(this).closest('.wrapper').find('#stock-amount').val());
        var minimum_val_cart= parseInt($(this).closest('.wrapper').find('#real-quantity').val());
  
        if(stock > minimum_val_cart)
        {
            minimum_val_cart++;
            $(this).closest('.wrapper').find('#real-quantity').val(minimum_val_cart);
            $(this).closest('.wrapper').find('.quantity').text(minimum_val_cart);
        }
        else{

            alert('There are no further quantity in stock to add in cart');
        }
        
    })

    $('.minus-cart').click(function(){
        var current_val=  parseInt($(this).closest('.wrapper').find('#real-quantity').val());
        if(current_val > 1){
            current_val--;
            $(this).closest('.wrapper').find('#real-quantity').val(current_val);
            $(this).closest('.wrapper').find('.quantity').text(current_val);
        }
        else{
            alert('Quantity cannot be less than 1');
        }
    })

    $('.go-to-cart').click(function(){
        window.location.href = 'cart-page.php';
    });

    $('.continue-shopping').click(function(){
        $('.close-cart-success').click();
    });
});


//effect on first img selected
$('.mini-img-container').first().addClass('active-img');


function showRecentReviews()
{
    
    if($('.newest-review').hasClass('d-none')){
        $('.newest-review').removeClass('d-none');
    }
    if(!$('.top-rated-review').hasClass('d-none')){
        $('.top-rated-review').addClass('d-none');
    }
}

function showTopReviews()
{
    
    if(!$('.newest-review').hasClass('d-none')){
        $('.newest-review').addClass('d-none');
    }
    if($('.top-rated-review').hasClass('d-none')){
        $('.top-rated-review').removeClass('d-none');
    }
}

