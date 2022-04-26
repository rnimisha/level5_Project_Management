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

?>