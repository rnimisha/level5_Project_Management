<?php
include_once('connection.php');
include_once('function.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
        integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <title>Product Category</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row w-100 p-5">
            <div class="col-md-3">
                <!-- category option list -->
                <div class="row" id="filter-option">
                    <div class="col-11 mx-auto justify-content-center align-items-center" id="filter-content">
                        <form id="price-filter-form" action="category-page.php" method="GET">
                            <!-- jquery ui -->
                            <h5 class="pb-2"><b>Price</b></h5>
                            <div class="slider-box align-items-center pb-5">
                                <div id="price-range" class="slider mb-3"></div>
                                <!-- <input class="text-center" type="text" id="priceRange" readonly> -->
                                <div class="row d-flex justify-content-center align-items-center">
                                    <input type="hidden" name="min-input" id="min-input" />
                                    <input type="hidden" name="max-input" id="max-input" />
                                    <div id="min-price" name="min-price"></div><span class="hide-div">
                                        <?php if(isset($_GET["min-input"])){echo $_GET["min-input"];}else{echo 0;}?> -
                                        &nbsp;</span>
                                    <div id="max-price" name="max-price"></div><span
                                        class="hide-div"><?php if(isset($_GET["max-input"])){echo $_GET["max-input"];}else{echo 1000;}?></span>
                                </div>
                                <div class="row col-5 mx-auto pt-2 ml-1">
                                    <button class="btn" type="submit" name="price-filter"
                                        id="price-filter">Filter</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <hr>
                        <!-- Filter by Category -->
                        <h5 class="py-2"><b>Category</b></h5>
                        <form id="product-filter-form" action="category-page.php" method="GET">
                            <ul class="list-group list-group-flush">
                                <?php
                                    $query="SELECT * FROM PRODUCT_CATEGORY ORDER BY CATEGORY_NAME";
                                    $parsed=oci_parse($connection, $query);
                                    oci_execute($parsed);
                                    while(($row = oci_fetch_assoc($parsed)) != false) 
                                    {
                                        ?>
                                <li class="list-group-item text-decoration-none">
                                    <input type="checkbox" class="checkbox-css filter-selection check-category"
                                        value="<?php echo $row['CATEGORY_ID'];?>" name="category[]"
                                        id="<?php echo $row['CATEGORY_NAME'];?>"
                                        <?php if(isset($_GET['category']) && (in_array($row['CATEGORY_ID'], $_GET['category']))){echo 'checked="checked"';}?> />
                                    <label class="text-uppercase"
                                        for="<?php echo $row['CATEGORY_NAME'];?>"><?php echo $row['CATEGORY_NAME']; ?></label>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                            <hr>

                            <!-- Filter by Shop -->
                            <h5 class="py-2"><b>Filter by Shop</b></h5>
                            <ul class="list-group list-group-flush">
                                <?php
                                    $query="SELECT * FROM SHOP ORDER BY SHOP_NAME";
                                    $parsed=oci_parse($connection, $query);
                                    oci_execute($parsed);
                                    while(($row = oci_fetch_assoc($parsed)) != false) 
                                    {
                                        ?>
                                <li class="list-group-item text-decoration-none">
                                    <input type="checkbox" class="checkbox-css filter-selection check-shop"
                                        value="<?php echo $row['SHOP_ID'];?>" name="shops[]"
                                        id="<?php echo $row['SHOP_NAME'];?>"
                                        <?php if(isset($_GET['shops']) && (in_array($row['SHOP_ID'], $_GET['shops']))){echo 'checked="checked"';}?> />
                                    <label class="text-uppercase"
                                        for="<?php echo $row['SHOP_NAME'];?>"><?php echo $row['SHOP_NAME'];?></label>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                            <hr>

                            <!-- filter by rating -->
                            <h5 class="py-2"><b>Filter by Rating</b></h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-decoration-none">
                                    <input type="checkbox" class="checkbox-css filter-selection check-rating"
                                        name="rating[]" id="rate5" value="rate5"
                                        <?php if(isset($_GET['rating']) && (in_array('rate5', $_GET['rating']))){echo 'checked="checked"';}?> />
                                    <label for="rate5"> &nbsp; <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </label>
                                </li>
                                <li class="list-group-item text-decoration-none">
                                    <input type="checkbox" class="checkbox-css filter-selection check-rating"
                                        name="rating[]" id="rate4" value="rate4"
                                        <?php if(isset($_GET['rating']) && (in_array('rate4', $_GET['rating']))){echo 'checked="checked"';}?> />
                                    <label for="rate4"> &nbsp; <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bx-star'></i>
                                    </label>
                                </li>
                                <li class="list-group-item text-decoration-none">
                                    <input type="checkbox" class="checkbox-css filter-selection check-rating"
                                        name="rating[]" id="rate3" value="rate3"
                                        <?php if(isset($_GET['rating']) && (in_array('rate3', $_GET['rating']))){echo 1;}?> />
                                    <label for="rate3"> &nbsp; <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                    </label>
                                </li>
                                <li class="list-group-item text-decoration-none">
                                    <input type="checkbox" class="checkbox-css filter-selection check-rating"
                                        name="rating[]" value="rate2" id="rate2"
                                        <?php if(isset($_GET['rating']) && (in_array('rate2', $_GET['rating']))){echo 'checked="checked"';}?> />
                                    <label for="rate2"> &nbsp; <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                    </label>
                                </li>
                                <li class="list-group-item text-decoration-none">
                                    <input type="checkbox" class="checkbox-css filter-selection check-rating"
                                        name="rating[]" value="rate1" id="rate1"
                                        <?php if(isset($_GET['rating']) && (in_array('rate1', $_GET['rating']))){echo 'checked="checked"';}?> />
                                    <label for="rate1"> &nbsp; <i class='bx bxs-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                    </label>
                                </li>
                                <li class="list-group-item text-decoration-none pt-2 ml-1">
                                    <button class="btn d-none" type="submit" name="submit-filter"
                                        id="submit-filter">Submit</button>
                                </li>
                                <!-- clear button -->
                                <li class="list-group-item text-decoration-none pt-2 ml-1">
                                    <button class="btn" name="clear-filter" id="clear-filter"
                                        value="default">Clear</button>
                                </li>
                            </ul>
                            <!-- </form> -->
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <!-- banner -->
                <div class="row">
                    <div class="col-md-6 pb-2 d-none d-md-block">
                        <div class="img-container">
                            <img src="image/banner/banner1.png" class="img-fluid category-banner" alt="banner">
                        </div>
                    </div>
                    <div class="col-md-6 pb-2 banner-img">
                        <div class="img-container">
                            <img src="image/banner/banner2.png" class="img-fluid category-banner" id="text-img-banner" alt="banner">
                        </div>
                        <div class="banner-text col-5">
                            <h3>Fresh Up! Power Up !</h3>
                            <p>Experience the whole new freshness</p>
                        </div>
                    </div>
                </div>

                <!-- sorting option for product -->
                <!-- <form id="sort-product" action="category-page.php" method="GET"> -->
                <div class="row py-3">
                    <div class="col-sm-3 offset-lg-6 offset-sm-5 d-flex justify-content-end align-items-center view-change">
                        <div id="grid-view-product" class="active-view">
                            <i class='bx bxs-grid'></i>
                        </div>
                        <div id="list-view-product">
                            <i class='bx bx-list-ul' ></i>
                        </div>
                    </div>
                    <div class="col-lg-3  col-sm-4 ">
                        <select class="custom-select form-control" id="sort-product-option" name="sort-product-option">
                            <option value=""
                                <?php if(isset($_GET['sort-product-option']) && $_GET['sort-product-option']==""){echo 'selected';}?>>
                                Sort by : Default</option>
                            <option value="PRODUCT_ID DESC"
                                <?php if(isset($_GET['sort-product-option']) && strtoupper($_GET['sort-product-option'])=="PRODUCT_ID DESC"){echo 'selected';}?>>
                                Sort by : New Arrival</option>
                            <option value="BESTSELLING"
                                <?php if(isset($_GET['sort-product-option']) && strtoupper($_GET['sort-product-option'])=="BESTSELLING"){echo 'selected';}?>>
                                Sort by : Best Selling</option>
                            <option value="PRICE"
                                <?php if(isset($_GET['sort-product-option']) && strtoupper($_GET['sort-product-option'])=="PRICE"){echo 'selected';}?>>
                                Price : Low to High</option>
                            <option value="PRICE DESC"
                                <?php if(isset($_GET['sort-product-option']) && strtoupper($_GET['sort-product-option'])=="PRICE DESC"){echo 'selected';}?>>
                                Price : High to Low</option>
                        </select>
                    </div>
                </div>
                <div class="d-none">
                    <button class="btn d-none" type="submit" name="sort-product-btn"
                        id="sort-product-btn">Submit</button>
                </div>
                </form>

                <!-- display product container -->
                <div class="row product-display">
                    <?php
                        $filter_query="SELECT P.PRODUCT_ID AS PRODUCT_ID, CATEGORY_ID, SHOP_ID, PRICE, PRODUCT_NAME, SUM(ITEM_QUANTITY) AS TOTAL_PURCHASED 
                        FROM ORDER_ITEM O
                        RIGHT JOIN PRODUCT P
                        ON P.PRODUCT_ID=O.PRODUCT_ID
                        WHERE UPPER(DISABLED)='F'";

                        // ------filter by price-----
                        if(isset($_GET['min-input']) & !empty($_GET['min-input']) )
                        {
                            // echo $_GET['min-input'];
                            $min_price=intVal($_GET['min-input']);
                            $filter_query.=" AND PRICE>=$min_price";
                        }
                        if(isset($_GET['max-input']) & !empty($_GET['max-input']) )
                        {
                            $max_price=intVal($_GET['max-input']);
                            $filter_query.=" AND PRICE<=$max_price";
                            // echo $filter_query;
                        }

                        if(isset($_GET['submit-filter']))
                        {
                             //------filter by category-----
                            if(isset($_GET['category']) && !empty($_GET['category']))
                            {
                                $category=implode(",", $_GET['category']);
                                $filter_query.=" AND CATEGORY_ID IN($category) ";
                                // echo $filter_query;
                            }

                            //------filter by shop-----
                            if(isset($_GET['shops']) && !empty($_GET['shops']))
                            {
                                $shop=implode(",", $_GET['shops']);
                                $filter_query.=" AND SHOP_ID IN($shop)";
                                // echo $filter_query;
                            }

                            //------filter by rating-----
                            if(isset($_GET['rating']) && !empty($_GET['rating']))
                            {
                                //array to store real rating
                                $rating=[];
                                foreach($_GET['rating'] as $rate)
                                {
                                    array_push($rating, intVal($rate[4]));
                                }
                            }

                        }

                        $filter_query.=" GROUP BY P.PRODUCT_ID, CATEGORY_ID, SHOP_ID, PRICE, PRODUCT_NAME";

                        //------sort the products -----
                        if(isset($_GET['submit-filter'])){
                            if(isset($_GET['sort-product-option']) && !empty($_GET['sort-product-option']) && strtoupper($_GET['sort-product-option'])!="BESTSELLING")
                            {
                                $filter_query.=" ORDER BY ".$_GET['sort-product-option'];
                        
                            }
                            if(isset($_GET['sort-product-option']) && !empty($_GET['sort-product-option']) && strtoupper($_GET['sort-product-option'])=="BESTSELLING")
                            {
                                $filter_query.=" ORDER BY (CASE WHEN TOTAL_PURCHASED  IS NULL THEN 2 ELSE 1 END), TOTAL_PURCHASED  DESC";
                                // echo $filter_query;
                        
                            }
                        }

                        if(isset($_GET['clear-filter']) && ($_GET['clear-filter'])=='default')
                        {
                            $filter_query="SELECT * FROM PRODUCT WHERE UPPER(DISABLED)='F'";
                            $_GET['category']=$_GET['shops']=$_GET['rating']=[];
                        }
                        $parsed=oci_parse($connection, $filter_query);
                        oci_execute($parsed);
                        $count_row=0;
                        while(($row = oci_fetch_assoc($parsed)) != false) 
                        {
                            $avg_rating =getAvgRating($row['PRODUCT_ID'], $connection);
                             //skip the product if rating does not match
                            if(isset($_GET['rating']) && !empty($_GET['rating']) && isset($rating))
                            {
                                if(!in_array($avg_rating, $rating))
                                {
                                    continue;
                                }
                            }
                    ?>

                    <!-- grid view product -->
                    <div class="col-lg-4 col-sm-6 cat-product-container py-1 mb-4 d-flex justify-content-center align-items-center grid-view-container">
                        <div class="cat-product col-12 text-center">
                            <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>"
                                class="img-fluid product-pic" alt="banner" />
                            <div class="option-container d-flex">
                                <div>
                                    <i class='bx bx-search-alt-2 quick-view-product' value="<?php echo $row['PRODUCT_ID'];?>"></i>
                                </div>
                                <div>
                                    <i class='bx bx-cart-alt'></i>
                                </div>
                                <div>
                                    <i class='bx bx-heart'></i>
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
                    <div class="list-view-container d-none">
                       hello
                    </div>
                    <?php
                    $count_row++;
                    }
                    if($count_row==0)
                    {  
                    ?>
                    <div class="row w-100">
                        <divc class="col-5 mx-auto">
                            <img src="image/noresultfound.png" class="no-data-found img-fluid" />
                    </div>
                </div>
                <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" id="quick-view" class="btn btn-primary d-none" data-toggle="modal" data-target="#popProductPreview">
        preview
    </button>

    <!-- Modal -->
    <div class="modal fade" id="popProductPreview" tabindex="-1" role="dialog"
        aria-labelledby="popProductPreviewTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="quick-view-body">
                    
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
</body>

<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- for price range -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- custom script -->
<script src="script/function.js"></script>
<script src="script/category-filter.js"></script>

</html>