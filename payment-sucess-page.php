<?php
include_once('connection.php');
include_once('function.php');
require('stripe\config.php');

    if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']) )
    {
        header('Location: loginform.php');
    }
    if(isset($_SESSION['user_role']) && $_SESSION['user_role']!='C')
    {
        header('Location: loginform.php');
    }
    if(isset($_GET['PayerID']))
    {
        $payment_id= $_GET['PayerID'];
        $method='PAYPAL';
    }
    else if(isset($_POST['stripeToken'])){
        \Stripe\Stripe::setVerifySslCerts(false);
    
        $token=$_POST['stripeToken'];
        $amount=floatval($_POST['amount']);
    
        $data=\Stripe\Charge::create(array(
            "amount"=>$amount*100,
            "currency"=>"gbp",
            "description"=>"Phoenix Mart Purchase",
            "source"=>$token,
        ));
        $payment_id=$token;
        $method='STRIPE';
    }
    else
    {
        header('Location: loginform.php');
    }
    
    $customer_id=$_SESSION['phoenix_user'];
    // $order_id=22;//for now
    // $collection_id=1;
    //get user information for invoice
    $getUser="SELECT * FROM MART_USER WHERE USER_ID=$customer_id";
    $parsedUser=oci_parse($connection, $getUser);
    oci_execute($parsedUser);
    $row= oci_fetch_assoc($parsedUser);
    $cust_name=$row['NAME'];
    $address=$row['ADDRESS'];
    $email=$row['EMAIL'];

    if(isset($_SESSION['collection-id']) && isset($_SESSION['buynow']))
    {
        $collection_id= $_SESSION['collection-id'];
        //insert new order
        $insertOrder="INSERT INTO CUST_ORDER(SLOT_ID, USER_ID) VALUES($collection_id,$customer_id)";
        $parsedOrder=oci_parse($connection, $insertOrder);
        oci_execute($parsedOrder);
        oci_free_statement($parsedOrder);

        //get order id for current order
        $getOrderId="SELECT ORDER_ID FROM CUST_ORDER ORDER BY ORDER_ID DESC ";
        $parsed=oci_parse($connection, $getOrderId);
        oci_execute($parsed);
        $row= oci_fetch_assoc($parsed);
        $order_id=$row['ORDER_ID'];
        
        if(strtolower($_SESSION['buynow'])=='t')
        {
            if(isset($_SESSION['buy-now-product']))
            {
                $product=$_SESSION['buy-now-product'];
                $insertItem="INSERT INTO ORDER_ITEM(ORDER_ID, ITEM_QUANTITY, PRODUCT_ID) VALUES($order_id, 1, $product)";
                $parsedItem=oci_parse($connection, $insertItem);
                oci_execute($parsedItem);
                oci_free_statement($parsedItem);
            }
        }
        else{
            //insert ordered products
            $cartQuery="SELECT * FROM CART_ITEM WHERE USER_ID=$customer_id";
            $paresedCart=oci_parse($connection, $cartQuery);
            oci_execute($paresedCart);
            while (($row = oci_fetch_assoc($paresedCart)) != false) {
                $quantity=$row['QUANTITY'];
                $product=$row['PRODUCT_ID'];
                $insertItem="INSERT INTO ORDER_ITEM(ORDER_ID, ITEM_QUANTITY, PRODUCT_ID) VALUES($order_id, $quantity, $product)";
                $parsedItem=oci_parse($connection, $insertItem);
                oci_execute($parsedItem);
                oci_free_statement($parsedItem);
            }
            oci_free_statement($paresedCart);

            //clear cart for user after order
            $clearCart="DELETE FROM CART_ITEM WHERE USER_ID=$customer_id";
            $parsedClear=oci_parse($connection, $clearCart);
            oci_execute($parsedClear);
            oci_free_statement($parsedClear);
        }

        //insert coupon if used
        if(isset($_SESSION['COUPON']))
        {
            $coupon_id= $_SESSION['COUPON'];
            $insertCoupon="INSERT INTO ORDER_COUPON(ORDER_ID, COUPON_ID) VALUES($order_id, $coupon_id)";
            $parsedCoupon=oci_parse($connection, $insertCoupon);
            oci_execute($parsedCoupon);
            oci_free_statement($parsedCoupon);
            unset($_SESSION['COUPON']);
        }
        
        //insert payment details
        $paymentInsert="INSERT INTO PAYMENT(PAYMENT_METHOD, ACCOUNT_ID, ORDER_ID) VALUES('$method', '$payment_id', $order_id)";
        $parsedPayment=oci_parse($connection, $paymentInsert);
        if(oci_execute($parsedPayment))
        {
            $to=$email;
            $subject="Order placed successfully";
            $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

        
            $body="
            <html>
            <head>
                <title>Order Success</title>
                <style>
                    th, td {
                    padding: 10px;
                    border-color: grey;
                    }
                </style>
            </head>
            <body>
                <div style='background-color: #fcf7f9; width:80%; margin:10%; padding: 20px;'>
                    <center>
                        $image <br/>
                        Your order has been placed successfully!
                        Order details are provided below <br> 
                        <br> 

                        <table style='width:80%;  border-collapse: collapse;'>
                        <tr style='border: 1px solid; background-color: #d7dfd2; '>
                            <th style='border: 1px solid;'> Product</th>
                            <th style='border: 1px solid;'> Price</th>
                            <th style='border: 1px solid;'> Quantity</th>
                            <th style='border: 1px solid;'> Discount(%)</th>
                            <th style='border: 1px solid;'> Subtotal</th>
                        </tr>";
                    
                        $subtotal=0;
                        $product_query="SELECT  P.PRODUCT_ID AS PRODUCT_ID, PRODUCT_NAME, PRICE, ITEM_QUANTITY FROM PRODUCT P JOIN ORDER_ITEM OI ON P.PRODUCT_ID=OI.PRODUCT_ID WHERE ORDER_ID=$order_id";
                        $parse_product=oci_parse($connection, $product_query);
                        oci_execute($parse_product);
                        while (($row = oci_fetch_assoc($parse_product)) != false) {
                        $discount=0;
                        $discount=floatval(getProductDiscount($row['PRODUCT_ID'], $order_id, $connection));
                        $total_individual=$row['PRICE']-(($discount/100)*$row['PRICE']);
                        $subtotal=$subtotal+$total_individual;
                        $body.="<tr style='border: 1px solid; text-align: center;'>
                                <td style='border: 1px solid;'>".$row['PRODUCT_NAME']."</td>
                                <td style='border: 1px solid;'>  <span>&#163;</span>".$row['PRICE']."</td>
                                <td style='border: 1px solid;'>".$row['ITEM_QUANTITY']." </td>
                                <td style='border: 1px solid;'>".$discount."</td>
                                <td style='border: 1px solid;'>  <span>&#163;</span>".$total_individual."</td>
                        </tr>";
                        }
                        $body.="</table>
                        <br>
                        <div style='text-align:right; padding-right: 10px;width:80%'>
                        <div>Subtotal : <span>&#163;</span>".$subtotal."</div>";
                        $final_total=$subtotal;
                        if(isset($coupon_id))
                        {
                            $final_total=calculateSubtotalAfterCoupon($coupon_id, $subtotal, $connection);
                            $discount=$subtotal-$final_total;
                        } 
                        $body.="<div>Discount : <span>&#163;</span>".$discount."</div> 
                        <div> Total : <span>&#163;</span>".$final_total."</div>  
                        </div>
                        <br><br><br>  
                        <hr style='border: 0.7px solid grey; width:80%;'>
                        <span style='color:grey';>Thank You For Supporting Us</span>
                    </center>
                </div>
            </body>
            </html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                mail($to, $subject, $body, $headers);
                }
        // echo $paymentInsert;
        oci_free_statement($parsedPayment);
    }
    // else
    // {
    //     header('Location: index.php');
    // }
    

    //get collection slot infor
    $collectQuery="SELECT * FROM SLOT WHERE SLOT_ID=$collection_id";
    $parsed=oci_parse($connection, $collectQuery);
    oci_execute($parsed);
    $row= oci_fetch_assoc($parsed);
    $collect_day=$row['SLOT_DAY'];
    $collect_time=$row['TIME_RANGE'];
    oci_free_statement($parsed);
    unset($_SESSION['collection-id']);

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
    <title>Payment Success</title>
</head>

<body>
    <div class="loader">
        <img src="image/loader.gif" />
    </div>
    <?php include_once('header.php');?>
    <div class="container mt-5 pt-5">
        <div class="row w-100 d-print-none">
            <div class="col-7 mx-auto text-center mt-5">
                <img src="image\payment-success.gif" alt="payment success" class="no-data-found img-fluid" />
                <div class="mt-1 my-green-font">
                    <h3><b>Success</b></h3>
                </div>
                <div>Your order has been placed successfully.</div>
                <a href="category-page.php" class="mt-3 py-1 pt-2 px-3 btn">
                    <h6>Continue shopping</h6>
                </a> &nbsp;
            </div>
        </div>
        <div class="invoice-container mb-5 mt-3 border rounded p-3 " id="invoice">
            <div class="col-12 text-center my-green-font">
                <h3>ORDER #<?php echo $order_id?></h3>
            </div>
            <div class="row">
                <div class="col-6 text-left">
                    <div class="mt-1">Name : <?php echo $cust_name;?></div>
                    <div class="mt-1">Email : <?php echo $email;?></div>
                    <div class="mt-1">Address : <?php echo $address;?></div>
                </div>
                <div class="col-6 text-right">
                    <div class="mt-1">Order Date : <?php echo date("dS M, Y");?><div>
                            <div class="mt-1">Collection : <?php echo $collect_day.', '. $collect_time;?></div>
                            <div class="mt-1">Status : <?php echo 'PENDING';?></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 table-responsive mt-5 px-3 mx-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>PRODUCT NAME</th>
                                <th>QUANTITY</th>
                                <th>PRICE PER UNIT</th>
                                <th>DISCOUNT(%)</th>
                                <th>SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $subtotal=0;
                                $product_query="SELECT  P.PRODUCT_ID AS PRODUCT_ID, PRODUCT_NAME, PRICE, ITEM_QUANTITY FROM PRODUCT P JOIN ORDER_ITEM OI ON P.PRODUCT_ID=OI.PRODUCT_ID WHERE ORDER_ID=$order_id";
                                $parse_product=oci_parse($connection, $product_query);
                                oci_execute($parse_product);
                                while (($row = oci_fetch_assoc($parse_product)) != false) {
                                $discount=floatval(getProductDiscount($row['PRODUCT_ID'], $order_id, $connection));
                                $total_individual=$row['PRICE']-(($discount/100)*$row['PRICE']);
                                $subtotal=$subtotal+$total_individual;
                            ?>
                            <tr>
                                <td>
                                    <div class="review-profile-container cat-product-container">
                                        <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>" alt="product image"  class="cart-prod-img img-fluid"/>
                                    </div>
                                </td>
                                <td><?php echo $row['PRODUCT_NAME'];?></td>
                                <td><?php echo $row['ITEM_QUANTITY'];?></td>
                                <td><span>&#163;</span><?php echo $row['PRICE'];?></td>
                                <td><?php echo $discount;?></td>
                                <td><span>&#163;</span><?php echo $total_individual;?></td>
                            </tr>
                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-right">
                <hr>
                    <div class="mt-1">Subtotal : <span>&#163;</span><?php echo $subtotal;?></div>
                    <?php
                    $final_total=$subtotal;
                    if(isset($coupon_id))
                    {
                        $final_total=calculateSubtotalAfterCoupon($coupon_id, $subtotal, $connection);
                        $discount=$subtotal-$final_total;
                    }   
                    ?>
                    <div class="mt-1">Discount :  <span>&#163;</span><?php echo (isset($discount)) ? $discount : '0.0';?></div>
                    <div class="mt-1">Total : <span>&#163;</span><?php echo $final_total;?></div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-12 text-center  d-print-none">
                <button  class="mt-1 py-1 pt-2 px-3 btn"  onclick="window.print()"> Print Invoice</button>
        </div>
    <div class="container-fluid mt-2 pt-5 mx-0 px-0 d-print-none">
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
<script>
    $(window).on("load",function(){
    $(".loader").fadeOut(1000);
    $(".container-fluid").fadeIn(1000);
    });
</script>
<!-- custom script -->
<script src="script/function.js"></script>
<script src="script/script.js"></script>
<script src="script/cart-action.js"></script>
</html>
