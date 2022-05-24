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
    <title>Reset Password</title>
</head>
<body>
<?php include_once('header.php');?>
    <div class="loader">
        <img src="image/loader.gif" />
    </div>
    <div class="container pt-5 mt-5">
        <div class="row w-100 mt-5 mx-auto reset-pass-container mb-5">
            <div class="col-md-6 mx-auto text-center mt-5">
                <img src="image\resetpass.png" alt="payment success" class="no-data-found img-fluid" />
            </div>
            <div class="col-md-6 transition-effect mt-5">
                <h3 class="all-heading text-center mt-5">Reset Password</h3>
                <form class="w-75 mx-auto py-4 mt-5" action="vaildate-reset-pass.php" method="POST"  id="reset-pass-forms">
                    <div class="form-group mt-2">
                            <input type="password" name="new-pass"  class="form-control" id="new-pass" placeholder="Enter new password"/>
                            <span id="new-pass-error" class="invalid-feedback" ></span>
                    </div>
                    <div class="form-group">
                            <input type="password" name="confirm-pass"  class="form-control" id="confirm-pass" placeholder="Re-enter password"/>
                            <span id="confirm-pass-error" class="invalid-feedback" ></span>
                    </div>
                    <input type="hidden" value="<?php echo $_GET['token']?>" id="token"/>
                    <input type="hidden" value="<?php echo $_GET['email']?>" id="email"/>
                    <div class="row w-100 justify-content-end">
                        <input type="submit" class="btn py-2 px-4" id="reset-pass-btn" name="forgotpass" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 mt-5 transition-effect justify-content-center d-none align-items-center pass-email-sent">
            <div class="row w-100 mx-auto justify-content-center">
                <img src="image\successpic.gif" class="contact-us-img img-fluid" />
            </div>
            <div  class="row w-100 mx-auto d-block justify-content-center text-center my-3">
                <div><h4>Success</h4> </div>
                <div>Your Password has been updated. Login to continue.</div>
                <a href="loginform.php" class="mt-3 py-1 pt-2 px-3 btn">
                    <h6>Login</h6>
                </a> &nbsp;
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