<?php
include_once('connection.php');
include_once('function.php');
?>
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
    <title>Forgot Password</title>
</head>
<body>
<?php include_once('header.php');?>
    <div class="container mt-5 pt-5">
        <div class="row w-100 mt-5 mx-auto forgot-pass-container mb-5">
            <div class="col-md-6 mx-auto text-center mt-5">
                <img src="image\forgot.png" alt="payment success" class="no-data-found img-fluid" />
            </div>
            <div class="col-md-6 transition-effect mt-5">
                <h3 class="all-heading text-center mt-5">Forgot Password?</h3>
                <p class="text-center text-muted">We will send a reset link to your email</p>
                <form class="w-75 mx-auto py-4 mt-5" action="vaildate-reset-pass.php" method="POST"  id="forgot-pass-form">
                    <div class="form-group mt-2">
                            <input type="text" name="forgot-email"  class="form-control" id="forgot-email" placeholder="Enter your email"/>
                            <span id="forgot-pass-error" class="invalid-feedback" ></span>
                    </div>
                    <div class="row w-100 justify-content-end">
                        <input type="submit" class="btn py-2 px-4" id="forgot-pass-btn" name="forgotpass" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 transition-effect justify-content-center d-none align-items-center pass-email-sent">
            <div class="row w-100 mx-auto justify-content-center">
                <img src="image\pass-mail.gif" class="contact-us-img img-fluid" />
            </div>
            <div  class="row w-100 mx-auto d-block justify-content-center text-center my-3">
                <h4>Request accepted</h4> <br>Check your email to reset password.
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 pt-5">
        <?php include_once('footer.php');?>
    </div>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom script -->
<script src="script/preventRefresh.js"></script>
<script src="script/function.js"></script>
<script src="script/script.js"></script>
</html>