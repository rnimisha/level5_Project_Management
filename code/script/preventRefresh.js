// for customer regsitration form
$(document).ready(function(){
    $("#cust-reg-form").submit(function(){
        // alert("hello");

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
                console.log(response);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true) {
                    resetForm('cust-reg-form');
                    $('#reg-sucess-msg').html('You have been sucessfully registered');
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

    // $("#useremail").keyup(function(){
    //     // alert("hello");

    //     var useremail=$('#useremail').val();

    //     $.ajax({
    //         type: "POST",
    //         url: 'validateCustomer.php',
    //         data: {
    //             useremail: useremail

    //         },
            
    //         success: function(response){
    //             // console.log(response);
    //             var resp=jQuery.parseJSON(response);
    //             if(resp.clear == true) {
    //                 $('#reg-sucess-msg').html('');
    //                 inlineMsg(resp);
    //             }
    //             else{
    //                 $('#reg-sucess-msg').html('');
    //                 inlineMsg(resp);
    //             }
    //         }
    //     });

    //     return false;
    // });

    // $("#fullname").keyup(function(){
    //     // alert("hello");

    //     var fullname=$('#fullname').val();

    //     $.ajax({
    //         type: "POST",
    //         url: 'validateCustomer.php',
    //         data: {
    //             fullname: fullname,

    //         },
    //         success: function(response){
    //             // console.log(response);
    //             var resp=jQuery.parseJSON(response);
    //             if(resp.clear == true) {
    //                 $('#reg-sucess-msg').html('');
    //                 inlineMsg(resp);
    //             }
    //             else{
    //                 $('#reg-sucess-msg').html('');
    //                 inlineMsg(resp);
    //             }
    //         }
    //     });

    //     return false;
    // });


});


