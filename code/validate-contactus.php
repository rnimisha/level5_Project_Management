<?php
    include_once('connection.php');

    $contact_error=array();
    $contact_error['clear']=true;
    
    // validation
    if(isset($_POST['firstname']))
    {
        //name validation
        if(!empty(trim($_POST['firstname'])))
        {
            if(strlen($_POST['firstname']) < 4)
            {
                $contact_error['#firstname_error']="Enter a valid name";
                $contact_error['clear']=false;
            }
            else{
                $contact_error['#firstname_error']="";
                $firstnames= $_POST['firstname'];
            }
        }
        else{
            $contact_error['#firstname_error']="Name cannot be empty";
            $contact_error['clear']=false;
        }
    }

    if(isset($_POST['lastname']))
    {
        //name validation
        if(!empty(trim($_POST['lastname'])))
        {
            $contact_error['#lastname_error']="";
            $firstnames= $_POST['firstname'];
        }
        else{
            $contact_error['#lastname_error']="Last Name cannot be empty";
            $contact_error['clear']=false;
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
                    $contact_error['#contact_error']="";
                    $contact=$_POST['contact'];
                }
                else
                {
                    $contact_error['#contact_error']="Contact can't be less than 10 digits";
                    $contact_error['clear']=false;
                }
            }
            else
            {
                $contact_error['#contact_error']="Enter valid digits";
                $contact_error['clear']=false;
            }

        }
        else{
            $contact_error['#contact_error']="Contact cannot be empty";
            $contact_error['clear']=false;
        }
    }

    //email validation
    if(isset($_POST['useremail'])){
        if(!empty(trim($_POST['useremail']))){
            if(filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)){
                $contact_error['#contact_email_error']="";
                $email=$_POST['useremail'];   
            }
            else{
                $contact_error['#contact_email_error']="Enter a valid email";
                $contact_error['clear']=false;
            }
        }
        else{
            $contact_error['#contact_email_error']="Email cannot be empty";
            $contact_error['clear']=false;
        }
    }

    //message validation
    if(isset($_POST['message']))
    {
        if(!empty(trim($_POST['message'])))
        {
            $contact_error['#message_error']="";
            $message=$_POST['message']; 
        }
        else
        {
            $contact_error['#message_error']="Fill your message";
            $contact_error['clear']=false;
        }
    }

    echo json_encode($contact_error);

?>