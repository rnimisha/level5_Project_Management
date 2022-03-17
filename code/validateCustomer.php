<?php
include 'connection.php';

$error=array();
$error['clear']=false;

//validation
if(isset($_POST['fullname']))
{
    //name validation
    if(!empty(trim($_POST['fullname'])))
    {
        if(strlen($_POST['fullname']) < 4)
        {
            $error['#name_error']="Enter a valid name";
            $error['clear']=false;

        }
        else{
            $error['#name_error']="";
            $error['clear']=true;
            $fullname=mysqli_real_escape_string($connection, $_POST['fullname']);

        }
    }
    else{
        $error['#name_error']="Name cannot be empty";
        $error['clear']=false;

    }
}

//response
echo json_encode($error);
?>