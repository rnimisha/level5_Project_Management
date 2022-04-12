<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script/contactus.js"></script>
    <script src="script/function.js"></script>
    <title>Contact us</title>

</head>
<body>
    <form action="contactus.php" method="POST"  id="contact-us-form">
        <label for="firstname"> First Name</label>
        <input type="text" name="firstname" id="firstname"  />
        <span id="firstname_error" style="color: red"></span>

        <label for="lastname"> Last Name</label>
        <input type="text" name="lastname" id="lastname"  /><br/>
        <span id="lastname_error" style="color: red"></span>

        <label for="useremail"> Email</label>
        <input type="text" name="uemail" id="useremail" />
        <span id="contact_email_error" style="color: red"></span>

        <label for="contact"> Contact</label>
        <input type="text" name="ucontact" id="contact" /><br/>
        <span id="contact_error" style="color: red"></span>

        <label for="message"> Message</label>
        <textarea name="message" id="message" ></textarea><br/>
        <span id="message_error" style="color: red"></span>

        <input type="submit" id="contact-btn" name="contactus" value="Send"/>
    </form>
</body>
</html>