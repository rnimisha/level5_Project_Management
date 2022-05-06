<?php
    include_once('../connection.php');
    if(isset($_GET['shopID']) && !empty(trim($_GET['shopID'])))
    {
        $deactivate="UPDATE SHOP SET ACTIVE_STATUS='I' WHERE SHOP_ID=".$_GET['shopID'];
        $parsed=oci_parse($connection, $deactivate);
        oci_execute($parsed);
        oci_free_statement($parsed);
        echo $deactivate;
    }
?>