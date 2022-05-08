$(document).ready(function(){

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

    $('').slick({
        slidesToShow: 3,
        slidesToScroll: 3
      });

    $('.related-product-slider').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 2,
        responsive: [
            {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
            },
            {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
            },
            {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
            }
        ]
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

