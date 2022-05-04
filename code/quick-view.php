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

    
  }
  oci_free_statement($parsedgetProduct);
  $img= getProductImage($product_id,$connection)[0];
  $avgRating=getAvgRating($product_id, $connection);
}

echo '<div class="row">
        <div class="col-6">
            <img src="image/product/'.$img.'" class="img-fluid quick-img" >
        </div>
        <div class="col-6 justify-content-center align-item-center">
            <h3>'.$name.'</h3>';
            for($i=1; $i<=$avgRating; $i++)
            {
                echo '<i class="bx bxs-star"></i>';
            }
            for($i=1; $i<=(5-$avgRating); $i++)
            {
                echo '<i class="bx bx-star"></i>';
            }
        echo  '</div>
    </div>';

?>
