<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script/preventRefresh.js"></script>
    <script src="script/function.js"></script>
    <title>User Login</title>

</head>
<body>
    <form action="validateLogin.php" method="POST"  id="login-form">
        <label for="l_useremail"> Email</label>
        <input type="text" name="uemail" id="l_useremail" /><br/>
        <div id="l_email_error" style="color: red"></div>

        <label for="l_pword"> Password</label>
        <input type="password" name="upass" id="l_pword" /><br/>
        <div id="l_pass_error" style="color: red"></div>

        <input type="submit" id="login-btn" name="loginUser" value="Login"/>
    </form>
</body>
</html>