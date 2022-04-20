$(document).ready(function(){
    // alert('trader form');
    $('#personal-sucess-msg').hide();
    $('#profile-sucess-msg').hide();
    $('#pass-sucess-msg').hide();

    $('#personal-form').submit(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();
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
                    $('#personal-sucess-msg').show();
                    $('#profile-sucess-msg').hide();
                    $('#pass-sucess-msg').hide();
                    removeStyle(resp);
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


    $('#password-form').submit(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();

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
                var resp=jQuery.parseJSON(response);
                jQuery('#pass-button').text('Save Changes');
                jQuery('#pass-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    resetForm('password-form');
                    $('#personal-sucess-msg').hide();
                    $('#profile-sucess-msg').hide();
                    $('#pass-sucess-msg').show();
                    removeStyle(resp);
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        //prevent page reload
        return false;
    });

    //submit form on change
    $('#trad-pic').change(function(){
        if (confirm('Do you want to upload the image?')) {
            $('#picture-form').submit();
        } 
    });

    $('#picture-form').submit(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();

        //button value change
        jQuery('#profile-button').text('Changing...');
        jQuery('#profile-button').attr('disabled', true);

        //for file
        var formData= new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: "JSON",
            contentType: false, //multipart/formdata
            processData: false, //not obj nor string
            success: function(response){
                var resp=response;
                jQuery('#profile-button').text('Change Profile');
                jQuery('#profile-button').attr('disabled', false);
                if(resp.clear == true){
                    $('#personal-sucess-msg').hide();
                    $('#profile-sucess-msg').show();
                    $('#pass-sucess-msg').hide();
                    $('#error-trad-pic').html("");
                    //change image 
                    var img_name=resp.pic_name;
                    changeTraderPic(img_name);
                }
                else{
                    $('#pass-sucess-msg').hide();
                    $('#error-trad-pic').html('<div class="alert alert-danger mt-4 mb-2 w-75 mx-auto"><strong>Error! </strong>'+response.error+'.</div>');
                }
            }
        });
        //prevent page reload
        return false;
    });

    //submit form on change
    $('#del-trad-pic').click(function(){
        if (confirm('Do you want to delete your avtar?')) {
            $('#profile-del-button').submit();
        } 
    });
});