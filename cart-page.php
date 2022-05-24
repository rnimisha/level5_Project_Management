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
    <title>My Cart</title>
</head>
<body>
    <?php include_once('header.php');?>
    <div class="loader">
        <img src="image/loader.gif" />
    </div>
    <div class="container mt-5 pt-5 cart-container">
        <div class="cart-msg pop-msg">
        </div>
    <?php
        $item_count=checkUserGotCartItem($_SESSION['phoenix_user'], $connection);
        if($item_count>0)
        {
        ?>
        <div class="row my-5 w-100 align-items-end">
            <div class="col-6 pl-3">
                <h2 class="all-heading">My Cart</h2>
                <div class="text-muted" id="total-item-count" value="<?php echo $item_count;?>">Total items : <?php echo $item_count;?></div>
            </div>
            <div class="col-3">
                <div class="text-right text-muted remove-all-cart-btn">
                <i class="fa-regular fa-trash-can text-muted"></i> Remove All
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-9">
                
                <div class="row w-100 cart-heading">
                    <div class="col-5">
                        Product
                    </div>
                    <div class="col-2">
                        Price
                    </div>
                    <div class="col-2">
                        Quantity
                    </div>
                    <div class="col-2 col-md-2 d-none d-md-flex ">
                        Subtotal
                    </div>
                    <div class="col-1">
                    
                    </div>
                </div>
                <hr>
                <?php 
                    $query="SELECT * FROM CART_ITEM CI JOIN PRODUCT P ON P.PRODUCT_ID=CI.PRODUCT_ID WHERE UPPER(DISABLED)='F' AND STOCK_QUANTITY>0 AND USER_ID=".$_SESSION['phoenix_user'];
                    $parsed=oci_parse($connection,$query);
                    oci_execute($parsed);
                    $subtotal=0;
                    while (($row = oci_fetch_assoc($parsed)) != false) {
                        $out_of_stock='f';
                        $price=calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);
                ?>
                <div class="row w-100 py-2 justify-content-center align-items-center cart-items">
                    <div class="col-2">
                        <div class="review-profile-container cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                            <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>" class="cart-prod-img img-fluid"/>
                        </div>
                    </div>
                    <div class="col-3 d-block cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                        <div><?php echo $row['PRODUCT_NAME'];?></div>
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
                    <div class="col-2 individual-price" value="<?php echo $price;?>">
                        <span>&#163;</span><?php echo $price;?></span>
                    </div>
                    <div class="col-2">
                        <div class="wrapper d-flex  align-items-center">
                            <span class="minus-cart">-</span>
                            <span class="quantity"><?php echo $row['QUANTITY'];?></span>
                            <span class="plus-cart">+</span>
                            <input type="hidden" value="<?php echo $row['QUANTITY'];?>" id="real-quantity" />
                            <input type="hidden" value="<?php echo $row['STOCK_QUANTITY'];?>" id="stock-amount" />
                            <input type="hidden" value="<?php echo $row['PRODUCT_ID'];?>" class="cart-product-id" />
                            <input type="hidden" value="<?php echo $row['MIN_ORDER'];?>" class="mimimum-order" />
                            <input type="hidden" value="<?php echo $row['MAX_ORDER'];?>" class="maximum-order" />
                        </div>
                    </div>
                    <div class="col-2 each-subtotal d-none d-md-flex ">
                        <span>&#163;</span><?php echo $price*$row['QUANTITY'];?>
                    </div>
                    <div class="col-1">
                        <i class="fa-regular fa-trash-can pl-3 remove-cart-item" value="<?php echo $row['PRODUCT_ID'];?>"></i>
                    </div>
                    <hr class="ml-3" style="width:100%;">
                </div>
                
                <?php
                    $subtotal=$subtotal+($price*$row['QUANTITY']);
                    }
                    oci_free_statement(($parsed));
                ?>
                
                <div class="row w-100 py-2 cart-items mt-5">
                    <div class="col-12 pl-3">
                        <h6><b>Apply Coupon</b></h6>
                    </div>
                    <div class="col-12  mb-4">
                        <form class="row w-100 submit-coupoun">
                        <input type="hidden" id="subtotal_coupon" value="<?php echo $subtotal;?>">
                            <div class="col-4 pl-3 pt-2">
                                <input type="text" class="form-control" id="coupon-code" style="width: 100%; border-radius: 5px; border: 1px solid #e8e8e8;">
                                <div class="invalid-feedback" id="error-coupon"></div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class=" btn py-1 mt-2 px-3 coupon-btn"> Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cart-summary px-2">
                    <div class="row w-100 justify-content-center px-2 pt-3 mb-n1 ">
                        <h5>Order Summary</h5>
                    </div>
                    <hr>
                    <div  class="row w-100 justify-content-between pt-1 pl-4">
                        <div  class="col-8">
                            Subtotal
                        </div>
                        <div class="col-4 over-all-subtotal" value="<?php echo $subtotal;?>">
                            <span>&#163;</span><?php echo $subtotal;?>
                        </div  class="col-6">
                    </div>
                    <div  class="row w-100 justify-content-between pt-2 pl-4">
                        <div class="col-8">
                            Discount
                        </div>
                        <div class="col-4 overall-dis">
                            <span>&#163;</span>0.0
                        </div>
                    </div>
                    <hr>
                    <div  class="row w-100 justify-content-between pl-4">
                        <div  class="col-8">
                            Total
                        </div>
                        <div  class="col-4 total-with-disc">
                            <span>&#163;</span><?php echo $subtotal;?>
                        </div>
                    </div>
                    <hr>
                    <div  class="row w-100 justify-content-center px-2">
                        <div class="btn py-1 px-3 mt-1 mb-3 checkout-btn">
                            Checkout
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <?php
        }
        else{
        ?>
        <div class="row mt-3 w-100">
            <div class="col-12 justify-content-center align-items-center">
                <h2 class="all-heading">My Cart</h2>
            </div>
            <div class="col-5 mx-auto text-center">
                <img src="image\cartempty.png" class="no-data-found img-fluid" />
                <div class="mt-3"><h4><b>Your cart is empty<b></h4></div>
                <a href="category-page.php" class="mt-3 py-1 pt-2 px-3 btn"><h6>Continue shopping</h6></a>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <?php
        include_once('popup-modal.php');
    ?>
    <div class="container-fluid mt-5 pt-5 px-0 mx-0">
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