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
                // console.log(response);
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

    $('.view-cust-order-detail').click(function(){

        var order_id=$(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'view-order-detail.php',
            data: {
               order_id: order_id
            },
            success: function(response){
                if(!$('.all-orders-container').hasClass('d-none'))
                {
                    $('.all-orders-container').addClass('d-none');
                }
                if(!$('.recieved-container').hasClass('d-none'))
                {
                    $('.recieved-container').addClass('d-none');
                }
                if(!$('.to-recieve-container').hasClass('d-none'))
                {
                    $('.to-recieve-container').addClass('d-none');
                }
                if($('.one-detail-container').hasClass('d-none'))
                {
                    $('.one-detail-container').removeClass('d-none');
                }
               
                $('.one-detail-container').html(response);

            }
        });
    });

    $('.all-order-select').click(function(){
        $('.all-orders-container').removeClass('d-none');
        $('.recieved-container').addClass('d-none');
        $('.to-recieve-container').addClass('d-none');
        $('.one-detail-container').addClass('d-none');

        $('.all-order-select').addClass('my-green-font');
        $('.recieved-select').removeClass('my-green-font');
        $('.to-recieve-select').removeClass('my-green-font');

    });

    $('.to-recieve-select').click(function(){
        $('.all-orders-container').addClass('d-none');
        $('.recieved-container').addClass('d-none');
        $('.to-recieve-container').removeClass('d-none');
        $('.one-detail-container').addClass('d-none');

        $('.all-order-select').removeClass('my-green-font');
        $('.recieved-select').removeClass('my-green-font');
        $('.to-recieve-select').addClass('my-green-font');
    });

    $('.recieved-select').click(function(){
        $('.all-orders-container').addClass('d-none');
        $('.recieved-container').removeClass('d-none');
        $('.to-recieve-container').addClass('d-none');
        $('.one-detail-container').addClass('d-none');

        $('.all-order-select').removeClass('my-green-font');
        $('.recieved-select').addClass('my-green-font');
        $('.to-recieve-select').removeClass('my-green-font');
    });

    var rating=-1;
    $('.rate-star').click(function(){
        rating=parseInt($(this).data('index'));
        rating=rating+1;
        $('#star-rating').val(rating);
    });

    $('.rate-star').mouseover(function(){
        $('.rate-star').css("color", "black");
        var index=parseInt($(this).data('index'));
        for(var i=0; i<=index; i++)
        {
            $('.rate-star:eq('+i+')').css("color", "#dac775");

        }

    });

    $('.rate-star').mouseleave(function(){
        $('.rate-star').css("color", "black");
        if(rating != -1)
        {
            rating--;
            for(var i=0; i<=rating ;i++)
            {
                $('.rate-star:eq('+i+')').css("color", "#dac775");
            }
        }
    });

    $('.add-review').click(function(){
        var p_id=$(this).attr('value');
        $('#review_prod_id').val(p_id);
        $('#show-review-form-btn').click();
    });

    $('#submit-review-btn').click(function(){
        $('#review-form').submit();
    });

    $('#review-form').submit(function(){
        jQuery('#submit-review-btn').text('Submitting...');
        jQuery('#submit-review-btn').attr('disabled', true);

        var prod_id=$('#review_prod_id').val();
        var cust_id=$('#u_id').val();
        var star=$('#star-rating').val();
        var comment=$('#prod-review').val();

        $.ajax({
            type: 'POST',
            url: 'submit-review.php',
            data: {
               prod_id:prod_id,
               cust_id:cust_id,
               star:star,
               comment:comment,
               form_name: 'review-form',
            },
            success: function(response){
                jQuery('#submit-review-btn').text('Submit');
                jQuery('#submit-review-btn').attr('disabled', false);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
                    removeStyle(resp);
                    $('.profile-success').html('<h5><strong><i class="fa-regular fa-circle-check"></i></i> Sucess! </strong> <br />Your Review has been submitted.</h5>');
                    $('.profile-success').show().delay(5000).fadeOut();
                    $('.close-review').click();
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        return false;
    });

    $('.reviewed-select').click(function(){
        $('.to-review-container').addClass('d-none');
        $('.reviewed-container').removeClass('d-none');

        $('.to-review-select').removeClass('my-green-font');
        $('.reviewed-select').addClass('my-green-font');
    });

    $('.to-review-select').click(function(){
        $('.to-review-container').removeClass('d-none');
        $('.reviewed-container').addClass('d-none');

        $('.reviewed-select').removeClass('my-green-font');
        $('.to-review-select').addClass('my-green-font');
    });

    $('#track-order-form').submit(function(){
        jQuery('#track-order-btn').text('Tracking...');
        jQuery('#track-order-btn').attr('disabled', true);
        // alert(1);
        var cust_id=$('#u_id').val();
        var order_id=$('#track-order-no').val();
        $.ajax({
            type: 'POST',
            url: 'validate-profile.php',
            data: {
               order_id:order_id,
               cust_id:cust_id,
               form_name: 'track-order-form',
            },
            success: function(response){
                jQuery('#track-order-btn').text('Track');
                jQuery('#track-order-btn').attr('disabled', false);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
                    // resetForm('track-order-form');
                    removeStyle(resp);
                    if(resp.status == 'COMPLETED')
                    {
                        $('.completed-container').removeClass('d-none');
                        $('.track-order-container').addClass('d-none');
                        $('.pending-container').addClass('d-none');
                        $('.processing-container').addClass('d-none');
                    }
                    if(resp.status == 'PROCESSING')
                    {
                        $('.completed-container').addClass('d-none');
                        $('.track-order-container').addClass('d-none');
                        $('.pending-container').addClass('d-none');
                        $('.processing-container').removeClass('d-none');
                    }
                    if(resp.status == 'PENDING')
                    {
                        $('.completed-container').addClass('d-none');
                        $('.track-order-container').addClass('d-none');
                        $('.pending-container').removeClass('d-none');
                        $('.processing-container').addClass('d-none');
                    }
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        return false;
    });

    $('#deactivate-account').click(function(){
        $('#deactivate-account').text('Deactivating...');
        $('#deactivate-account').attr('disabled', false);

        $.ajax({
            type: 'POST',
            url: 'validate-profile.php',
            data: {
               form_name: 'deactivate-cust-acc',
            },
            success: function(response){
                $('#deactivate-account').text('Deactivate');
                $('#deactivate-account').attr('disabled', true);
                var resp=jQuery.parseJSON(response);
                if(resp.clear == true)
                {
                    window.location.href = 'account-deactivate-success.php';
                }
                else{
                    alert("There were some errors while deactivating.");
                }
            }
        });
        return false;
    });
});

$('body').addClass('transition-effect');