<?php
  include_once('connection.php');
  include_once('function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>About Us</title>
    <link rel="stylesheet" type="text/css" href="aboutus/style.css">
    <link rel="stylesheet" type="text/css" href="style/header.css">
</head>
<body>
<?php include_once('header.php');?>
<!-- Banner  -->
<!-- <div class="Banner-Aboutus">
    <img src="./images/banner5.jpg" alt="organic text banner">
</div> -->
<!-- Phoenix mart Header -->
<div class="Header mt-5 pt-5">
    <h1 class="mt-5">Welcome to Phoenix Mart</h1>
    <h6>Delivering Freshness your footstep! </h6>
    <p>
        "We know the importance of great food. Getting the freshest, best-tasting food to households from our own local mart is why we wake up each morning, smiling and raring to go!We know the importance of great food. Getting the freshest, best-tasting food to households from our own local mart is why we wake up each morning, smiling and raring to go!"

    </p>
</div>
<!-- section one -->
<div class="container_center">
<div class="wrapper-1">
    <div class="row-2">
        <img src="aboutus\images\image2.jpg" alt="organic text banner">
    </div>
    <div class="row-2-1">
        <h2 class="row-2-1-header">We Provide Fresh Goods & Tasty Nuts</h2>
        <p class="row-2-1-paragraph">Have raw and organic food for a healthier lifestyle. Organic food is free from all sorts of harmful fertilizers and exclusively produced keeping health as the priority.Natural breed without any artificial components. Natural process of farming, storing and distributing the quality food for your need.Have a stay at home shopping experience with our online store and have the natural products delivered at your doorstep.
    </p></div>
</div>
</div>
<!-- Animation counter -->
<div class="counters">
    <div class="counter-header">
        <h1>What we do</h1>
        <h3>We are Trusted by Clients</h3>
    </div>
    <div class="counter-container">
        <div class="counter-container1">
            <i class="fab fa-youtube fa-4x"></i>
            <div class="counter" data-target="3">0</div>
            <h3>Service Years</h3>
        </div>
        <div class="counter-container2">
            <i class="fab fa-twitter fa-4x"></i>
            <div class="counter" data-target="1000">0</div>
            <h3>Sales</h3>
        </div>
        <div class="counter-container3">
            <i class="fab fa-facebook fa-4x"></i>
            <div class="counter" data-target="700">0</div>
            <h3>Happy Customers</h3>
        </div>
        <div class="counter-container4">
            <i class="fab fa-linkedin fa-4x"></i>
            <div class="counter" data-target="10">0</div>
            <h3>Areas</h3>
        </div>
    </div>
</div>
<!-- Our Speciality section -->
<div class="wrapper-3">
    <div class="wrapper-3-item1">
        <h1 >Our Speciality</h1> <br>
        <h3>Healthy Meat</h3>   
        <p> We specialize in all-natural, whole foods raised the way nature intended. Thank you to all of our loyal customers who support sustainable family farms. </p> 
        <h3>Fresh Fruit</h3>
        <p>Find the finest of locally produced fruits, sourcing in its varied form from the locals themselves. Learn more about our products.</p>
        <h3>Organic Veggies</h3>
        <p>Get Best deals on organic vegetables price  from the Phoenix Mart organic vegetables at best price at your home.Feel the freshness of the organic vegetables at your every bite. </p>
    </div>
    <div class="wraper-3-item2">
        <img src="aboutus/images/image4.jpg" alt="man on a cliff">
    </div>
    <div class="wraper-3-item3">
        <img src="aboutus/images/image3.jpg" alt="women inside hut">
    </div>
</div>
<div class="testimonial-container">
    <div class="testimonial-header">
        <h2>TESTIMONIAL</h2>
        <h5>Why choose us?</h5>
    </div>
    <div class="progress-bar"></div>
    <div class="fas fa-quote-right fa-quote"></div>
    <div class="fas fa-quote-left fa-quote"></div>
    <p class="testimonial">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem repellendus inventore hic quo ipsum nihil.
        Incidunt qui ipsum quisquam sequi maxime architecto similique reiciendis quidem facilis corporis libero nam
        nemo ratione id, necessitatibus ab debitis nulla harum. Optio corrupti dolorum debitis incidunt est
        architecto voluptas aut, nobis amet corporis accusamus.
    </p>
    <div class="user">
        <img src="https://randomuser.me/api/portraits/women/46.jpg" alt="user" class="user-image">
        <div class="user-details">
            <h4 class="username">Miyah Myles</h4>
            <p class="role">Marketing</p>
        </div>
    </div>
    
</div>
<div class="container-fluid mt-5 pt-5 mx-0 px-0">
        <?php include_once('footer.php');?>
</div>
<!-- <script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src ="aboutus/java.js"></script>
<script src ="aboutus/testimonial.js"></script>
<script src="script/function.js"></script>
<script src="script/script.js"></script>
</body>
</html>