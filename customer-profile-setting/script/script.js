$(document).ready(function(){ 
    $('.profile-success').hide();

    // ------------customer password update------------
    //post password form data
    $('#update-password-form').submit(function(){
        //button value change
        jQuery('#change-pass-btn').text('Saving...');
        jQuery('#change-pass-btn').attr('disabled', true);

        var old_pass=$('#cust-old-pass').val();
        var new_pass=$('#cust-new-pass').val();
        var re_pass=$('#cust-re-pass').val();
        var customer_id=$('#customer-id').val();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                old_pass:old_pass,
                new_pass:new_pass,
                re_pass:re_pass,
                customer_id:customer_id,
                form_name: 'update-password-form',
                run_query: 't'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                jQuery('#change-pass-btn').text('Save Changes');
                jQuery('#change-pass-btn').attr('disabled', false);
                if(resp.clear == true)
                {
                    resetForm('update-password-form');
                    removeStyle(resp);
                    $('.profile-success').html('<h5><strong><i class="fa-regular fa-circle-check"></i></i> Sucess! </strong> <br />Password has been updated.</h5>');
                    $('.profile-success').show().delay(5000).fadeOut();
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        return false;
    });

    $('#cust-old-pass').keyup(function(){
        var old_pass=$('#cust-old-pass').val();
        var customer_id=$('#customer-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                old_pass:old_pass,
                customer_id:customer_id,
                form_name: 'update-password-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#cust-new-pass').keyup(function(){
        var new_pass=$('#cust-new-pass').val();
        var customer_id=$('#customer-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                new_pass:new_pass,
                customer_id:customer_id,
                form_name: 'update-password-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#cust-re-pass').keyup(function(){
        var new_pass=$('#cust-new-pass').val();
        var re_pass=$('#cust-re-pass').val();
        var customer_id=$('#customer-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                new_pass:new_pass,
                re_pass:re_pass,
                customer_id:customer_id,
                form_name: 'update-password-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    /*------ Customer personal information change--------*/
    $('#cust-personal-form').submit(function(){
    
        jQuery('#cust-personal-button').text('Saving...');
        jQuery('#cust-personal-button').attr('disabled', true);

        var fullname=$('#cust-fullname').val();
        var customeremail=$('#cust-email').val();
        var contact=$('#cust-contact').val();
        var dob=$('#cust-dob').val();
        var address=$('#cust-address').val();
        var customer_id=$('#cust-id').val();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                fullname: fullname,
                customeremail: customeremail,
                contact: contact,
                dob: dob,
                address: address,
                customer_id:customer_id,
                form_name: 'cust-personal-form',
                run_query: 't'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                
                jQuery('#cust-personal-button').text('Save Changes');
                jQuery('#cust-personal-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    clearFormValidation();
                    removeStyle(resp);
                    if(resp.emailchange==true)
                    {
                        $('#check-email-msg').show().delay(5000).fadeOut();
                        $('.profile-success').html('<h5><strong><i class="fa-regular fa-circle-check"></i></i> Sucess! </strong> <br />Please check email to confirm new email.</h5>');
                        $('.profile-success').show().delay(5000).fadeOut();
                    }
                    else{
                        $('#personal-sucess-msg').show().delay(5000).fadeOut();
                        $('.profile-success').html('<h5><strong><i class="fa-regular fa-circle-check"></i></i> Sucess! </strong> <br />Informations updated successfully.</h5>');
                        $('.profile-success').show().delay(5000).fadeOut();
                    }
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        return false;
    });
});