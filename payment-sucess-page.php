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
    $payment_id= $_GET['PayerID'];
    $customer_id=$_SESSION['phoenix_user'];

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
        $paymentInsert="INSERT INTO PAYMENT(PAYMENT_METHOD, ACCOUNT_ID, ORDER_ID) VALUES('PAYPAL', '$payment_id', $order_id)";
        $parsedPayment=oci_parse($connection, $paymentInsert);
        oci_execute($parsedPayment);
        // echo $paymentInsert;
        oci_free_statement($parsedPayment);
    unset($_SESSION['collection-id']);
    unset($_SESSION['buynow']);
    }
    $order_id=4;//for now

    //get user information for invoice
    $getUser="SELECT * FROM MART_USER WHERE USER_ID=$customer_id";
    $parsedUser=oci_parse($connection, $getUser);
    oci_execute($parsedUser);
    $row= oci_fetch_assoc($parsedUser);
    $cust_name=$row['NAME'];
    $address=$row['ADDRESS'];
    $email=$row['EMAIL'];
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
    <title>Payment Success</title>
</head>

<body>
    <div class="container">
        <div class="row w-100">
            <div class="col-7 mx-auto text-center mt-5">
                <img src="image\payment-success.gif" alt="payment success" class="no-data-found img-fluid" />
                <div class="mt-3 my-green-font">
                    <h3><b>Success</b></h3>
                </div>
                <div>Your order has been placed successfully</div>
                <a href="category-page.php" class="mt-3 py-1 pt-2 px-3 btn">
                    <h6>Continue shopping</h6>
                </a> &nbsp;
                <a href="" class="mt-3 py-1 pt-2 px-3 btn">
                    <h6>View My Invoice</h6>
                </a>
            </div>
        </div>
        <div class="invoice-container my-5 border rounded p-3">
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
                    <div class="mt-1">Order Date : <?php echo $cust_name;?><div>
                            <div class="mt-1">Collection : <?php echo $email;?></div>
                            <div class="mt-1">Status : <?php echo $address;?></div>
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
                            <tr>
                                <td>
                                    <div class="review-profile-container cat-product-container">
                                        <img src="image\product\777088782.png" alt="product image"  class="cart-prod-img img-fluid"/>
                                    </div>
                                </td>
                                <td>Strawberry</td>
                                <td>2</td>
                                <td><span>&#163;</span>11</td>
                                <td>3</td>
                                <td><span>&#163;</span>11</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="review-profile-container cat-product-container">
                                        <img src="image\product\777088782.png" alt="product image"  class="cart-prod-img img-fluid"/>
                                    </div>
                                </td>
                                <td>Strawberry</td>
                                <td>2</td>
                                <td><span>&#163;</span>11</td>
                                <td>3</td>
                                <td><span>&#163;</span>11</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-right">
                <hr>
                    <div class="mt-1">Subtotal : <?php echo $cust_name;?></div>
                    <div class="mt-1">Discount : <?php echo $email;?></div>
                    <div class="mt-1">Total : <?php echo $address;?></div>
                </div>
            </div>
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