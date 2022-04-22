$(document).ready(function(){
    $("#left-toggle").click(function(){
        var navigation = $("#nav1");
        var container = $(".main-container");

        navigation.addClass('ease-out');
        container.addClass('ease-out');
        // change navigation
        if (navigation.hasClass("col-lg-2")){
            if(navigation.hasClass("col-md-3")){
                $("#nav1").removeClass("col-lg-2");
                $("#nav1").removeClass("col-md-3");
                $("#nav1").addClass("col-md-1");
                $('.hide-text').hide();
                $('.nav-list').addClass('text-center');
            }
        }
        //change container width
        if(container.hasClass("col-md-9")){
            if(container.hasClass("col-lg-10")){
                $(".main-container").removeClass("col-md-9");
                $(".main-container").removeClass("col-lg-10");
                $(".main-container").addClass("col-md-11");
            }
        }

        //change icon
        if($('#right-toggle').hasClass("d-none")){
            $('#right-toggle').removeClass('d-none');
            $('#right-toggle').addClass('d-block');
        }
        if($('#left-toggle').hasClass('d-block')){
            $('#left-toggle').removeClass('d-block');
            $('#left-toggle').addClass('d-none');
        }

        //change image size
        $('#profile-picture').css({'width' : '35px' , 'height' : '35px'});
    });

    $("#right-toggle").click(function(){
        var navigation = $("#nav1");
        var container = $(".main-container");

        // change navigation
        if (navigation.hasClass("col-md-1")){
            $("#nav1").removeClass("col-md-1");
            $("#nav1").addClass("col-lg-2");
            $("#nav1").addClass("col-md-3");
            $('.hide-text').show();
            $('.nav-list').removeClass('text-center');
        }
        //change container width
        if(container.hasClass("col-md-11")){
            $(".main-container").removeClass("col-md-11");
            $(".main-container").addClass("col-md-9");
            $(".main-container").addClass("col-lg-10");
        }

        //change icon
        if($('#right-toggle').hasClass("d-block")){
            $('#right-toggle').removeClass('d-block');
            $('#right-toggle').addClass('d-none');
        }
        if($('#left-toggle').hasClass('d-none')){
            $('#left-toggle').removeClass('d-none');
            $('#left-toggle').addClass('d-block');
        }

        //change back image size
        $('#profile-picture').css({'width' : '75px' , 'height' : '75px'});
    });

    //change to setting
    $("#setting-div").click(function(){
        if(!$("#setting-div").hasClass('active-form')){

            $("#setting-div").addClass('active-form');
        }
        if($('#about-me-div').hasClass('active-form'))
        {
            $('#about-me-div').removeClass('active-form');
        }
        
        //hide about me 
        if($('#about-me').hasClass('d-flex'))
        {
            $('#about-me').removeClass('d-flex');
        }
        if(!$('#about-me').hasClass('d-none'))
        {
            $('#about-me').addClass('d-none');
        }

        //hide password form
        if(!$('#password-form').hasClass('d-none'))
        {
            $('#password-form').addClass('d-none');
        }
        //hide personal form
        if(!$('#personal-form').hasClass('d-none'))
        {
            $('#personal-form').addClass('d-none');
        }
        if( $('#pass-change').hasClass("active-list"))
        {
            //remove active line
            $('#pass-change').removeClass('active-list');
        }
        if( $('#personal').hasClass("active-list"))
        {
            //remove active line
            $('#personal').removeClass('active-list');
        }

        //show settings
        $('#settings').addClass('transition-effect')
        if($('#settings').hasClass('d-none'))
        {
            $('#settings').removeClass('d-none');
        }

        //add active line to picture form
        if(!$('#picture').hasClass('active-list'))
        {
            $('#picture').addClass('active-list');
        }

        //display picture form
        if($('#picture-form').hasClass('d-none'))
        {
            $('#picture-form').removeClass('d-none');
        }

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-index.php" ><b>My Profile</b></a></li><li class="breadcrumb-item"><a href="#">Settings</a></li><li class="breadcrumb-item active" aria-current="page">Avatar</li>');
    });

    //change to about me
    $("#about-me-div").click(function(){
        if(!$("#about-me-div").hasClass('active-form')){

            $("#about-me-div").addClass('active-form');
        }
        if($('#setting-div').hasClass('active-form'))
        {
            $('#setting-div').removeClass('active-form');
        }
        
        //hide settings
        if(!$('#settings').hasClass('d-none'))
        {
            $('#settings').addClass('d-none');
        }

        //hide picture form
        if(!$('#picture-form').hasClass('d-none'))
        {
            $('#picture-form').addClass('d-none');
        }

        //show about-me
        $('#about-me').addClass('transition-effect');
        if($('#about-me').hasClass('d-none'))
        {
            $('#about-me').removeClass('d-none');
        }
        if(!$('#about-me').hasClass('d-flex'))
        {
            $('#about-me').addClass('d-flex');
        }

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-index.php" ><b>My Profile</b></a></li><li class="breadcrumb-item active"><a href="#">About Me</a></li><li class="breadcrumb-item" aria-current="page"></li>');
    });

    //change setting form
    $('#personal').click(function(){
        if( $('#pass-change').hasClass("active-list"))
        {
            //remove active line
            $('#pass-change').removeClass('active-list');
        }
        if( $('#picture').hasClass("active-list"))
        {
            //remove active line
            $('#picture').removeClass('active-list');
        }

        //add active line
        $('#personal-form').addClass('transition-effect')
        if(!$('#personal').hasClass('active-list'))
        {
            $('#personal').addClass('active-list');
        }
        //display personal form
        if($('#personal-form').hasClass('d-none'))
        {
            $('#personal-form').removeClass('d-none');
        }
        //hide password form
        if(!$('#password-form').hasClass('d-none'))
        {
            $('#password-form').addClass('d-none');
        }
        //hide picture form
        if(!$('#picture-form').hasClass('d-none'))
        {
            $('#picture-form').addClass('d-none');
        }

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-index.php" ><b>My Profile</b></a></li><li class="breadcrumb-item"><a href="#">Settings</a></li><li class="breadcrumb-item active" aria-current="page">Personal</li>');
    });

    $('#picture').click(function(){
        if( $('#pass-change').hasClass("active-list"))
        {
            //remove active line
            $('#pass-change').removeClass('active-list');
        }
        if( $('#personal').hasClass("active-list"))
        {
            //remove active line
            $('#personal').removeClass('active-list');
        }

        //add active line
        if(!$('#picture').hasClass('active-list'))
        {
            $('#picture').addClass('active-list');
        }

        //display picture form
        $('#picture-form').addClass('transition-effect');
        if($('#picture-form').hasClass('d-none'))
        {
            $('#picture-form').removeClass('d-none');
        }
        //hide password form
        if(!$('#password-form').hasClass('d-none'))
        {
            $('#password-form').addClass('d-none');
        }
        //hide personal form
        if(!$('#personal-form').hasClass('d-none'))
        {
            $('#personal-form').addClass('d-none');
        }

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-index.php" ><b>My Profile</b></a></li><li class="breadcrumb-item "><a href="#">Settings</a></li><li class="breadcrumb-item active" aria-current="page">Avatar</li>');

    });

    $('#pass-change').click(function(){
        if( $('#picture').hasClass("active-list"))
        {
            //remove active line
            $('#picture').removeClass('active-list');
        }
        if( $('#personal').hasClass("active-list"))
        {
            //remove active line
            $('#personal').removeClass('active-list');
        }

        //add active line
        if(!$('#pass-change').hasClass('active-list'))
        {
            $('#pass-change').addClass('active-list');
        }

        //display password form
        $('#password-form').addClass('transition-effect');
        if($('#password-form').hasClass('d-none'))
        {
            $('#password-form').removeClass('d-none');
        }
        //hide pic form
        if(!$('#picture-form').hasClass('d-none'))
        {
            $('#picture-form').addClass('d-none');
        }
        //hide personal form
        if(!$('#personal-form').hasClass('d-none'))
        {
            $('#personal-form').addClass('d-none');
        }

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-index.php" ><b>My Profile</b></a></li><li class="breadcrumb-item"><a href="#">Settings</a></li><li class="breadcrumb-item active" aria-current="page">Password</li>');
    });

    $('.view-order-detail').click(function(){
        
        var order_id=$(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'view-order.php',
            data: {
               order_id: order_id
            },
            success: function(response){
                $('#order-detail-table').addClass('transition-effect');
                // alert(response);
                if(!$('#order-table').hasClass('d-none'))
                {
                    $('#order-table').addClass('d-none');
                }
                if($('#order-detail-table').hasClass('d-none'))
                {
                    $('#order-detail-table').removeClass('d-none');
                }
                $('#order-detail-table').html(response);

                $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-order.php" ><b>Order</b></a></li><li class="breadcrumb-item active"><a href="#">Details</a></li>');

            }
        });
    });

    $('.edit-product').click(function(){
        var product_id=$(this).attr('value');
        // alert(product_id);
        $.ajax({
            type: 'POST',
            url: 'get-details.php',
            data: {
               product_id: product_id,
               product_modal:'yes'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
                    $('#product-modal').click();
                    $(".edit-product-form #product_id").val( product_id );
                    $(".edit-product-form #product-name").val( resp.name );
                    $(".edit-product-form #product-stock").val( resp.quantity );
                    $(".edit-product-form #product-price").val( resp.price);
                    $(".edit-product-form #product-unit").val( resp.unit);
                    $(".edit-product-form #product-min").val( resp.min);
                    $(".edit-product-form #product-max").val( resp.max);
                    $(".edit-product-form #product-descp").val( resp.descp);
                    $(".edit-product-form #product-allergy").val( resp.allergy);
                }
                else{
                    alert('unable to edit the product');

                }
            }
        });
    });

});
$('body').addClass('transition-effect');

