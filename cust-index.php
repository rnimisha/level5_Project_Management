<?php
include_once('connection.php');
echo "Heelloooo";
if(isset($_SESSION['phoenix_user']))
{
    echo "customer";
    echo $_SESSION['phoenix_user'];
    // unset($_SESSION['phoenix_user']);
}
?>