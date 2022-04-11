// for customer regsitration form
$(document).ready(function(){
    $("#cust-reg-form").submit(function(){
        // alert("hello");

        //change button while submitting
        jQuery('#reg-btn').val('Submitting..');
        jQuery('#reg-btn').attr('disabled', true);
        //data to be passed
        var fullname=$('#fullname').val();
        var useremail=$('#useremail').val();
        var pword=$('#pword').val();
        var repass=$('#repass').val();
        var contact=$('#contact').val();
        var dob=$('#dob').val();
        var address=$('#address').val();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                fullname: fullname,
                useremail: useremail,
                pword: pword,
                repass: repass,
                contact: contact,
                dob: dob,
                address: address,
                registercust: 'yes'

            },
            
            success: function(response){
                //success ajax reposnse
                console.log(response);
                jQuery('#reg-btn').val('Register');
                jQuery('#reg-btn').attr('disabled', false);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    resetForm('cust-reg-form');
                    $('#reg-sucess-msg').html('Please check your email to activate account');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });
        //prevent page reload
        return false;
    });

    //live validation for email
    $("#useremail").keyup(function(){
        // alert("hello");

        var useremail=$('#useremail').val();

        $.ajax({
            type: "POST",
            url: 'validateCustomer.php',
            data: {
                useremail: useremail

            },
            
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });

        return false;
    });

    //live validation for fullname
    $("#fullname").keyup(function(){
        // alert("hello");

        var fullname=$('#fullname').val();

        $.ajax({
            type: "POST",
            url: 'validateCustomer.php',
            data: {
                fullname: fullname

            },
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });

        return false;
    });

    //live validation for password
    $("#pword").keyup(function(){

        var pword=$('#pword').val();

        $.ajax({
            type: "POST",
            url: 'validateCustomer.php',
            data: {
                pword: pword

            },
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });

        return false;
    });

    //live validation for re entered password
    $("#repass").keyup(function(){

        var repass=$('#repass').val();
        var pword=$('#pword').val();

        $.ajax({
            type: "POST",
            url: 'validateCustomer.php',
            data: {
                repass: repass,
                pword: pword

            },
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });

        return false;
    });

    //live validation foraddress
    $("#address").keyup(function(){

        var address=$('#address').val();

        $.ajax({
            type: "POST",
            url: 'validateCustomer.php',
            data: {
                address: address
            },
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });

        return false;
    });

    //live validation for contact
    $("#contact").keyup(function(){

        var contact=$('#contact').val();

        $.ajax({
            type: "POST",
            url: 'validateCustomer.php',
            data: {
                contact: contact
            },
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });

        return false;
    });


    //live validation for dob
    $("#dob").keyup(function(){

        var dob=$('#dob').val();

        $.ajax({
            type: "POST",
            url: 'validateCustomer.php',
            data: {
                dob: dob
            },
            success: function(response){
                // console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
                else{
                    $('#reg-sucess-msg').html('');
                    inlineMsg(resp);
                }
            }
        });

        return false;
    });



});


