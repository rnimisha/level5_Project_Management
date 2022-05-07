// $(window).on("load",function(){
//     $(".loader").fadeOut(1000);
//     $(".container-fluid").fadeIn(1000);
// });

// reset form data 
function resetForm(formID){
    document.getElementById(formID).reset();
}

//display inline message
function inlineMsg(resp){
    for(const key in resp){
        $(key).html(resp[key]);

        //change style
        if(resp[key] == 'is-invalid')
        {
            if(!$(key).hasClass('is-invalid'))
            {
                $(key).addClass('is-invalid');
            }
            if($(key).hasClass('is-valid')) 
            {
                $(key).removeClass('is-valid');
            }
        }
        else if(resp[key] == 'valid'){
            if($(key).hasClass('is-invalid'))
            {
                $(key).removeClass('is-invalid');
            }
            if(!$(key).hasClass('is-valid'))
            {
                $(key).addClass('is-valid');
            }
        }
    }
}

function removeStyle(resp)
{
    for(const key in resp){
        $(key).html(resp[key]);
        if(resp[key] == 'valid')
        {
            if($(key).hasClass('is-valid')) 
            {
                $(key).removeClass('is-valid');
            }
            if($(key).hasClass('is-invalid')) 
            {
                $(key).removeClass('is-invalid');
            }
        }
    }
}

function changeTraderPic(img_name)
{
    $("#changing-profile").attr("src",img_name);
    $("#profile-picture").attr("src",img_name);
    $("#profile-header").attr("src",img_name);
    $("#about-profile").attr("src",img_name);
}

function clearFormValidation()
{
    if($('.form-control').hasClass('is-invalid'))
    {
        $('.form-control').removeClass('is-invalid');
    }
    if($('.form-control').hasClass('is-valid'))
    {
        $('.form-control').removeClass('is-valid');
    }
}

//get all the values checked in array for filtering
function getFilterValue(filter_class)
{
    var filteredValue=[];
    $('.'+filter_class+':checked').each(function(){
        filteredValue.push($(this).val());
    });
  
    return filteredValue;
}


$('body').addClass('transition-effect');