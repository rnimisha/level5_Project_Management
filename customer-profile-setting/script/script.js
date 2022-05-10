$(document).ready(function(){ 
    $('.profile-success').hide();


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
                    $('.profile-success').show().delay(3000).fadeOut();
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        return false;
    });
});