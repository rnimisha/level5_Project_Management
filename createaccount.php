<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CustomerLogin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        position: absolute;
        max-width: 1200px;
        height: 640px;
        margin: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .leftpanel {
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
        color:#000;
    }
    .leftpanel header {
        color:#000;
        font-size: 44px;
    }

    .form-container {
        background: #fff;
        min-height: 600px;
        position: relative;
        margin: 0 30px;
        overflow: hidden;
    }

    .row {
        height: 100%;
    }

    .newaccount {
        position: relative;
        background: #fff;
        height: 105%;
        border-radius: 25px;
        box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
    }

    .rightpanel header {
        color:#78967e;
        font-size: 22px;
        font-weight: 700;
        text-align: center;
    }

    .rightpanel .fa {
        position: relative;
        color: bb36fd;
        left: 36px;
    }

    .form-container span {
        font-weight: bold;
        margin-left: 100px;
        padding: 0 10px;
        position: relative;
        color: #333;
        cursor: pointer;
        width: 100px;
        display: inline-block;
        margin-right: 15px;
    }

    .log-opt {
        display: inline-block;
    }

    .cus {
        left: 30px;
    }


    .form-container form {
        max-width: 400px;
        padding: 10px 10px;
        position: absolute;
        transition: transform 1s;
    }

    .rightpanel .inputs {
        width: 240px;
        border-radius: 25px;
        padding: 10px;
        padding-left: 50px;
        border: none;
        box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
        margin-left: auto;
        top: 10px;

    }

    .inputbox .bttn:hover {
        background: linear-gradient(45deg, #c3cfbb, #c4cbbf, #c6c4c7);
        opacity: .3;
    }

    .inputbox .bttn {
        background: linear-gradient(45deg, #78967e, #8ea792, #bac9bc, #c6c4c7);
        color: #fff;
        width: 225px;
        border: none;
        border-radius: 25px;
        padding: 10px;
        box-shadow: 0px 10px 21px -11px rgba(0, 0, 0, 0.1);
        margin-left: 26px;
    }


    .inputbox .bttn:focus {
        outline: none;
    }

    span>a {
        position: absolute;
        left: 82.33%;
    }

    #trad {
        left: 115px;
    }

    #cust {
        left: -390px;
    }

    #line {
        border: none;
        width: 70px;
        background-color: #000000;
        height: 5px;
        margin-top: 10px;
        margin-left: 220px;
        transform: translateX(100px);
        transition: transform 1s;
    }

    .butt {
        background: transparent;
        color: #fff;
        width: 120px;
        border: 2px solid #fff;
        border-radius: 25px;
        padding: 10px;
        box-shadow: 0px 10px 49 -14px rgba(0, 0, 0, 0.7);

    }
    .butt:hover {
        border: 2px solid #eecbff;
    }

    .butt:focus {
        outline: none;
    }
 .form-control {
    color: #495057;
    background-color: #fff;
    border: 0px solid #ced4da;
    border-bottom: 1px solid #d4cfcf;
    border-radius: 0rem;
    background-color: transparent;
}
.form-control:focus {
    border-color: #78967e;
    box-shadow: 0 0 0 0rem rgb(0 123 255 / 25%);
}
</style>

<body>
    <div class="container">
        <div class="newaccount">
            <div class="row">
                <div class="col-md-6">
                    <div class="leftpanel">
                        <div class="contain">
                            <header>Already a member?</header>
                            <p>Click button below to login</p>
                            <input type="button" class="butt" value="lOGIN" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 justify-content-center align-items-center">
                    <div class="rightpanel ">
                        <div class="form-container mt-5">
                            <header>CREATE AN ACCOUNT</header>
                            <div class="log-opt mt-3 ">
                                <span class="cus" onclick="create()">Customer</span>
                                <span class="tra" onclick="create1()">Trader</span>
                                <hr id="line">
                            </div>
              
                            <form action="validateCustomer.php" method="POST"  id="cust-reg-form">
                            <div class="inputbox">
                                <div class="form-group mt-2">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="fullname" class="inputs" placeholder="Full Name" id="fullname" />
                                    <div id="name_error" style="color: red"></div>
                                </div>
                                <div class="form-group mt-2">
                                    <i class="fa fa-envelope"></i>
                                    <input type="text" name="uemail" id="useremail" class="inputs" placeholder="Email"/>
                                    <div id="email_error" style="color: red"></div>
                                </div>

                                <div class="form-group mt-2">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" name="ucontact" id="contact" class="inputs" placeholder="Contact" />
                                    <div id="contact_error" style="color: red"></div>
                                </div>

                                <div class="form-group mt-2">
                                    <i class="fa fa-calendar"></i>
                                    <input type="date" name="udob" id="dob" class="inputs" placeholder="Date of Birth"/><br/>
                                    <div id="dob_error" style="color: red"></div>
                                </div>
                                <div class="form-group mt-2">
                                    <i class="fa fa-map-marker"></i>
                                    <input type="text" name="uaddress" id="address" class="inputs" placeholder="Address"/><br/>
                                <div id="address_error" style="color: red"></div>
                                </div>
                                <div class="form-group mt-2">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="upass" id="pword" class="inputs" placeholder="Password" />
                                    <div id="pass_error" style="color: red"></div>
                                </div>
                                <div class="form-group mt-2">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="urep-pass" id="repass" class="inputs" placeholder="Confirm Password" /><br/>
                                    <div id="repass_error" style="color: red"></div>
                                </div>
                                <input type="submit" id="reg-btn" name="registerCustomer" value="Register"/>
                            </div>
                            </form>
    
                            <!-- <form id="cust" method="post" action="createaccount.php" >
                                <div class="inputbox">
                                    <div class="form-group">
                                        <i class="fa fa-user"></i>
                                        <input type="text" class="inputs" placeholder="Full Name" name="user" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" class="inputs" placeholder="Email" name="email" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-phone"></i>
                                        <input type="tel" class="inputs" placeholder="Contact" name="contact" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-map-marker"></i>
                                        <input type="text" class="inputs" placeholder="Address" name="address" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-calendar"></i>
                                        <input type="date" class="inputs" placeholder="DOB" name="birthdate" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="inputs" placeholder="Password" name="pass" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="inputs" placeholder="Re-enter Password" name="pass1" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div><br>
                                    <input type="submit" class="bttn" value="NEXT">
                                </div>
                            </form> -->
                            <form id="trad" method="post" action="createaccount.php">
                                <div class="inputbox">
                                    <div class="form-group">
                                        <i class="fa fa-user"></i>
                                        <input type="text" class="inputs" placeholder="Full Name" name="user" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" class="inputs" placeholder="Email" name="email" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-phone"></i>
                                        <input type="tel" class="inputs" placeholder="Contact" name="contact" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-map-marker"></i>
                                        <input type="text" class="inputs" placeholder="Address" name="address" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-calendar"></i>
                                        <input type="date" class="inputs" placeholder="DOB" name="birthdate" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="inputs" placeholder="Password" name="pass" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="inputs" placeholder="Re-enter Password" name="pass1" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <i class="fa fa-question-circle"></i>
                                        <input type="text" class="inputs" placeholder="What product you want to sell?" name="sale" />
                                        <div class="invalid-feedback">Please fill out this field</div>
                                    </div><br>
                                    <input type="submit" class="bttn" value="NEXT">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="Graphic">
            <img src="foody.jpg" alt="error in content display">
        </div> -->
        <script>
            var Customer = document.getElementById("trad");
            var Trader = document.getElementById("cust");
            var line = document.getElementById("line");

            function create1() {
                Trader.style.transform = "translateX(100px)";
                trad.style.transform = "translateX(3px)";
                line.style.transform = "translateX(98px)";
            }

            function create() {
                cust.style.transform = "translateX(510px)";
                trad.style.transform = "translateX(510px)";
                line.style.transform = "translateX(-78px)";
            }
        </script>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="script/preventRefresh.js"></script>
<script src="script/preventRefreshTrader.js"></script>
<script src="script/function.js"></script>
</html>
