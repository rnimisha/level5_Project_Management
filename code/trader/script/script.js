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

        //show settings
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
        //hide picture form
        if(!$('#picture-form').hasClass('d-none'))
        {
            $('#picture-form').addClass('d-none');
        }

        $('#page-link').text("Personal");
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

        $('#page-link').text("Picture");

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
        if($('#password-form').hasClass('d-none'))
        {
            $('#password-form').removeClass('d-none');
        }
        //hide password form
        if(!$('#picture-form').hasClass('d-none'))
        {
            $('#picture-form').addClass('d-none');
        }
        //hide picture form
        if(!$('#personal-form').hasClass('d-none'))
        {
            $('#personal-form').addClass('d-none');
        }

        $('#page-link').text("Password");
    });
});