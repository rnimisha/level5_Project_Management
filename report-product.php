<?php
    include_once('connection.php');

    $report=array();
    $report['clear']=true;
    $report['valid']=true;
    if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']) )
    {
        $report['clear']=false;
        $report['valid']=false;
        $report['error']='login';
    }
    else if(isset($_POST['action']) && $_POST['action']=='report-product-submit' && isset($_POST['product_id']))
    {
        $product_id=$_POST['product_id'];
        $user=$_SESSION['phoenix_user'];
        if(isset($_POST['message']))
        {
            if(!empty($_POST['message']))
            {
                $message=$_POST['message'];
                $query="INSERT INTO REPORT(REPORT_DETAIL, PRODUCT_ID, USER_ID) VALUES('$message', $product_id, $user)";
                $parsed=oci_parse($connection, $query);
                oci_execute($parsed);
                oci_free_statement($parsed);
                $report['#error_prod-report']="";
                $report['#prod-report']='valid';
                $report['q']=$query;
            }
            else
            {
                $report['clear']=false;
                $report['#error_prod-report']="Please enter your message";
                $report['#prod-report']='is-invalid';
            }
        }
    } 

 
    echo json_encode($report);
?>