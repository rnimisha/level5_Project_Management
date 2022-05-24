<?php
include_once('..\connection.php');
include_once('..\function.php');
?>
<div class="container-fluid p-0 header-main" id="sticky-nav">
        <nav class="navbar py-0 navbar-expand-lg navbar-light border-bottom">
            <a class="navbar-brand pl-5" href="..\index.php" id="logo-header">
            <img src="..\image\logo.png" alt="logo"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-5">
                <li class="nav-item">
                <a class="nav-link " href="..\index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link  ml-3" href="..\category-page.php">Shop</a>
                </li>
                <li class="nav-item">
                <a class="nav-link  ml-3" href="..\about-us.php">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link ml-3" href="..\contact-us-page.php">Contact</a>
                </li>
                <li class="nav-item">
                <a class="nav-link ml-3" href="..\faq.php">FAQ</a>
                </li>
            </ul>
            <div class="justify-content-right navbar-nav search-bar transition-effect d-none ">
                <form class="form-inline ml-auto" id="text-filter">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" id="ftext" name="ftext">
                <button class="btn d-none btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="pr-5 nav-logo text-right">
                <span class="mr-3 search-icon transition-effect"><ion-icon name="search-outline"></ion-icon></span>
                <?php 
                    if(isset($_SESSION['phoenix_user']) && !empty($_SESSION['phoenix_user']) && isset($_SESSION['user_role']) && $_SESSION['user_role']=='C' )
                    {
                        $profile_pic= getProfilePicture($connection, $_SESSION['phoenix_user']);
                ?>
                         <span class="mr-3 user-hover header-pp"><img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>"  alt="profile" class="header-pp"/></span>
                <?php 
                    }
                    else
                    {
                ?>
                        <span class="mr-3 user-hover"><ion-icon name="person-outline"></ion-icon></span>
                <?php
                    }
                ?>
                <a href="..\wishlist-page.php"><span class="mr-3"><ion-icon name="heart-outline"></ion-icon></i></span></a>
                <a href="..\cart-page.php"><span class="mr-3"><ion-icon name="cart-outline"></ion-icon></span></a>
                <div class="dropdownmenu text-left d-none">
                <?php 
                    if(isset($_SESSION['phoenix_user']) && !empty($_SESSION['phoenix_user']) && isset($_SESSION['user_role']) && $_SESSION['user_role']=='C' )
                    {
                ?>
                    <div class="mt-2 ml-4 border-bottom py-2"><a href="cust-setting-index.php" ><i class="fa-regular fa-circle-user"></i> &nbsp; My Account</a></div>
                    <div class="mt-2 ml-4 pt-2 "><a href="my-orders-page.php" >My Order</a></div>
                    <div class="mt-2 ml-4 border-bottom pb-2"><a href="my-account-page.php" >Setting</a></div>
                    <div class="mt-2 ml-4 border-bottom pt-2 pb-3"><a href="cust-logout.php" >LogOut</a></div>
                    <?php 
                    }
                    else
                    {
                    ?>
                    <div class="mt-3 ml-4 border-bottom pb-2"><a href="..\loginform.php" >Login</a></div>
                    <div class="mt-2 ml-4 border-bottom pt-2 pb-3"><a href="..\registerform.php" >Register</a></div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            </div>
        </nav>
    </div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>