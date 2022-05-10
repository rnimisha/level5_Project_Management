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

    $('#cust-fullname').keyup(function(){

        var fullname=$('#cust-fullname').val();
        var customer_id=$('#cust-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                fullname: fullname,
                customer_id:customer_id,
                form_name: 'cust-personal-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });
    $('#cust-email').keyup(function(){

        var customeremail=$('#cust-email').val();
        var customer_id=$('#cust-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                customeremail: customeremail,
                customer_id:customer_id,
                form_name: 'cust-personal-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#cust-contact').keyup(function(){

        var contact=$('#cust-contact').val();
        var customer_id=$('#cust-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                contact: contact,
                customer_id:customer_id,
                form_name: 'cust-personal-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#cust-dob').keyup(function(){

        var dob=$('#cust-dob').val();
        var customer_id=$('#cust-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                dob: dob,
                customer_id:customer_id,
                form_name: 'cust-personal-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#cust-address').keyup(function(){

        var address=$('#cust-address').val();
        var customer_id=$('#cust-id').val();

        $.ajax({
            type: "POST",
            url: "validate-profile.php",
            data: {
                address: address,
                customer_id:customer_id,
                form_name: 'cust-personal-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    /*----------customer profile change-----------*/
    $('#new-profile-pic').change(function(){
        $('#new-profile-pic').removeClass('is-invalid');
        var file=this.files[0];
        var imgfile=file.type;
        var match=["image/jpeg", "image/png", "image/jpg"];
        if(!((imgfile==match[0]) || (imgfile==match[1]) || (imgfile==match[2])))
        {
            $('#new-profile-pic').addClass('is-invalid');
            $('#error-new-prod-pic').text("Please select valid image");
            return false;
        }
        else
        {
            $('#preview-cust-pp').click();
            $('#new-profile-pic').addClass('valid');
            $('#error-new-prod-pic').text("");
            var reader=new FileReader();
            reader.onload=loadProfile;
            reader.readAsDataURL(this.files[0]);
        }
    });


    function loadProfile(e)
    {
        $('#cust-preview').attr('src', e.target.result);
        $('#cust-preview').css('width', '250px');
        $('#cust-preview').css('height', '250px');
    }

    $('#upload-profile-confirm').click(function(){
        $('#change-cust-pp-form').submit();
    });

    $('#change-cust-pp-form').submit(function(){

        //button value change
        jQuery('#change-profile-pic-btn').text('Changing...');
        jQuery('#change-profile-pic-btn').attr('disabled', true);

        //for file
        var formData= new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response);
                var resp=response;
                jQuery('#change-profile-pic-btn').text('Change Profile');
                jQuery('#change-profile-pic-btn').attr('disabled', false);
                if(resp.clear == true){

                    var img_name=resp.pic_name;
                    $(".cust-profile-img").attr("src",img_name);
                    $(".changing-profile").attr("src",img_name);
                    $('.profile-success').html('<h5><strong><i class="fa-regular fa-circle-check"></i></i> Sucess! </strong> <br />Profile change successfully.</h5>');
                    $('.profile-success').show().delay(5000).fadeOut();
                }
                else{
                    alert('Could not change profile');
                }
            }
        });
        //prevent page reload
        return false;
    });
});

$('body').addClass('transition-effect');