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
    <title>Contact</title>
</head>
<body>
    <?php include_once('header.php');?>
    <div class="loader">
        <img src="image/loader.gif" />
    </div>
    <div class="container mt-5 pt-5">
        <div class="row w-100 mt-5 pt-1 mx-auto contact-us-container">
            <div class="row w-100 mt-5">
                <div class="col-12">
                    <h1 class="all-heading text-center">Get In Touch</h1>
                </div>
            </div>
            <div class="col-12 transition-effect">
                <form class="w-75 mx-auto py-4" action="validate-contactus.php" method="POST"  id="contact-us-form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text"  class="form-control"  name="firstname" id="firstname" placeholder="First Name"/>
                            <div class="invalid-feedback" id="firstname_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control"  name="lastname" id="lastname" placeholder="Last Name" />
                            <div class="invalid-feedback" id="lastname_error"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" name="uemail"  class="form-control" id="useremail" placeholder="Email"/>
                            <span id="contact_email_error" class="invalid-feedback"></span><br/>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="ucontact"  class="form-control" id="contact" placeholder="Contact"/>
                            <div id="contact_error" class="invalid-feedback" ></div><br/>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" id="message" placeholder="Message"></textarea>
                        <div id="message_error" class="invalid-feedback"></div><br/>
                    </div>
                    <div class="row w-100 justify-content-end submit-contact">
                        <input type="submit" class="btn py-2 px-4" id="contact-btn" name="contactus" value="Send"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 transition-effect justify-content-center d-none align-items-center contact-us-sent">
            <div class="row w-100 mx-auto justify-content-center">
                <img src="image\contact-us.gif" class="contact-us-img img-fluid" />
            </div>
            <div  class="row w-100 mx-auto justify-content-center text-center my-3">
                <h6>Thank you <br>We will contact you as soon as possible.</h6>
            </div>
        </div>

        <div class="row  w-100 g-3 my-5 justify-content-center align-items-center">
            <div class="col-md-4 mt-5 text-center">
                <i class="fa fa-map-marker fa-3x my-green-font" aria-hidden="true"></i>
                <h3>Location</h3>
                <p>Cleckhudders</p>
            </div>
            <div class="col-md-4 mt-5 text-center">
                <i class="fa fa-phone fa-3x my-green-font"></i>
                <h3>Phone</h3>
                <a href="tel:98413032413">+44 7911 123456</a>
            </div>
            <div class="col-md-4 mt-5 text-center">
                <i class="fa fa-envelope fa-3x my-green-font"></i>
                <h3>Email</h3>
                <a href="mailto:phoenixmart123@gmail.com">phoenixmart123@gmail.com</a>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 pt-5 mx-0 px-0">
    <?php include_once('footer.php');?>
    </div>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom script -->
<script src="script/contactus.js"></script>
<script src="script/script.js"></script>
<script src="script/function.js"></script>
</html>