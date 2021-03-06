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
    <title>Checkout</title>
</head>
<body>
    <?php include_once('header.php');?>
    <div class="loader">
        <img src="image/loader.gif" />
    </div>
    <div class="container mt-5 pt-5 cart-container">
        <div class="alert alert-success cart-success action-success" role="alert">
        </div>
        <div class="fail-container pop-msg">
        </div>
    <?php
        $item_count=checkUserGotCartItem($_SESSION['phoenix_user'], $connection);
        if($item_count>0 || isset($_GET['buynow']))
        {
        ?>
        <div class="row my-5 w-100 align-items-end">
            <div class="col-6 pl-3">
                <h2 class="all-heading">Order Overview</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-8">
                <div class="row w-100 cart-heading">
                    <div class="col-4">
                        Image
                    </div>
                    <div class="col-4">
                        Name 
                    </div>
                    <div class="col-4">
                        Price
                    </div>
                </div>
                <hr>
                <?php 
                    if(isset($_GET['buynow']) && isset($_GET['pid']) && !empty($_GET['pid']))
                    {
                      $query="SELECT * FROM PRODUCT WHERE PRODUCT_ID=".$_GET['pid'];
                      $quantity=1;
                      $_SESSION['buy-now-product']=$_GET['pid'];
                      $buynow='t';
                    }
                    else
                    {
                    $query="SELECT * FROM CART_ITEM CI JOIN PRODUCT P ON P.PRODUCT_ID=CI.PRODUCT_ID AND USER_ID=".$_SESSION['phoenix_user'];
                    $buynow='f';
                    }
                    $parsed=oci_parse($connection,$query);
                    oci_execute($parsed);
                    $subtotal=0;
                    while (($row = oci_fetch_assoc($parsed)) != false) {
                        if($buynow == 'f')
                        {
                            $quantity=$row['QUANTITY'];
                        }
                        $price=calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);
                ?>
                <div class="row w-100 py-2 justify-content-center align-items-center cart-items">
                    <div class="col-4">
                        <div class="review-profile-container cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                            <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>" class="cart-prod-img img-fluid"/>
                        </div>
                    </div>
                    <div class="col-4 d-block cat-product-container"  value="<?php echo $row['PRODUCT_ID'];?>">
                        <div><?php echo $row['PRODUCT_NAME'];?></div>
                    </div>
                    <div class="col-4 individual-price" value="<?php echo $price;?>">
                        <span>&#163;</span><?php echo $price;?> X <?php echo $quantity;?></span>
                    </div>
                    <hr class="ml-3" style="width:100%;">
                </div>
                
                <?php
                    $subtotal=$subtotal+($price*$quantity);
                    $total=$subtotal;
                    }
                    oci_free_statement(($parsed));

                    if(isset($_SESSION['COUPON']) & !empty($_SESSION['COUPON']))
                    {
                        $coupon=$_SESSION['COUPON'];

                        $total= calculateSubtotalAfterCoupon($coupon, $subtotal, $connection);
                        $discount=$subtotal-$total;
                    }
                ?>

            </div>
            <?php
            date_default_timezone_set("Europe/London");
            $today_day=date('D');
            $today_day=strtoupper($today_day);
            $current_hour=date('G');
            // $current_hour=13;
            // $today_day='FRI';
            ?>
            <div class="col-lg-4">
            <input type="hidden" id="today_day" value="<?php echo $today_day; ?>"/>
            <input type="hidden" id="current_hour" value="<?php echo $current_hour; ?>"/>
                <div class="cart-summary px-2">
                    <div class="row w-100 justify-content-center px-2 pt-3 mb-n1 ">
                        <h5>Purchase Information</h5>
                    </div>
                    <hr>
                   
                        <div  class="row w-100 justify-content-between pt-1 pl-4">
                            <div  class="col-4">
                                Day
                            </div>
                            <div class="col-7" value="">
                                <select class="custom-select form-control" id="select-collection-slot" name="select-collection-slot">
                                    <option value="0" disabled selected>Collection Day</option>
                                    
                                <?php  
                                    if(($today_day== 'SAT') ||( $today_day== 'SUN') || ($today_day== 'MON') || ($today_day=='TUE' && $current_hour<16) ||( $today_day== 'FRI'))
                                    {
                                ?>
                                        <option value="WED"><?php echo date('dS F, D', strtotime('next wednesday'));?></option>
                                        <option value="THU"><?php echo date('dS F, D', strtotime('next thursday'));?></option>
                                        <option value="FRI"><?php echo date('dS F, D', strtotime('next friday'));?></option>
                                    <?php
                                    }
                                    else if($today_day=='TUE')
                                    {
                                    ?>
                                        <option value="THU"><?php echo date('dS F, D', strtotime('next thursday'));?></option>
                                        <option value="FRI"><?php echo date('dS F, D', strtotime('next friday'));?></option>
                                    <?php 
                                    }
                                    else if( $today_day == 'WED')
                                    {
                                    ?>
                                        <option value="THU"><?php echo date('dS F, D', strtotime('next thursday'));?></option>
                                        <option value="FRI"><?php echo date('dS F, D', strtotime('next friday'));?></option>
                                        <option value="WED"><?php echo date('dS F, D', strtotime('next wednesday'));?></option>
                                    <?php 
                                    }
                                    else if( $today_day == 'THU')
                                    {
                                    ?>
                                        <option value="FRI"><?php echo date('dS F, D', strtotime('next friday'));?></option>
                                        <option value="WED"><?php echo date('dS F, D', strtotime('next wednesday'));?></option>
                                        <option value="THU"><?php echo date('dS F, D', strtotime('next thursday'));?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            
                            </div>
                        </div>
                        <div  class="row w-100 justify-content-between pt-3 pl-4 d-none collect-time-container">
                            <div  class="col-4">
                                Time
                            </div>
                            <div class="col-7" value="">
                                <select class="custom-select form-control" id="select-collect-time" name="sort-product-option">
                                    <option value="0" selected disabled>Collection Time</option>
                                    <option value="10-13"> 10AM - 1PM</option>
                                    <option value="13-16"> 1PM - 4PM</option>
                                    <option value="16-19"> 4PM - 7PM</option>
                                </select>
                            </div>
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
                        <div  class="row w-100  justify-content-between pt-2 pl-4">
                            <div class="col-8">
                                Discount
                            </div>
                            <div class="col-4">
                                <span>&#163;</span><?php echo (isset($discount)) ? $discount : '0.0';?>
                            </div>
                        </div>
                        <hr>
                        <div  class="row w-100 justify-content-between pl-4">
                            <div  class="col-8">
                                Total
                            </div>
                            <div  class="col-4 total-with-disc">
                                <span>&#163;</span><?php echo $total;?>
                            </div>
                        </div>
                        <div  class="row w-100 justify-content-center px-2">
                            <div class="btn py-1 px-3 mt-1 mb-3 check-collection">
                                Payment
                            </div> 
                        </div>
                        <div  class="row w-100 justify-content-center payment-container d-none py-3">
                            <hr>

                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST" id="make-payment" name="make-payment">
                                <input type="hidden" name="purchase-type" id="purchase-type" value="<?php echo $buynow;?>">
                                <input type="hidden" name="business" value="sb-spqm012101291@business.example.com"/>
                                <input type="hidden" name="cmd" value="_xclick" />
                                <input type="hidden" name="amount" value="<?php echo $total?> " />
                                <input type="hidden" name="currency_code" value="GBP" />
                                <input type="hidden" name="cancel_return" value="http://localhost/project_management/level5_project_management/cart-page.php">
                                <input type="hidden" name="return" value="http://localhost/project_management/level5_project_management/payment-sucess-page.php" />
                                
                                <div class=" col-6  mt-1 mb-3 paypal-btn text-center">
                                <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online."> 
                                <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1"> 
                            </form>
                        </div> 
                            
                                                        <?php
                                require('stripe\config.php');
                            ?>   
                            <form action="payment-sucess-page.php" method="post">
                                <input type="hidden" name="purchase-type" id="purchase-type" value="<?php echo $buynow;?>">
                                <input type="hidden" name="amount" id="amount" value="<?php echo $total;?>">
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button" id="ll"
                                        data-key="<?php echo $publishableKey?>"
                                        data-amount="<?php echo $total*100;?> "
                                        data-name="PhoenixMart"
                                        data-description="Phoenix Mart"
                                        data-image="https://i.ibb.co/GRzxrdD/logo.png"
                                        data-currency="gbp"
                                        data-email="nimisaraut@gmail.com"
                                    >
                                    </script>
                            </form>
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