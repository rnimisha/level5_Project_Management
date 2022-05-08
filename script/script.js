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
});


//effect on first img selected
$('.mini-img-container').first().addClass('active-img');