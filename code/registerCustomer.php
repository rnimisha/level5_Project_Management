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
    <form action="validateCustomer.php" method="POST" id="cust-reg-form">
        <label for="fullname"> Name</label>
        <input type="text" name="uname" id="fullname" /><br/><br/>
        <label for="useremail"> Email</label>
        <input type="text" name="uemail" id="useremail" /><br/><br/>
        <label for="pword"> Password</label>
        <input type="password" name="upass" id="pword" /><br/><br/>
        <label for="repass"> Re-enter Password</label>
        <input type="text" name="urep-pass" id="repass" /><br/><br/>
        <label for="contact"> Contact</label>
        <input type="text" name="ucontact" id="contact" /><br/><br/>
        <label for="dob"> DOB</label>
        <input type="text" name="udob" id="dob" /><br/><br/>
        <label for="address"> Address</label>
        <input type="text" name="uaddress" id="address" /><br/><br/>
        <!-- image later -->
        <input type="submit" name="registerCustomer" value="Register"/>
    </form>
</body>
</html>