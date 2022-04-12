//trader form stop refresh
$(document).ready(function(){
   $('#trader-shop-form').hide();
   $('#trader-general-form').show();
   $("#next-shop-btn").click(function(){

      var fullname=$('#fullname').val();
      var useremail=$('#useremail').val();
      var pword=$('#pword').val();
      var repass=$('#repass').val();
      var contact=$('#contact').val();
      var dob=$('#dob').val();
      var address=$('#address').val();
      var reason=$('#reason').val();
      

      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            fullname: fullname,
            useremail: useremail,
            pword: pword,
            repass: repass,
            contact: contact,
            dob: dob,
            address: address,
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

      var fullname=$('#fullname').val();
      var useremail=$('#useremail').val();
      var pword=$('#pword').val();
      var repass=$('#repass').val();
      var contact=$('#contact').val();
      var dob=$('#dob').val();
      var address=$('#address').val();
      var reason=$('#reason').val();
      var shopname=$('#shopname').val();
      var register_date=$('#register_date').val();
      var register_no=$('#register_no').val();

      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            fullname: fullname,
            useremail: useremail,
            pword: pword,
            repass: repass,
            contact: contact,
            dob: dob,
            address: address,
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