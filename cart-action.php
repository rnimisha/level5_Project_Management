<?php
    include_once('connection.php');
    include_once('function.php');

    $cart_action=array();

    if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']) )
    {
        if(isset($_POST['action']) && $_POST['action']=='add-to-cart')
        {
            if(isset($_POST['product_id']) && !empty($_POST['product_id']))
            {
            $_SESSION['cart-product-remaining']=$_POST['product_id'];
            }
        }
        $cart_action['valid']=false;
    }
    else if(isset($_SESSION['phoenix_user']) && isset($_SESSION['user_role']) && $_SESSION['user_role']=='C' && isset($_POST['product_id']) && !empty($_POST['product_id']) && isset($_POST['action']))
    {
        if($_POST['action']=='add-to-cart')
        {
            if((checkCartProduct($_POST['product_id'], $_SESSION['phoenix_user'], $connection))>0)
            {
                $original_quantity=getCartProductQuantity($_POST['product_id'], $_SESSION['phoenix_user'], $connection);
                $stock_status=addProductQuantity($_POST['product_id'], $_SESSION['phoenix_user'],$original_quantity,1, $connection);
                if($stock_status)
                {
                    $cart_action['stocklimit']=false;
                }
                else
                {
                    $cart_action['stocklimit']=true;
                }
            }
            else{
                insertCartProduct($_POST['product_id'], $_SESSION['phoenix_user'],1, $connection);
                $cart_action['stocklimit']=false;
            }
        }
        $cart_action['valid']=true;
    }

    echo json_encode($cart_action);
?>