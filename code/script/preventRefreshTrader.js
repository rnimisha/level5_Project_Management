//trader form stop refresh
$(document).ready(function(){
   $('#trader-shop-form').hide();
   $('#trader-general-form').show();
   $("#next-shop-btn").click(function(){

      var t_fullname=$('#t_fullname').val();
      var t_useremail=$('#t_useremail').val();
      var t_pword=$('#t_pword').val();
      var t_repass=$('#t_repass').val();
      var t_contact=$('#t_contact').val();
      var t_dob=$('#t_dob').val();
      var t_address=$('#t_address').val();
      var reason=$('#reason').val();
      

      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_fullname: t_fullname,
            t_useremail: t_useremail,
            t_pword: t_pword,
            t_repass: t_repass,
            t_contact: t_contact,
            t_dob: t_dob,
            t_address: t_address,
            reason: reason,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
               $('#trader-shop-form').show();
               $('#trader-general-form').hide();
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#trader-reg-form").submit(function(){

      jQuery('#trader-reg-btn').val('Submitting..');
      jQuery('#trader-reg-btn').attr('disabled', true);

      var t_fullname=$('#t_fullname').val();
      var t_useremail=$('#t_useremail').val();
      var t_pword=$('#t_pword').val();
      var t_repass=$('#t_repass').val();
      var t_contact=$('#t_contact').val();
      var t_dob=$('#t_dob').val();
      var t_address=$('#t_address').val();
      var reason=$('#reason').val();
      var shopname=$('#shopname').val();
      var register_date=$('#register_date').val();
      var register_no=$('#register_no').val();

      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_fullname: t_fullname,
            t_useremail: t_useremail,
            t_pword: t_pword,
            t_repass: t_repass,
            t_contact: t_contact,
            t_dob: t_dob,
            t_address: t_address,
            reason: reason,
            shopname: shopname,
            register_date: register_date,
            register_no: register_no,
            registertrader: 'yes',
            validatetrader: 'no'
         },
         success: function(response)
         {
            jQuery('#trader-reg-btn').val('Register');
            jQuery('#trader-reg-btn').attr('disabled', false);
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               resetForm('trader-reg-form');
               $('#reg-trader-sucess-msg').html('Please confirm your email.');
               inlineMsg(resp);
            }
            else{
               $('#reg-trader-sucess-msg').html('');
               inlineMsg(resp);
            }
         }
      });
      return false;
   });
});