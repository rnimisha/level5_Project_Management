$(document).ready(function(){
    // alert('trader form');

    $('#personal-form').submit(function(){
        var fullname=$('#trad-fullname').val();
        var traderemail=$('#trad-email').val();
        var contact=$('#trad-contact').val();
        var dob=$('#trad-dob').val();
        var address=$('#address').val();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                fullname: fullname,
                traderemail: traderemail,
                contact: contact,
                dob: dob,
                address: address,
                form_name: 'personal-form'
            },
            success: function(response){
                console.log(response);
                // alert('success inside form');

            }
        });
        //prevent page reload
        // return false;
    });
});