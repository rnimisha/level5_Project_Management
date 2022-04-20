$(document).ready(function(){
    // alert('trader form');
    $('#personal-sucess-msg').hide();
    $('#profile-sucess-msg').hide();
    $('#pass-sucess-msg').hide();

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
                // console.log(resp);
                jQuery('#personal-button').text('Save Changes');
                jQuery('#personal-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    // resetForm('personal-form');
                    $('#personal-form').addClass('was-validated');
                    removeStyle(resp);
                    $('#personal-sucess-msg').show();
                    $('#profile-sucess-msg').hide();
                    $('#pass-sucess-msg').hide();
                }
                else{
                    jQuery('#pass-button').text('Save Changes');
                    jQuery('#pass-button').attr('disabled', false);
                    // alert('success inside form');
                    inlineMsg(resp);
                }
            }
        });
        //prevent page reload
        return false;
    });


    $('#password-form').submit(function(){

        //button value change
        jQuery('#pass-button').text('Saving...');
        jQuery('#pass-button').attr('disabled', true);

        var old_pass=$('#trad-old-pass').val();
        var new_pass=$('#trad-new-pass').val();
        var re_pass=$('#trad-re-pass').val();
        var trader_id=$('#trader-id').val();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                old_pass:old_pass,
                new_pass:new_pass,
                re_pass:re_pass,
                trader_id:trader_id,
                form_name: 'pass-form'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                console.log(resp);
                jQuery('#pass-button').text('Save Changes');
                jQuery('#pass-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    resetForm('password-form');
                    $('#picture-form').addClass('was-validated');
                    $('#personal-sucess-msg').hide();
                    $('#profile-sucess-msg').hide();
                    $('#pass-sucess-msg').show();
                    removeStyle(resp);
                }
                else{
                    jQuery('#pass-button').text('Save Changes');
                    jQuery('#pass-button').attr('disabled', false);
                    inlineMsg(resp);
                }
            }
        });
        //prevent page reload
        return false;
    });
    
});