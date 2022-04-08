<?php
    include_once('connection.php');

    $error=array();
    $error['clear']=true;
    
    // validation
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
                $fullnames= $_POST['fullname'];
            }
        }
        else{
            $error['#name_error']="Name cannot be empty";
            $error['clear']=false;
        }
    }

    //email validation
    if(isset($_POST['useremail'])){
        if(!empty(trim($_POST['useremail']))){
            if(filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)){

                $useremail=$_POST['useremail'];
                // // $checkQuery="SELECT * FROM `mart_user` WHERE email='$useremail'";
                $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM mart_user WHERE upper(email)=upper(:email)";
                $result=oci_parse($connection,$checkQuery);

                $rows=oci_bind_by_name($result, ":email", $useremail);
                oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                oci_execute($result);
                oci_fetch($result);
                if($number_of_rows>0){
                    $error['#email_error']="Enter already registered";
                    $error['clear']=false;
                    oci_free_statement($result); 
                }
                else{
                    $error['#email_error']="";
                    $email=$_POST['useremail'];
                   
                }
                  
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
                $password=md5($_POST['pword']);
            
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
                    $contact=$_POST['contact'];
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
            $dob=date("d-m-Y", strtotime($_POST['dob']));
            
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
                $address=$_POST['address'];
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
    else{
        if( $error['clear']==true)
        {
            $fullname= $_POST['fullname'];
            $email=$_POST['useremail'];
            $password=md5($_POST['pword']);
            $contact=$_POST['contact'];
            $dob=$_POST['dob'];
            $address=$_POST['address'];
            $statuss='i';
            $role='c';
            $dob=date("d-m-Y", strtotime($_POST['dob']));

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
        }
    }

    // $fullnames='2521';
    // $email="obs";
    // $password="123";
    // $contact="2345";
    // $address="addre";
    // $role='r';
    // $statuss="s";
    // $fullnames=$_POST['fullname'];
    // $email=$_POST['useremail'];
    // $password=md5($_POST['pword']);
    // $contact=$_POST['contact'];
    // $address=$_POST['address'];
    // $role='C';
    // $statuss="I";
    // $dob=date("d-m-Y", strtotime($_POST['dob']));

    // $fullname= $_POST['fullname'];
    // $email=$_POST['useremail'];
    // $password=md5($_POST['pword']);
    // $contact=$_POST['contact'];
    // $dob=$_POST['dob'];
    // $address=$_POST['address'];
    // $statuss='i';
    // $role='c';
    // $dob='04/04/2022';

    // $insertQuery="INSERT INTO mart_user(NAME, EMAIL, PASSWORD, CONTACT, ADDRESS, USER_ROLE, ACTIVE_STATUS, DOB) VALUES(:fullname, :email, :pass,:contact, :addr, :roles, :statuss, to_date(:dob,'DD/MM/YYYY'))";

    // $parsedQuery=oci_parse($connection,$insertQuery);


    // oci_bind_by_name($parsedQuery, ":fullname", $fullnames);
    // oci_bind_by_name($parsedQuery, ":email", $email);
    // oci_bind_by_name($parsedQuery, ":pass", $password);
    // oci_bind_by_name($parsedQuery, ":contact", $contact);
    // oci_bind_by_name($parsedQuery, ":addr", $address);
    // oci_bind_by_name($parsedQuery, ":roles", $role);
    // oci_bind_by_name($parsedQuery, ":statuss", $statuss);
    // oci_bind_by_name($parsedQuery, ":dob", $dob);

    // oci_execute($parsedQuery);
    // oci_free_statement($parsedQuery);

    // //response
    echo json_encode($error);
?>