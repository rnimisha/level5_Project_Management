<?php
// $hostname="localhost";
// $username="root";
// $password="";
// $database="phoenix_mart";

// $connection=mysqli_connect($hostname,$username,$password,$database);

$connection= oci_connect('rnimisha20@tbc.edu.np', 'SummerRain!221', '//localhost/xe');
 if (!$connection) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit; }

?>