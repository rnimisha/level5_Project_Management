<?php
    include_once('connection.php');

    $trader_error=array();
    $trader_error['clear']=true;
    
    // validation
    if(isset($_POST['fullname']))
    {
        //name validation
        if(!empty(trim($_POST['fullname'])))
        {
            if(strlen($_POST['fullname']) < 4)
            {
                $trader_error['#t_name_error']="Enter a valid name";
                $trader_error['clear']=false;
            }
            else{
                $trader_error['#t_name_error']="";
                $fullnames= $_POST['fullname'];
            }
        }
        else{
            $trader_error['#t_name_error']="Name cannot be empty";
            $trader_error['clear']=false;
        }
    }

    //email validation
    if(isset($_POST['useremail'])){
        if(!empty(trim($_POST['useremail']))){
            if(filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)){

                $useremail=$_POST['useremail'];
                $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM mart_user WHERE upper(email)=upper(:email)";
                $result=oci_parse($connection,$checkQuery);

                $rows=oci_bind_by_name($result, ":email", $useremail);
                oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                oci_execute($result);
                oci_fetch($result);
                if($number_of_rows>0){
                    $trader_error['#t_email_error']="Enter already registered";
                    $trader_error['clear']=false;
                    oci_free_statement($result); 
                }
                else{
                    $trader_error['#t_email_error']="";
                    $email=$_POST['useremail'];
                   
                }
                  
            }
            else{
                $trader_error['#t_email_error']="Enter a valid email";
                $trader_error['clear']=false;
            }

        }
        else{
            $trader_error['#t_email_error']="Email cannot be empty";
            $trader_error['clear']=false;
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
                $trader_error['#t_pass_error']="";
                $password=md5($_POST['pword']);
            
            }
            else
            {
                $trader_error['clear']=false;
                $trader_error['#t_pass_error']="Atleast 7 alphanumeric character <br/> atleast one upper one lower and one digit!<br/>";
            }

        }
        else
        {
            $trader_error['#t_pass_error']="Password cannot be empty";
            $trader_error['clear']=false;
        }
    }

    //re enter password validaion
    if(isset($_POST['repass'])){
        if(!empty(trim($_POST['repass'])))
        {
            if($_POST['repass'] == $_POST['pword'])
            {
                $trader_error['#t_repass_error']="";
            }
            else
            {
                $trader_error['#t_repass_error']="Password does not match";
                $trader_error['clear']=false; 
            }
        }
        else
        {
            $trader_error['#t_repass_error']="Re-enter password";
            $trader_error['clear']=false;
            
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
                    $trader_error['#t_contact_error']="";
                    $contact=$_POST['contact'];
                }
                else
                {
                    $trader_error['#t_contact_error']="Contact can't be less than 10 digits";
                    $trader_error['clear']=false;
                }
            }
            else
            {
                    $trader_error['#t_contact_error']="Enter valid digits";
                    $trader_error['clear']=false;
            }

        }
        else{
            $trader_error['#t_contact_error']="Contact cannot be empty";
            $trader_error['clear']=false;
        }
    }

    //dob validation
    if(isset($_POST['dob'])){
        if(!empty($_POST['dob']))
        {
            $trader_error['#t_dob_error']="";
            $dob=date("d-m-Y", strtotime($_POST['dob']));
            
        }
        else{
            $trader_error['#t_dob_error']="DOB cannot be empty";
            $trader_error['clear']=false;
        }
    }

    //address validation
    if(isset($_POST['address'])){
        if(!empty($_POST['address']))
        {
            if(strlen($_POST['address']) < 4)
            {
                $trader_error['#t_address_error']="Enter a valid address";
                $trader_error['clear']=false;
            }
            else{
                $trader_error['#t_address_error']="";
                $address=$_POST['address'];
            }

        }
        else{
            $trader_error['#t_address_error']="Address cannot be empty";
            $trader_error['clear']=false;
        }
    }

    //reason justificarion validation
    if(isset($_POST['reason']))
    {
        if(!empty(trim($_POST['reason'])))
        {
            if(strlen($_POST['reason']) < 10)
            {
                $trader_error['#reason_error']="Enter a valid justification";
                $trader_error['clear']=false;
            }
            else{
                $trader_error['#reason_error']="";
                $reason= $_POST['reason'];
            }
        }
        else{
            $trader_error['#reason_error']="Enter your reason";
            $trader_error['clear']=false;
        }
    }

    if(isset($_POST['registertrader']))
    {
        //shop name validation
        if(isset($_POST['shopname']))
        {
            if(!empty(trim($_POST['shopname'])))
            {
                if(strlen($_POST['shopname']) < 4)
                {
                    $trader_error['#shopname_error']="Enter a valid shop name";
                    $trader_error['clear']=false;
                }
                else{
                    $trader_error['#shopname_error']="";
                    $shopname= $_POST['shopname'];
                }
            }
            else{
                $trader_error['#shopname_error']="Shop name cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //registration date validation
        if(isset($_POST['register_date'])){
            if(!empty($_POST['register_date']))
            {
                $trader_error['#register_date_error']="";
                $register_date=date("d-m-Y", strtotime($_POST['register_date']));
                
            }
            else{
                $trader_error['#register_date_error']="Registration date cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //registration number validation 
        if(isset($_POST['register_no'])){
            if(!empty(trim($_POST['register_no'])))
            {
                if(strlen(trim($_POST['register_no']))>=12)
                {
                    $trader_error['#register_no_error']="";
                    $register_no=$_POST['register_no'];
                }
                else
                {
                    $trader_error['#register_no']="Registration number can't be less than 12 characters";
                    $trader_error['clear']=false;
                }
            }
            else{
                $trader_error['#register_no_error']="PAN cannot be empty";
                $trader_error['clear']=false;
            }
        }
    }
    

    

    echo json_encode($trader_error);
    // print_r($trader_error) ;
?>