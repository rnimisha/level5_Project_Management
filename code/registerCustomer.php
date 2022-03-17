<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script/preventRefresh.js"></script>
    <title>User Registration</title>
</head>
<body>
    <div id="reg-sucess-msg" style="color: green"></div>

    <form action="validateCustomer.php" method="POST" id="cust-reg-form">
        <label for="fullname"> Name</label>
        <input type="text" name="uname" id="fullname" /><br/>
        <div id="name_error" style="color: red"></div>

        <label for="useremail"> Email</label>
        <input type="text" name="uemail" id="useremail" /><br/>
        <div id="email_error" style="color: red"></div>

        <label for="pword"> Password</label>
        <input type="password" name="upass" id="pword" /><br/>
        <div id="pass_error" style="color: red"></div>

        <label for="repass"> Re-enter Password</label>
        <input type="text" name="urep-pass" id="repass" /><br/>
        <div id="repass_error" style="color: red"></div>

        <label for="contact"> Contact</label>
        <input type="text" name="ucontact" id="contact" /><br/>
        <div id="contact_error" style="color: red"></div>

        <label for="dob"> DOB</label>
        <input type="text" name="udob" id="dob" /><br/>
        <div id="dob_error" style="color: red"></div>

        <label for="address"> Address</label>
        <input type="text" name="uaddress" id="address" /><br/>
        <div id="address_error" style="color: red"></div>

        <!-- image later -->
        <input type="submit" name="registerCustomer" value="Register"/>
    </form>
</body>
</html>