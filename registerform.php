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
    <link rel="stylesheet" type="text/css" href="style/header.css" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/login-reg.css" />
    <title>Register</title>
</head>
<body>
    <?php include_once('header.php');?>
    <div class="success"></div>
    <div class="container mb-5 mt-5 pt-5">
        <div class="row w-100 mt-3 mx-auto register-us-container mb-2">
            <div class="col-md-5 transition-effect side-container">
                <div class="leftpanel">
                    <div class="contain">
                        <header>Already a member?</header>
                        <p>Click button below to login</p>
                        <a href="loginform.php" type="button" class="butt" value="LOGIN" >LOGIN</a>
                    </div>
            </div>
            </div>
            <div class="col-md-7 transition-effect mb-3 pr-0">
                <div class="row w-100 d-block justify-content-center align-items-center">
                    <h3 class="my-green-font text-center mt-5"><b>CREATE AN ACCOUNT</b></h3>
                    <div class="row w-100 my-1">
                        <div class="col-6 text-right">
                            <span class="cust-form active-form">Customer</span>
                        </div>
                        <div class="col-6 text-left">
                            <span class="trad-form">Trader</span>
                        </div>
                    </div>
                    <div class="row w-100 justify-content-center align-items-center">
                    <form action="validateCustomer.php" method="POST"  id="cust-reg-form" class="customer-register-container">
                        <div class="form-group">
                            <i class="fa fa-user"></i>
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" id="fullname" />
                            <div id="name_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <input type="text" name="uemail" id="useremail" class="form-control" placeholder="Email"/>
                            <div id="email_error" class="invalid-feedback ml-4"></div>
                        </div>

                        <div class="form-group">
                            <i class="fa fa-phone"></i>
                            <input type="number" name="ucontact" id="contact" class="form-control" placeholder="Contact" />
                            <div id="contact_error" class="invalid-feedback ml-4"></div>
                        </div>

                        <div class="form-group">
                            <i class="fa fa-calendar"></i>
                            <input type="date" name="udob" id="dob" class="form-control" placeholder="Date of Birth"/>
                            <div id="dob_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="uaddress" id="address" class="form-control" placeholder="Address"/>
                        <div id="address_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input type="password" name="upass" id="pword" class="form-control" placeholder="Password" />
                            <div id="pass_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input type="password" name="urep-pass" id="repass" class="form-control" placeholder="Confirm Password" />
                            <div id="repass_error" class="invalid-feedback ml-4"></div>
                        </div>
                        <br>
                        <input type="submit" class="bttn text-center" id="reg-btn" name="registerCustomer" value="Register"/>
                        </form>


                        <form action="validateTrader.php" method="POST"  id="trader-reg-form" class="trader-register-container d-none">
                            <div id="reg-trader-sucess-msg" style="color: green"></div>
                                <div id="trader-general-form">
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="t_fullname" class="form-control" placeholder="Full Name" id="t_fullname"  />
                                    <div class="invalid-feedback ml-4" id="t_name_error"></div>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-envelope"></i>
                                    <input type="text" name="uemail"class="form-control" placeholder="Email"  id="t_useremail" />
                                    <div id="t_email_error" class="invalid-feedback ml-4"></div>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" name="ucontact" id="t_contact" class="form-control" placeholder="Contact"/>
                                    <div id="t_contact_error" class="invalid-feedback ml-4"></div>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-map-marker"></i>
                                    <input type="text" name="uaddress" id="t_address" class="form-control" placeholder="Address"/>
                                    <div id="t_address_error" class="invalid-feedback ml-4"></div>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-calendar"></i>
                                    <input type="date" name="udob" id="t_dob" class="form-control" placeholder="DOB"/>
                                    <div id="t_dob_error" class="invalid-feedback ml-4"></div>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="upass" id="t_pword" class="form-control" placeholder="Password"/>
                                    <div id="t_pass_error" class="invalid-feedback ml-4"></div>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="urep-pass" id="t_repass" class="form-control" placeholder="Re-enter Password"  />
                                    <div id="t_repass_error" class="invalid-feedback ml-4"></div>
                                </div>
                                <div class="form-group what-sell">
                                    <i class="fa fa-question-circle"></i>
                                    <textarea type="textbox" name="reason" id="reason" class="form-control" placeholder="What product you want to sell?" ></textarea>
                                    <div id="reason_error" class="invalid-feedback ml-4"></div>
                                </div><br>

                                <button type="button" id="next-shop-btn" class="bttn">Next </button>
                                </div>
                                <div id="trader-shop-form">
                                    <div class="form-group mt-2">
                                        <i class="fa-solid fa-shop"></i>
                                        <input type="text" name="shopname" id="shopname" class="form-control" placeholder="Shop Name"/>
                                        <div id="shopname_error" class="invalid-feedback ml-4"></div>
                                    </div>
                                    <div class="form-group">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <input type="date" name="register_date" id="register_date" class="form-control" placeholder="Registration Date"/>
                                        <div id="register_date_error" class="invalid-feedback ml-4"></div>
                                    </div>
                                    <div class="form-group">
                                        <i class="fa-solid fa-id-card"></i>
                                        <input type="text" name="register_no" id="register_no" class="form-control" placeholder="PAN"/>
                                        <div id="register_no_error" class="invalid-feedback ml-4"></div>
                                    </div>
                                   <div class="pl-2">
                                   <input type="submit" id="trader-reg-btn" name="registerTrader" value="Register" class="bttn" style="margin-left:46px;"/>
                                   </div>
                                </div>

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
<script src="script/script.js"></script>
<script>
    $('.trad-form').click(function(){
        $('.trad-form').addClass('active-form');
        $('.cust-form').removeClass('active-form');
        $('.customer-register-container').addClass('d-none');
        $('.trader-register-container').removeClass('d-none');
    });

    $('.cust-form').click(function(){
        $('.cust-form').addClass('active-form');
        $('.trad-form').removeClass('active-form');
        $('.customer-register-container').removeClass('d-none');
        $('.trader-register-container').addClass('d-none');
    });
</script>
    
<script src="script/preventRefresh.js"></script>
<script src="script/preventRefreshTrader.js"></script>
<script src="script/function.js"></script>
</html>