<?php
include_once('connection.php');

$error=array();
$error['clear']=true;



// //validation
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
            $fullname= $_POST['fullname'];

        }
    }
    else{
        $error['#name_error']="Name cannot be empty";
        $error['clear']=false;

    }
}

if(isset($_POST['useremail'])){
    //email validation
    if(!empty(trim($_POST['useremail']))){
        if(filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)){

            //sanitize before rurnning query
            $useremail=$_POST['useremail'];
            // $checkQuery="SELECT * FROM `mart_user` WHERE email='$useremail'";
            $checkQuery="SELECT * FROM `mart_user` WHERE email=:email";
            $result=oci_parse($connection,$checkQuery);

            oci_bind_by_name($result, ":email", $useremail);
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
}

    //password validation
if(isset($_POST['pword'])){
    if(!empty(trim($_POST['pword'])))
    {
        $pattern='/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{7,}$/';
        if(preg_match($pattern,$_POST['pword']))
        {
            //encrypt password before

            $error['#pass_error']="";
           
        }
        else
        {
            $error['clear']=false;
            $error['#pass_error']="Atleast 7 alphanumeric character <br/> atleast one upper one lower and one digit!<br/>";
        }

    }
    else
    {
        $error['#pass_error']="Password cannot be empty";
        $error['clear']=false;

    }
}

    //re enter password validaion
if(isset($_POST['repass'])){
    if(!empty(trim($_POST['repass'])))
    {
        if($_POST['repass'] == $_POST['pword'])
        {
            $error['#repass_error']="";
        }
        else
        {
            $error['#repass_error']="Password does not match";
            $error['clear']=false;
        }
    }
    else
    {
        $error['#repass_error']="Re-enter password";
        $error['clear']=false;
    }
}

    //contact validation 
if(isset($_POST['contact'])){
    if(!empty(trim($_POST['contact'])))
    {
        if(is_numeric(trim($_POST['contact'])))
        {
             if(strlen(trim($_POST['contact']))>=10)
            {
                $error['#contact_error']="";
            
            }
            else
            {
                $error['#contact_error']="Contact can't be less than 10 digits";
                $error['clear']=false;
            }
        }
        else
        {
                $error['#contact_error']="Enter valid digits";
                $error['clear']=false;
        }

    }
    else{
        $error['#contact_error']="Contact cannot be empty";
        $error['clear']=false;
    }
}

    //dob validation
if(isset($_POST['dob'])){
    if(!empty($_POST['dob']))
    {
        $error['#dob_error']="";
    }
    else{
        $error['#dob_error']="DOB cannot be empty";
        $error['clear']=false;
    }
}

    //address validation
if(isset($_POST['address'])){
    if(!empty($_POST['address']))
    {
        if(strlen($_POST['address']) < 4)
        {
            $error['#address_error']="Enter a valid address";
            $error['clear']=false;

        }
        else{
            $error['#address_error']="";

        }

    }
    else{
        $error['#address_error']="Address cannot be empty";
        $error['clear']=false;
    }
}

if(!isset($_POST['registercust']))
{
    $error['clear']=false;
}


$fullnames='Heedo';
$email="Heedo";
$password="123";
$contact="2345";
$address="addre";
$role='r';
$statuss="s";
$dob='05/06/2007';

$insertQuery="INSERT INTO mart_user(NAME, EMAIL, PASSWORD, CONTACT, ADDRESS, USER_ROLE, ACTIVE_STATUS, DOB) VALUES(:fullname, :email, :pass,:contact, :addr, :roles, :statuss, to_date(:dob,'DD/MM/YYYY'))";

$parsedQuery=oci_parse($connection,$insertQuery);


oci_bind_by_name($parsedQuery, ":fullname", $fullnames);
oci_bind_by_name($parsedQuery, ":email", $email);
oci_bind_by_name($parsedQuery, ":pass", $password);
oci_bind_by_name($parsedQuery, ":contact", $contact);
oci_bind_by_name($parsedQuery, ":addr", $address);
oci_bind_by_name($parsedQuery, ":roles", $role);
oci_bind_by_name($parsedQuery, ":statuss", $statuss);
oci_bind_by_name($parsedQuery, ":dob", $dob);

oci_execute($parsedQuery);
oci_free_statement($parsedQuery);

//response
echo json_encode($error);
?>