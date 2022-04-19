
// reset form data 
function resetForm(formID){
    document.getElementById(formID).reset();
}

//display inline message
function inlineMsg(resp){
    for(const key in resp){
        $(key).html(resp[key]);
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