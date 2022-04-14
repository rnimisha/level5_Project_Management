<?php
include_once('connection.php');
echo "trader";
echo $_SESSION['phoenix_user'];
unset($_SESSION['phoenix_user']);
?>