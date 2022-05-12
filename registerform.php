<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- customized css -->
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/login-reg.css" />
    <title>My Wishlist</title>
</head>
<body>
    <div class="success"></div>
    <div class="container pt-5">
        <div class="row w-100 mt-5 mx-auto register-us-container mb-5">
            <div class="col-md-5 transition-effect side-container">
                <div class="leftpanel">
                    <div class="contain">
                        <header>Already a member?</header>
                        <p>Click button below to login</p>
                        <input type="button" class="butt" value="LOGIN" />
                    </div>
            </div>
            </div>
            <div class="col-md-7 transition-effect mb-5 pr-0">
                <div class="row w-100 d-block justify-content-center align-items-center">
                    <h3 class="my-green-font text-center mt-5">CREATE AN ACCOUNT</h3>
                    <div class="row w-100 mt-3">
                        <div class="col-6 text-right">
                            <span class="cus">Customer</span>
                        </div>
                        <div class="col-6 text-left">
                            <span class="tra">Trader</span>
                        </div>
                    </div>
                    <div class="row w-100 justify-content-center align-items-center">
                    <form action="validateCustomer.php" method="POST"  id="cust-reg-form">
                        <div class="form-group mt-2">
                            <i class="fa fa-user"></i>
                            <input type="text" name="fullname" class="inputs" placeholder="Full Name" id="fullname" />
                            <div id="name_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group mt-2">
                            <i class="fa fa-envelope"></i>
                            <input type="text" name="uemail" id="useremail" class="inputs" placeholder="Email"/>
                            <div id="email_error" class="invalid-feedback ml-4"></div>
                        </div>

                        <div class="form-group mt-2">
                            <i class="fa fa-phone"></i>
                            <input type="number" name="ucontact" id="contact" class="inputs" placeholder="Contact" />
                            <div id="contact_error" class="invalid-feedback ml-4"></div>
                        </div>

                        <div class="form-group mt-2">
                            <i class="fa fa-calendar"></i>
                            <input type="date" name="udob" id="dob" class="inputs" placeholder="Date of Birth"/><br/>
                            <div id="dob_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group mt-2">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="uaddress" id="address" class="inputs" placeholder="Address"/><br/>
                        <div id="address_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group mt-2">
                            <i class="fa fa-lock"></i>
                            <input type="password" name="upass" id="pword" class="inputs" placeholder="Password" />
                            <div id="pass_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group mt-2">
                            <i class="fa fa-lock"></i>
                            <input type="password" name="urep-pass" id="repass" class="inputs" placeholder="Confirm Password" /><br/>
                            <div id="repass_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <input type="submit" class="bttn text-center" id="reg-btn" name="registerCustomer" value="Register"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom script -->

<script src="script/preventRefresh.js"></script>
<script src="script/preventRefreshTrader.js"></script>
<script src="script/function.js"></script>
</html>