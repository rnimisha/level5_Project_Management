$(document).ready(function(){

    //jquery ui function for price range
    $(function() {
        $("#price-range").slider({
            step: 1,
            range: true, 
            min: 0, 
            max: 1000, 
            values: [0, 1000], 
            slide: function(event, ui)
            {
                $("#min-price").text(ui.values[0]);
                $("#max-price").text(ui.values[1]);
            }
        });
        $("#min-price").text($("#price-range").slider("values", 0));
        $("#max-price").text($("#price-range").slider("values", 1));
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


    //post selected filter to php
    $(".filter-selection").click(function(){
        var category=getFilterValue('check-category');
        $.ajax({
            type: "POST",
            url: 'filter-product.php',
            data: {
                category:category,
                form_name: 'filter-product'
            },
            success: function(response){
                // console.log(response);
                $('.product-display').html(response);
            }
        });
        //prevent page reload
        // return false;
    });
});
