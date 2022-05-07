<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .login-msg{
            width: 30%;
            position: absolute;
            top: 60px;
            right: 0px;
            z-index: 1000;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .fa-triangle-exclamation{
            color:#fca483;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script/preventRefresh.js"></script>
    <script src="script/function.js"></script>
    <title>User Login</title>

</head>
<body>
    <?php
        if(isset($_GET['msg']))
        {
            if($_GET['msg']=="cartaccess")
            {
                ?>
                <div class="alert alert-warning login-msg" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="True">&times;</span>
                    </button>
                    <h5><strong> <i class="fa-solid fa-triangle-exclamation"></i> Alert! </strong> Login to access cart.</h5>
                </div>
                <?php
            }
            if($_GET['msg']=="wishlistaccess")
            {
                ?>
                <div class="alert alert-warning login-msg" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="True">&times;</span>
                    </button>
                    <h5><strong> <i class="fa-solid fa-triangle-exclamation"></i> Alert! </strong> Login to access wishlist.</h5>
                </div>
                <?php
            }
        }
    ?>
    <form action="validateLogin.php" method="POST"  id="login-form">
        <input type="hidden" value="<?php if(isset($_GET['msg'])){echo $_GET['msg'];} else{echo "";}?>" id="login-message" name="login-message"/>
        <label for="l_useremail"> Email</label>
        <input type="text" name="uemail" id="l_useremail" /><br/>
        <div id="l_email_error" style="color: red"></div>

        <label for="l_pword"> Password</label>
        <input type="password" name="upass" id="l_pword" /><br/>
        <div id="l_pass_error" style="color: red"></div>

        <input type="submit" id="login-btn" name="loginUser" value="Login"/>
    </form>
</body>

<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</html>