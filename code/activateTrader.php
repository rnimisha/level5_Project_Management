<?php
    include_once('connection.php');
    
    if(isset($_GET['userid']))
    {
        $uid=$_GET['userid'];
        $query="UPDATE mart_user SET active_status='A' where USER_ID=$uid";
        $parsedQuery=oci_parse($connection,$query);

        if(oci_execute($parsedQuery)){
            oci_free_statement($parsedQuery);
            //update shop
            $shopQuery="UPDATE shop SET active_status='A' WHERE USER_ID=$uid";
            $parsedQuery2=oci_parse($connection,$shopQuery);
            if(oci_execute($parsedQuery2)){
                echo "success";
            }
            else
            {
                echo "loooool";
            }
            oci_free_statement($parsedQuery2);
        }
        else{
            echo "lol";
        }
    }
?>