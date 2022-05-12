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
$collection_id= $_SESSION['collection-id'];
// $payment_id= $_GET['PayerID'];
// $coupon_id= $_SESSION['COUPON'];
$customer_id=$_SESSION['phoenix_user'];
// unset($_SESSION['COUPON']);
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
                <div class="mt-3 my-green-font"><h3><b>Success</b></h3></div>
                <div>Your order has been placed successfully</div>
                <a href="category-page.php" class="mt-3 py-1 pt-2 px-3 btn"><h6>Continue shopping</h6></a> &nbsp;
                <a href="" class="mt-3 py-1 pt-2 px-3 btn"><h6>View My Invoice</h6></a>
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