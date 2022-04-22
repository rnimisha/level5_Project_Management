<?php
include_once('../connection.php');

$product_detail=array();
$product_detail['clear']=true;
if(isset($_POST['product_modal']) && ($_POST['product_modal'])=='yes')
{
    if(isset($_POST['product_id']) && !empty(trim($_POST['product_id'])))
    {
        $p_id=trim($_POST['product_id']);
        // echo($p_id);
        $query="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$p_id";

        $parsed = oci_parse($connection, $query);
        oci_execute($parsed);
        while (($row = oci_fetch_assoc($parsed)) != false) {
            $product_detail['name']=$row['PRODUCT_NAME'];
            $product_detail['category']=$row['CATEGORY_ID'];
            // $product_detail['shop']=$row[''];
            $product_detail['quantity']=$row['STOCK_QUANTITY'];
            $product_detail['price']=$row['PRICE'];    
            $product_detail['unit']=$row['PRICING_UNIT'];   
            $product_detail['min']=$row['MIN_ORDER'];
            $product_detail['max']=$row['MAX_ORDER']; 
            $product_detail['descp']=$row['DESCRIPTION']->load();
            $product_detail['allergy']=$row['ALLERGY_INFO'];
        }
    }
    echo json_encode($product_detail);
}

?>