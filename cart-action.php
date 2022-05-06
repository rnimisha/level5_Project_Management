<?php
    include_once('connection.php');
    include_once('function.php');

    $cart_action=array();

    if(!isset($_SESSION['phoenix_user']) & empty($_SESSION['phoenix_user']))
    {
        $cart_action['valid']=false;
        if(isset($_POST['product_id']) && !empty($_POST['product_id']))
        {
            $_SESSION['cart-product-remaining']=$_POST['product_id'];
        }
    }
    else if(isset($_SESSION['phoenix_user']) && isset($_SESSION['user_role']) && $_SESSION['user_role']=='C')
    {
        $cart_action['valid']=true;
    }

    echo json_encode($cart_action);
?>