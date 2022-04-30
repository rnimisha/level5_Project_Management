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
        $(this).find('.option-container2').css("visibility", "visible");
        $(this).find('.option-container').css("transform", "scale(1.4)");
        $(this).find('.option-container2').css("transform", "translate(-15px)");
        $(this).find('.product-pic').css("padding", "25px");

    }, function(){
        $(this).find('.option-container').css("transform", "scale(0)");
        $(this).find('.option-container2').css("transform", "translate(10px)");
        $(this).find('.option-container2').css("visibility", "hidden");
        $(this).find('.product-pic').css("padding", "15px");
        $(this).find('.option-container').css("visibility", "hidden");

    });


    //post selected filter to php
    $(".filter-selection").click(function(){
        var category=getFilterValue('check-category');
        
    });
});
