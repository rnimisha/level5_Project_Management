
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

//confirm before signing out
// $(document).ready(function(){
//     $('.confirm-logout').click(function(){
//         if (confirm('Do you want to sign out?')) 
//         {
//         
//         } 
//     });
// });

//jquery function for price range
$(function() {
    $("#price-range").slider({
      step: 500,
      range: true, 
      min: 0, 
      max: 10000, 
      values: [0, 10000], 
      slide: function(event, ui)
      {$("#priceRange").val('\u00A3' +ui.values[0] + " - " +'\u00A3' + ui.values[1]);}
    });
    $("#priceRange").val('\u00A3' + $("#price-range").slider("values", 0) + " - " + '\u00A3'+ $("#price-range").slider("values", 1));
    
});