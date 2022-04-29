$(document).ready(function(){

    //jquery function for price range
    $(function() {
        $("#price-range").slider({
          step: 1,
          range: true, 
          min: 0, 
          max: 1000, 
          values: [0, 1000], 
          slide: function(event, ui)
          {$("#priceRange").val('\u00A3' +ui.values[0] + " - " +'\u00A3' + ui.values[1]);}
        });
        $("#priceRange").val('\u00A3' + $("#price-range").slider("values", 0) + " - " + '\u00A3'+ $("#price-range").slider("values", 1));
        
    });

    $(".cat-product").hover(function(){
        $(this).find('.option-container').css("visibility", "visible");
        $(this).find('.option-container2').css("visibility", "visible");
        $(this).find('.option-container').css("transform", "scale(1.5)");
        $(this).find('.option-container2').css("transform", "translate(-15px)");
        $(this).find('.product-pic').css("padding", "25px");

    }, function(){
        $(this).find('.option-container').css("transform", "scale(0)");
        $(this).find('.option-container2').css("transform", "translate(10px)");
        $(this).find('.option-container2').css("visibility", "hidden");
        $(this).find('.product-pic').css("padding", "15px");
        $(this).find('.option-container').css("visibility", "hidden");

    });

});
