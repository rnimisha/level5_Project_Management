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
                contactform: 'yes',
                submitform: 'yes'
            },
            success: function(response){
                console.log(response);
                jQuery('#contact-btn').val('Send');
                jQuery('#contact-btn').attr('disabled', false);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
                    resetForm('contact-us-form');

                    inlineMsg(resp);
                    if(!$('.contact-us-container').hasClass('d-none'))
                    {
                        $('.contact-us-container').addClass('d-none');
                    }
                    if($('.contact-us-sent').hasClass('d-none'))
                    {
                        $('.contact-us-sent').removeClass('d-none');
                    }

                }
                else{
                    $('#contact-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }            
        });
        return false;
    });

    //live validation

    $('#firstname').keyup(function(){

        var firstname=$('#firstname').val();

        $.ajax({

            type: "POST",
            url: 'validate-contactus.php',
            data: {
                firstname: firstname,
                contactform: 'yes',
                submitform: 'no'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
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

    $('#lastname').keyup(function(){

        var lastname=$('#lastname').val();

        $.ajax({

            type: "POST",
            url: 'validate-contactus.php',
            data: {
                lastname: lastname,
                contactform: 'yes',
                submitform: 'no'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
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

    $('#useremail').keyup(function(){

        var useremail=$('#useremail').val();
        $.ajax({

            type: "POST",
            url: 'validate-contactus.php',
            data: {
                useremail: useremail,
                contactform: 'yes',
                submitform: 'no'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
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

    $('#contact').keyup(function(){

        var contact=$('#contact').val();
        $.ajax({

            type: "POST",
            url: 'validate-contactus.php',
            data: {
                contact: contact,
                contactform: 'yes',
                submitform: 'no'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
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

    $('#message').keyup(function(){

        var message=$('#message').val();

        $.ajax({

            type: "POST",
            url: 'validate-contactus.php',
            data: {
                message: message,
                contactform: 'yes',
                submitform: 'no'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
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