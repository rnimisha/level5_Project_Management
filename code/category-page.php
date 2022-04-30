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
                        <!-- jquery ui -->
                        <h5 class="pb-2"><b>Price</b></h5>
                        <div class="slider-box align-items-center pb-5">
                            <div id="price-range" class="slider mb-3"></div>
                            <!-- <input class="text-center" type="text" id="priceRange" readonly> -->
                            <div class="row d-flex justify-content-center align-items-center">
                               <div id="min-price"></div><span>&nbsp;- &nbsp;</span>
                               <div id="max-price"></div>
                            </div>
                        </div>
                        <hr>

                        <!-- Filter by Category -->
                        <h5 class="py-2"><b>Category</b></h5>
                        <ul class="list-group list-group-flush">
                            <?php
                                $query="SELECT * FROM PRODUCT_CATEGORY ORDER BY CATEGORY_NAME";
                                $parsed=oci_parse($connection, $query);
                                oci_execute($parsed);
                                while(($row = oci_fetch_assoc($parsed)) != false) 
                                {
                                    ?>
                                    <li class="list-group-item text-decoration-none">
                                        <input type="checkbox" class="checkbox-css" id="<?php echo $row['CATEGORY_ID'];?>"/>
                                        <label class="text-uppercase" for="<?php echo $row['CATEGORY_ID'];?>"><?php echo $row['CATEGORY_NAME'];?></label>
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
                                        <input type="checkbox" class="checkbox-css" id="<?php echo $row['SHOP_ID'];?>"/>
                                        <label class="text-uppercase" for="<?php echo $row['SHOP_ID'];?>"><?php echo $row['SHOP_NAME'];?></label>
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
                                <input type="checkbox" class="checkbox-css" id=""/>
                                <span> &nbsp; <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </span>
                            </li>
                            <li class="list-group-item text-decoration-none">
                                <input type="checkbox" class="checkbox-css" id=""/>
                                <span> &nbsp; <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bx-star'></i>
                                </span>
                            </li>
                            <li class="list-group-item text-decoration-none">
                                <input type="checkbox" class="checkbox-css" id=""/>
                                <span> &nbsp; <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </span>
                            </li>
                            <li class="list-group-item text-decoration-none">
                                <input type="checkbox" class="checkbox-css" id=""/>
                                <label for=""> &nbsp; <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </label>
                            </li>
                            <li class="list-group-item text-decoration-none">
                                <input type="checkbox" class="checkbox-css" id=""/>
                                <span> &nbsp; <i class='bx bxs-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </span>
                            </li>
                            <!-- clear button -->
                            <li class="list-group-item text-decoration-none pt-2 ml-1">
                                <button class="btn">Clear</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <!-- banner -->
                <div class="row">
                    <div class="col-md-6 pb-2">
                        <img src="image/banner/banner2.png" class="img-fluid category-banner" alt="banner">
                    </div>
                    <div class="col-md-6 pb-2">
                        <img src="image/banner/banner1.png" class="img-fluid category-banner" alt="banner">
                    </div>
                </div>

                <!-- sorting option for product -->
                <div class="row py-3">
                    <div class="col-md-3 offset-md-9 col-sm-4 offset-sm-8" >
                        <select class="custom-select form-control" id="sort-product-option">
                            <option selected>Sort by : Default</option>
                            <option value="">Sort by : New Arrival</option> 
                            <option value="">Sort by : Best Selling</option> 
                            <option value="">Price : Low to High</option>
                            <option value="">Price : High to Low</option>
                        </select>
                    </div>

                </div>

                <!-- display product container -->
                <div class="row">
                    <?php
                        $query="SELECT * FROM ACTIVE_PRODUCT";
                        $parsed=oci_parse($connection, $query);
                        oci_execute($parsed);
                        while(($row = oci_fetch_assoc($parsed)) != false) 
                        {
                    ?>
                    <div class="col-lg-4 col-sm-6 cat-product-container py-1 mb-4 d-flex justify-content-center align-items-center">
                        <div class="cat-product col-12 text-center">
                            <img src="image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>" class="img-fluid product-pic" alt="banner"/>
                            <div class="option-container d-flex">
                                <div>
                                    <i class='bx bx-heart'></i>
                                </div>
                                <div>
                                    <i class='bx bx-cart-add'></i>
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
                    <div class="col-lg-4 col-sm-6 cat-product-container py-1 mb-4 d-flex justify-content-center align-items-center">
                        <div class="cat-product col-12 text-center">
                            <img src="image/product/fruit5.png" class="img-fluid product-pic" alt="banner"/>
                            <div class="option-container d-flex">
                                <div>
                                    <i class='bx bx-heart'></i>
                                </div>
                                <div>
                                    <i class='bx bx-cart-add'></i>
                                </div>
                            </div>
                            <div class="">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bx-star'></i>
                                <i class='bx bx-star'></i>
                            </div>
                            <div class="text-center">
                                <b>Apricot</b>
                            </div>
                            <div class="prod-price">
                                33.5
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 cat-product-container py-1 mb-4 d-flex justify-content-center align-items-center">
                        <div class="cat-product col-12 text-center">
                            <img src="image/product/fruit1.png" class="img-fluid product-pic" alt="banner"/>
                            <div class="option-container2">
                                <div>
                                    <i class='bx bx-heart'></i>
                                </div>
                                <div>
                                    <i class='bx bx-cart-alt'></i>
                                </div>
                            </div>
                            <div class="">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bx-star'></i>
                                <i class='bx bx-star'></i>
                            </div>
                            <div class="text-center">
                                <b>Apricot</b>
                            </div>
                            <div class="prod-price">
                                33.5
                            </div>
                        </div>
                    </div>
             
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="script/category-filter.js"></script>
<script src="script/function.js"></script>

</html>