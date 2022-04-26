<?php
    include_once('../connection.php');
    include_once('../function.php');

    $add_shop_error=array();
    $add_shop_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='add-shop-form' && isset($_POST['trader_id'])){

        $trader_id=$_POST['trader_id'];
        if(isset($_POST['shop_name'])){
            if(!empty(trim($_POST['shop_name'])))
            {
                if(strlen($_POST['shop_name']) < 4)
                {
                    $add_shop_error['clear']=false;
                    $add_shop_error['#error-shop-name']="Enter valid shop name";
                    $add_shop_error['#shop-name']='is-invalid';
                }
                else{
                    $shop_name=$_POST['shop_name'];
                    if(!checkShopNameValid($shop_name, $connection))
                    {
                        $add_shop_error['clear']=false;
                        $add_shop_error['#error-shop-name']="Name already registered";
                        $add_shop_error['#shop-name']='is-invalid';
                    }
                    else{
                        $add_shop_error['#error-shop-name']="";
                        $add_shop_error['#shop-name']='valid';
                    }
                }
            }
            else{
                $add_shop_error['clear']=false;
                $add_shop_error['#error-shop-name']="Shop name is required";
                $add_shop_error['#shop-name']='is-invalid';
            }

        }
        echo json_encode($add_shop_error);
    }
?>