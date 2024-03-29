<?php
include_once('connection.php');
include_once('function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/header.css" /> 
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: "Quicksand", sans-serif;
    }

    .faq {
        height: 100%;
        padding: 50px 0;
        color: #78967e;

    }
    .btn:hover {
        background-color: transparent;
        transition: background-color 0.7s linear;
        cursor: pointer;
    }

    .faq header {
        font-weight: 1000;
        font-size: 50px;
        text-align: center;
        padding: 20px 0 50px 0;
    }

    .accordion .card {
        background: none;
        border-radius: 0px;
        border-left-width: 0;
        border-right-width: 0;
        /* border-top-width: 0; */
    }

    .accordion .card .card-header {
        background: none;
        padding-top: 7px;
        padding-bottom: 7px;
        border-radius: 0px;
    }

    .accordion .card-header h2 a {
        font-size: 1.2rem;
        text-decoration: none;
    }

    .accordion .card-header .btn {
        color: #78967e;
        width: 100%;
        text-align: left;
        padding-left: 0;
        padding-right: 0;
    }

    .accordion .card-header i {
        font-size: 1.3rem;
        position: absolute;
        top: 15px;
        right: 1rem;

    }

    .accordion .card-body {
        /* color: #78967e; */
    }
    a {
        text-decoration: none;
    }
    .card-body{ 
        color:#000;
    }    
</style>

<body>
    <?php include_once('header.php');?>
    <div class="faq mt-5 pt-5 transition-effect">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <header class="head">FAQ's</header>
                    <div class="accordion" id="accordion-id">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapsei"> How to sell product with Phoenix Mart?<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapsei" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Trader can sell products that are unique to them. First step is registration which needs approvals. After approval products can be sold.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseii"> How to purchase a product?<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapseii" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Firstly login is required. You can search your desired product with text or filter with options available. Then add the required product to cart which can be brought by checking out with payment. You can directly procceed to checkout by clicking buy now button.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseiii"> What is collection slot?<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapseiii" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    We send the ordered goods at different collection location which can be picked up at mentioned time.<br>
                                    Available Slots are:<br>
                                    - WEDNESDAY (10AM - 1PM, 1PM - 4PM, 4PM - 7PM)<br>
                                    - THURSDAY (10AM - 1PM, 1PM - 4PM, 4PM - 7PM)<br>
                                    - FRIDAY (10AM - 1PM, 1PM - 4PM, 4PM - 7PM)
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseiv"> Is there home delivery?<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapseiv" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    We dont feature home delievry for the time being.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapsev"> Do we exchange or return goods?<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapsev" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    Ordered goods cannot be exchanged or returned.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="heading mb-0">
                                    <a class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapsevi"> What are our payment methods?<i class="fa fa-angle-down"></i></a>
                                </h2>
                            </div>
                            <div id="collapsevi" class="collapse" data-parent="#accordion-id">
                                <div class="card-body">
                                    We support two payment methods. Stripe and Paypal.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="container-fluid mt-5 pt-5 mx-0 px-0">
        <?php include_once('footer.php');?>
</div>
</html>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="script/script.js"></script>
<script src="script/function.js"></script>