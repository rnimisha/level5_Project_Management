<?php
include_once('connection.php');;

$error=array();
$error['clear']=true;

//validation
if(isset($_POST['fullname']) && isset($_POST['useremail']) && isset($_POST['pword']))
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
            $fullname= $_POST['fullname'];

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
            $useremail=$_POST['useremail'];
            $checkQuery="SELECT * FROM `mart_user` WHERE email='$useremail'";
            $result=oci_parse($connection,$checkQuery);
            if(oci_num_rows($result)>0){
                $error['#email_error']="Enter already registered";
                $error['clear']=false;
            }

            $error['#email_error']="";


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

    //password validation
    if(!empty(trim($_POST['pword'])))
    {
        $pattern='/^(?=.[a-z])(?=.[A-Z])(?=.[0-9])(?=.[@$!%?&_])[a-zA-Z0-9@$!%?&_]{7,}$/';
        if(preg_match($pattern,$_POST['pword']))
        {
            //encrypt password before

            $error['#pass_error']="";
           
        }
        else
        {
            $error['clear']=false;
            $error['#pass_error']="Atleast 7 alphanumeric character with atleast one upper one lower and one digit!<br/>";
        }

    }
    else
    {
        $error['#pass_error']="Password cannot be empty";
        $error['clear']=false;

    }
}

//response
echo json_encode($error);
?>