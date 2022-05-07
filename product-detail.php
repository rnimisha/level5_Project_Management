<?php
include_once('connection.php');
include_once('function.php');
$product_id=1; //for a moment
$getProduct= "SELECT * FROM PRODUCT WHERE PRODUCT_ID=$product_id";

$parsedgetProduct = oci_parse($connection, $getProduct);
oci_execute($parsedgetProduct);
while (($row = oci_fetch_assoc($parsedgetProduct)) != false) {
    $name=$row['PRODUCT_NAME'];
    $descp=$row['DESCRIPTION']->load();
    $price=$row['PRICE'];
    $unit=$row['PRICING_UNIT'];
    $stock=$row['STOCK_QUANTITY'];
    $cat_id=$row['CATEGORY_ID'];
    $shop_id=$row['SHOP_ID'];
}
$avgRating=getAvgRating($product_id, $connection);
$totalReviews=getTotalReview($product_id, $connection);
$cat_name=getCategory($cat_id, $connection);
$shop_name=getShop($shop_id, $connection);
$img= getProductImage($product_id,$connection);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <title>Product Detail</title>
</head>
<body>
    
    <div class="container-fluid product-detail-main-container">
        <div class="row w-100 p-5">
            <div class="col-md-5">
                <div class="row prod-image-div">
                    <div class="product-img-container">
                        <img src="image\product\<?php echo $img[0];?>"  class="img-fluid product-detail-img m-auto"/>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center prod-image-div pt-2">
                    <?php
                        foreach($img as $prodimg)
                        {
                            ?>
                            <div class="col-3 mini-img-container mr-2">
                                <img src="image\product\<?php echo $prodimg;?>"  class="img-fluid product-detail-img"/>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-7 pl-4 main-product-detail">
                <div class="pl-4 mt-3">
                    <h1 class="pb-2"><?php echo $name; ?></h1>
                </div>
                <div  class="pl-4">
                    <?php 
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
                    <span class="text-muted"><small>(<?php echo $totalReviews;?> reviews)</small></span>
                </div>
                <div class="pl-4  mt-3">
                    <?php
                        if($stock>0){
                    ?>
                        <span  class="badge badge-pill badge-completed">In Stock</span>
                    <?php
                        }
                    ?>
                </div>
                <div class="pl-4 pt-3">
                    <h3><span>&#163;</span><?php echo $price.'/'.$unit;?></h3>
                </div>
                <div class="pl-4 d-none d-lg-flex">
                    <?php echo $descp;?>
                </div>
                <div class="pl-4 mt-4 d-flex justify-content-left align-items-center">
                    <div class="py-2 wrapper d-flex  align-items-center">
                        <span class="minus">-</span>
                        <span class="quantity">1</span>
                        <span class="plus">+</span>
                    </div>
                </div>
                <div class="pl-4 mt-4 pb-2 d-flex justify-content-left align-items-center">
                    <div class="py-2 second-wrapper d-flex justify-content-center align-items-center mr-2">
                        <span>Buy Now</span>
                    </div>
                    <div class="py-2 mx-1 second-wrapper d-flex justify-content-center align-items-center mr-2" id="add-cart-with-quantity" value="'.$product_id.'">
                        <span>Add To Cart</span>
                    </div>
                    <div class="px-2 mx-1 mini-wrapper">
                        <i class='bx bxs-heart'></i>
                    </div>
                </div>
                <hr>
                <div class="pl-4  mt-3">
                    <span class="text-muted"><small>category : <span class="text-lowercase"><?php echo $cat_name;?></small></span></span>
                </div>
                <div class="pl-4  mb-4">
                    <span class="text-muted"><small>shop : <span class="text-lowercase"><?php echo $shop_name;?></small></span></span>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="1" id="real-quantity"/>
    <input type="hidden" value="<?php echo $stock;?>" id="stock-amount"/>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom script -->
<script src="script/function.js"></script>
<script src="script/cart-action.js"></script>
<script src="script/category-filter.js"></script>
</html>