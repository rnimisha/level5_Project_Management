$(document).ready(function(){
    $('#contact-us-form').submit(function(){

        jQuery('#contact-btn').val('Sending..');
        jQuery('#contact-btn').attr('disabled', true);

        var firstname=$('#firstname').val();
        var lastname=$('#lastname').val();
        var useremail=$('#useremail').val();
        var contact=$('#contact').val();
        var message=$('#message').val();

        $.ajax({

            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                firstname: firstname,
                lastname: lastname,
                useremail: useremail,
                contact: contact,
                message: message,
                contactform: 'yes'
            },
            success: function(response){
                console.log(response);
                jQuery('#contact-btn').val('Send..');
                jQuery('#contact-btn').attr('disabled', false);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
                    resetForm('contact-us-form');
                    $('#contact-sucess-msg').html('Your message has been sent.');
                    inlineMsg(resp);

                }
                else{
                    $('#contact-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }            
        });
        return false;
    });
});