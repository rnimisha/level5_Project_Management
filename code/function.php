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

?>