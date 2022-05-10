<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrint-into">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-image: linear-gradient(135deg, #8ac1ef, #ca6ce9, #8ac1ee);
        animation: gradient 10s ease infinite;
        background-size: 400% 400%;
        font-family: "Open Sans", sans-serif;
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
        height: 600px;
        margin: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .left {
        position: relative;
        background-image: linear-gradient(45deg, #ff00d4, #00ddff);
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

    .right header {
      color: #903775;
        font-size: 44px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .row {
        height: 100%;
    }

    .myRegister {
        position: relative;
        background: #fff;
        height: 100%;
        border-radius: 25px;
        box-shadow: 0px 10px 40px -10px rgba(0, 0, 0, 0.7);
    }

    .left header {
        color: #fff;
        font-size: 44px;
    }

    .contain {
        position: relative;
        margin: 20px;
        margin-bottom: 100px;
    }

    .right .inputs {
        width: 230px;
        border-radius: 25px;
        padding: 10px;
        padding-left: 50px;
        border: none;
        box-shadow: 0px 10px 49px -14px rgba(0, 0, 0, 0.7);
    }

    .right .inputs:focus {
        outline: none;
    }

    .forms {
        position: relative;
        margin-top: 50px;
    }

    .right .bttn {
        background: linear-gradient(45deg, #ff00d4, #00ddff);
        color: #fff;
        width: 225px;
        border: none;
        border-radius: 25px;
        padding: 10px;
        box-shadow: 0px 10px 41px -11px rgba(0, 0, 0, 0.7);
    }

    .right .bttn:hover {
        background: linear-gradient(45deg, #000000, #ff00d4);
        opacity: .3;
    }

    .right .bttn:focus {
        outline: none;
    }

    .right .fa{
        position: relative;
        color: bb36fd;
        left: 36px;
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

    .acc {
        font-size: 13px;
    }

    .butt:hover {
        border: 2px solid #eecbff;
    }

    .butt:focus {
        outline: none;
    }
</style>

<body>
    <div class="container">
        <div class="myRegister">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <div class="contain">
                            <header>Hey Signup</header>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor ipsum, odit rerum cupiditate quisquam, temporibus mollitia eaque omnis sint minima tempora corporis nesciunt aliquid facilis alias, obcaecati eos quo ut!</p>
                            <input type="button" class="butt" value="learn More" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right">
                        <form class="forms text-center">
                            <header>Login</header>
                            <span class="acc">Don't have an account? <a href="#">Create a new account</a></span><br>

                            <div class="form-group mx-auto d-block w-25 mt-4">
                                <img src="phon.png" class="img-thumbnail" alt="error in content display">
                            </div>

                            <div class="form-group mt-3">
                                <i class="fa fa-user"></i>
                                <input type="text" class="inputs" placeholder="Username/Email">
                                <div class="invalid-feedback">Please fill out this field</div>
                            </div>

                            <div class="form-group mt-3">
                                <i class="fa fa-lock"></i>
                                <input type="password" class="inputs" placeholder="Password" name="pass">
                                <div class="invalid-feedback">Please fill out this field</div>
                            </div>

                            <div class="form-group mt-3">
                                <label>
                                    <input type="checkbox" class="check" name="check1"><small>I read and agree to Terms & Conditions</small></input>
                                    <div class="invalid-feedback">you must check the box.</div>
                                </label>
                            </div><br>
                            <input type="submit" class="bttn" value="Login"><br>
                            <span class="forget"><a href="#">Forget Password?</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>