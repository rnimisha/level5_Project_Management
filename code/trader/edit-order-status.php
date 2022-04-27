<?php
    include_once('../connection.php');

    $edit_prod_error=array();
    $edit_prod_error['clear']=true;
    if(isset($_POST['form_name']) && $_POST['form_name']=='edit-status-form' && isset($_POST['order_id']))
    {
        $order_id=$_POST['order_id'];
        if(!empty(trim($_POST['order_status'])))
        {
            if(strtoupper($_POST['order_status'])=="COMPLETED" || strtoupper($_POST['order_status'])=="PROCESSING" || strtoupper($_POST['order_status'])=="PENDING")
            {
                $new_status=$_POST['order_status'];
                $edit_prod_error['#error-new-order-status']="";
                $edit_prod_error['#new-order-status']='valid';
            }
            else
            {
                $edit_prod_error['clear']=false;
                $edit_prod_error['#error-new-order-status']="Select proper status";
                $edit_prod_error['#new-order-status']='is-invalid';
            }
        }
        else
        {
            $edit_prod_error['clear']=false;
            $edit_prod_error['#error-new-order-status']="Please choose status first";
            $edit_prod_error['#new-order-status']='is-invalid';
        }

        if($edit_prod_error['clear'])
        {
            $query="UPDATE CUST_ORDER SET ORDER_STATUS='$new_status' WHERE ORDER_ID=$order_id";
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
        }

        echo json_encode($edit_prod_error);
    }
?>