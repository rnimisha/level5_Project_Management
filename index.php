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
  <?php include_once('header.php');?>
  <!-- banner -->
  <div class="container mt-5 pt-5">
    <div class="row mt-4">
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


    <div class="row mt-5 mb-5 d-flex justify-content-center align-items-center main-category">
      <!-- <div class="col-12 text-center h3 my-green-font mb-2">
        Category
      </div> -->
      <div class="col-md-2 col-4 text-center">
        <a href="category-page.php?submit-filter=&category[]=1">
          <img src="image\category\fruit.png" alt="profile" class="img-fluid category-img" />
          <div class="cat-font"> Fruit</div>
        </a>
      </div>
      <div class="col-md-2 col-4  text-center">
        <a href="category-page.php?submit-filter=&category[]=3">
          <img src="image\category\butcher.png" alt="profile" class="img-fluid category-img" />
          <div>Meat</div>
        </a>
      </div>
      <div class="col-md-2 col-4  text-center">
        <a href="category-page.php?submit-filter=&category[]=4">
          <img src="image\category\bakery.png" alt="profile" class="img-fluid category-img" />
          <div>Bakery</div>
        </a>
      </div>
      <div class="col-md-2 col-4 text-center">
        <a href="category-page.php?submit-filter=&category[]=7">
          <img src="image\category\fish.png" alt="profile" class="img-fluid category-img" />
          <div>Seafood</div>
        </a>
      </div>
      <!-- <div class="col-md-2 col-4">
        <img src="image\category\deli.png" alt="profile" class="img-fluid category-img" />
        <div class="ml-4">Fruit</div>
      </div> -->
      <div class="col-md-2 col-4 text-center">
        <a href="category-page.php">
          <img src="image\category\allcat.png" alt="profile" class="img-fluid category-img" />
          <div>All</div>
        </a>
      </div>
    </div>




    <!-- best sellers -->
    <div class="row mt-5 mb-5 top-seller">
      <div class="col-12 text-center mt-5 h3 my-green-font">
        Top Seller
      </div>
      <div class="row px-5 pb-5">
        <?php

          $query="SELECT a.* FROM (SELECT COUNT(P.PRODUCT_ID) AS COUNT_ORDER, PRODUCT_NAME, PRICE, P.PRODUCT_ID AS PRODUCT_ID FROM PRODUCT P JOIN ORDER_ITEM OI ON P.PRODUCT_ID=OI.PRODUCT_ID WHERE UPPER(DISABLED)='F' GROUP BY P.PRODUCT_ID, PRODUCT_NAME, PRICE ORDER BY COUNT(P.PRODUCT_ID) DESC)a WHERE ROWNUM <= 6";
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



    <!-- New arrivals -->
    <div class="row mt-5 mb-5">
      <div class="col-12 text-center h3 my-green-font mb-2">
        New Arrival
      </div>
      <div class="row mt-2">
        <?php

          $query="SELECT a.* FROM(SELECT * FROM PRODUCT WHERE UPPER(DISABLED)='F' ORDER BY PRODUCT_ID DESC)a WHERE ROWNUM <= 4";
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



    <!-- two side banner -->
    <div class="row p-0 d-flex justify-content-center align-items-center">
      <div class="img-container col-lg-6 pr-2 pl-0">
        <img src="image\banner\longbanner.jpg" class="img-fluid category-banner" alt="banner">
        <div class="banner-text col-5">
          <h3>Healthy meat</h3>
          <p class="text-dark">Top quality meat for you</p>
          <a href="category-page.php?submit-filter=&category[]=3" class="btn px-3">Shop</a>
        </div>
      </div>
      <div class="img-container col-lg-6 d-lg-flex d-none pl-2 pr-0">
        <img src="image\banner1.png" class="img-fluid category-banner" alt="banner">
        <div class="banner-text col-5">
          <h3>Rich in quality</h3>
          <p class="text-dark">Locallly grown juciest fruits</p>
          <a href="category-page.php?submit-filter=&category[]=1" class="btn px-3">Shop</a>
        </div>
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

          $query="SELECT a.* FROM(SELECT PRODUCT_ID, PRICE,PRODUCT_NAME, COUNT_SUM/COUNT_TOTAL AS AVERAGE FROM (SELECT COUNT(*) AS COUNT_TOTAL,P.PRODUCT_ID,PRICE,PRODUCT_NAME ,SUM(STAR_RATING) AS COUNT_SUM FROM PRODUCT P JOIN REVIEW R ON R.PRODUCT_ID = P.PRODUCT_ID WHERE UPPER(DISABLED)='F' GROUP BY P.PRODUCT_ID, PRICE,PRODUCT_NAME ) ORDER BY AVERAGE DESC)a  WHERE ROWNUM <= 4";
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

    <!-- banner -->
    <div class="row mt-5 mb-5 p-0 d-md-block d-none">
      <div class="col-12 p-0 fullbanner-container">
        <img src="image\banner\full_longbanner.jpg" alt="payment success" class="full-banner img-fluid" />
        <div class="full-banner-text col-5">
          <h2>100% Organic and Fresh!</h2>
          <p>Beverages full of nutrition and energy</p>
          <a href="category-page.php?submit-filter=&category[]=5" class="btn px-3">Shop</a>
        </div>
      </div>
    </div>

    <div class="row p-0 mx-0 my-5">
      <div class="container mx-auto px-0">
        <div class="col-12 text-center h3 my-green-font mb-2">
          Ongoing Offers
        </div>
        <!-- DISCOUNT PRODUCT ROW -->
        <div class="row w-100">
          <div class="col-lg-8">
            <div class="row p-0 m-0">
              <?php
                $discount_query="SELECT a.* FROM(SELECT PRODUCT_NAME, PRICE, DISCOUNT_RATE, DISCOUNT_ID, P.PRODUCT_ID FROM PRODUCT P JOIN DISCOUNT D ON P.PRODUCT_ID=D.PRODUCT_ID WHERE EXPIRY_DATE>=SYSDATE AND START_DATE<=SYSDATE AND UPPER(DISABLED)='F')a  WHERE ROWNUM <= 4";
                $parsed_disc=oci_parse($connection, $discount_query);
                oci_execute($parsed_disc);
                while (($row = oci_fetch_assoc($parsed_disc)) != false) {
                ?>
              <div class="col-sm-6 mt-4">
                <div class="row w-100 d-flex justify-content-center align-items-center">
                  <div class="col-6 bg-light">
                    <div class="cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                        <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>" class="discount-img img-fluid"/>
                    </div>
                  </div>
                  <div class="col-6 d-block cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                    <div><?php echo $row['PRODUCT_NAME'];?></div>
                    <div>
                        <span
                            class="prod-price"><?php echo calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);?></span>&nbsp;
                        <span class="before-discount">&#163;<?php echo $row['PRICE']; ?> </span>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                }
              ?>
            </div>
          </div>
          <!-- BANNER ROW -->
          <div class="col-lg-4 mt-4 discount-banner d-lg-flex d-none">
              <div class="img-container">
                <img src="image\banner\discountbanner.jpg" alt="discount banner" class="img-fluid discount-banner category-banner" />
              </div>
              <div class="discount-text col-5">
                <h3>Discount Offers!</h3>
                <a href="discount-page.php" class="btn px-3 mt-3 align-self-end">View</a>
              </div>
          </div>
        </div>
      </div>
    </div>

  <!-- order process  -->
    <div class="row mb-5 mt-5 pt-5 d-lg-flex d-none">
      <div class="col-12 text-center h3 my-green-font">
        Order Process
      </div>
      <div class="col-7 mx-auto text-center mt-0 delivery-img">
        <img src="image\deliveryphase.gif" alt="payment success" class="no-data-found img-fluid" />
        <div class="delivery-text-container row d-flex justify-content-around mt-1">
          <div class="col-4">
            <span>&nbsp;&nbsp;&nbsp; Place Order</span>
          </div>
          <div class="col-4">
            <span>&nbsp;&nbsp; Payment</span>
          </div>
          <div class="col-4">
            <span>Out For Collection</span>
          </div>
        </div>
      </div>
    </div>

    <!-- discount  -->
    <!-- <div class="row mb-5 bg-light">
      efje
    </div> -->



      <!-- OUR TRADERS -->
    <!-- <div class="row mt-5 mb-5 d-flex justify-content-center align-items-center">
      <div class="col-12 text-center h3 my-green-font mb-2">
        Our Traders
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\butcher.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\fishmonger.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\baker.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\greengrocer.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
      <div class="col-md-2 col-4">
        <img src="image\shop\deli.jpg" alt="profile" class="img-fluid trader-img" />
      </div>
    </div> -->
  </div>

 
  <?php 
  include_once('popup-modal.php');
  include_once('footer.php');
  ?>

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