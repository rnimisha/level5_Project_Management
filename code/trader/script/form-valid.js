$(document).ready(function(){
    // alert('trader form');

    $('#personal-form').submit(function(){

        //button value change
        jQuery('#personal-button').text('Saving...');
        jQuery('#personal-button').attr('disabled', true);

        var fullname=$('#trad-fullname').val();
        var traderemail=$('#trad-email').val();
        var contact=$('#trad-contact').val();
        var dob=$('#trad-dob').val();
        var address=$('#trad-address').val();
        var trader_id=$('#trad-id').val();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                fullname: fullname,
                traderemail: traderemail,
                contact: contact,
                dob: dob,
                address: address,
                trader_id:trader_id,
                form_name: 'personal-form'
            },
            success: function(response){
                console.log(response);
                // alert('success inside form');
                var resp=jQuery.parseJSON(response);
                console.log(resp);
                jQuery('#personal-button').text('Save Changes');
                jQuery('#personal-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    // resetForm('personal-form');
                    $('#profile-sucess-msg').addClass('was-validated');
                    $('#profile-sucess-msg').html('Changes has been saved successfully.');
                    inlineMsg(resp);
                    
                }
                else{
                    // alert('success inside form');
                    inlineMsg(resp);
                }
            }
        });
        //prevent page reload
        return false;
    });
    
});