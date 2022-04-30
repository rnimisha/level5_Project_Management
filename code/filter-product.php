<?php
    include_once('connection.php');
    include_once('function.php');
    if(isset($_POST['form_name']) && $_POST['form_name']=='filter-product')
    {
        $filter_query="SELECT * FROM PRODUCT WHERE UPPER(DISABLED)='F'";
        
        //------filter by category-----
        if(isset($_POST['category']) && !empty($_POST['category']))
        {
            $category=implode(",", $_POST['category']);
            $filter_query.="AND CATEGORY_ID IN($category)";
            // echo $filter_query;
        }

        //run query
        $parsed=oci_parse($connection, $filter_query);
        oci_execute($parsed);
        $count_row=0;
        while (($row = oci_fetch_assoc($parsed)) != false) 
        {
            $img=getProductImage($row['PRODUCT_ID'],$connection)[0];
            $count_row++;
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
        }
        
    }
?>