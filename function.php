<?php
// include_once('connection.php');

// check if shop name already exists
function checkShopNameValid($shop_name, $connection)
{
    $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM SHOP WHERE upper(shop_name)=upper(:shopname)";
    $result=oci_parse($connection,$checkQuery);

    oci_bind_by_name($result, ":shopname", $shop_name);
    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);

    oci_execute($result);
    oci_fetch($result);
    // oci_free_statement($result); 
    if($number_of_rows>0){
        return false;
        
    }
    else{
        return true;
    }
}

//check if shop registration number already exists
function checkRegistrationNumValid($reg_id, $connection)
{
    $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM SHOP WHERE upper(REGISTATION_ID)=upper(:reg_id)";
    $result=oci_parse($connection,$checkQuery);

    oci_bind_by_name($result, ":reg_id", $reg_id);
    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    if($number_of_rows>0){
        return false;
    }
    else{
        return true;
    }                 
}

//returns email of user in parameter
function getEmail($user_id, $connection)
{
    $getEmail= "SELECT * from mart_user where USER_ID=$user_id";
    $parsedGetEmail = oci_parse($connection, $getEmail);
    oci_execute($parsedGetEmail);
    while (($row = oci_fetch_assoc($parsedGetEmail)) != false) {
        $email= $row['EMAIL'];
    }
    oci_free_statement($parsedGetEmail);

    return $email;
}

//get number of shop of a trader
//returns false if shop exceeds 2
function checkShopExceed($trader_id, $connection)
{
    $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM SHOP WHERE USER_ID=$trader_id AND UPPER(ACTIVE_STATUS)='A'";
    $result=oci_parse($connection,$checkQuery);

    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    if($number_of_rows>2){
        return false;
    }
    else{
        return true;
    }   
}

//get product image
function getProductImage($product_id, $connection)
{
    $query="SELECT * FROM PRODUCT_IMAGE WHERE PRODUCT_ID=$product_id AND ROWNUM<=3 ORDER BY IMAGE_ID DESC";
    $parsed=oci_parse($connection,$query);

    oci_execute($parsed);
    $img=[];
    while (($row = oci_fetch_assoc($parsed)) != false) {
        array_push($img, $row['IMAGE_DETAIL']);
    }
    oci_free_statement($parsed);

    if(empty($img))
    {
        array_push($img, 'productplaceholder.png');
    }

    return $img;
}

//get total rating of product
function getAvgRating($product_id, $connection)
{
    $query="SELECT STAR_RATING FROM REVIEW WHERE PRODUCT_ID=$product_id";
    $parsed2=oci_parse($connection, $query);
    oci_execute($parsed2);
    $count_rating=0;
    $total=0;
    while (($row = oci_fetch_assoc($parsed2)) != false) {
        $count_rating++;
        $total+=$row['STAR_RATING'];
    }

    oci_free_statement($parsed2);
    if($count_rating!=0)
    {
        return (intval($total/$count_rating));
    }
    else{
        return 0;
    } 
}

//get total rating of product
function getTotalReview($product_id, $connection)
{
    $query="SELECT  COUNT(*) AS NUMBER_OF_ROWS FROM REVIEW WHERE PRODUCT_ID=$product_id";
    $result=oci_parse($connection, $query);

    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    oci_free_statement($result);
    return $number_of_rows;
}

function getRatingPercent($product_id, $stars ,$connection)
{
    $query="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM REVIEW WHERE PRODUCT_ID=$product_id AND STAR_RATING=$stars";
    $result=oci_parse($connection, $query);
    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    oci_free_statement($result);

    $totalRating= getTotalReview($product_id, $connection);
    $percent=($number_of_rows/$totalRating)*100;
    $value=array($number_of_rows, $percent);
    return $value;
    
}

//get category name from id
function getCategory($cat_id, $connection)
{
    $query="SELECT * FROM PRODUCT_CATEGORY WHERE CATEGORY_ID=$cat_id";
    $result=oci_parse($connection, $query);

    oci_execute($result);
    while (($row = oci_fetch_assoc($result)) != false) {
        $cat_name=$row['CATEGORY_NAME'];
    }
    oci_free_statement($result);
    return $cat_name;
}

//get shop name from id
function getShop($shop_id, $connection)
{
    $query="SELECT * FROM SHOP WHERE SHOP_ID=$shop_id";
    $result=oci_parse($connection, $query);

    oci_execute($result);
    while (($row = oci_fetch_assoc($result)) != false) {
        $shop_name=$row['SHOP_NAME'];
    }
    oci_free_statement($result);
    return $shop_name;
}

//get product discount for specific order
function getProductDiscount($product_id, $order_id,  $connection)
{
    $discount_rate=0;
    $query="SELECT DISTINCT DISCOUNT_ID, DISCOUNT_RATE,  P.PRODUCT_ID FROM DISCOUNT D
    JOIN PRODUCT P
    ON P.PRODUCT_ID=D.PRODUCT_ID
    JOIN ORDER_ITEM OI
    ON P.PRODUCT_ID=OI.PRODUCT_ID
    JOIN CUST_ORDER CO
    ON OI.ORDER_ID=CO.ORDER_ID
    WHERE START_DATE<= ORDER_DATE
    AND EXPIRY_DATE>= ORDER_DATE
    AND P.PRODUCT_ID=$product_id
    AND CO.ORDER_ID=$order_id";
    $result=oci_parse($connection, $query);

    oci_execute($result);
    while (($row = oci_fetch_assoc($result)) != false) {
        $discount_rate=$row['DISCOUNT_RATE'];
    }
    oci_free_statement($result);
    return $discount_rate;

}

//get price for specific order with pricing history
function getPrice($product_id, $order_id, $connection)
{
    $query="SELECT PRICE
    FROM CUST_ORDER CO
    JOIN ORDER_ITEM OI
    ON CO.ORDER_ID=OI.ORDER_ID
    JOIN PRICING_HISTORY PH
    ON PH.PRODUCT_ID=OI.PRODUCT_ID
    WHERE CO.ORDER_DATE>=START_DATE
    AND CO.ORDER_ID=$order_id
    AND PH.PRODUCT_ID=$product_id
    ORDER BY START_DATE";

    $result=oci_parse($connection, $query);
    oci_execute($result);
    $row = oci_fetch_assoc($result);
    $price=$row['PRICE'];
    oci_free_statement($result);
    return $price;
}

//get description from product id
function getDescription($product_id, $connection)
{
    $query="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$product_id";
    $result=oci_parse($connection, $query);
    oci_execute($result);
    $row = oci_fetch_assoc($result);
    $descp=$row['DESCRIPTION']->load();
    oci_free_statement($result);
    return $descp;
}

//Check if product exists in cart
function checkCartProduct($product_id, $user_id, $connection)
{
    $query="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM CART_ITEM WHERE PRODUCT_ID=$product_id AND USER_ID=$user_id";
    $result=oci_parse($connection, $query);

    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    oci_free_statement($result);
    return $number_of_rows;
}


//insert into cart
function insertCartProduct($product_id, $user_id,$quantity, $connection)
{
    $query="INSERT INTO CART_ITEM(QUANTITY, PRODUCT_ID, USER_ID) VALUES($quantity, $product_id, $user_id)";
    $result=oci_parse($connection, $query);

    oci_execute($result);
    oci_free_statement($result);
}

//get quantity of product in cart
function getCartProductQuantity($product_id, $user_id, $connection)
{
    $query="SELECT * FROM CART_ITEM WHERE PRODUCT_ID=$product_id AND USER_ID=$user_id";
    $result=oci_parse($connection, $query);
    oci_execute($result);
    $row = oci_fetch_assoc($result);
    $quantity=$row['QUANTITY'];
    oci_free_statement($result);
    return $quantity;
}

//add quantity of product in cart
function addProductQuantity($product_id, $user_id, $old_quantity, $quantity, $connection)
{
    $new_quantity=$old_quantity+$quantity;
    $stock=getProductStock($product_id, $connection);
    if($stock<$new_quantity)
    {
        return false;
    }
    else
    {
        $query="UPDATE CART_ITEM SET QUANTITY=$new_quantity WHERE USER_ID=$user_id AND PRODUCT_ID=$product_id";
        $result=oci_parse($connection, $query);
    
        oci_execute($result);
        oci_free_statement($result);
        return true;
    }
}

//get product stock
function getProductStock($product_id, $connection)
{
    $query="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$product_id";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    $row=oci_fetch_assoc($parsed);
    $stock=$row['STOCK_QUANTITY'];
    return $stock;
}

function getStockLeftToAdd($product_id, $user_id,$stock, $connection)
{
    $query="SELECT * FROM CART_ITEM WHERE USER_ID=$user_id AND PRODUCT_ID=$product_id";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    $row=oci_fetch_assoc($parsed);
    $quantity=$stock-$row['QUANTITY'];
    return $quantity;
}

function checkProductInWishList($product_id, $user_id, $connection)
{
    $query="SELECT  COUNT(*) AS NUMBER_OF_ROWS FROM WISHLIST_ITEM WHERE PRODUCT_ID=$product_id AND USER_ID=$user_id";
    $result=oci_parse($connection, $query);

    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    oci_free_statement($result);
    if($number_of_rows>0)
    {
        return true;
    }
    else{
        return false;
    }
}

//add product to wishlist
function saveToWishlist($product_id, $user_id, $connection)
{
    if(checkProductInWishList($product_id, $user_id, $connection))
    {
        return false;
    }
    else{
        $query="INSERT INTO WISHLIST_ITEM( PRODUCT_ID, USER_ID) VALUES( $product_id, $user_id)";
        $result=oci_parse($connection, $query);

        oci_execute($result);
        oci_free_statement($result);
        return true;
    }    
}

function removeFromWishlist($product_id, $user_id, $connection)
{
    if(!checkProductInWishList($product_id, $user_id, $connection))
    {
        return false;
    }
    else{
        $query="DELETE FROM WISHLIST_ITEM WHERE USER_ID=$user_id AND PRODUCT_ID=$product_id";
        $result=oci_parse($connection, $query);

        oci_execute($result);
        oci_free_statement($result);
        return true;
    }    
}

function getSimilarProduct($product_id, $category_id, $shop_id, $connection)
{
    $product_array=[];
    $sameCategory="SELECT * FROM PRODUCT WHERE (CATEGORY_ID=$category_id OR SHOP_ID=$shop_id)  AND ROWNUM<=6";
    $result=oci_parse($connection, $sameCategory);
    oci_execute($result);
    while (($row = oci_fetch_assoc($result)) != false) {
        if($row['PRODUCT_ID']==$product_id)
        {
            continue;
        }
       array_push($product_array, $row['PRODUCT_ID']);
    }
    oci_free_statement($result);

    if(count($product_array)<6)
    {
        $needed_prod_count=6-count($product_array);
        $otherproduct="SELECT * FROM PRODUCT";
        $result=oci_parse($connection, $otherproduct);
        oci_execute($result);
        $count=0;
        while (($row = oci_fetch_assoc($result)) != false) {
            if($count>=$needed_prod_count)
            {
                break;
            }
            if($row['PRODUCT_ID']==$product_id || in_array($row['PRODUCT_ID'], $product_array))
            {
                continue;
            }
            array_push($product_array, $row['PRODUCT_ID']);
            $count++;
        }
        oci_free_statement($result);
    }

   return $product_array;
}

function checkUserGotCartItem($user_id, $connection)
{
    $query="SELECT SUM(QUANTITY) AS NUMBER_OF_ROWS FROM CART_ITEM WHERE USER_ID=$user_id";
    $result=oci_parse($connection, $query);

    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    oci_free_statement($result);
    return $number_of_rows;

}

function removeFromCart($product_id, $user_id, $connection)
{
    $query="DELETE FROM CART_ITEM WHERE USER_ID=$user_id AND PRODUCT_ID=$product_id";
    $result=oci_parse($connection, $query);
    oci_execute($result);
    oci_free_statement($result);
}

function removeAllFromCart($user_id, $connection)
{
    $query="DELETE FROM CART_ITEM WHERE USER_ID=$user_id ";
    $result=oci_parse($connection, $query);
    oci_execute($result);
    oci_free_statement($result);
}

function updateCartItemQuantity($pid, $quantity, $user_id, $connection)
{
    $query="UPDATE CART_ITEM SET QUANTITY=$quantity WHERE USER_ID=$user_id AND PRODUCT_ID=$pid";
    $result=oci_parse($connection, $query);
    oci_execute($result);
    oci_free_statement($result);
}

function checkWishlistCount($user_id, $connection)
{
    $query="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM WISHLIST_ITEM WHERE USER_ID=$user_id";
    $result=oci_parse($connection, $query);

    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($result);
    oci_fetch($result);
    oci_free_statement($result);
    return $number_of_rows;

}
?>
