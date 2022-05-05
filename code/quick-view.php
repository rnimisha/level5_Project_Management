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
  }
  oci_free_statement($parsedgetProduct);
  $img= getProductImage($product_id,$connection)[0];
  $avgRating=getAvgRating($product_id, $connection);
  $totalReviews=getTotalReview($product_id, $connection);
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
            <div class="py-2 wrapper d-flex  align-items-center">
                <span class="minus">-</span>
                <span class="quantity">1</span>
                <span class="plus">+</span>
            </div>
            <input type="hidden" value="1" id="real-quantity"/>
        </div>
    </div>';

?>

<script src="script/category-filter.js"></script>