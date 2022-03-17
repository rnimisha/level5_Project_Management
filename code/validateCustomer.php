<?php
include 'connection.php';

$error=array();
$error['clear']=false;

//validation
if(isset($_POST['fullname']) && isset($_POST['useremail']))
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

    //email validation
    if(!empty(trim($_POST['useremail']))){
        if(filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)){

            //sanitize before rurnning query
            $useremail=mysqli_real_escape_string($connection, $_POST['useremail']);
            $checkQuery="SELECT * FROM `user` WHERE email='$useremail'";
            $result=mysqli_query($connection,$checkQuery);
            if(mysqli_num_rows($result)>0){
                $error['#email_error']="Enter already registered";
                $error['clear']=false;
            }

            $error['#email_error']="";
            $error['clear']=true;


        }
        else{
            $error['#email_error']="Enter a valid email";
            $error['clear']=false;
        }

    }
    else{
        $error['#email_error']="Email cannot be empty";
        $error['clear']=false;
    }
}

//response
echo json_encode($error);
?>