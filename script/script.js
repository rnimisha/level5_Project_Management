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

            $('.cart-msg').html('<div class="alert alert-danger pop-msg " role="alert"><h5><strong><i class="bx bx-error-circle"></i> Failure!</strong> <br />No more stock available to add.</h5></div>').delay(4000).fadeOut();
            $('.cart-msg').show();
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
            $('.cart-msg').html('<div class="alert alert-danger pop-msg " role="alert"><h5><strong><i class="bx bx-error-circle"></i> Failure!</strong> <br />Quantity cant be less than 1.</h5></div>').delay(4000).fadeOut();
            $('.cart-msg').show();
        }
    })

    var total_cart_items= parseInt($('#total-item-count').attr('value'));
    var overallsubtotal= parseFloat($('.over-all-subtotal').attr('value'));
    $('.plus-cart').click(function(e){
        var stock= parseInt($(this).closest('.wrapper').find('#stock-amount').val());
        var max_order= parseInt($(this).closest('.wrapper').find('.maximum-order').val());
        var minimum_val_cart= parseInt($(this).closest('.wrapper').find('#real-quantity').val());
        var price=parseFloat($(this).closest('.cart-items').find('.individual-price').attr('value'));
        if(stock > minimum_val_cart)
        {
            if(max_order > minimum_val_cart)
            {
                minimum_val_cart++;
                $(this).closest('.wrapper').find('#real-quantity').val(minimum_val_cart);
                $(this).closest('.wrapper').find('.quantity').text(minimum_val_cart);
                subtotal = (price*minimum_val_cart).toFixed(2);
                $(this).closest('.cart-items').find('.each-subtotal').html("<span>&#163;</span>"+subtotal);

                overallsubtotal = overallsubtotal + price;
                $('.over-all-subtotal').html("<span>&#163;</span>"+overallsubtotal.toFixed(2));
                $('.total-with-disc').html("<span>&#163;</span>"+overallsubtotal.toFixed(2));
                $('#subtotal_coupon').val(overallsubtotal.toFixed(2));
                var pid= parseInt($(this).closest('.wrapper').find('.cart-product-id').val());
                changeQuantity(minimum_val_cart, pid);

                total_cart_items++;
                $('#total-item-count').html('Total items : '+total_cart_items);
                $('#total-item-count').attr('value', total_cart_items);
            }
            else{

                $('.cart-msg').html('<div class="alert alert-danger pop-msg " role="alert"><h5><strong><i class="bx bx-error-circle"></i> Failure!</strong> <br />You can buy maximum of '+max_order+'.</h5></div>').delay(4000).fadeOut();
                $('.cart-msg').show();
            }
        }
        else{

            $('.cart-msg').html('<div class="alert alert-danger pop-msg " role="alert"><h5><strong><i class="bx bx-error-circle"></i> Failure!</strong> <br />No more stock available.</h5></div>').delay(4000).fadeOut();
            $('.cart-msg').show();
        }
        
    })

    $('.minus-cart').click(function(){
        var current_val=  parseFloat($(this).closest('.wrapper').find('#real-quantity').val());
        var min_order= parseInt($(this).closest('.wrapper').find('.mimimum-order').val());
        var price=parseFloat($(this).closest('.cart-items').find('.individual-price').attr('value'));
        if(current_val > min_order){
            current_val--;
            $(this).closest('.wrapper').find('#real-quantity').val(current_val);
            $(this).closest('.wrapper').find('.quantity').text(current_val);

            subtotal=(parseFloat($(this).closest('.cart-items').find('.individual-price').attr('value'))*current_val).toFixed(2);
            $(this).closest('.cart-items').find('.each-subtotal').html("<span>&#163;</span>"+subtotal);

            var pid= parseInt($(this).closest('.wrapper').find('.cart-product-id').val());
            changeQuantity(current_val, pid);

            overallsubtotal = overallsubtotal - price;
            $('#subtotal_coupon').val(overallsubtotal.toFixed(2));
            $('.over-all-subtotal').html("<span>&#163;</span>"+overallsubtotal.toFixed(2));
            $('.total-with-disc').html("<span>&#163;</span>"+overallsubtotal.toFixed(2));

            total_cart_items--;
            $('#total-item-count').html('Total items : '+total_cart_items);
            $('#total-item-count').attr('value', total_cart_items);

        }
        else{
            $('.cart-msg').html('<div class="alert alert-danger pop-msg " role="alert"><h5><strong><i class="bx bx-error-circle"></i> Failure!</strong> <br />Item cannot be less than '+min_order+'.</h5></div>').delay(4000).fadeOut();
            $('.cart-msg').show();
        }
    })

    $('.go-to-cart').click(function(){
        window.location.href = 'cart-page.php';
    });

    $('.continue-shopping').click(function(){
        $('.close-cart-success').click();
    });

    $('.write-review').click(function(){
        var prod_id=$(this).attr('value');

        $.ajax({
            type: "POST",
            url: "customer-profile-setting//submit-review.php",
            data: {
                product_id:prod_id,
                action: 'write-review'
            },
            success: function(response){
                console.log(response);
    
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    window.location.href = 'customer-profile-setting\\my-review-page.php';
             
                }
                else{
                    if(resp.error == 'login')
                    {
                        $('.dynamic-body').html("<b>You need to login to review a product</b>");
                        $('#dynamic-msg').click();
                    }
                    if(resp.error == 'buy')
                    {
                        $('.dynamic-body').html("<b>You need to make a purchase in order to review</b>");
                        $('#dynamic-msg').click();
                    }
                    
                }
            }
        });
        //prevent page reload
        return false;
    })

    //check checkout quantity limit
    $('.checkout-btn').click(function(){
        var total_items=$('#total-item-count').attr('value');
        if(total_items>20)
        {
            $('.dynamic-body').html("<b>You cannot buy more than 20 items at one purchase</b>");
            $('#dynamic-msg').click();
        }
        else if(total_items == 0){
            $('.dynamic-body').html("<b>Your cart is empty</b>");
            $('#dynamic-msg').click();
        }
        else{

            
            window.location.href = 'checkout.php';
        }
    });

    $('#select-collection-slot').change(function(){
        $("#select-collect-time option").removeAttr('disabled');

        $("#select-collect-time option[value=0]").prop({selected: true});

        $("#select-collect-time option[value=0]").attr('disabled','disabled');

        var day_selected=$('#select-collection-slot').val();
        var today_day=$('#today_day').val();
        var today_date=$('#current_hour').val();
        
        if(today_day == 'TUE')
        {
            if(day_selected == 'WED')
            {
                disableOption(today_date);
            }
        }

        if(today_day == 'WED')
        {
            if(day_selected == 'THU')
            {
                disableOption(today_date);
            }
        }
        if(today_day == 'THU')
        {
            if(day_selected == 'FRI')
            {
                disableOption(today_date);
            }
        }
        $('.collect-time-container').removeClass('d-none');
    });

    $('.check-collection').click(function(){
        var day_selected= $('#select-collection-slot').val();
        var time_selected=$("#select-collect-time").val();
        var buynow=$('#purchase-type').val();

        // alert(day_selected);
        // alert(time_selected);
        if(day_selected == null && time_selected == null )
        {
            $('.fail-container').html('<div class="alert alert-warning pop-msg py-4" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Please Select Collection Slot before payment.</div>').delay(4000).fadeOut();
            $('.fail-container').show();

        } 
        else{
            $.ajax({
                type: "POST",
                url: "check-out-valid.php",
                data: {
                    day_selected:day_selected,
                    time_selected:time_selected,
                    buynow:buynow,
                    action: 'save-detail'
                },
                success: function(response){
                    // $('#make-payment').submit();
                    $('.payment-container').removeClass('d-none');
                }
            });
        }
    });

    $('#submit-report-btn').click(function(){
        $('#review-form').submit();
    });

    $('.report-product').click(function(){
        var product_id=$(this).attr('value');
  
        $.ajax({
            type: "POST",
            url: 'report-product.php',
            data: {
                product_id:product_id,
                action:'report-product'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.valid == false) {
                    if(resp.error == 'login')
                    {
                        $('.dynamic-body').html("<b>You need to login to review a product</b>");
                        $('#dynamic-msg').click();
                    }
                }
                else{
                    $('#report_prod_id').val(product_id);
                    $('#report-modal-btn').click();
                }
            }
        });
    });

    $('#review-form').submit(function(){
        var product_id=$('#report_prod_id').val();
        var message=$('#prod-report').val();
        jQuery('#submit-report-btn').text('Submitting...');
        jQuery('#submit-report-btn').attr('disabled', true);
        $.ajax({
            type: "POST",
            url: 'report-product.php',
            data: {
                product_id:product_id,
                message:message,
                action:'report-product-submit'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                jQuery('#submit-report-btn').text('Submit');
                jQuery('#submit-report-btn').attr('disabled', false);
                if(resp.clear == true)
                {
                    removeStyle(resp);
                    $('.close-report').click();
                    $('.succ-msg').html('<div class="alert alert-succes pop-msg py-4" role="alert"><i class="fa-regular fa-circle-check"></i> Your report has been submitted.</div>').delay(4000).fadeOut();
                    $('.succ-msg').show();
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        // return false;
    });

    $(".search-icon").mouseover(function(){
        $('.search-icon').addClass('d-none');
        $('.search-bar').removeClass('d-none');
    
    });
    
    $(".search-bar").mouseleave(function(){
        $('.search-icon').removeClass('d-none');
        $('.search-bar').addClass('d-none');
    });
    
    $('#text-filter').submit(function(){
        var text=$('#ftext').val();
        window.location.href = 'category-page.php?ftext='+text;
        return false;
    });

    $('.navbar-light .navbar-nav .nav-link').click(function(){
        $('.navbar-light .navbar-nav .nav-link').css('color', '#000000');
        $(this).css('color', '#78967e');
    })

    $(".user-hover").mouseover(function(){
        $('.dropdownmenu').removeClass('d-none');
        $('.dropdownmenu').addClass('d-block');
    });

    $(".dropdownmenu").mouseleave(function(){
        $('.dropdownmenu').addClass('d-none');
        $('.dropdownmenu').removeClass('d-block');
    });

    $(".text-in-banner").hover(function(){
        $('#text-img-banner').css("transform", "scale(1.1)");

    }, function(){
        $('#text-img-banner').css("transform", "scale(1)");
    });
    $('.action-success').css({"opacity":"1"});
});

//effect on first img selected
$('.mini-img-container').first().addClass('active-img');

 $(window).on("load",function(){
    $(".loader").fadeOut(1000);
    $(".container-fluid").fadeIn(1000);
});
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
