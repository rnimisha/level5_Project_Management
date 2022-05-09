<?php
include_once('connection.php');
include_once('function.php');
if(isset($_GET['pid']))
{
    $product_id=$_GET['pid']; 
}
else{
    header('Location: category-page.php');
}
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
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- slick slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"
        integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
        integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- customized css -->
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <title>Product Detail</title>
</head>

<body>
    <div class="alert alert-danger action-success" role="alert">
        <h5><strong><i class='bx bx-error-circle'></i> Failure!</strong> <br />No more stock available to add.</h5>
    </div>
    <div class="container-fluid product-detail-main-container">
        <div class="row w-100 p-5">
            <div class="col-md-5">
                <div class="row prod-image-div">
                    <div class="product-img-container">
                        <img src="image\product\<?php echo $img[0];?>"
                            class="img-fluid product-detail-img bigger-img m-auto" />
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center prod-image-div pt-2">
                    <?php
                        foreach($img as $prodimg)
                        {
                            ?>
                    <div class="col-3 mini-img-container mr-2">
                        <img src="image\product\<?php echo $prodimg;?>" class="img-fluid product-detail-img mini-img" />
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
                <div class="pl-4">
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
                    <span class="badge badge-pill badge-completed">In Stock</span>
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
                    <div class="py-2 second-wrapper d-flex justify-content-center align-items-center mr-2"
                        value="<?php echo $product_id;?>">
                        Buy Now
                    </div>
                    <div class="py-2 mx-1 second-wrapper d-flex justify-content-center align-items-center mr-2"
                        id="add-cart-with-quantity" value="<?php echo $product_id;?>">
                        Add To Cart
                    </div>
                    <div class="px-2 mx-1 mini-wrapper">
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
                    <span class="text-muted"><small>category : <span
                                class="text-lowercase"><?php echo $cat_name;?></small></span></span>
                </div>
                <div class="pl-4  mb-4">
                    <span class="text-muted"><small>shop : <span
                                class="text-lowercase"><?php echo $shop_name;?></small></span></span>
                </div>
            </div>
        </div>

        <div class="row mt-4 more-product-info">
            <div class="row w-100 px-3">
                <div class="col-3 detail-nav description-nav p-1 pt-2 active-detail-nav text-center">
                    <b>
                        <h5>Description</h5>
                    </b>
                </div>
                <div class="col-3 detail-nav p-1 pt-2 text-center allergy-nav">
                    <b>
                        <h5>Allergy Info</h5>
                    </b>

                </div>
                <div class="col-3 detail-nav p-1 pt-2 text-center review-nav">
                    <b>
                        <h5>Review</h5>
                    </b>
                </div>
            </div>
            <div class="row w-100 detail-into-container p-5">
                <div class="prod-descp-div transition-effect">
                    <h5>Product Details</h5>
                    <?php echo $descp;?>
                </div>
                <div class="prod-allergy-div d-none transition-effect">
                    <h5>Product Ingredients</h5>
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
                </div>
                <div class="prod-review-div d-none row w-100 transition-effect">
                    <?php
                        if(getTotalReview($product_id, $connection)>0)
                        {
                    ?>
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
                        <div class="col-lg-6 d-none d-md-inline">
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
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar"
                                        aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100">
                                    </div>
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
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar"
                                        aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100">
                                    </div>
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
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar"
                                        aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100">
                                    </div>
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
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar"
                                        aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100">
                                    </div>
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
                                    <div class="progress-bar w-<?php echo $percent;?>" role="progressbar"
                                        aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="text-muted pl-2">
                                    <small> <?php echo $rating_count;?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- feedbacks -->
                    <div class="row w-100 ml-3 mt-4">
                        <div class="col-12 comment-bar p-1">
                            <div class="row align-items-end">
                                <div class="col-md-5 justify-content-start align-items-start text-left pl-5">
                                    <h4>Comments</h4>
                                </div>
                                <div class="col-md-4 text-right">
                                    <div class="btn write-review">Write Review</div>
                                </div>
                                <div class="col-3 text-right pr-5">
                                    <select class="custom-select form-control" id="sort-review-option"
                                        name="sort-review-option">
                                        <option value="top">
                                            Sort by : Top Rated
                                        </option>
                                        <option value="recent">
                                            Sort by : Newest
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- top rated reviews -->
                        <div class="col-12 p-1 text-center top-rated-review">
                            <?php
                                $query="SELECT REVIEW_COMMENT, STAR_RATING, REVIEW_DATE, NAME,VERIFIED, EMAIL, PROFILE_PIC FROM REVIEW R JOIN MART_USER MU ON R.USER_ID=MU.USER_ID WHERE PRODUCT_ID=$product_id ORDER BY STAR_RATING DESC";
                                $parsed_query=oci_parse($connection, $query);
                                oci_execute($parsed_query);
                                while (($row = oci_fetch_assoc($parsed_query)) != false) {
                                    if($row['PROFILE_PIC']==null)
                                    {
                                        $src="default_profile.jpg";
                                    }
                                    else{
                                        $src=$row['PROFILE_PIC'];
                                    }
                            ?>
                            <div class="row mt-5">
                                <div class="col-2">
                                    <div class="review-profile-container">
                                        <img src="image\profile\<?php echo $src;?>" class="review-profile img-fluid" />
                                    </div>
                                </div>
                                <div class="col-10 d-block justify-content-start">
                                    <div class="row w-100 text-muted">
                                        <div class="col-6 justify-content-start align-items-start text-left px-0">
                                            <?php 
                                                for($i=1; $i<=$row['STAR_RATING']; $i++)
                                                {
                                                ?>
                                            <i class='bx bxs-star'></i>
                                            <?php
                                                }
                                                for($i=1; $i<=(5-$row['STAR_RATING']); $i++)
                                                {
                                                ?>
                                            <i class='bx bx-star'></i>
                                            <?php
                                                }
                                                ?>
                                        </div>
                                        <div class="col-6 text-right px-0">
                                            <small><?php echo $row['REVIEW_DATE']; ?></small>
                                        </div>
                                    </div>
                                    <div class="row w-100 verification">
                                        <small><?php echo $row['NAME']; ?></small>
                                        <?php
                                                if(strtoupper($row['VERIFIED'])=='T')
                                                {
                                            ?>
                                        <small><i class='bx bxs-badge-check'></i></small>
                                        <?php
                                                }
                                                else{
                                                ?>
                                        <small><i class='bx bxs-error-alt'> Purchase Not Verified</i></small>
                                        <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="row w-100 text-left mt-1">
                                        <?php echo $row['REVIEW_COMMENT']->load(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>

                        <!-- recent reviews -->
                        <div class="col-12 p-1 text-center d-none newest-review">
                            <?php
                                $query="SELECT REVIEW_COMMENT, STAR_RATING, REVIEW_DATE, NAME,VERIFIED, EMAIL, PROFILE_PIC FROM REVIEW R JOIN MART_USER MU ON R.USER_ID=MU.USER_ID WHERE PRODUCT_ID=$product_id ORDER BY REVIEW_DATE DESC";
                                $parsed_query=oci_parse($connection, $query);
                                oci_execute($parsed_query);
                                while (($row = oci_fetch_assoc($parsed_query)) != false) {
                                    if($row['PROFILE_PIC']==null)
                                    {
                                        $src="default_profile.jpg";
                                    }
                                    else{
                                        $src=$row['PROFILE_PIC'];
                                    }
                            ?>
                            <div class="row mt-5">
                                <div class="col-2">
                                    <div class="review-profile-container">
                                        <img src="image\profile\<?php echo $src;?>" class="review-profile img-fluid" />
                                    </div>
                                </div>
                                <div class="col-10 d-block justify-content-start">
                                    <div class="row w-100 text-muted">
                                        <div class="col-6 justify-content-start align-items-start text-left px-0">
                                            <?php 
                                                for($i=1; $i<=$row['STAR_RATING']; $i++)
                                                {
                                                ?>
                                            <i class='bx bxs-star'></i>
                                            <?php
                                                }
                                                for($i=1; $i<=(5-$row['STAR_RATING']); $i++)
                                                {
                                                ?>
                                            <i class='bx bx-star'></i>
                                            <?php
                                                }
                                                ?>
                                        </div>
                                        <div class="col-6 text-right px-0">
                                            <small><?php echo $row['REVIEW_DATE']; ?></small>
                                        </div>
                                    </div>
                                    <div class="row w-100 verification">
                                        <small><?php echo $row['NAME']; ?></small>
                                        <?php
                                                if(strtoupper($row['VERIFIED'])=='T')
                                                {
                                            ?>
                                        <small><i class='bx bxs-badge-check'></i></small>
                                        <?php
                                                }
                                                else{
                                                ?>
                                        <small><i class='bx bxs-error-alt'> Purchase Not Verified</i></small>
                                        <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="row w-100 text-left mt-1">
                                        <?php echo $row['REVIEW_COMMENT']->load(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>

                        </div>

                    </div>
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="row w-100 justify-content-center align-items-center">
                        <div class="col-12 text-center">
                            No reviews yet
                        </div>
                        <div class="col-12 text-center mt-4">
                            <div class="btn write-review p-2">Write Review</div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- slick slider -->
        <div class="col-12 text-center">
                <h3 class="mb-n4 all-heading">You Might Also Like<h3>
        </div>
        <div class="row mx-0 related-product-slider p-5 w-100 ">
            <?php 
                $product_array=getSimilarProduct($product_id, $cat_id, $shop_id, $connection);
                foreach($product_array as $topProductID)
                {
                    $query="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$topProductID";
                    $parsed=oci_parse($connection, $query);
                    oci_execute($parsed);
                    $row=oci_fetch_assoc($parsed);
                ?>
            <div class="col-3 cat-product-container" value="<?php echo $row['PRODUCT_ID'];?>">
                <div class="cat-product col-12 text-center">
                    <div class="inner-img-container">
                        <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>"
                            class="img-fluid product-pic" alt="product-img" />
                    </div>
                    <div class="option-container d-flex">
                        <div>
                            <i class='bx bx-search-alt-2 quick-view-product'
                                value="<?php echo $row['PRODUCT_ID'];?>"></i>
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
                    <div class="prod-price">
                        <?php echo $row['PRICE']; ?>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
    </div>
    <input type="hidden" value="1" id="real-quantity" />
    <input type="hidden" value="<?php echo $stock;?>" id="stock-amount" />
    <?php
        include_once('popup-modal.php');
    ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- custom script -->
<script src="script/function.js"></script>
<script src="script/script.js"></script>
<script src="script/cart-action.js"></script>
<script src="script/slick.js"></script>
</html>