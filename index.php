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
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <link rel="stylesheet" type="text/css" href="style/header.css" />
  <title>Phoenix Mart</title>
</head>

<body>
  <div class="container-fluid p-0 header-main" id="sticky-nav">
    <nav class="navbar py-0 navbar-expand-lg navbar-light border-bottom">
      <a class="navbar-brand pl-5" href="index.php" id="logo-header">
        <img src="image\logo.png" alt="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-5">
          <li class="nav-item">
            <a class="nav-link " href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  ml-3" href="category-page.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  ml-3" href="about-us.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ml-3" href="contact-us-page.php">Contact</a>
          </li>
        </ul>
        <div class="justify-content-right navbar-nav search-bar transition-effect d-none ">
          <form class="form-inline ml-auto" id="text-filter">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" id="ftext" name="ftext">
            <button class="btn d-none btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
        <div class="pr-5 nav-logo text-right">
          <span class="mr-3 search-icon transition-effect">
            <ion-icon name="search-outline"></ion-icon>
          </span>
          <span class="mr-3 user-hover">
            <ion-icon name="person-outline"></ion-icon>
          </span>
          <a href="wishlist-page.php"><span class="mr-3">
              <ion-icon name="heart-outline"></ion-icon></i>
            </span></a>
          <a href="cart-page.php"><span class="mr-3">
              <ion-icon name="cart-outline"></ion-icon>
            </span></a>
        </div>
      </div>
    </nav>
  </div>

  <!-- banner -->
  <div class="container mt-5 pt-5">
    <div class="row mt-3">
      <div class="col-lg-4 d-lg-block d-none">
        <div>
          <div class="img-container">
            <img src="image\banner\bannermini3.jpg" class="img-fluid category-banner" alt="banner">
          </div>
        </div>
        <div class=" mt-4">
          <div class="img-container">
            <img src="image\banner\bannermini4.png" class="img-fluid category-banner" alt="banner">
          </div>
        </div>
      </div>
      <div class="col-lg-8 ml-n1 pr-0">
        <div class="img-container banner-img">
          <img src="image\banner\bannerbg.jpg" class="img-fluid category-banner main-banner" id="text-img-banner"
            alt="banner">
          <img src="image\banner\frontorange.png" class="img-fluid main-banner bounce" id="over-img" alt="banner">
          <div class="text-in-banner col-5">
            <h2>Fresh Up! Power Up !</h2>
            <p>Experience the whole new freshness</p>
            <a href="category-page.php" class="btn px-3">Shop</a>
          </div>
        </div>
      </div>
    </div>

    <!-- New arrivals -->
    <div class="row mt-5 mb-5">
      <div class="col-12 text-center h3 my-green-font mb-2">
        New Arrival
      </div>
      <div class="row mt-2">
        <?php

          $query="SELECT a.* FROM(SELECT * FROM PRODUCT ORDER BY PRODUCT_ID DESC)a WHERE ROWNUM <= 4";
          $parsed=oci_parse($connection, $query);
          oci_execute($parsed);
          while(($row = oci_fetch_assoc($parsed)) != false) 
          {
          ?>
        <div class="col-lg-3 col-sm-6 cat-product-container mt-1" value="<?php echo $row['PRODUCT_ID'];?>">
          <div class="cat-product col-12 text-center">
            <div class="inner-img-container">
              <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>"
                class="img-fluid product-pic" alt="product-img" />
            </div>
            <div class="option-container d-flex">
              <div>
                <i class='bx bx-search-alt-2 quick-view-product' value="<?php echo $row['PRODUCT_ID'];?>"></i>
              </div>
              <div>
                <i class='bx bx-cart-alt add-to-cart' value="<?php echo $row['PRODUCT_ID'];?>"></i>
              </div>
              <div>
                <?php
                            if(isset($_SESSION['phoenix_user']) && $_SESSION['user_role'])
                            {
                                $wishlist_status=checkProductInWishList($row['PRODUCT_ID'], $_SESSION['phoenix_user'], $connection);

                                if($wishlist_status)
                                {
                                ?>
                <i class='bx bxs-heart remove-from-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                                }
                                else
                                {
                                ?>
                <i class='bx bx-heart save-to-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                                }
                            }
                            else{
                                ?>
                <i class='bx bx-heart save-to-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                            }
                            ?>
              </div>
            </div>
            <div>
              <!-- display rating for product -->
              <?php 
                            $avgRating=getAvgRating($row['PRODUCT_ID'], $connection);
                            for($i=1; $i<=$avgRating; $i++)
                            {
                                ?>
              <i class='bx bxs-star'></i>
              <?php
                            }
                            for($i=1; $i<=(5-$avgRating); $i++)
                            {
                                ?>
              <i class='bx bx-star'></i>
              <?php
                            }
                        ?>
            </div>
            <div>
              <b><?php echo $row['PRODUCT_NAME']; ?></b>
            </div>
            <div>
              <?php 
                        $dis_rate=checkProductDiscountRate($row['PRODUCT_ID'], $connection);
                        if($dis_rate>0){
                            ?>
              <span
                class="prod-price"><?php echo calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);?></span>&nbsp;
              <span class="before-discount">&#163;<?php echo $row['PRICE']; ?> </span>
              <?php
                        }
                        else{
                            ?>
              <span class="prod-price"><?php echo $row['PRICE']; ?></span>
              <?php
                        }
                    ?>
            </div>
          </div>
        </div>
        <?php 
                }
            ?>
      </div>
    </div>


    <!-- best sellers -->
    <div class="row mt-5 mb-5 top-seller">
      <div class="col-12 text-center mt-5 h3">
        Top Seller
      </div>
      <div class="row px-5 pb-5">
        <?php

          $query="SELECT a.* FROM (SELECT COUNT(P.PRODUCT_ID) AS COUNT_ORDER, PRODUCT_NAME, PRICE, P.PRODUCT_ID AS PRODUCT_ID FROM PRODUCT P JOIN ORDER_ITEM OI ON P.PRODUCT_ID=OI.PRODUCT_ID GROUP BY P.PRODUCT_ID, PRODUCT_NAME, PRICE ORDER BY COUNT(P.PRODUCT_ID) DESC)a WHERE ROWNUM <= 6";
          $parsed=oci_parse($connection, $query);
          oci_execute($parsed);
          while(($row = oci_fetch_assoc($parsed)) != false) 
          {
          ?>
        <div class="col-lg-4 col-sm-6 mt-4 cat-product-container " value="<?php echo $row['PRODUCT_ID'];?>">
          <div class="cat-product col-12 text-center top-seller-product">
            <div class="inner-img-container">
              <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>"
                class="img-fluid product-pic" alt="product-img" />
            </div>
            <div class="option-container d-flex">
              <div>
                <i class='bx bx-search-alt-2 quick-view-product' value="<?php echo $row['PRODUCT_ID'];?>"></i>
              </div>
              <div>
                <i class='bx bx-cart-alt add-to-cart' value="<?php echo $row['PRODUCT_ID'];?>"></i>
              </div>
              <div>
                <?php
                            if(isset($_SESSION['phoenix_user']) && $_SESSION['user_role'])
                            {
                                $wishlist_status=checkProductInWishList($row['PRODUCT_ID'], $_SESSION['phoenix_user'], $connection);

                                if($wishlist_status)
                                {
                                ?>
                <i class='bx bxs-heart remove-from-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                                }
                                else
                                {
                                ?>
                <i class='bx bx-heart save-to-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                                }
                            }
                            else{
                                ?>
                <i class='bx bx-heart save-to-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                            }
                            ?>
              </div>
            </div>
            <div>
              <!-- display rating for product -->
              <?php 
                            $avgRating=getAvgRating($row['PRODUCT_ID'], $connection);
                            for($i=1; $i<=$avgRating; $i++)
                            {
                                ?>
              <i class='bx bxs-star'></i>
              <?php
                            }
                            for($i=1; $i<=(5-$avgRating); $i++)
                            {
                                ?>
              <i class='bx bx-star'></i>
              <?php
                            }
                        ?>
            </div>
            <div>
              <b><?php echo $row['PRODUCT_NAME']; ?></b>
            </div>
            <div>
              <?php 
                        $dis_rate=checkProductDiscountRate($row['PRODUCT_ID'], $connection);
                        if($dis_rate>0){
                            ?>
              <span
                class="prod-price"><?php echo calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);?></span>&nbsp;
              <span class="before-discount">&#163;<?php echo $row['PRICE']; ?> </span>
              <?php
                        }
                        else{
                            ?>
              <span class="prod-price"><?php echo $row['PRICE']; ?></span>
              <?php
                        }
                    ?>
            </div>
          </div>
        </div>
        <?php 
                }
            ?>
      </div>
    </div>

    <!-- banner -->
    <div class="row p-0 d-flex justify-content-center align-items-center">
      <div class="img-container col-lg-6 pl-0">
        <img src="image\banner\longbanner.jpg" class="img-fluid category-banner" alt="banner">
      </div>
      <div class="img-container col-lg-6 d-lg-flex d-none pr-0">
        <img src="image\banner1.png" class="img-fluid category-banner" alt="banner">
      </div>
      <!-- <img src="image\banner\longbanner.jpg" alt="payment success" class="no-data-found img-fluid" /> -->
    </div>
    <!-- </div> -->


    <!-- Highest rated -->
    <div class="row mt-5 mb-5">
      <div class="col-12 text-center h3 my-green-font mb-2">
        Top Rated
      </div>
      <div class="row mt-2">
        <?php

          $query="SELECT a.* FROM(SELECT PRODUCT_ID, PRICE,PRODUCT_NAME, COUNT_SUM/COUNT_TOTAL AS AVERAGE FROM (SELECT COUNT(*) AS COUNT_TOTAL,P.PRODUCT_ID,PRICE,PRODUCT_NAME ,SUM(STAR_RATING) AS COUNT_SUM FROM PRODUCT P JOIN REVIEW R ON R.PRODUCT_ID = P.PRODUCT_ID GROUP BY P.PRODUCT_ID, PRICE,PRODUCT_NAME ) ORDER BY AVERAGE DESC)a  WHERE ROWNUM <= 4";
          $parsed=oci_parse($connection, $query);
          oci_execute($parsed);
          while(($row = oci_fetch_assoc($parsed)) != false) 
          {
          ?>
        <div class="col-lg-3 col-sm-6 mt-1 cat-product-container" value="<?php echo $row['PRODUCT_ID'];?>">
          <div class="cat-product col-12 text-center">
            <div class="inner-img-container">
              <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>"
                class="img-fluid product-pic" alt="product-img" />
            </div>
            <div class="option-container d-flex">
              <div>
                <i class='bx bx-search-alt-2 quick-view-product' value="<?php echo $row['PRODUCT_ID'];?>"></i>
              </div>
              <div>
                <i class='bx bx-cart-alt add-to-cart' value="<?php echo $row['PRODUCT_ID'];?>"></i>
              </div>
              <div>
                <?php
                            if(isset($_SESSION['phoenix_user']) && $_SESSION['user_role'])
                            {
                                $wishlist_status=checkProductInWishList($row['PRODUCT_ID'], $_SESSION['phoenix_user'], $connection);

                                if($wishlist_status)
                                {
                                ?>
                <i class='bx bxs-heart remove-from-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                                }
                                else
                                {
                                ?>
                <i class='bx bx-heart save-to-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                                }
                            }
                            else{
                                ?>
                <i class='bx bx-heart save-to-wishlist' value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                <?php
                            }
                            ?>
              </div>
            </div>
            <div>
              <!-- display rating for product -->
              <?php 
                            $avgRating=getAvgRating($row['PRODUCT_ID'], $connection);
                            for($i=1; $i<=$avgRating; $i++)
                            {
                                ?>
              <i class='bx bxs-star'></i>
              <?php
                            }
                            for($i=1; $i<=(5-$avgRating); $i++)
                            {
                                ?>
              <i class='bx bx-star'></i>
              <?php
                            }
                        ?>
              (<?php echo $row['AVERAGE'];?>)
            </div>
            <div>
              <b><?php echo $row['PRODUCT_NAME']; ?></b>
            </div>
            <div>
              <?php 
                        $dis_rate=checkProductDiscountRate($row['PRODUCT_ID'], $connection);
                        if($dis_rate>0){
                            ?>
              <span
                class="prod-price"><?php echo calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);?></span>&nbsp;
              <span class="before-discount">&#163;<?php echo $row['PRICE']; ?> </span>
              <?php
                        }
                        else{
                            ?>
              <span class="prod-price"><?php echo $row['PRICE']; ?></span>
              <?php
                        }
                    ?>
            </div>
          </div>
        </div>
        <?php 
                }
            ?>
      </div>
    </div>

  </div>
  <div class="container-fluid">

  <div class="row mt-5 mb-5 p-0">
    <div class="col-12 p-0">
      <img src="image\banner\full_longbanner.jpg" alt="payment success" class="full-banner img-fluid" />
    </div>
  </div>
    <!-- OUR TRADERS -->
    <div class="row mt-5 mb-5 d-flex justify-content-center align-items-center">
      <div class="col-12 text-center h3 my-green-font mb-2">
        Our Traders
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\Traders-butcher.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\Traders-fishmonger.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\Traders-greengrocer.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\Traders-bakery.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\Traders-delicatessen.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
    </div>



    <div class="row bg-light">
      <div class="col-7 mx-auto text-center mt-5">
        <img src="image\deliveryphase.gif" alt="payment success" class="no-data-found img-fluid" />
      </div>
    </div>
  </div>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- custom script -->
<script src="script/function.js"></script>
<script src="script/script.js"></script>
<script src="script/cart-action.js"></script>

</html>