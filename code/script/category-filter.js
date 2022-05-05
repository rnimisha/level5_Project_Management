$(document).ready(function(){

    //jquery ui function for price range
    $(function() {
        $("#price-range").slider({
            
            step: 1,
            range: true, 
            min: 0, 
            max: 100, 
            values: [0, 1000], 
            slide: function(event, ui)
            {
                $("#min-price").text(ui.values[0] + ' -  ');
                $("#min-price").val(ui.values[0]);
                $("#min-input").val(ui.values[0]);

                $('.hide-div').hide();

                $("#max-price").text(ui.values[1]);
                $("#max-price").val(ui.values[1]);
                $("#max-input").val(ui.values[1]);


            }
        });

        var minimum= $("#min-input").val();
        var maximum= $("#max-input").val();
        $("#min-price").text(minimum);
        $("#min-input").val($("#price-range").slider("values", 0));
        $("#max-input").val($("#price-range").slider("values", 1));
        $("#max-price").text(maximum);
       
    });

    // $("#price-range").mouseup(function(){
    //    $('#price-filter-form').submit();
    // });

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


    //click submit
    $(".filter-selection").click(function(){
        $('#submit-filter').click();
    });


    $('#clear-filter').click(function(){
        $('.filter-selection').prop('checked', false);
    })

    $("#sort-product-option").change(function(){
        $('#submit-filter').click();
    });


    //show quick view modal on clicking icon
    $('.quick-view-product').click(function(){
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

            alert('There are no further quantity in stock');
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
});
