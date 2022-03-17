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
                address: address

            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
            }
        });

        return false;
    });
});