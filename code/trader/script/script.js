$(document).ready(function(){
    $("#left-toggle").click(function(){
        var navigation = $("#nav1");
        var container = $(".main-container");

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

    });
});