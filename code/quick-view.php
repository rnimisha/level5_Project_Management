<?php
include_once('connection.php');
include_once('function.php');

if(isset($_POST['product_id']) && isset($_POST['type']) && strtolower($_POST['type'])=='quick-view')
{
  $product_id=$_POST['product_id'];
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
  oci_free_statement($parsedgetProduct);
  $img= getProductImage($product_id,$connection)[0];
  $avgRating=getAvgRating($product_id, $connection);
  $totalReviews=getTotalReview($product_id, $connection);
  $cat_name=getCategory($cat_id, $connection);
  $shop_name=getShop($shop_id, $connection);
}

echo '<div class="row">
        <div class="col-6">
            <img src="image/product/'.$img.'" class="img-fluid quick-img" >
        </div>
        <div class="col-5 justify-content-center align-item-center">
            <h1 class="pb-2">'.$name.'</h1>';
            for($i=1; $i<=$avgRating; $i++)
            {
                echo '<i class="bx bxs-star"></i>';
            }
            for($i=1; $i<=(5-$avgRating); $i++)
            {
                echo '<i class="bx bx-star"></i>';
            }
        echo  ' <span class="text-muted">('.$totalReviews.' reviews)</span>
            <div class="py-2">
            <h3><span>&#163;</span>'.$price.'/'.$unit.'</h3>
            </div>
            <div class="py-2">
            <p>'.$descp.'</p>
            </div>
            <div class="row d-flex justify-content-left align-items-center">
                <div class="py-2 wrapper d-flex  align-items-center">
                    <span class="minus">-</span>
                    <span class="quantity">1</span>
                    <span class="plus">+</span>
                </div>
                
            </div>
            <div class="row mt-3 d-flex justify-content-left align-items-center">
                <div class="py-2 second-wrapper d-flex justify-content-center align-items-center">
                    <span>Buy Now</span>
                </div>
                <div class="py-2 mx-1 second-wrapper d-flex justify-content-center align-items-center">
                    <span>Add To Cart</span>
                </div>
                <div class="px-2 mx-1 mini-wrapper">
                    <i class="bx bx-heart"></i>
                </div>
            </div>
            <div class="row mt-3">
                <span class="text-muted"><small>category : <span class="text-lowercase">'.$cat_name.'</small></span></span>
            </div>
            <div class="row mb-4">
                <span class="text-muted"><small>shop : <span class="text-lowercase">'.$shop_name.'</small></span></span>
            </div>
            <input type="hidden" value="1" id="real-quantity"/>
            <input type="hidden" value="'.$stock.'" id="stock-amount"/>
        </div>
    </div>';

?>

<script src="script/category-filter.js"></script>