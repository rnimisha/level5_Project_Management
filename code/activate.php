<?php
    include_once('connection.php');
    
    if(isset($_GET['token']))
    {
        $token=$_GET['token'];
        $query="UPDATE mart_user SET active_status='A' where token='$token'";
        $parsedQuery=oci_parse($connection,$query);

        if(oci_execute($parsedQuery)){
            echo "sucess";
        }
        else{
            echo "lol";
        }
    }
?>