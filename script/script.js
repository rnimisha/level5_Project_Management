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

