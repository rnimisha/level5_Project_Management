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
    <title>My Review</title>
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
                    <a href="..\wishlist-page.php" class="list-group-item">
                        <i class='bx bx-heart' ></i>
                        <span> &nbsp; My WishList</span>
                    </a>
                    <a href="my-review-page.php" class="list-group-item active">
                        <i class='bx bx-message-rounded-dots'></i>
                        <span> &nbsp; My Reviews</span>
                    </a>
                    <a href="" class="list-group-item rounded-bottom">
                        <i class='bx bx-exit bx-rotate-180' ></i>
                        <span> &nbsp; Sign Out</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9 d-flex justify-content-center align-items-start">
                <div class="row w-100 justify-content-center align-items-start">
                    <div class="col-12 mt-2">
                        <div class="setting-nav align-items-center pb-4">
                            <div class="border-bottom pt-3 pb-2 d-flex justify-content-center text-center">
                                <div class="col-md-6 my-green-font"><b><i class="fa-solid fa-comment-dots"></i>&nbsp;
                                        Reviewed</b></div>
                                <div class="col-md-6"><b><i class="fa-solid fa-comment-medical"></i>&nbsp; To Review</b>
                                </div>
                            </div>
                            <?php
                                $query="SELECT REVIEW_COMMENT, STAR_RATING, REVIEW_DATE, P.PRODUCT_ID AS PRODUCT_ID, PRODUCT_NAME FROM REVIEW R JOIN PRODUCT P ON P.PRODUCT_ID=R.PRODUCT_ID WHERE USER_ID=$cust_id ORDER BY REVIEW_DATE DESC";
                                $parsed_query=oci_parse($connection, $query);
                                oci_execute($parsed_query);
                                while (($row = oci_fetch_assoc($parsed_query)) != false) {

                            ?>
                            <div class="row justify-content-center align-items-center all-orders-container transition-effect px-4 my-5">
                                <div class="col-2">
                                    <div class="review-profile-container">
                                        <a href="..\product-detail-page.php?pid=<?php echo $row['PRODUCT_ID']?>">
                                            <img src="..\image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>" class="review-profile img-fluid" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-10 d-block justify-content-start">
                                    <div class="row w-100 text-muted">
                                        <div class="col-6 justify-content-start align-items-start text-left px-0">
                                            <?php 
                                                for($i=1; $i<=$row['STAR_RATING']; $i++)
                                                {
                                                ?>
                                            <i class='bx bxs-star'></i>
                                            <?php
                                                }
                                                for($i=1; $i<=(5-$row['STAR_RATING']); $i++)
                                                {
                                                ?>
                                            <i class='bx bx-star'></i>
                                            <?php
                                                }
                                                ?>
                                        </div>
                                        <div class="col-6 text-right px-0">
                                            <small><?php echo $row['REVIEW_DATE']; ?></small>
                                        </div>
                                    </div>
                                    <div class="row w-100 verification">
                                        <small><a href="..\product-detail-page.php?pid=<?php echo $row['PRODUCT_ID']?>"><?php echo $row['PRODUCT_NAME']; ?></a></small>
                                    </div>
                                    <div class="row w-100 text-left mt-1">
                                        <?php echo $row['REVIEW_COMMENT']->load(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
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