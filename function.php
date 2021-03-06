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
        return (number_format(($total/$count_rating),2));
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
    // return $price;
    return number_format($price, 2);
}

//get total items order in specific order
function getOrderItemQuantity($order_id, $connection)
{
    $query="SELECT SUM(ITEM_QUANTITY) AS TOTAL_ITEMS FROM CUST_ORDER CO JOIN ORDER_ITEM OT ON OT.ORDER_ID=CO.ORDER_ID WHERE CO.ORDER_ID=$order_id";
    $result=oci_parse($connection, $query);

    oci_define_by_name($result, 'TOTAL_ITEMS', $total_items);
    oci_execute($result);
    oci_fetch($result);
    oci_free_statement($result);
    return $total_items;
}

function getSubtotalforOrder($order_id, $connection)
{
    $selectQuery="SELECT DISTINCT PRODUCT_ID, ITEM_QUANTITY FROM CUST_ORDER CO JOIN ORDER_ITEM OT ON OT.ORDER_ID=CO.ORDER_ID WHERE CO.ORDER_ID=$order_id";
    $parsed=oci_parse($connection, $selectQuery);
    oci_execute($parsed);
    $total=0.0;
    while (($row = oci_fetch_assoc($parsed)) != false) {
        
        $prod_price=getPrice($row['PRODUCT_ID'], $order_id, $connection) * $row['ITEM_QUANTITY'];
        $prod_dis=getProductDiscount($row['PRODUCT_ID'], $order_id, $connection);
        $total=$total+$prod_price;
        $total=$total-(($prod_dis/100)*$total);
    }
    oci_free_statement($parsed);
    return $total;
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


//insert into cart if not in cart at all
function insertCartProduct($product_id, $user_id,$quantity, $connection)
{
    $min_quantity=$quantity;
    $query_min_order="SELECT MIN_ORDER FROM PRODUCT WHERE PRODUCT_ID=$product_id";
    $parsed_min=oci_parse($connection, $query_min_order);
    $execute=oci_execute($parsed_min);
    $row = oci_fetch_assoc($parsed_min);
    $min_quantity=$row['MIN_ORDER'];
    oci_free_statement($parsed_min);

    $query="INSERT INTO CART_ITEM(QUANTITY, PRODUCT_ID, USER_ID) VALUES($min_quantity, $product_id, $user_id)";
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

function removeAllFromWishlist($user_id, $connection)
{
    $query="DELETE FROM WISHLIST_ITEM WHERE USER_ID=$user_id ";
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

function productLeftToReview($customer_id, $connection)
{
    $query="SELECT DISTINCT REVIEW_ID, CO.ORDER_ID, ORDER_ITEM_ID,ITEM_QUANTITY, OI.PRODUCT_ID FROM CUST_ORDER CO 
    JOIN ORDER_ITEM OI 
    ON CO.ORDER_ID=OI.ORDER_ID
    LEFT JOIN (SELECT * FROM REVIEW WHERE USER_ID=$customer_id) R
    ON R.PRODUCT_ID=OI.PRODUCT_ID
    WHERE CO.USER_ID=$customer_id
    AND REVIEW_ID IS NULL
    GROUP BY CO.ORDER_ID, ORDER_ITEM_ID, ITEM_QUANTITY,OI.PRODUCT_ID, REVIEW_ID
    ORDER BY ORDER_ID";

    $parsed=oci_parse($connection,$query);
    $products=[];
    oci_execute($parsed);
    while (($row = oci_fetch_assoc($parsed)) != false) {
        array_push($products, $row['PRODUCT_ID']);
    }
    oci_free_statement($parsed);
    return $products;

}

function checkProductDiscountRate($product_id, $connection)
{
    $query="SELECT * FROM DISCOUNT WHERE PRODUCT_ID=$product_id AND START_DATE<=SYSDATE AND EXPIRY_DATE>=SYSDATE";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    $discount=0;
    while (($row = oci_fetch_assoc($parsed)) != false) {
        $discount=$row['DISCOUNT_RATE'];
    }
    oci_free_statement($parsed);
    return $discount;
}
function calculatePriceWithDiscount($product_id, $connection){
    $query="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$product_id";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    while (($row = oci_fetch_assoc($parsed)) != false) {
        $price=$row['PRICE'];
    }
    oci_free_statement($parsed);

    $discount= checkProductDiscountRate($product_id, $connection);
    $final=$price-(($discount/100)*$price);
    return number_format($final, 2);
}

function calculateSubtotalAfterCoupon($coupon_id, $subtotal, $connection)
{
    $coupon_id=trim($coupon_id);
    $query="SELECT * FROM COUPON WHERE COUPON_ID=$coupon_id";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    $row = oci_fetch_assoc($parsed);
    $di_rate=$row['DISCOUNT_RATE'];
    $symbol=$row['DISCOUNT_RATE'];
    if(strtoupper($symbol)=='GBP')
    {
        $subtotal=$subtotal-$di_rate;
    }
    else{
        $subtotal=discountFormula($di_rate, $subtotal);
    }

    return number_format($subtotal, 2);
}

function discountFormula($discount_rate, $total)
{
    $discount=($discount_rate/100) * $total;
    return ($total - $discount);
}

function getshopProductRatingPercent($shop_id, $connection)
{
    $query="SELECT SUM(TOTAL_RATE) AS TOTAL_RATE, SUM(TOTAL_PEOPLE) AS TOTAL_PEOPLE FROM (SELECT SUM(STAR_RATING) AS TOTAL_RATE, COUNT(*) AS TOTAL_PEOPLE, PRODUCT_ID FROM REVIEW WHERE PRODUCT_ID IN(SELECT PRODUCT_ID FROM PRODUCT P JOIN SHOP S ON S.SHOP_ID=P.SHOP_ID WHERE S.SHOP_ID=$shop_id) GROUP BY PRODUCT_ID)";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    $row = oci_fetch_assoc($parsed);
    if($row['TOTAL_PEOPLE']>0)
    {
        $average= number_format((($row['TOTAL_RATE'])/($row['TOTAL_PEOPLE']*5))*100,2);
        return $average."% Positive Rating";
    }
    else{
        return "No ratings on product yet";
    }
    oci_free_statement($parsed);
}

function getProfilePicture($connection, $user_id)
{
    $query="SELECT PROFILE_PIC FROM MART_USER WHERE USER_ID=$user_id";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    $row = oci_fetch_assoc($parsed);
    return $row['PROFILE_PIC'];

}
function getAdminEmail($connection)
{
    $query="SELECT EMAIL FROM MART_USER WHERE UPPER(USER_ROLE)='A'";
    $parsed=oci_parse($connection, $query);
    oci_execute($parsed);
    $row = oci_fetch_assoc($parsed);
    return $row['EMAIL'];
}
?>
