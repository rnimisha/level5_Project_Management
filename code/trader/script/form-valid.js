$(document).ready(function(){ 
    //hide success mesages
    $('#personal-sucess-msg').hide();
    $('#profile-sucess-msg').hide();
    $('#pass-sucess-msg').hide();
    $('#discount-sucess-msg').hide();
    $('#product-edit-sucess-msg').hide();
    $('#shop-edit-sucess-msg').hide();
    $('#shop-logo-sucess-msg').hide();

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

    //post password form data
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
            $('#picture-form-up').submit();
        } 
    });

    //post 
    $('#picture-form-up').submit(function(){
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


    $('#picture-form-del').submit(function(){
        if (confirm('Do you want to delete the image?')) 
        {
            $('#personal-sucess-msg').hide();
            $('#profile-sucess-msg').hide();
            $('#pass-sucess-msg').hide();

            //button value change
            jQuery('#profile-del-button').text('Deleting...');
            jQuery('#profile-del-button').attr('disabled', true);

            var trader_id=$('#trader-id-profile').val();
            // alert(1);
            $.ajax({
                
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: {
                    trader_id: trader_id,
                    edit_type: 'delete_pic'
                },
                success: function(response){
                    var resp=jQuery.parseJSON(response);
                    jQuery('#profile-del-button').text('Delete Profile');
                    jQuery('#profile-del-button').attr('disabled', false);
                    if(resp.clear == true){
                        // console.log(response);
                        $('#personal-sucess-msg').hide();
                        $('#profile-sucess-msg').show();
                        $('#pass-sucess-msg').hide();
                        $('#error-trad-pic').html("");
                        //change image 
                        var img_name=resp.pic_name;
                        changeTraderPic(img_name);
                    }
                    else{
                        // alert(response);
                        $('#pass-sucess-msg').hide();
                    }
                }
            });
            //prevent page reload
            return false;
        } 
        else
        {
            return false;
        }
    });

    // post details to edit product details
    $('#edit-product-form').submit(function(){
        //button value change

        jQuery('#edit-prod-button').text('Saving...');
        jQuery('#edit-prod-button').attr('disabled', true);

        var product_id=$('#product_id').val();
        var name=$('#product-name').val();
        var stock=$('#product-stock').val();
        var price=$('#product-price').val();
        var unit=$('#product-unit').val();
        var min=$('#product-min').val();
        var max=$('#product-max').val();
        var descp=$('#product-descp').val();
        var allergy=$('#product-allergy').val();
        var cat_id=$('#product-category').val();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                product_id:product_id,
                name:name,
                stock,stock,
                price:price,
                unit:unit,
                min:min,
                max:max,
                descp:descp,
                allergy:allergy,
                cat_id:cat_id,
                form_name: 'edit-product-form'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
               
                jQuery('#edit-prod-button').text('Save Changes');
                jQuery('#edit-prod-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    $('#product-edit-sucess-msg').show();
                    $('#product-img-sucess-msg').hide();
                    $('#close-modal').click();
                    removeStyle(resp);
                    // location.reload();
                }
                else{
                    // alert('not success inside form');
                    inlineMsg(resp);
                }
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#close-modal').click(function(){
        clearFormValidation();
    });

    //details to add product
    $('#add-product-form').submit(function(){
        jQuery('#add-prod-button').text('Adding...');
        jQuery('#add-prod-button').attr('disabled', true);

        var name=$('#add-product-name').val();
        var stock=$('#add-product-stock').val();
        var price=$('#add-product-price').val();
        var unit=$('#add-product-unit').val();
        var min=$('#add-product-min').val();
        var max=$('#add-product-max').val();
        var descp=$('#add-product-descp').val();
        var allergy=$('#add-product-allergy').val();
        var cat_id=$('#add-product-category').val();
        var shop_id=$('#add-product-shop').val();
        // alert(shop_id);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                name:name,
                stock,stock,
                price:price,
                unit:unit,
                min:min,
                max:max,
                descp:descp,
                allergy:allergy,
                cat_id:cat_id,
                shop_id:shop_id,
                form_name: 'add-product-form'
            },
            success: function(response){
    
                var resp=jQuery.parseJSON(response);
               
                jQuery('#add-prod-button').text('Add Product');
                jQuery('#add-prod-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    $('#product-edit-sucess-msg').hide();
                    $('#product-img-sucess-msg').show();
                    resetForm('add-product-form');
                    // clearFormValidation();
                }
                else{
                    // alert('not success inside form');
                    inlineMsg(resp);
                }
            }
            
        });
        //prevent page reload
        return false;
    });


    //details to add product
    $('#discount-form').submit(function(){
        jQuery('#add-discount-btn').text('Adding...');
        jQuery('#add-discount-btn').attr('disabled', true);

        var prod_id=$('#prod-id').val();
        var dis_name=$('#dis-name').val();
        var dis_rate=$('#dis-rate').val();
        var dis_start=$('#dis-start').val();
        var dis_end=$('#dis-end').val();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                prod_id:prod_id,
                dis_name:dis_name,
                dis_start:dis_start,
                dis_rate:dis_rate,
                dis_end:dis_end,
                form_name: 'discount-form'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
               
                jQuery('#add-discount-btn').text('Add Discount');
                jQuery('#add-discount-btn').attr('disabled', false);
                if(resp.clear == true)
                {
                    $('#discount-sucess-msg').show();
                    resetForm('discount-form');
                    clearFormValidation();
                }
                else{
                    inlineMsg(resp);
                }
            }
            
        });
        //prevent page reload
        return false;
    });

    //details to add shop
    $('#add-shop-form').submit(function(){
        jQuery('#add-shop-button').text('Adding...');
        jQuery('#add-shop-button').attr('disabled', true);

        var formData= new FormData(this);
        formData.append("form_name", "add-shop-form");

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: "JSON",
            contentType: false, //multipart/formdata
            processData: false,
            success: function(response){
                console.log(response);
                var resp=response;
               
                jQuery('#add-shop-button').text('Add Shop');
                jQuery('#add-shop-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    resetForm('add-shop-form');
                    clearFormValidation();
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
            $('#picture-form-up').submit();
        } 
    });

    //post new picture for product
    $('#new-prod-pic-form').submit(function(){

        //button value change
        jQuery('#add-prod-pic').text('Uploading..');
        jQuery('#add-prod-pic').attr('disabled', true);

        //for file
        var formData= new FormData(this);
        formData.append("form_name", "new-prod-pic-form");

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: "JSON",
            contentType: false, //multipart/formdata
            processData: false, //not obj nor string
            success: function(response){
                var resp=response;
                console.log(response);
                jQuery('#add-prod-pic').text('Upload Image');
                jQuery('#add-prod-pic').attr('disabled', false);
                if(resp.clear == true){
                    clearFormValidation();
                }
                else{
                    inlineMsg(resp);
                }
            }
        });
        //prevent page reload
        return false;
    });

    // post for editing shop name
    $('#discount-form').submit(function(){
        jQuery('#add-discount-btn').text('Adding...');
        jQuery('#add-discount-btn').attr('disabled', true);

        var prod_id=$('#prod-id').val();
        var dis_name=$('#dis-name').val();
        var dis_rate=$('#dis-rate').val();
        var dis_start=$('#dis-start').val();
        var dis_end=$('#dis-end').val();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                prod_id:prod_id,
                dis_name:dis_name,
                dis_start:dis_start,
                dis_rate:dis_rate,
                dis_end:dis_end,
                form_name: 'discount-form'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
               
                jQuery('#add-discount-btn').text('Add Discount');
                jQuery('#add-discount-btn').attr('disabled', false);
                if(resp.clear == true)
                {
                    $('#discount-sucess-msg').show();
                    resetForm('discount-form');
                    clearFormValidation();
                }
                else{
                    inlineMsg(resp);
                }
            }
            
        });
        //prevent page reload
        return false;
    });

    // post for editing shop name
    $('#edit-shop-form').submit(function(){
        jQuery('#edit-shop-button').text('Saving...');
        jQuery('#edit-shop-button').attr('disabled', true);

        var shop_id=$('#edit_shop_id').val();
        var new_name=$('#new-shop-name').val();
        var check_pass=$('#check-pass').val();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                shop_id:shop_id,
                new_name:new_name,
                check_pass:check_pass,
                form_name: 'edit-shop-form'
            },
            success: function(response){
                 var resp=jQuery.parseJSON(response);
                console.log(response);
                jQuery('#edit-shop-button').text('Save Changes');
                jQuery('#edit-shop-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    $('#shop-edit-sucess-msg').show();
                    resetForm('edit-shop-form');
                    // clearFormValidation();
                }
                else{
                    inlineMsg(resp);
                }
            }
            
        });
        //prevent page reload
        return false;
    });

});






// function clearFormValidation()
// {
//     if($('.form-control').hasClass('is-invalid'))
//     {
//         $('.form-control').removeClass('is-invalid');
//     }
//     if($('.form-control').hasClass('valid'))
//     {
//         $('.form-control').removeClass('valid');
//     }
// }
