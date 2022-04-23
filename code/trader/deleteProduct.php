<?php
    include_once('../connection.php');
    if(isset($_GET['prodID']) && !empty(trim($_GET['prodID'])))
    {
        $deactivate="UPDATE PRODUCT SET DISABLED='T' WHERE PRODUCT_ID=".$_GET['prodID'];
        $parsed=oci_parse($connection, $deactivate);
        oci_execute($parsed);
        oci_free_statement($parsed);
        echo $deactivate;
    }
?>