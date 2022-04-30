<?php
    include_once('connection.php');
    include_once('function.php');
    if(isset($_POST['form_name']) && $_POST['form_name']=='filter-product')
    {
        $filter_query="SELECT PRODUCT_NAME, PRODUCT_ID, PRICE, SHOP_ID, CATEGORY_ID FROM PRODUCT WHERE UPPER(DISABLED)='F'";
        
        //------filter by category-----
        if(isset($_POST['category']) && !empty($_POST['category']))
        {
            $_SESSION['category']=$_POST['category'];
            $category=implode(",", $_POST['category']);
            $filter_query.=" AND CATEGORY_ID IN($category) ";
            // echo $filter_query;
        }

        //------filter by shop-----
        if(isset($_POST['shops']) && !empty($_POST['shops']))
        {
            $shop=implode(",", $_POST['shops']);
            $filter_query.=" AND SHOP_ID IN($shop)";
            // echo $filter_query;
            // exit;
        }

        //------filter by rating-----
        if(isset($_POST['rating']) && !empty($_POST['rating']))
        {
            //array to store real rating
            $rating=[];
            foreach($_POST['rating'] as $rate)
            {
                array_push($rating, intVal($rate[4]));
            }
        }

        //run query
        $parsedq=oci_parse($connection, $filter_query);
        oci_execute($parsedq) or die("F");
        $count_row=0;
        echo $filter_query;
        while (($row = oci_fetch_assoc($parsedq)) != false) 
        {
            $avg_rating =getAvgRating($row['PRODUCT_ID'], $connection);
            $img=getProductImage($row['PRODUCT_ID'],$connection)[0];

            //skip the product if rating does not match
            // if(isset($_POST['rating']) && !empty($_POST['rating']))
            // {
            //     if(!in_array($avg_rating, $rating))
            //     {
            //         continue;
            //     }
            // }
            echo '<div class="col-lg-4 col-sm-6 cat-product-container py-1 mb-4 d-flex justify-content-center align-items-center">
                        <div class="cat-product col-12 text-center">'.
                            '<img src="image\\product\\'.$img.'" class="img-fluid product-pic" alt="banner"/>
                            <div class="option-container d-flex">
                                <div>
                                    <i class="bx bx-heart"></i>
                                </div>
                                <div>
                                    <i class="bx bx-cart-add"></i>
                                </div>
                            </div>
                            <div>';
                                    $avgRating=getAvgRating($row['PRODUCT_ID'], $connection);
                                    for($i=1; $i<=$avgRating; $i++)
                                    {
                                    
                                        echo '<i class="bx bxs-star"></i>';
                                    }
                                    for($i=1; $i<=(5-$avgRating); $i++)
                                    {
                                         echo '<i class="bx bx-star"></i>';
                                    }
                            echo '</div>
                            <div>
                                <b>'.$row['PRODUCT_NAME'].'</b>
                            </div>
                            <div class="prod-price">'.$row['PRICE'].
                            '</div>
                        </div>
                        </div>';
                        $count_row++;
        } 

        if($count_row==0)
        {
            echo 'No Match found';
        }
        oci_free_statement($parsedq);
    }
?>

<!-- link script for new html content -->
<script src="script/category-filter.js"></script>