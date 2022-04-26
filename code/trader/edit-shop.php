<?php
    include_once('../connection.php');
    include_once('../function.php');

    $shop_name_error=array();
    $shop_name_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='edit-shop-form' && isset($_POST['shop_id']))
    {
        $shop_id=$_POST['shop_id'];

        if(isset($_POST['new_name'])){
            if(!empty(trim($_POST['new_name'])))
            {
                if(strlen($_POST['new_name']) < 4)
                {
                    $shop_name_error['clear']=false;
                    $shop_name_error['#error-new-shop-name']="Enter valid shop name";
                    $shop_name_error['#new-shop-name']='is-invalid';
                }
                else{
                    $shop_name=$_POST['new_name'];
                    if(!checkShopNameValid($shop_name, $connection))
                    {
                        $shop_name_error['clear']=false;
                        $shop_name_error['#error-new-shop-name']="Name already registered";
                        $shop_name_error['#new-shop-name']='is-invalid';
                    }
                    else{
                        $shop_name_error['#error-new_name']="";
                        $shop_name_error['#new-shop-name']='valid';
                    }
                }
            }
            else{
                $shop_name_error['clear']=false;
                $shop_name_error['#error-new-shop-name']="Enter shop name";
                $shop_name_error['#new-shop-name']='is-invalid';
            }

        }

        echo json_encode($shop_name_error);
    }
    
?>