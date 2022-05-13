<?php
include_once('connection.php');
include_once('function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrint-into">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">   
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/header.css" />
    <link rel="stylesheet" type="text/css" href="style/login-reg.css" />

</head>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Quicksand:wght@300;400;500&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        /* background-image: linear-gradient(45deg, #78967e, #8ea792, #bac9bc, #c6c4c7); */
        animation: gradient 10s ease infinite;
        background-size: 400% 400%;
        font-family: 'Quicksand', sans-serif;
        color: #333333;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .container {
        position: absolute;
        max-width: 1200px;
        height: 550px;
        margin: auto;
        top: 60%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .left {
        position: relative;
        background-image: linear-gradient(45deg, #78967e, #8ea792, #bac9bc, #c6c4c7);
        border-radius: 25px;
        height: 100%;
        padding: 25px;
        color: rgb(192, 192, 192);
        font-size: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right {
        position: relative;
        background: #fff;
        border-radius: 25px;
        padding: 25px;
        padding-left: 30px;
        height: 100%;
    }
    .login-msg{
        width: 30%;
        position: absolute;
        top: 60px;
        right: 0px;
        z-index: 9999999;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }
    .fa-triangle-exclamation{
        color:#fca483;
    }
    .right header {
        color:#78967e;
        font-size: 44px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .row {
        height: 100%;
    }

    .myRegister {
        width: 80%;
        position: relative;
        background: #fff;
        height: 100%;
        border-radius: 25px;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
    }

    .left header {
        color: #000;
        font-size: 44px;
    }
    .fa {
    position: relative;
    color:#d2caca;
    left: -100px;
    bottom: -35px;
}

    .contain {
        position: relative;
        margin: 20px;
        color:#000000;
        margin-bottom: 100px;
    }

    .forms {
        position: relative;
        margin-top: 50px;
    }
</style>
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
if(isset($_GET['logoutmsg']))
{
    if($_GET['logoutmsg']=='yes')
    {
        $_GET['logoutmsg']="";
        
        ?>
        <div class="alert alert-success login-msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="True">&times;</span>
            </button>
            <h5> You have been successfully logged out.</h5>
        </div>
        <?php
    }
}
?>
<body>
<?php include_once('header.php');?>
    <div class="container pb-5">
        <div class="myRegister mx-auto">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <div class="contain">
                            <header class="font-green">Hello</header>
                            <p>Dont't have an account? Click button below to register</p>
                            <a href="registerform.php" type="button" class="butt">Register</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center my-auto">
                    <div class="right text-center">
                            <header>Login</header>
                            <form action="validateLogin.php" method="POST"  id="login-form" class="forms">
                                <input type="hidden" value="<?php if(isset($_GET['msg'])){echo $_GET['msg'];} else{echo "";}?>" id="login-message" name="login-message"/>
                                <div class="form-group mt-1">
                                    <i class="fa fa-user"></i>
                                    <input type="text"  class="form-control" name="uemail" id="l_useremail" placeholder="Email"/>
                                    <div class="invalid-feedback" id="l_email_error"></div>
                                    
                                </div>

                            <div class="form-group">
                                <i class="fa fa-lock"></i>
                                <input type="password" class="form-control" name="upass" id="l_pword" placeholder="Password"/>
                                <div id="l_pass_error" class="invalid-feedback"></div>
                            </div>
                            <br>
                            <input type="submit" style="margin-left : 10px;" id="login-btn" class="bttn"  name="loginUser" value="Login"/>
                            <br><br>
                            <span class="forget"><a href="forgot_password.php">Forget Password?</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script src="script/preventRefresh.js"></script>
<script src="script/function.js"></script>
<script src="script/script.js"></script>
</html>