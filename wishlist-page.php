<?php
include_once('connection.php');
include_once('function.php');
if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']) )
{
    header('Location: loginform.php');
}
if(isset($_SESSION['user_role']) && $_SESSION['user_role']!='C')
{
    header('Location: loginform.php');
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
    <link rel="stylesheet" type="text/css" href="style/header.css" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <title>My Wishlist</title>
</head>
<body>
    <?php include_once('header.php');?>
    <div class="container mt-5 pt-5 cart-container">
        <div class="alert alert-success cart-success action-success" role="alert">
            
        </div>
        <?php
        $item_count=checkWishlistCount($_SESSION['phoenix_user'], $connection);
        if($item_count>0)
        {
        ?>
        <div class="row my-5 w-100 align-items-end">
            <div class="col-6 pl-3">
                <h2 class="all-heading">My Wishlist</h2>
                <div class="text-muted" id="wislist-item-count" value="<?php echo $item_count;?>">Total items : <?php echo $item_count;?></div>
            </div>
            <div class="col-6">
                <div class="text-right text-muted">
                    <i class="fa-solid fa-heart-crack text-muted"></i> Remove All</i> 
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="row w-100 cart-heading">
                    <div class="col-5">
                        Product
                    </div>
                    <div class="col-md-2 d-none d-md-flex">
                        Price
                    </div>
                    <div class="col-md-2 d-none d-md-flex">
                        Status
                    </div>
                    <div class="col-md-3 d-none d-md-flex">
                        Action
                    </div>
                </div>
                <hr>
                <?php 
                    $query="SELECT * FROM WISHLIST_ITEM WI JOIN PRODUCT P ON P.PRODUCT_ID=WI.PRODUCT_ID AND USER_ID=".$_SESSION['phoenix_user'];
                    $parsed=oci_parse($connection,$query);
                    oci_execute($parsed);
                    $subtotal=0;
                    while (($row = oci_fetch_assoc($parsed)) != false) {
                ?>
                <div class="row w-100 py-2 justify-content-center align-items-center wishlist-items">
                    <div class="col-md-2 col-sm-3 cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                        <div>
                            <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>"  class="wishlist-prod-img img-fluid"/>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 d-block text-left cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                        <div><?php echo $row['PRODUCT_NAME'];?></div>
                    </div>
                    <div class="col-md-2  d-none d-md-flex individual-price" value="">
                        <span>&#163;</span><?php echo $row['PRICE'];?></span>
                    </div>
                    <div class="col-md-2 d-none d-md-flex">
                        <?php 
                        if($row['STOCK_QUANTITY']>0)
                        {
                        ?>
                            <span class="badge badge-pill badge-completed">In Stock</span>
                        <?php
                        }
                        else{
                        ?>
                            <span class="badge badge-pill badge-fail">Out of Stock</span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-3 col-sm-3   remove-wishlist-item" value="<?php echo $row['PRODUCT_ID'];?>">
                        <span><i class="fa-solid fa-heart-crack" style="font-size: 20px;"></i> &nbsp;</span>
                        <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                    </div>
                    <hr class="ml-3" style="width:100%;">
                </div>
                <?php
                    }
                    oci_free_statement(($parsed));
                ?>
            </div>
        </div>
        <?php
        }
        else{
            ?>
            <div class="row mt-3 w-100">
                <div class="col-12 justify-content-center align-items-center">
                    <h2 class="all-heading">My Wishlist</h2>
                </div>
                <div class="col-5 mx-auto text-center pt-5 mb-4">
                    <img src="image\empty-wishlist.png" class="no-data-found img-fluid" />
                    <div class="mt-3"><h4><b>Your wishlist is empty<b></h4></div>
                    <a href="category-page.php" class="mt-3 py-1 pt-2 px-3 btn"><h6>Continue shopping</h6></a>
                </div>
            </div>
            <?php
            }
            ?>
    </div>
    <div class="container-fluid mt-5 pt-5 mx-0 px-0">
        <?php include_once('footer.php');?>
    </div>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<!-- custom script -->
<script src="script/function.js"></script>
<script src="script/script.js"></script>
<script src="script/cart-action.js"></script>
</html>