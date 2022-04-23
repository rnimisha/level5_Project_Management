<?php
include_once('../connection.php');
if(isset($_POST['product_id']))
{
  $product_id=$_POST['product_id'];
  $img=array();
  $getProduct= "SELECT * FROM ACTIVE_PRODUCT WHERE PRODUCT_ID=$product_id";
  // echo $getProduct;
  $parsedgetProduct = oci_parse($connection, $getProduct);
  oci_execute($parsedgetProduct);
  while (($row = oci_fetch_assoc($parsedgetProduct)) != false) {
    $name=$row['PRODUCT_NAME'];
    $category=$row['CATEGORY_NAME'];
    $quantity=$row['STOCK_QUANTITY'];
    $price=$row['PRICE'];    
    $unit=$row['PRICING_UNIT'];   
    $min=$row['MIN_ORDER'];
    $max=$row['MAX_ORDER']; 
    $descp=$row['DESCRIPTION']->load();
    $allergy=$row['ALLERGY_INFO'];
    $discount=$row['DISCOUNT_RATE'];
  }
  oci_free_statement($parsedgetProduct);

  $getImg="SELECT * FROM PRODUCT_IMAGE WHERE PRODUCT_ID=$product_id AND ROWNUM <= 4";
  $parsed=oci_parse($connection, $getImg);
  oci_execute($parsed);
  while (($row = oci_fetch_assoc($parsed)) != false) {
    $img=array_push($img, $row['IMAGE_DETAIL']);
  }
  oci_free_statement($parsed);
  if(empty($img[0]))
  {
    $img[0]='productplaceholder.png';
  }

}

echo '<div class="row">
          <div class="col-12 d-flex justify-content-center border-bottom">
            <div class="h4 font-weight-bold"> Product Detail</div>
          </div>
    </div>
    <div class="row detail-prod">
    <div class="row justify-content-center align-item-center mx-auto">
        <img src="../image/product/'.$img[0].'" alt="product-image" class="prod-detail-img"/>
    </div>
    <ul class="list-group list-group-flush my-1 col-md-6 pl-4">
        <li class="list-group-item ">
            <span class="font-green font-weight-bold"> Product Name : </span> '.$name.'
        </li>
        <li class="list-group-item">
        <span class="font-green font-weight-bold"> Category : </span> '.$category.'
        </li>
        <li class="list-group-item">
        <span class="font-green font-weight-bold"> Price : </span> '.$price.'/'.$unit.'
        </li>
        <li class="list-group-item ">
        <span class="font-green font-weight-bold"> Quantity : </span> '.$quantity.'
        </li>
        <li class="list-group-item">
        <span class="font-green font-weight-bold"> Minimum Order : </span> '.$min.'
        </li>
        <li class="list-group-item">
        <span class="font-green font-weight-bold">Maximum Order : </span> '.$max.'
        </li>
        <li class="list-group-item">
        <span class="font-green font-weight-bold"> Discount : </span> '.$discount.'%
        </li>
    </ul>
    </div>
    <div class="row">
        <ul class="list-group list-group-flush my-1 col-12 pl-4">
        <li class="list-group-item">
                <span>
                <p class="text-center font-green font-weight-bold">Description</p> '.$descp.'
                </span>
            </li>';
            if(!empty($allergy)){
            echo'<li class="list-group-item">
                <span>
                <p class="text-center font-green font-weight-bold">Allergy Information</p>'.$allergy.'
                </span>
            </li>';
            }
        echo'</ul>
    </div>';

?>


