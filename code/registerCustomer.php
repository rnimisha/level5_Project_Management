<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <form action="validateCustomer.php" method="POST">
        <label for="fullname"> Name</label>
        <input type="text" name="uname" id="fullname" /><br/>
        <label for="useremail"> Email</label>
        <input type="text" name="uemail" id="useremail" /><br/>
        <label for="pword"> Password</label>
        <input type="password" name="upass" id="pword" /><br/>
        <label for="fullname"> Re-enter Password</label>
        <input type="text" name="uname" id="fullname" /><br/>
        <label for="contact"> Contact</label>
        <input type="text" name="ucontact" id="contact" /><br/>
        <label for="dob"> DOB</label>
        <input type="text" name="udob" id="dob" /><br/>
        <label for="address"> Address</label>
        <input type="text" name="uaddress" id="address" /><br/>
        <!-- image later -->
        <input type="submit" name="registerCustomer" value="Register"/>
    </form>
</body>
</html>