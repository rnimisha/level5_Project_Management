//trader form stop refresh with ajax call
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
            registershop: 'yes',
            validatetrader: 'no',
            insertdetail: 'yes'
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

   //live validation
   $("#t_fullname").keyup(function(){

      var t_fullname=$('#t_fullname').val();
      
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_fullname: t_fullname,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#t_useremail").keyup(function(){

      var t_useremail=$('#t_useremail').val();
      
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_useremail: t_useremail,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#t_pword").keyup(function(){

      var t_pword=$('#t_pword').val();
      
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_pword: t_pword,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#t_repass").keyup(function(){

      var t_pword=$('#t_pword').val();
      var t_repass=$('#t_repass').val();
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_pword: t_pword,
            t_repass: t_repass,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#t_contact").keyup(function(){

      var t_contact=$('#t_contact').val();
      
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_contact: t_contact,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#t_dob").keyup(function(){

      var t_dob=$('#t_dob').val();
      
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_dob: t_dob,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#t_address").keyup(function(){

      var t_address=$('#t_address').val();
      
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            t_address: t_address,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   $("#reason").keyup(function(){

      var reason=$('#reason').val();
      
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            reason: reason,
            validatetrader: 'yes'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
               inlineMsg(resp);
            }
            else{
               inlineMsg(resp);
            }
         }
      });
   });

   //live validation shop details
   $("#shopname").keyup(function(){

      var shopname=$('#shopname').val();
      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            shopname: shopname,
            registershop: 'yes',
            validatetrader: 'no'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
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

   $("#register_date").keyup(function(){

      var register_date=$('#register_date').val();

      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            register_date: register_date,
            registershop: 'yes',
            validatetrader: 'no'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
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

   $("#register_no").keyup(function(){

      var register_no=$('#register_no').val();

      $.ajax({
         type: "POST",
         url: 'validateTrader.php',
         data: {
            register_no: register_no,
            registershop: 'yes',
            validatetrader: 'no'
         },
         success: function(response)
         {
            console.log(response);
            var resp=jQuery.parseJSON(response);
            if(resp.clear == true) {
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