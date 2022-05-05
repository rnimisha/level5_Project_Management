$(document).ready(function(){ 
    //hide success mesages
    $('#personal-sucess-msg').hide();
    $('#profile-sucess-msg').hide();
    $('#pass-sucess-msg').hide();
    $('#discount-sucess-msg').hide();
    $('#product-edit-sucess-msg').hide();
    $('#add-prod-sucess-msg').hide();
    $('#product-img-sucess-msg').hide();
    $('#shop-edit-sucess-msg').hide();
    $('#shop-logo-sucess-msg').hide();
    $('#add-shop-sucess-msg').hide();
    $('#status-change-sucess-msg').hide();
    $('#check-email-msg').hide();

    
    // ------------trader profile setting---------------
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
                form_name: 'personal-form',
                run_query: 't'
            },
            success: function(response){
                // alert('success inside form');
                var resp=jQuery.parseJSON(response);
                // console.log(resp);
                jQuery('#personal-button').text('Save Changes');
                jQuery('#personal-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    // // resetForm('personal-form');
                    // $('#personal-form').addClass('was-validated');
                    $('#profile-sucess-msg').hide();
                    $('#pass-sucess-msg').hide();
                    clearFormValidation();
                    removeStyle(resp);
                    if(resp.emailchange==true)
                    {
                        $('#check-email-msg').show().delay(5000).fadeOut();
                        $('#personal-sucess-msg').hide();
                    }
                    else{
                        $('#personal-sucess-msg').show().delay(5000).fadeOut();
                        $('#check-email-msg').hide();
                    }
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

    // personal information edit live validation 
    $('#trad-address').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();
     
        var address=$('#trad-address').val();
        var trader_id=$('#trad-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                address:address,
                trader_id:trader_id,
                form_name: 'personal-form',
                run_query: 'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#trad-dob').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();
     
        var dob=$('#trad-dob').val();
        var trader_id=$('#trad-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                dob:dob,
                trader_id:trader_id,
                form_name: 'personal-form',
                run_query: 'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#trad-email').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();
     
        var traderemail=$('#trad-email').val();
        var trader_id=$('#trad-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                traderemail: traderemail,
                trader_id:trader_id,
                form_name: 'personal-form',
                run_query: 'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#trad-fullname').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();
     
        var fullname=$('#trad-fullname').val();
        var trader_id=$('#trad-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                fullname: fullname,
                trader_id:trader_id,
                form_name: 'personal-form',
                run_query: 'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#trad-contact').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();
     
        var contact=$('#trad-contact').val();
        var trader_id=$('#trad-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                contact:contact,
                trader_id:trader_id,
                form_name: 'personal-form',
                run_query: 'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
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
                form_name: 'pass-form',
                run_query: 't'
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
                    $('#pass-sucess-msg').show().delay(5000).fadeOut();
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

    $('#trad-new-pass').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();

        var new_pass=$('#trad-new-pass').val();
        var trader_id=$('#trader-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                new_pass:new_pass,
                trader_id:trader_id,
                form_name: 'pass-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#trad-re-pass').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();

        var new_pass=$('#trad-new-pass').val();
        var re_pass=$('#trad-re-pass').val();
        var trader_id=$('#trader-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                new_pass:new_pass,
                re_pass:re_pass,
                trader_id:trader_id,
                form_name: 'pass-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    $('#trad-old-pass').keyup(function(){
        $('#personal-sucess-msg').hide();
        $('#profile-sucess-msg').hide();
        $('#pass-sucess-msg').hide();

        var old_pass=$('#trad-old-pass').val();
        var trader_id=$('#trader-id').val();

        $.ajax({
            type: "POST",
            url: 'form-valid.php',
            data: {
                old_pass:old_pass,
                trader_id:trader_id,
                form_name: 'pass-form',
                run_query: 'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
        });
        return false;
    });

    //submit form on pic change
    $('#trad-pic').change(function(){
        $('#trad-pic').removeClass('is-invalid');
        var file=this.files[0];
        var imgfile=file.type;
        var match=["image/jpeg", "image/png", "image/jpg"];
        if(!((imgfile==match[0]) || (imgfile==match[1]) || (imgfile==match[2])))
        {
            // alert(9);
            $('#trad-pic').addClass('is-invalid');
            $('#error-pp-pic').text("Please select valid image");
            return false;
        }
        else
        {
            $('#preview-pp').click();
            $('#trad-pic').addClass('valid');
            $('#error-pp-pic').text("");
            var reader=new FileReader();
            reader.onload=loadProfile;
            reader.readAsDataURL(this.files[0]);
        }
    });


    function loadProfile(e)
    {
        $('#trad-preview').attr('src', e.target.result);
        $('#trad-preview').css('width', '250px');
        $('#trad-preview').css('height', '250px');
    }

    $('#upload-pp-confirm').click(function(){
        $('#picture-form-up').submit();
    });

    //post picture
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
                    $('#profile-sucess-msg').show().delay(5000).fadeOut();
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


    // delete profile picture for trader
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
                        $('#profile-sucess-msg').show().delay(5000).fadeOut();
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

    //--------------Trader Product crud----------------
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
                    $('#product-edit-sucess-msg').show().delay(5000).fadeOut();;
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


    //details to add product
    $('#add-product-form').submit(function(){
        jQuery('#add-prod-button').text('Adding...');
        jQuery('#add-prod-button').attr('disabled', true);
        // alert(1);
        var formData= new FormData(this);
        formData.append("form_name", "add-product-form");
        formData.append("run_query", "t");
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: "JSON",
            contentType: false, //multipart/formdata
            processData: false,
            success: function(response){
                var resp=response;
                jQuery('#add-prod-button').text('Add Product');
                jQuery('#add-prod-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    $('#prod-preview').attr('src', '../image/product/productplaceholder.png');
                    $('#product-edit-sucess-msg').hide();
                    $('#add-prod-sucess-msg').show().delay(5000).fadeOut();;
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

     //add product live validation
     $('#add-product-name').keyup(function(){
        var product_name=$('#add-product-name').val();
        var shop_id=$('#add-product-shop').val();
        $.ajax({
            type: "POST",
            url: "add-product.php",
            data: {
                'add-product-name':product_name,
                'add-product-shop':shop_id,
                form_name:'add-product-form',
                run_query:'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#add-product-stock').keyup(function(){
        var stock=$('#add-product-stock').val();
        var shop_id=$('#add-product-shop').val();
        $.ajax({
            type: "POST",
            url: "add-product.php",
            data: {
                'add-product-stock':stock,
                'add-product-shop':shop_id,
                form_name:'add-product-form',
                run_query:'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#add-product-price').keyup(function(){
        var price=$('#add-product-price').val();
        var shop_id=$('#add-product-shop').val();
        $.ajax({
            type: "POST",
            url: "add-product.php",
            data: {
                'add-product-price':price,
                'add-product-shop':shop_id,
                form_name:'add-product-form',
                run_query:'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#add-product-unit').keyup(function(){
        var unit=$('#add-product-unit').val();
        var shop_id=$('#add-product-shop').val();
        $.ajax({
            type: "POST",
            url: "add-product.php",
            data: {
                'add-product-unit':unit,
                'add-product-shop':shop_id,
                form_name:'add-product-form',
                run_query:'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#add-product-min').keyup(function(){
        var min=$('#add-product-min').val();
        var shop_id=$('#add-product-shop').val();
        $.ajax({
            type: "POST",
            url: "add-product.php",
            data: {
                'add-product-min':min,
                'add-product-shop':shop_id,
                form_name:'add-product-form',
                run_query:'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#add-product-max').keyup(function(){
        var min=$('#add-product-min').val();
        var max=$('#add-product-max').val();
        var shop_id=$('#add-product-shop').val();
        $.ajax({
            type: "POST",
            url: "add-product.php",
            data: {
                'add-product-min':min,
                'add-product-max':max,
                'add-product-shop':shop_id,
                form_name:'add-product-form',
                run_query:'f'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#add-product-descp').keyup(function(){
       
        var descp=$('#add-product-descp').val();
        var shop_id=$('#add-product-shop').val();
        $.ajax({
            type: "POST",
            url: "add-product.php",
            data: {
                'add-product-descp':descp,
                'add-product-shop':shop_id,
                form_name:'add-product-form',
                run_query:'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    // preview image on change
    $('#prod-pic').change(function(){
        
        $('#error-prod-pic').text("");
        $('#prod-pic').removeClass('is-valid');
        $('#prod-pic').removeClass('is-invalid');

        var file=this.files[0];
        var imgfile=file.type;
        var match=["image/jpeg", "image/png", "image/jpg"];
        if(!((imgfile==match[0]) || (imgfile==match[1]) || (imgfile==match[2])))
        {
            // alert(9);
            $('#prod-preview').attr('src', '../image/product/productplaceholder.png');
            $('#prod-pic').addClass('is-invalid');
            $('#error-prod-pic').text("Please select valid image");
            return false;
        }
        else
        {
            $('#prod-pic').addClass('valid');
            $('#error-prod-pic').text("");
            var reader=new FileReader();
            reader.onload=imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

    //load image as preview
    function imageIsLoaded(e)
    {
        $('#prod-preview').attr('src', e.target.result);
        $('#prod-preview').css('width', '200px');
        $('#prod-preview').css('height', '200px');
    }


    //submit form on change
    $('#new-prod-pic').change(function(){
        $('#new-prod-pic').removeClass('is-invalid');
        var file=this.files[0];
        var imgfile=file.type;
        var match=["image/jpeg", "image/png", "image/jpg"];
        if(!((imgfile==match[0]) || (imgfile==match[1]) || (imgfile==match[2])))
        {
            
            $('#new-prod-pic').addClass('is-invalid');
            $('#error-new-prod-pic').text("Please select valid image");
            return false;
        }
        else
        {
            $('#new-prod-pic').addClass('valid');
            $('#error-new-prod-pic').text("");
            var reader=new FileReader();
            reader.onload=loadProductImg;
            reader.readAsDataURL(this.files[0]);
        }
    });


    function loadProductImg(e)
    {
        $('#preview-prod-img').attr('src', e.target.result);
        $('#preview-prod-img').css('width', '250px');
        $('#preview-prod-img').css('height', '250px');
    }

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
                $('#product-img-sucess-msg').show().delay(5000).fadeOut();;
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

    //details to add product discount
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
                    $('#discount-sucess-msg').show().delay(5000).fadeOut();
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
        formData.append("run_query", "t");

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
                    $('#add-shop-sucess-msg').show().delay(5000).fadeOut();
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

    //add shop live validation
    $('#shop-name').keyup(function(){
       
        var name=$('#shop-name').val();
        var trader_id=$('#trader-id').val();
        $.ajax({
            type: "POST",
            url: "add-shop.php",
            data: {
                'shop-name':name,
                'trader-id':trader_id,
                form_name:'add-shop-form',
                run_query:'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#shop-date').keyup(function(){
       
        var shopdate=$('#shop-date').val();
        var trader_id=$('#trader-id').val();
        $.ajax({
            type: "POST",
            url: "add-shop.php",
            data: {
                'shop-date':shopdate,
                'trader-id':trader_id,
                form_name:'add-shop-form',
                run_query:'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#reg-id').keyup(function(){
       
        var regid=$('#reg-id').val();
        var trader_id=$('#trader-id').val();
        $.ajax({
            type: "POST",
            url: "add-shop.php",
            data: {
                'reg-id':regid,
                'trader-id':trader_id,
                form_name:'add-shop-form',
                run_query:'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    $('#reg-reason').keyup(function(){
       
        var reason=$('#reg-reason').val();
        var trader_id=$('#trader-id').val();
        $.ajax({
            type: "POST",
            url: "add-shop.php",
            data: {
                'reg-reason':reason,
                'trader-id':trader_id,
                form_name:'add-shop-form',
                run_query:'f'
            },
            success: function(response){
                console.log(response);
                var resp=jQuery.parseJSON(response);
                inlineMsg(resp);
            }
            
        });
        //prevent page reload
        return false;
    });

    // //submit form on change
    // $('#trad-pic').change(function(){
    //     if (confirm('Do you want to upload the image?')) {
    //         $('#picture-form-up').submit();
    //     } 
    // });

    

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
                    $('#discount-sucess-msg').show().delay(5000).fadeOut();;
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

    //-----------edit shop--------
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
                    $('#shop-edit-sucess-msg').show().delay(5000).fadeOut();
                    resetForm('edit-shop-form');
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
    $('#new-shop-logo').change(function(){
        $('#new-shop-logo').removeClass('is-invalid');
        var file=this.files[0];
        var imgfile=file.type;
        var match=["image/jpeg", "image/png", "image/jpg"];
        if(!((imgfile==match[0]) || (imgfile==match[1]) || (imgfile==match[2])))
        {
            
            $('#new-shop-logo').addClass('is-invalid');
            $('#error-new-shop-logo').text("Please select valid image");
            return false;
        }
        else
        {
            $('#new-shop-logo').addClass('valid');
            $('#error-new-shop-logo').text("");
            var reader=new FileReader();
            reader.onload=loadShopLogo;
            reader.readAsDataURL(this.files[0]);
        }
    });


    function loadShopLogo(e)
    {
        $('#preview-logo').attr('src', e.target.result);
        $('#preview-logo').css('width', '250px');
        $('#preview-logo').css('height', '250px');
    }


    // post logo of shop
    $('#new-shop-logo-form').submit(function(){
        jQuery('#add-shop-logo').text('Uploading...');
        jQuery('#add-shop-logo').attr('disabled', true);

        var formData= new FormData(this);
        formData.append("form_name", "new-shop-logo-form");
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
               
                jQuery('#add-shop-logo').text('Upload Image');
                jQuery('#add-shop-logo').attr('disabled', false);
                if(resp.clear == true)
                {
                    resetForm('new-shop-logo-form');
                    clearFormValidation();
                    $('#shop-logo-sucess-msg').show().delay(5000).fadeOut();
                }
                else{
                    inlineMsg(resp);
                }
            }
            
        });
        //prevent page reload
        return false;
    });

    // $('#new-prod-pic-form').submit(function(){

    //     //button value change
    //     jQuery('#add-prod-pic').text('Uploading..');
    //     jQuery('#add-prod-pic').attr('disabled', true);

    //     //for file
    //     var formData= new FormData(this);
    //     formData.append("form_name", "new-prod-pic-form");

    //     $.ajax({
    //         type: $(this).attr('method'),
    //         url: $(this).attr('action'),
    //         data: formData,
    //         dataType: "JSON",
    //         contentType: false, //multipart/formdata
    //         processData: false, //not obj nor string
    //         success: function(response){
    //             var resp=response;
    //             console.log(response);
    //             jQuery('#add-prod-pic').text('Upload Image');
    //             jQuery('#add-prod-pic').attr('disabled', false);
    //             $('#product-img-sucess-msg').show().delay(5000).fadeOut();;
    //             if(resp.clear == true){
    //                 clearFormValidation();
    //             }
    //             else{
    //                 inlineMsg(resp);
    //             }
    //         }
    //     });
    //     //prevent page reload
    //     return false;
    // });

    //change order status
    $('#edit-status-form').submit(function(){
        jQuery('#change-status-button').text('Changing...');
        jQuery('#change-status-button').attr('disabled', true);

        var order_id=$('#order-id-status').val();
        var order_status=$('#new-order-status').val();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: {
                order_id:order_id,
                order_status:order_status,
                form_name: 'edit-status-form'
            },
            success: function(response){
                var resp=jQuery.parseJSON(response);
               
                jQuery('#change-status-button').text('Save Changes');
                jQuery('#change-status-button').attr('disabled', false);
                if(resp.clear == true)
                {
                    $('#status-change-sucess-msg').show().delay(5000).fadeOut();
                    resetForm('edit-status-form');
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

    $('.confirm-logout').click(function(){
        $('#confirm-log-out').click();
    });

    $('#sign-out-yes').click(function(){
        $(location).attr('href','../logout.php');
    });
});
