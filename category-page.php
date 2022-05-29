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

    <link rel="stylesheet" type="text/css" href="style/header.css" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <title>Product Category</title>
</head>

<body>
    <div class="container-fluid p-0 header-main" id="sticky-nav">
        <nav class="navbar py-0 navbar-expand-lg navbar-light border-bottom">
            <a class="navbar-brand pl-5" href="index.php" id="logo-header">
                <img src="image\logo.png" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ml-5">
                    <li class="nav-item">
                        <a class="nav-link " href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  ml-3" href="category-page.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  ml-3" href="about-us.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="contact-us-page.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-3" href="faq.php">FAQ</a>
                    </li>
                </ul>
                <div class="justify-content-right navbar-nav search-bar transition-effect d-none ">
                    <form class="form-inline ml-auto" id="text-filter">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" id="ftext" name="ftext"
                            value="<?php if(isset($_GET["ftext"])){echo $_GET["ftext"];}else{if(isset($_GET["filter-text"])){echo $_GET["filter-text"];}else{echo null;}}?> ">
                        <button class="btn d-none btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
                <div class="pr-5 nav-logo text-right">
                <span class="mr-3 search-icon transition-effect"><ion-icon name="search-outline"></ion-icon></span>
                <?php 
                    if(isset($_SESSION['phoenix_user']) && !empty($_SESSION['phoenix_user']) && isset($_SESSION['user_role']) && $_SESSION['user_role']=='C' )
                    {
                        $profile_pic= getProfilePicture($connection, $_SESSION['phoenix_user']);
                ?>
                         <span class="mr-3 user-hover header-pp"><img src="image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>"  alt="profile" class="header-pp"/></span>
                <?php 
                    }
                    else
                    {
                ?>
                        <span class="mr-3 user-hover"><ion-icon name="person-outline"></ion-icon></span>
                <?php
                    }
                ?>
                        <a href="wishlist-page.php"><span class="mr-3"><ion-icon name="heart-outline"></ion-icon></i></span></a>
                        <a href="cart-page.php"><span class="mr-3"><ion-icon name="cart-outline"></ion-icon></span></a>
                        <div class="dropdownmenu text-left d-none">
                        <?php 
                            if(isset($_SESSION['phoenix_user']) && !empty($_SESSION['phoenix_user']) && isset($_SESSION['user_role']) && $_SESSION['user_role']=='C' )
                            {
                        ?>
                            <div class="mt-2 ml-4 border-bottom py-2"><a href="customer-profile-setting\cust-setting-index.php" ><i class="fa-regular fa-circle-user"></i> &nbsp; My Account</a></div>
                            <div class="mt-2 ml-4 pt-2 "><a href="customer-profile-setting\my-orders-page.php" >My Order</a></div>
                            <div class="mt-2 ml-4 border-bottom pb-2"><a href="customer-profile-setting\my-account-page.php" >Setting</a></div>
                            <div class="mt-2 ml-4 border-bottom pt-2 pb-3"><a href="customer-profile-setting\cust-logout.php" >LogOut</a></div>
                            <?php 
                            }
                            else
                            {
                            ?>
                            <div class="mt-3 ml-4 border-bottom pb-2"><a href="loginform.php" >Login</a></div>
                            <div class="mt-2 ml-4 border-bottom pt-2 pb-3"><a href="registerform.php" >Register</a></div>
                            <?php
                            }
                            ?>
                        </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="loader">
        <img src="image/loader.gif" />
    </div>
    <!-- <div class="alert alert-danger action-success" role="alert">
        <h5><strong><i class='bx bx-error-circle'></i> Failure!</strong> <br />No more stock available to add.</h5>
    </div> -->
    <div class="cart-msg pop-msg">
    </div>
    <div class="container-fluid cat-page mt-5 pt-4">
        <div class="row w-100 p-5">
            <div class="col-md-3">
                <!-- category option list -->
                <div class="row mb-2" id="filter-option">
                    <div class="col-11 mx-auto justify-content-center align-items-center" id="filter-content">
                        <!-- <form id="price-filter-form" action="category-page.php" method="GET"> -->
                        <!-- jquery ui -->
                        <h5 class="pb-2"><b>Price</b></h5>
                        <div class="slider-box align-items-center pb-5">
                            <div id="price-range" class="slider mb-3"></div>
                            <!-- <input class="text-center" type="text" id="priceRange" readonly> -->
                            <div class="row d-flex justify-content-center align-items-center">
                                <!-- <input type="hidden" name="min-input" id="min-input" />
                                    <input type="hidden" name="max-input" id="max-input" /> -->
                                <div id="min-price" name="min-price"></div><span class="hide-div">
                                    <?php if(isset($_GET["min-input"])){echo $_GET["min-input"];}else{echo 0;}?> -
                                    &nbsp;</span>
                                <div id="max-price" name="max-price"></div><span
                                    class="hide-div"><?php if(isset($_GET["max-input"])){echo $_GET["max-input"];}else{echo 1000;}?></span>
                            </div>
                            <div class="row col-5 mx-auto pt-2 ml-1">
                                <button class="btn" type="submit" name="price-filter" id="price-filter">Filter</button>
                            </div>
                        </div>
                        <!-- </form> -->
                        <br>
                        <hr>
                        <!-- Filter by Category -->
                        <h5 class="py-2"><b>Category</b></h5>
                        <form id="product-filter-form" action="category-page.php" method="GET">
                            <input type="hidden" name="min-input" id="min-input" />
                            <input type="hidden" name="max-input" id="max-input" />
                            <input type="hidden" name="filter-text" id="filter-text"
                                value="<?php if(isset($_GET["ftext"])){echo $_GET["ftext"];}else{if(isset($_GET["filter-text"])){echo $_GET["filter-text"];}else{echo null;}}?> " />
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
                                        <?php if(isset($_GET['rating']) && (in_array('rate3', $_GET['rating']))){echo 'checked="checked"';}?> />
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
                            <img src="image/banner/banner2.png" class="img-fluid category-banner" id="text-img-banner"
                                alt="banner">
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
                    <div
                        class="col-sm-3 offset-lg-6 offset-sm-5 d-flex justify-content-end align-items-center view-change">
                        <div id="grid-view-product"
                            class="<?php if( isset($_GET['view-type']) && $_GET['view-type']=='grid'){echo "active-view";} else{echo "";} if(!isset($_GET['view-type'])){echo "active-view";} else{echo "";}?>"
                            value="grid">
                            <i class='bx bxs-grid'></i>
                        </div>
                        <div id="list-view-product"
                            class="<?php if(isset($_GET['view-type']) && $_GET['view-type']=='list'){echo "active-view";} else{echo "";}?>"
                            value="list">
                            <i class='bx bx-list-ul'></i>
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
                <div class="row justify-content-center my-2" id="filter-mini">
                    <div class="btn px-4 filter-mini-btn">More Filter options</div>
                </div>
                <input type="hidden" id="page-value" name="page-value">
                <input type="hidden" id="view-type" name="view-type"
                    value="<?php if(isset($_GET['view-type']) &&!empty($_GET['view-type'])){echo $_GET['view-type'];} ?>">
                <div class="d-none">
                    <button class="btn d-none" type="submit" name="sort-product-btn"
                        id="sort-product-btn">Submit</button>
                </div>
                </form>

                <!-- display product container -->
                <div class="row product-display">
                    <?php
                        $view='grid';
                        if(isset($_GET['view-type']))
                        {
                            if(!empty($_GET['view-type']))
                            {
                                $view=$_GET['view-type'];
                            }
                        }
                        $page=1;
                        $limit_per_page=9;
                        if(isset($_GET['page-value']))
                        {
                            if(!empty($_GET['page-value']))
                            {
                                $page=$_GET['page-value'];
                            }
                        }
                        $offset=($page -1) * $limit_per_page;
                        $limit=$limit_per_page*$page;
                        $filter_query="SELECT * FROM (SELECT a.*, ROWNUM rnum FROM (SELECT P.PRODUCT_ID AS PRODUCT_ID,STOCK_QUANTITY, CATEGORY_ID, SHOP_ID, PRICE, PRODUCT_NAME, SUM(ITEM_QUANTITY) AS TOTAL_PURCHASED 
                        FROM ORDER_ITEM O
                        RIGHT JOIN PRODUCT P
                        ON P.PRODUCT_ID=O.PRODUCT_ID
                        WHERE UPPER(DISABLED)='F'
                        AND STOCK_QUANTITY>0";

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

                        //filter by text
                        if((isset($_GET['ftext']) && !empty($_GET['ftext'])) || (isset($_GET['filter-text']) && !empty($_GET['filter-text'])))
                        {
                            if((isset($_GET['ftext']) && !empty($_GET['ftext'])) )
                            {
                                $text=$_GET['ftext'];
                            }
                            if((isset($_GET['filter-text']) && !empty($_GET['filter-text'])) )
                            {
                                $text=$_GET['filter-text'];
                            }
                            //separate words here with delimiter as space
                            $data_entered=explode(' ', $text);

                            $data_trimmed=array();
                            //new array without any blank value
                            foreach($data_entered as $data)
                            {
                                if(!empty(trim($data)))
                                {
                                    $data=strtoupper(trim($data));
                                    array_push($data_trimmed,$data);
                                }
                            }
                            // print_r ($data_trimmed);
                            
                            if(count($data_trimmed)>0)
                            {
                                //for each separated word
                                foreach($data_trimmed as $search)
                                {
                                    //array of conditions
                                    $search_word[]="CONCAT(UPPER(PRODUCT_NAME), UPPER(DESCRIPTION)) LIKE '%$search%'";

                                }
                                // concat array with OP delimiter
                                $filter_query.=" AND (".implode(' OR ', $search_word)." )";
                            }
                        }

                        $filter_query.=" GROUP BY P.PRODUCT_ID, CATEGORY_ID, STOCK_QUANTITY, SHOP_ID, PRICE, PRODUCT_NAME";

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
                        else{
                            $filter_query.=" ORDER BY PRODUCT_ID";
                        }


             
                        if(isset($_GET['clear-filter']) && ($_GET['clear-filter'])=='default')
                        {
    
                            $filter_query="SELECT * FROM (SELECT a.*, ROWNUM rnum FROM (SELECT P.PRODUCT_ID AS PRODUCT_ID,STOCK_QUANTITY, CATEGORY_ID, SHOP_ID, PRICE, PRODUCT_NAME, SUM(ITEM_QUANTITY) AS TOTAL_PURCHASED 
                            FROM ORDER_ITEM O
                            RIGHT JOIN PRODUCT P
                            ON P.PRODUCT_ID=O.PRODUCT_ID
                            WHERE UPPER(DISABLED)='F'
                            AND STOCK_QUANTITY>0 GROUP BY P.PRODUCT_ID, CATEGORY_ID, STOCK_QUANTITY, SHOP_ID, PRICE, PRODUCT_NAME";

                            if(isset($_GET['category']))
                            {
                                $_GET['category']=[];
                            }
                            if(isset($_GET['shops']))
                            {
                                $_GET['shops']=[];
                            }
                            if(isset($_GET['rating']))
                            {
                                $_GET['rating']=[];
                            }
                            if(isset($_GET['ftext']))
                            {
                                $_GET['ftext']="";
                            }
                            $_GET['filter-text']="";
                        }
                        $count_query=$filter_query.")a)";
                        $filter_query.=")a WHERE ROWNUM <= $limit) WHERE rnum > $offset";
                        // echo $filter_query;
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
                    <?php 
                    if($view=='grid')
                    {

                    ?>
                    <div class="col-lg-4 col-md-6 cat-product-container py-1 mb-4 d-flex justify-content-center align-items-center grid-view-container"
                        value="<?php echo $row['PRODUCT_ID'];?>">
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
                                    <i class='bx bxs-heart remove-from-wishlist'
                                        value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                                    <?php
                                        }
                                        else
                                        {
                                        ?>
                                    <i class='bx bx-heart save-to-wishlist'
                                        value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                                    <?php
                                        }
                                    }
                                    else{
                                        ?>
                                    <i class='bx bx-heart save-to-wishlist'
                                        value="<?php echo $row['PRODUCT_ID'] ?>"></i>
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
                            <div class="mb-1">
                                <?php 
                                    $dis_rate=checkProductDiscountRate($row['PRODUCT_ID'], $connection);
                                    if($dis_rate>0){
                                        ?>
                                <span
                                    class="prod-price"><?php echo calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);?></span>&nbsp;
                                <span class="before-discount">&#163;<?php echo $row['PRICE']; ?> </span>
                                <?php
                                    }
                                    else{
                                        ?>
                                <span class="prod-price"><?php echo $row['PRICE']; ?></span>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                    <!-- list view product -->
                    <?php 
                    if($view=='list')
                    {
                    ?>
                    <div class="list-view-container row w-100 d-flex p-3 mx-auto cat-product-container" value="<?php echo $row['PRODUCT_ID'];?>">
                        <div class="col-md-4 list-prod-img">
                            <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>"
                                class="img-fluid product-pic" alt="product-img" />
                        </div>
                        <div class="col-md-8 list-prod-detail d-flex justify-content-start align-items-center">
                            <div class="col-12">
                                <div>
                                    <h3><?php echo $row['PRODUCT_NAME']; ?></h3>
                                </div>
                                <div class="mt-n1">
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
                                    <?php 
                                    $dis_rate=checkProductDiscountRate($row['PRODUCT_ID'], $connection);
                                    if($dis_rate>0){
                                        ?>
                                    <span
                                        class="prod-price"><?php echo calculatePriceWithDiscount($row['PRODUCT_ID'], $connection);?></span>&nbsp;
                                    <span class="before-discount">&#163;<?php echo $row['PRICE']; ?> </span>
                                    <?php
                                    }
                                    else{
                                        ?>
                                    <span class="prod-price"><?php echo $row['PRICE']; ?></span>
                                    <?php
                                    } 
                                ?>
                                </div>
                                <div class="my-1">
                                    <?php echo getDescription($row['PRODUCT_ID'], $connection); ?>
                                </div>
                                <div class="d-flex justify-content-start align-items-center">
                                    <a href="checkout.php?buynow=yes&pid=<?php echo $row['PRODUCT_ID']; ?>" class="py-2 second-wrapper d-flex justify-content-center align-items-center">
                                        <span>Buy Now</span>
                                    </a>
                                    <div class="list-options">
                                        <i class='bx bx-search-alt-2 quick-view-product'
                                            value="<?php echo $row['PRODUCT_ID'];?>"></i>
                                    </div>
                                    <div class="list-options">
                                        <i class='bx bx-cart-alt add-to-cart'
                                            value="<?php echo $row['PRODUCT_ID'];?>"></i>
                                    </div>
                                    <div class="list-options">
                                        <?php
                                        if(isset($_SESSION['phoenix_user']) && strtoupper($_SESSION['user_role'])=='C')
                                        {
                                            $wishlist_status=checkProductInWishList($row['PRODUCT_ID'], $_SESSION['phoenix_user'], $connection);

                                            if($wishlist_status)
                                            {
                                            ?>
                                        <i class='bx bxs-heart remove-from-wishlist'
                                            value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                                        <?php
                                            }
                                            else
                                            {
                                            ?>
                                        <i class='bx bx-heart save-to-wishlist'
                                            value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                                        <?php
                                            }
                                        }
                                        else{
                                            ?>
                                        <i class='bx bx-heart save-to-wishlist'
                                            value="<?php echo $row['PRODUCT_ID'] ?>"></i>
                                        <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    $count_row++;
                    }
                    if($count_row==0)
                    {  
                    ?>
                    <div class="row w-100">
                        <div class="col-5 mx-auto">
                            <img src="image/noresultfound.png" class="no-data-found img-fluid" />
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                $parse_count=oci_parse($connection, $count_query);
                // echo $count_query;
                oci_execute($parse_count);
                $total_row=0;
                while(($row = oci_fetch_assoc($parse_count)) != false) 
                {
                    $total_row++;
                }
                $limit_per_page=9;
                $page_count=ceil($total_row/$limit_per_page);
            ?>
                <div>
                    <ul class="pagination justify-content-end mt-2">
                        <?php 
                    for ($i=1; $i<=$page_count; $i++)
                    {
                        ?>
                        <li class="page-item"><span
                                class="page-link <?php if($page==$i){echo "active-page";} else{echo "";}?>"
                                value="<?php echo $i; ?>"><?php echo $i; ?></span></li>
                        <?php
                    }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once('popup-modal.php');
    ?>
    <?php
        if(isset($_SESSION['phoenix_user']) && isset($_SESSION['cart-product-remaining']) && isset($_SESSION['quantity']))
        {
            if((checkCartProduct($_SESSION['cart-product-remaining'], $_SESSION['phoenix_user'], $connection))>0)
            {
                $original_quantity=getCartProductQuantity($_SESSION['cart-product-remaining'], $_SESSION['phoenix_user'], $connection);
                addProductQuantity($_SESSION['cart-product-remaining'], $_SESSION['phoenix_user'],$original_quantity, $_SESSION['quantity'] , $connection);
            }
            else{
                insertCartProduct($_SESSION['cart-product-remaining'], $_SESSION['phoenix_user'], $_SESSION['quantity'] , $connection);
            }
            unset($_SESSION['cart-product-remaining']);
            unset($_SESSION['quantity']);
            echo '<script> window.onload = function () {location.reload(); }; </script>';
            echo '<script> window.onload = function () {document.getElementById("item-added-modal").click(); }; </script>';
        }

        if(isset($_SESSION['phoenix_user']) &&  isset($_SESSION['wishlist-product-remaining']))
        {
            if(saveToWishlist($_SESSION['wishlist-product-remaining'], $_SESSION['phoenix_user'], $connection))
            {
                echo 'wishlist done';
            }
            unset ($_SESSION['wishlist-product-remaining']);
            echo '<script> window.onload = function () {location.reload(); }; </script>';
            echo '<script> window.onload = function () {document.getElementById("item-saved-modal").click(); }; </script>';
        }
    ?>
    <?php include_once('footer.php');?>
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
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- for price range -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- custom script -->
<script>
    var click_count = 0;
</script>
<script src="script/script.js"></script>
<script src="script/function.js"></script>
<script src="script/category-filter.js"></script>
<script src="script/cart-action.js"></script>
</html>