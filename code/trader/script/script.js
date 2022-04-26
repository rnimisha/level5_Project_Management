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

    //change div for pass word change
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

    //view orderdetails of clicked order in new div
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

    //populate product detail edit form with values of current product
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
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
                    // alert(response);
                    $("#product_id").val( product_id );
                    $("#p_id").val( product_id );
                    $("#product-name").val( resp.name );
                    $("#product-stock").val( resp.quantity );
                    $("#product-price").val( resp.price);
                    $("#product-unit").val( resp.unit);
                    $("#product-min").val( resp.min);
                    $("#product-max").val( resp.max);
                    $("#product-descp").val( resp.descp);
                    $("#product-allergy").val( resp.allergy);
                    $('#product-category option[value="' + resp.category +'"]').prop('selected',true);
                    
                    if( $('#product-photo').hasClass("active-list"))
                    {
                        //remove active line
                        $('#product-photo').removeClass('active-list');
                    }

                    //add active line
                    if(!$('#product-general').hasClass('active-list'))
                    {
                        $('#product-general').addClass('active-list');
                    }

                    if($('#product-edit-form').hasClass('d-none'))
                    {
                        $('#product-edit-form').removeClass('d-none');
                    }
                    
                    if(!$('#product-detail-table').hasClass('d-none'))
                    {
                        $('#product-detail-table').addClass('d-none');
                    }  


                    $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-product.php" ><b>Product</b></a></li><li class="breadcrumb-item active"><a href="#">Edit General</a></li>');
                }
                else{
                    alert('unable to edit the product');

                }
            }
        });
    });


    //change container on click
    $('#product-general').click(function(){
        if( $('#product-photo').hasClass("active-list"))
        {
            //remove active line
            $('#product-photo').removeClass('active-list');
        }

        //add active line
        if(!$('#product-general').hasClass('active-list'))
        {
            $('#product-general').addClass('active-list');
        }

        if($('#edit-product-form').hasClass('d-none'))
        {
            $('#edit-product-form').removeClass('d-none');
        }
        
        if(!$('#prod-pic-form').hasClass('d-none'))
        {
            $('#prod-pic-form').addClass('d-none');
        }  


        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-product.php" ><b>Product</b></a></li><li class="breadcrumb-item active"><a href="#">Edit General</a></li>');
    });

    $('#product-photo').click(function(){
        if( $('#product-general').hasClass("active-list"))
        {
            //remove active line
            $('#product-general').removeClass('active-list');
        }

        //add active line
        if(!$('#product-photo').hasClass('active-list'))
        {
            $('#product-photo').addClass('active-list');
        }

        if($('#prod-pic-form').hasClass('d-none'))
        {
            $('#prod-pic-form').removeClass('d-none');
        }
        
        if(!$('#edit-product-form').hasClass('d-none'))
        {
            $('#edit-product-form').addClass('d-none');
        }  


        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-product.php" ><b>Product</b></a></li><li class="breadcrumb-item active"><a href="#">Edit Photo</a></li>');
    });

    //data to php to delete product 
    $('.delete-product').click(function(){
        var product_id=$(this).attr('value');
        if (confirm('Do you want to delete the product?')) 
        {
            $.ajax({
                url: 'deleteProduct.php?prodID='+product_id,
                success: function(response){
                    // alert(response);
                    location.reload();
                }
            });
            //prevent page reload
            return false;
        }
        else{
            return false;
        }
    });

    //view details of clicked product in new div
    $('.view-product-detail').click(function(){
        
        var product_id=$(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'view-product.php',
            data: {
               product_id: product_id
            },
            success: function(response){
                $('#product-detail-table').addClass('transition-effect');
                // alert('s');
                if(!$('#add-prod-row').hasClass('d-none'))
                {
                    $('#add-prod-row').addClass('d-none');
                }
                if(!$('#product-table').hasClass('d-none'))
                {
                    $('#product-table').addClass('d-none');
                }
                if($('#product-detail-table').hasClass('d-none'))
                {
                    $('#product-detail-table').removeClass('d-none');
                }
                $('#product-detail-table').html(response);

                $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-product.php" ><b>Product</b></a></li><li class="breadcrumb-item active"><a href="#">Details</a></li>');

            }
        });
    });

    $('#add-prod-btn').click(function(){
        // alert(1);
        $('#product-detail-form').addClass('transition-effect');
        if(!$('#product-detail-table').hasClass('d-none'))
        {
            $('#product-detail-table').addClass('d-none');
        }
        if($('#product-detail-form').hasClass('d-none'))
        {
            $('#product-detail-form').removeClass('d-none');
        }

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-product.php" ><b>Product</b></a></li><li class="breadcrumb-item active"><a href="#">Add Product</a></li>');

    });

    $('.add-discount').click(function(){
        $('#add-discount-form').addClass('transition-effect');
        if(!$('#product-detail-table').hasClass('d-none'))
        {
            $('#product-detail-table').addClass('d-none');
        }
        if($('#add-discount-form').hasClass('d-none'))
        {
            $('#add-discount-form').removeClass('d-none');
        }
        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-product.php" ><b>Product</b></a></li><li class="breadcrumb-item active"><a href="#">Add Discount</a></li>');

        var product_id=$(this).attr('value');
        $("#prod-id").val( product_id );

    });

    $('#add-shop-btn').click(function(){

        var shopcount=$(this).attr("value");
        if(shopcount>2)
        {
            alert("You cant register more than two active shops");
        }
        else{
            $('#add-shop-form').addClass('transition-effect');
        if(!$('#shop-detail-table').hasClass('d-none'))
        {
            $('#shop-detail-table').addClass('d-none');
        }
        if($('#add-shop-container').hasClass('d-none'))
        {
            $('#add-shop-container').removeClass('d-none');
        }
        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-shop.php" ><b>Shop</b></a></li><li class="breadcrumb-item active"><a href="#">Add Shop</a></li>');
        }
    });

    //populate edit shop form 
    $('.edit-shop').click(function(){
        var shop_id=$(this).attr('value');
        $("#edit_shop_id").val(shop_id);
        $("#logo_shop_id").val(shop_id);

        if( $('#shop-photo').hasClass("active-list"))
        {
            //remove active line
            $('#shop-photo').removeClass('active-list');
        }

        //add active line
        if(!$('#shop-general').hasClass('active-list'))
        {
            $('#shop-general').addClass('active-list');
        }

        if($('#shop-edit-form').hasClass('d-none'))
        {
            $('#shop-edit-form').removeClass('d-none');
        }
        
        if(!$('#shop-detail-table').hasClass('d-none'))
        {
            $('#shop-detail-table').addClass('d-none');
        }  
        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-shop.php" ><b>Shop</b></a></li><li class="breadcrumb-item active"><a href="#">Edit General</a></li>');
    });

    //change to logo edit form
    $('#shop-photo').click(function(){

        if( $('#shop-general').hasClass("active-list"))
        {
            //remove active line
            $('#shop-general').removeClass('active-list');
        }

        //add active line
        if(!$('#shop-photo').hasClass('active-list'))
        {
            $('#shop-photo').addClass('active-list');
        }

        if($('#shop-pic-form').hasClass('d-none'))
        {
            $('#shop-pic-form').removeClass('d-none');
        }
        
        if(!$('#edit-shop-form').hasClass('d-none'))
        {
            $('#edit-shop-form').addClass('d-none');
        }  

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-shop.php" ><b>Shop</b></a></li><li class="breadcrumb-item active"><a href="#">Edit Logo</a></li>');
    });

    //change to shop name edit form
    $('#shop-general').click(function(){

        if( $('#shop-logo').hasClass("active-list"))
        {
            //remove active line
            $('#shop-logo').removeClass('active-list');
        }

        //add active line
        if(!$('#shop-general').hasClass('active-list'))
        {
            $('#shop-general').addClass('active-list');
        }

        if($('#edit-shop-form').hasClass('d-none'))
        {
            $('#edit-shop-form').removeClass('d-none');
        }
        
        if(!$('#shop-pic-form').hasClass('d-none'))
        {
            $('#shop-pic-form').addClass('d-none');
        }  

        $('#trad-breadcrumb').html('<li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li><li class="breadcrumb-item"><a href="trader-shop.php" ><b>Shop</b></a></li><li class="breadcrumb-item active"><a href="#">Edit General</a></li>');
    });

    //data to php to deactivate shop
    $('.delete-shop').click(function(){
        var shop_id=$(this).attr('value');
        if (confirm('Do you want to disable the shop?')) 
        {
            $.ajax({
                url: 'deleteShop.php?shopID='+shop_id,
                success: function(response){
                    location.reload();
                }
            });
            //prevent page reload
            return false;
        }
        else{
            return false;
        }
    });

    //change opacity on hover
    // $(".td-discount").mouseenter(function(){
    //     $('.hover-edit').css('opacity', '1');
    // });

    // $(".td-discount").mouseleave(function(){
    //     $('.hover-edit').css('opacity', '0');
    // });


    $(".prod-view-img").mouseenter(function(){
        $('.hover-edit').css('opacity', '1');
    });

    $(".td-discount").mouseleave(function(){
        $('.hover-edit').css('opacity', '0');
    });


});



$('body').addClass('transition-effect');
