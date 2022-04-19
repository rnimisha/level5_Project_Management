$(document).ready(function(){
    // alert('trader form');

    $('#personal-form').submit(function(){
        var fullname=$('#trad-fullname').val();
        var traderemail=$('#trad-email').val();
        var contact=$('#trad-contact').val();
        var dob=$('#trad-dob').val();
        var address=$('#address').val();
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
                console.log(resp);
                if(resp.clear == true)
                {
                    resetForm('personal-form');
                    $('#profile-sucess-msg').html('Changes has been saved successfully.');
                    inlineMsg(resp);
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
    
});