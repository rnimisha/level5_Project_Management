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
    $allergy=$row['ALLERGY_INFO'];
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
                        <img src="image\product\<?php echo $img[0];?>"  class="img-fluid product-detail-img bigger-img m-auto"/>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center prod-image-div pt-2">
                    <?php
                        foreach($img as $prodimg)
                        {
                            ?>
                            <div class="col-3 mini-img-container mr-2">
                                <img src="image\product\<?php echo $prodimg;?>"  class="img-fluid product-detail-img mini-img"/>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-7 pl-4 main-product-detail">
                <div class="pl-4 mt-5">
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
                    <span class="text-muted">(<?php echo $totalReviews;?> reviews)</span>
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
                    <div class="py-2 second-wrapper d-flex justify-content-center align-items-center mr-2" value="<?php echo $product_id;?>" >
                        Buy Now
                    </div>
                    <div class="py-2 mx-1 second-wrapper d-flex justify-content-center align-items-center mr-2" id="add-cart-with-quantity" value="<?php echo $product_id;?>" >
                        Add To Cart
                    </div>
                    <div class="px-2 mx-1 mini-wrapper" >  
                        <?php
                        if(isset($_SESSION['phoenix_user']) && strtoupper($_SESSION['user_role'])=='C')
                        {
                            $wishlist_status=checkProductInWishList($product_id, $_SESSION['phoenix_user'], $connection);

                            if($wishlist_status)
                            {
                            ?>
                                <i class='bx bxs-heart remove-from-wishlist' value="<?php echo $product_id;?>"></i>
                            <?php
                            }
                            else
                            {
                            ?>
                                <i class='bx bx-heart save-to-wishlist' value="<?php echo $product_id;?>"></i>
                            <?php
                            }
                        }
                        else{
                            ?>
                            <i class='bx bx-heart save-to-wishlist' value="<?php echo $product_id;?>"></i>
                        <?php
                        }
                        ?>
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

        <div class="row mt-4 more-product-info">
            <div class="row w-100 px-3">
                <div class="col-3 detail-nav p-1 active-detail-nav text-center">
                    <b><h5>Description</h5></b>
                </div>
                <div class="col-3 detail-nav p-1 text-center">
                    <b><h5>Allergy Info</h5></b>

                </div>
                <div class="col-3 detail-nav p-1 text-center">
                    <b><h5>Review</h5></b>
                </div>
            </div>
            <div class="row w-100 detail-into-container p-5">
                <!-- <div class="prod-descp-div">
                    <h5>Information</h5>
                    <?php echo $descp;?>
                </div>
                <div class="prod-allergy-div">
                    <?php 
                        if(isset($allergy) && !empty(trim($allergy)))
                        {
                            echo $allergy;
                        }
                        else
                        {
                            echo "No allergy information available";
                        }
                    ?>
                </div> -->
                <div class="prod-review-div row w-100">
                    <div class="row w-100">
                        <div class="col-lg-6 text-center mt-n2">
                            <div class="h1 rating-heading"><?php echo $avgRating; ?></div>
                            <div>Out of 5</div>
                            <div class="d-flex d-flex justify-content-center align-items-center">
                                <?php 
                                for($i=1; $i<=$avgRating; $i++)
                                {
                                ?>
                                    <i class='bx bxs-star pr-2'></i>
                                <?php
                                }
                                for($i=1; $i<=(5-$avgRating); $i++)
                                {
                                ?>
                                    <i class='bx bx-star pr-2'></i>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="text-muted">
                                <?php echo $totalReviews; ?> Reviews
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="5-star-review row w-100 d-flex justify-content-end">
                                <div class="mr-5">
                                <?php 
                                for($i=1;$i<=5; $i++)
                                {
                                ?>
                                    <i class='bx bxs-star'></i>
                                <?php
                                }
                                $value= getRatingPercent($product_id, 5, $connection);
                                $percent=$value[1];
                                $rating_count=$value[0];
                                ?>
                                </div>
                                <div class="progress col-7 p-0">
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-muted pl-2">
                                   <small> <?php echo $rating_count;?></small>
                                </div>
                            </div>
                            
                            <div class="4-star-review row w-100 d-flex justify-content-end">
                                <div class="mr-5">
                                    <?php 
                                    for($i=1;$i<=4; $i++)
                                    {
                                    ?>
                                        <i class='bx bxs-star'></i>
                                    <?php
                                    }
                                    $value= getRatingPercent($product_id, 4, $connection);
                                    $percent=$value[1];
                                    $rating_count=$value[0];
                                    ?>
                                    <i class='bx bx-star'></i>
                                </div>
                                <div class="progress col-7 p-0">
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-muted pl-2">
                                   <small> <?php echo $rating_count;?></small>
                                </div>
                            </div>
                            <div class="3-star-review row w-100 d-flex justify-content-end">
                                <div class="mr-5">
                                    <?php 
                                    for($i=1;$i<=3; $i++)
                                    {
                                    ?>
                                        <i class='bx bxs-star'></i>
                                    <?php
                                    }
                                    $value= getRatingPercent($product_id, 3, $connection);
                                    $percent=$value[1];
                                    $rating_count=$value[0];
                                    ?>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </div>
                                <div class="progress col-7 p-0">
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-muted pl-2">
                                   <small> <?php echo $rating_count;?></small>
                                </div>
                            </div>
                            <div class="2-star-review row w-100 d-flex justify-content-end">
                                <div class="mr-5">
                                <?php 
                                    for($i=1;$i<=2; $i++)
                                    {
                                    ?>
                                        <i class='bx bxs-star'></i>
                                    <?php
                                    }
                                    $value= getRatingPercent($product_id, 2, $connection);
                                    $percent=$value[1];
                                    $rating_count=$value[0];
                                    ?>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </div>
                                <div class="progress col-7 p-0">
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-muted pl-2">
                                   <small> <?php echo $rating_count;?></small>
                                </div>
                            </div>
                            <div class="1-star-review row w-100 d-flex justify-content-end">
                                <div class="mr-5">
                                    <?php 
                                    for($i=1;$i<=1; $i++)
                                    {
                                    ?>
                                        <i class='bx bxs-star'></i>
                                    <?php
                                    }
                                    $value= getRatingPercent($product_id, 1, $connection);
                                    $percent=$value[1];
                                    $rating_count=$value[0];
                                    ?>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </div>
                                <div class="progress col-7 p-0">
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-muted pl-2">
                                   <small> <?php echo $rating_count;?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- feedbacks -->
                    <div class="row w-100 ml-3 mt-4">
                        <div class="col-12 comment-bar p-1 text-center">
                            <h4>Comments</h4>
                        </div>
                        <div class="col-12 comment-bar p-1 text-center">
                            <div class="row">
                                <div class="col-2">
                                    <div class="review-profile-container">
                                        <img src="image\profile\default_profile.jpg" class="review-profile img-fluid"/>
                                    </div>
                                </div>
                                <div class="col-10 d-block justify-content-start">
                                    <div class="row w-100">
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                    </div>
                                    <div  class="row w-100 text-muted">
                                        <small>Name Here</small>
                                    </div>
                                    <div  class="row w-100 text-left mt-1">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis omnis, voluptate culpa tempora aperiam nobis! Quisquam similique, sint quae neque asperiores, assumenda repudiandae autem commodi labore sunt sed sequi saepe.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="1" id="real-quantity"/>
    <input type="hidden" value="<?php echo $stock;?>" id="stock-amount"/>


     <!-- Button trigger modal for cart success -->
     <button type="button" id="item-added-modal" class="btn btn-primary d-none" data-toggle="modal"
        data-target="#popItemAdded">
        preview
    </button>

    <!-- Modal for cart success -->
    <div class="modal fade" id="popItemAdded" tabindex="-1" role="dialog" aria-labelledby="popItemAdded"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content w-50 mx-auto">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row item-added-body d-flex justify-content-center align-items-center mb-4">
                    <div class="col-12 text-center mt-n2">
                        <h3 style="color:#78967e; font-weight:bolder;">Item Added To Cart Successfully</h3>
                    </div>
                    <div class="col-12 text-center mt-n2">
                        <img src="image/cart-add-success.gif" alt="cart-add-success" class="product-pic" />
                    </div>
                    <div class="col-4 text-center py-3 btn">
                        Continue Shopping
                    </div>
                    <div class="col-4 text-center ml-1 py-3 btn">
                        Go To Cart
                    </div>
                </div>
            </div>
        </div>
    </div>
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
</html>