
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
}
