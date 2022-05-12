<?php
include_once('connection.php');
include_once('function.php');
if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']) )
{
    header('Location: loginform.php');
}
if(isset($_SESSION['user_role']) && $_SESSION['user_role']!='C')
{
    header('Location: loginform.php');
}
echo $_SESSION['collection-id'];
echo $_GET['PayerID'];
echo $_SESSION['COUPON'];
?>