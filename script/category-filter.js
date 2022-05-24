$(window).on("load",function(){
    $(".loader").fadeOut(1000);
    $(".container-fluid").fadeIn(1000);
});
$(document).ready(function(){
    $('.action-success').hide();
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


    $(".banner-text").hover(function(){
        $('#text-img-banner').css("transform", "scale(1.1)");

    }, function(){
        $('#text-img-banner').css("transform", "scale(1)");
    });

    $("#text-img-banner").hover(function(){
        $('#text-img-banner').css("transform", "scale(1.1)");

    }, function(){
        $('#text-img-banner').css("transform", "scale(1)");
    });


    $('#grid-view-product').click(function(){

        $('#view-type').val('grid');
        if(!$('#grid-view-product').hasClass('active-view')){
            $('#grid-view-product').addClass('active-view');
        }

        if($('#list-view-product').hasClass('active-view')){
            $('#list-view-product').removeClass('active-view');
        }

        if($('.grid-view-container').hasClass('d-none')){
            $('.grid-view-container').removeClass('d-none');
        }

        if(!$('.grid-view-container').hasClass('d-flex')){
            $('.grid-view-container').addClass('d-flex');
        }

        if(!$('.list-view-container').hasClass('d-none')){
            $('.list-view-container').addClass('d-none');
        }

        if($('.list-view-container').hasClass('d-flex')){
            $('.list-view-container').removeClass('d-flex');
        }
        $('#submit-filter').click();
    });


    $('.filter-mini-btn').click(function(){
        alert(1);
        $('#filter-option').css({"display":'flex'});
    });

    $('#list-view-product').click(function(){

        $('#view-type').val('list');
        if(!$('#list-view-product').hasClass('active-view')){
            $('#list-view-product').addClass('active-view');
        }

        if($('#grid-view-product').hasClass('active-view')){
            $('#grid-view-product').removeClass('active-view');
        }

        if($('.grid-view-container').hasClass('d-flex')){
            $('.grid-view-container').removeClass('d-flex');
        }

        if(!$('.grid-view-container').hasClass('d-none')){
            $('.grid-view-container').addClass('d-none');
        }

       
        if($('.list-view-container').hasClass('d-none')){
            $('.list-view-container').removeClass('d-none');
        }

        if(!$('.list-view-container').hasClass('d-flex')){
            $('.list-view-container').addClass('d-flex');
        }
        $('#submit-filter').click();
        
    });

    $('.page-link').click(function(){
        $page=$(this).attr('value');
        $('#page-value').val($page);
        $('#submit-filter').click();
    });
 
    $('#price-filter').click(function(){
        $('#submit-filter').click();
    });
});
