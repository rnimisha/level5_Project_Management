<?php
  include_once('../connection.php');
  include_once('../function.php');
  if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']))
  {
    header('Location: ../loginform.php');
  }
  if(isset($_SESSION['user_role']) && $_SESSION['user_role']!='C')
  {
    header('Location: ../loginform.php');
  }
  if(isset($_SESSION['phoenix_user']) && !empty(($_SESSION['phoenix_user'])) && $_SESSION['user_role']=='C')
  {
      $cust_id=$_SESSION['phoenix_user'];
  }
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
    <link rel="stylesheet" type="text/css" href="../style/header.css" />
    <link rel="stylesheet" type="text/css" href="style/cust-style.css" />
    <title>My Account</title>
</head>
<body>
    <?php include_once('header.php');?>
    <?php include_once('include-header.php');?>
    <div class="loader">
            <img src="../image/loader.gif" />
    </div>
    <div class="container setting-container mb-5">
        <div class="row w-100 mt-5">
            <div class="col-md-3 d-flex justify-content-start align-items-start pr-0 mt-2">
                <div class="list-group list-group-flush setting-nav w-100 setting-nav">
                    <a href="cust-setting-index.php" class="list-group-item active rounded-top">
                        <i class='bx bx-grid-alt' ></i>
                        <span> &nbsp; Dashboard</span>
                    </a>
                    <a href="my-account-page.php" class="list-group-item">
                        <i class='bx bx-user' ></i>
                        <span> &nbsp; My Profile</span>
                    </a>
                    <a href="my-orders-page.php" class="list-group-item">
                        <i class='bx bx-package'></i>
                        <span> &nbsp; My Orders</span>
                    </a>
                    <a href="track-order-page.php" class="list-group-item">
                        <i class='bx bx-notepad'></i>
                        <span> &nbsp; Track My Order</span>
                    </a>
                    <a href="..\wishlist-page.php" class="list-group-item">
                        <i class='bx bx-book-heart' ></i>
                        <!-- <i class='bx bx-bookmark-heart' ></i> -->
                        <span> &nbsp; My WishList</span>
                    </a>
                    <a href="my-review-page.php" class="list-group-item">
                        <i class='bx bx-message-rounded-dots'></i>
                        <span> &nbsp; My Reviews</span>
                    </a>
                    <a href="deactivate-account-page.php" class="list-group-item">
                        <i class='bx bx-user-x'></i>
                        <span> &nbsp; Deactivate</span>
                    </a>
                    <a href="cust-logout.php" class="list-group-item rounded-bottom">
                        <i class='bx bx-exit bx-rotate-180' ></i>
                        <span> &nbsp; Sign Out</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9 d-flex justify-content-center align-items-start">
                <div class="row w-100 justify-content-center align-items-start">
                    <div class="col-md-6 pr-3 mt-2">
                        <div class="setting-nav d-block justify-content-center align-items-center my-profile-container overview-row">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>My Profile</b></div>
                            <div class="px-4 py-2">
                                <!-- <img src="..\image\profile\default_profile.jpg"  alt="profile" class="img-fluid container-profile"/> -->
                                <i class="fa-solid fa-user-tag"></i>&nbsp; <?php  echo (isset($fullnames)) ? $fullnames : null;?>
                            </div>
                            <div class="px-4 py-2">
                                <i class="fa-solid fa-envelope-open-text"></i>&nbsp;&nbsp; <?php  echo (isset($email)) ? $email : null;?>
                            </div>
                            <div class="px-4 py-2">
                                <i class="fa-solid fa-cake-candles"></i> &nbsp;&nbsp; <?php  echo (isset($dob)) ? $dob : null;?>
                            </div>
                            <div class="px-4 py-2">
                                <i class="fa-solid fa-location-dot"></i> &nbsp;&nbsp; <?php  echo (isset($address)) ? $address : null;?>
                            </div>
                            <div class="px-4 py-2">
                                <i class="fa-solid fa-phone"></i> &nbsp; <?php  echo (isset($contact)) ? $contact : null;?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="setting-nav overview-row">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>Wishlist</b></div>
                            <a href="..\wishlist-page.php"><div class="wishlist-dashboard text-center mt-3">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                            <div class="text-center pb-3">
                                <?php echo checkWishlistCount($_SESSION['phoenix_user'], $connection);?> items
                            </div></a>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="setting-nav align-items-center pb-4">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>Orders</b></div>
                            <div class="row w-100 d-flex justify-content-center align-items-center">
                                <div class="col-md-3 d-block text-center px-4 py-2">
                                    <a href="my-orders-page.php"><i class="fa-solid fa-basket-shopping orders-icons"></i>
                                    <div>All order</div></a>
                                </div>
                                <div class="col-md-3 d-block text-center px-4 py-2">
                                    <a href="my-orders-page.php"><i class="fa-solid fa-truck-fast orders-icons "></i>
                                    <div>To Receive</div></a>
                                </div>
                                <div class="col-md-3 d-block text-center px-4 py-2">
                                    <a href="my-orders-page.php"><i class="fa-solid fa-truck-ramp-box orders-icons"></i>
                                    <div>Received</div></a>
                                </div>
                                <div class="col-md-3 d-block text-center px-4 py-2">
                                    <a href="my-review-page.php"><i class="fa-solid fa-comment orders-icons "></i>
                                    <div>To Review</div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script src="../script/function.js"></script>
<script src="script/script.js"></script>
</html>