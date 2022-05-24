<?php
include_once('connection.php');
include_once('function.php');

if(isset($_GET['shopno']) && !empty($_GET['shopno']))
{
    $shop_id=$_GET['shopno'];
    $shopQuery="SELECT * FROM SHOP WHERE SHOP_ID=$shop_id";
    $parsed=oci_parse($connection, $shopQuery);
    oci_execute($parsed);
    $row = oci_fetch_assoc($parsed);
    $shop_name=$row['SHOP_NAME'];
    $shop_logo=$row['SHOPLOGO'];
    oci_free_statement($parsed);
}
else{
    header('Location: index.php');
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
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <link rel="stylesheet" type="text/css" href="style/header.css" />
  <title>Shop</title>
</head>
<body>
  <?php include_once('header.php');?>
  <div class="cart-msg pop-msg">
    </div>
  <div class="container-fluid mt-5">
        <!-- banner -->
        <div class="row mt-5 mb-3 pt-4 shop-header p-0 d-flex justify-content-center align-items-center">
            <div class="col-md-2 col-3 p-0 text-right">
                <img src="image\shop\<?php  echo (isset($shop_logo) && !empty($shop_logo)) ? $shop_logo: 'shop-placeholder.jpg';?>"  alt="profile" class="img-fluid shop-logo-img"/>
                <div class="mb-4"><?php  echo (isset($fullnames)) ? $fullnames : null;?> </div>
            </div>
            <div class="col-sm-6">
                <h4><?php echo $shop_name;?></h4>
                <span><?php echo  getshopProductRatingPercent($shop_id, $connection);?></span>
            </div>
        </div>
            </div>
        </div>
    </div>
    
    <div class="container mb-5 pb-5">
        <div class="col-12 text-center mt-5 h3 my-green-font">
            Shop Products
        </div>
        <div class="d-flex flex-row-reverse">
            <a href="category-page.php?submit-filter=&shops[]=<?php echo $shop_id?>" class="btn">Filter</a>
        </div>
        <!-- Discount Products -->
        <div class="row mt-3 mb-5">
            <?php

            $query="SELECT * FROM PRODUCT WHERE SHOP_ID=$shop_id AND STOCK_QUANTITY>0 AND UPPER(DISABLED)='F'";
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
            while(($row = oci_fetch_assoc($parsed)) != false) 
            {
            ?>
            <div class="col-lg-3 col-sm-6 cat-product-container mt-3" value="<?php echo $row['PRODUCT_ID'];?>">
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

  <?php 
  include_once('popup-modal.php');
  include_once('footer.php');?>

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