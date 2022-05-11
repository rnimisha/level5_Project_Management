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
    <link rel="stylesheet" type="text/css" href="style/cust-style.css" />
    <title>Account Deactivation</title>
</head>
<body>
    <?php include_once('include-header.php');?>
    <div class="container setting-container mb-5">
        <div class="row w-100 mt-5">
            <div class="col-md-3 d-flex justify-content-start align-items-start pr-0 mt-2">
                <div class="list-group list-group-flush setting-nav w-100 setting-nav" id="sticky-nav">
                    <a href="cust-setting-index.php" class="list-group-item rounded-top">
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
                    <a href="cust-logout.php" class="list-group-item active rounded-bottom">
                        <i class='bx bx-exit bx-rotate-180' ></i>
                        <span> &nbsp; Sign Out</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9 d-flex justify-content-center align-items-start">
                <div class="row w-100 justify-content-center align-items-start">
                    <div class="col-12 mt-2">
                        <div class="setting-nav align-items-center pb-4 order-cust-container">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>Sign Out</b></div>
                            <div class="row w-100 d-flex justify-content-center align-items-center">
                                <div class="col-md-5 text-center">
                                    <img src="..\image\sign-out.gif" class="img-fluid deactivate-pic"/>
                                </div>
                                <div class="col-12 text-center">
                                    Do you want to sign out?
                                </div>
                                <div class="col-12 mt-1 text-center">
                                    <a href="../logout.php"><div class="btn">Sign Out</div></div>
                                </div>
                            </div>
                        </div>
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
<script src="../script/function.js"></script>
<script src="script/script.js"></script>
</html>