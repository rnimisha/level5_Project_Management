<?php
    include_once('../connection.php');

    $add_dis_error=array();
    $add_dis_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='add-discount-form' && isset($_POST['prod_id'])){
        $prod_id=$_POST['prod_id'];
        if(isset($_POST['dis-name'])){
            if(!empty(trim($_POST['dis-name'])))
            {
                
            }
            else{
                $add_dis_error['clear']=false;
                $add_dis_error['#error-dis-name']="Product name is required";
                $add_dis_error['#dis-name']='is-invalid';
            }

        }
    }
?>