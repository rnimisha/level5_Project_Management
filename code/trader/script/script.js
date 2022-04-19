$(document).ready(function(){
    $("#left-toggle").click(function(){
        var navigation = $("#nav1");
        if (navigation.hasClass("col-lg-2")) {
            $("#nav1").removeClass("col-lg-2");
            $("#nav1").removeClass("col-md-3");
            $("#nav1").addClass("col-md-1");
            $('.hide-text').hide();
            $(".main-container").removeClass("col-md-9");
            $(".main-container").removeClass("col-lg-10");
            $(".main-container").addClass("col-md-11");

            $('#right-toggle').removeClass('d-none');
            $('#right-toggle').addClass('d-block');

            $('#left-toggle').removeClass('d-block');
            $('#left-toggle').addClass('d-none');
        }
    });
});