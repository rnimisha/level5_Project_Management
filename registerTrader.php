<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script/preventRefreshTrader.js"></script>
    <script src="script/function.js"></script>
    <title>Trader Registration</title>

</head>
<body>
    <form action="validateTrader.php" method="POST"  id="trader-reg-form">
    <div id="reg-trader-sucess-msg" style="color: green"></div>
        <div id="trader-general-form">
            <label for="t_fullname"> Name</label>
            <input type="text" name="t_fullname" id="t_fullname"  /><br/>
            <div id="t_name_error" style="color: red"></div>

            <label for="t_useremail"> Email</label>
            <input type="text" name="uemail" id="t_useremail" /><br/>
            <div id="t_email_error" style="color: red"></div>

            <label for="t_pword"> Password</label>
            <input type="password" name="upass" id="t_pword" /><br/>
            <div id="t_pass_error" style="color: red"></div>

            <label for="t_repass"> Re-enter Password</label>
            <input type="password" name="urep-pass" id="t_repass" /><br/>
            <div id="t_repass_error" style="color: red"></div>

            <label for="t_contact"> Contact</label>
            <input type="text" name="ucontact" id="t_contact" /><br/>
            <div id="t_contact_error" style="color: red"></div>

            <label for="t_dob"> DOB</label>
            <input type="date" name="udob" id="t_dob" /><br/>
            <div id="t_dob_error" style="color: red"></div>

            <label for="t_address"> Address</label>
            <input type="text" name="uaddress" id="t_address" /><br/>
            <div id="t_address_error" style="color: red"></div>

            <label for="reason"> What you want to sell?</label>
            <input type="textbox" name="reason" id="reason" /><br/>
            <div id="reason_error" style="color: red"></div>

            <button type="button" id="next-shop-btn">Next </button>
        </div>
        <div id="trader-shop-form">
            <label for="shopname"> Shop Name</label>
            <input type="text" name="shopname" id="shopname" /><br/>
            <div id="shopname_error" style="color: red"></div>

            <label for="register_date"> Registration Date</label>
            <input type="date" name="register_date" id="register_date" /><br/>
            <div id="register_date_error" style="color: red"></div>

            <label for="register_no"> PAN</label>
            <input type="text" name="register_no" id="register_no" /><br/>
            <div id="register_no_error" style="color: red"></div>

            <input type="submit" id="trader-reg-btn" name="registerTrader" value="Register"/>
        </div>

    </form>
</body>
</html>