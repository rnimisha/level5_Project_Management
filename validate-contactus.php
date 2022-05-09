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
                $contact_error['#firstname']='is-invalid';
            }
            else{
                $contact_error['#firstname_error']="";
                $firstname= $_POST['firstname'];
                $contact_error['#firstname']='valid';
                
            }
        }
        else{
            $contact_error['#firstname_error']="Name cannot be empty";
            $contact_error['clear']=false;
            $contact_error['#firstname']='is-invalid';
        }
    }

    if(isset($_POST['lastname']))
    {
        //name validation
        if(!empty(trim($_POST['lastname'])))
        {
            $contact_error['#lastname_error']="";
            $lastname= $_POST['lastname'];
            $contact_error['#lastname']='valid';
        }
        else{
            $contact_error['#lastname_error']="Last Name cannot be empty";
            $contact_error['clear']=false;
            $contact_error['#lastname']='is-invalid';
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
                    $contact_error['#contact']='valid';
                }
                else
                {
                    $contact_error['#contact_error']="Contact can't be less than 10 digits";
                    $contact_error['clear']=false;
                    $contact_error['#contact']='is-invalid';
                }
            }
            else
            {
                $contact_error['#contact_error']="Enter valid digits";
                $contact_error['clear']=false;
                $contact_error['#contact']='is-invalid';
            }

        }
        else{
            $contact_error['#contact_error']="Contact cannot be empty";
            $contact_error['clear']=false;
            $contact_error['#contact']='is-invalid';
        }
    }

    //email validation
    if(isset($_POST['useremail'])){
        if(!empty(trim($_POST['useremail']))){
            if(filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL)){
                $contact_error['#contact_email_error']="";
                $email=$_POST['useremail'];  
                $contact_error['#useremail']='valid'; 
            }
            else{
                $contact_error['#contact_email_error']="Enter a valid email";
                $contact_error['clear']=false;
                $contact_error['#useremail']='is-invalid';
            }
        }
        else{
            $contact_error['#contact_email_error']="Email cannot be empty";
            $contact_error['clear']=false;
            $contact_error['#useremail']='is-invalid';
        }
    }

    //message validation
    if(isset($_POST['message']))
    {
        if(!empty(trim($_POST['message'])))
        {
            $contact_error['#message_error']="";
            $message=$_POST['message']; 
            $contact_error['#message']='valid';
        }
        else
        {
            $contact_error['#message_error']="Fill your message";
            $contact_error['clear']=false;
            $contact_error['#message']='is-invalid';
        }
    }

    if(!isset($_POST['contactform']) && !isset($_POST['submitform']))
    {
        $contact_error['clear']=false;
    }
    else{
        if($contact_error['clear']==true &&  $_POST['contactform']=='yes' && $_POST['submitform']=='yes')
        {
            $to='phoenixmart123@gmail.com';
            $subject="Customer Message";
            $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

            $body="
            <html>
            <head>
                <title>Customer query</title>
                <style>
                    th, td {
                      padding: 10px;
                      border-color: grey;
                    }
                </style>
            </head>
            <body>
                <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                    <center>
                        $image<br> 
                         Hello! <br> A message from $firstname has arrived.  <br><br>
                         <table style='width:50%;  border-collapse: collapse;'>
                            <tr  style='border: 1px solid; background-color: #bacebc; '>
                                <th>
                                    Message
                                </th>
                            </tr>
                            <tr  style='border: 1px solid; padding-left: 10px;'>
                                <td>
                                    $message
                                </td>
                            </tr>
                       </table>
                       <br>
                       User Details
                         <table style='width:50%;  border-collapse: collapse;'>
                            <tr style='border: 1px solid; background-color: #bacebc; '>
                                <th style='border: 1px solid;'> Email</th>
                                <th style='border: 1px solid;'> Contact</th>
                            </tr>
                            <tr style='border: 1px solid; text-align: center;'>
                                 <td style='border: 1px solid;'>
                                     $email
                                 </td>
                                 <td style='border: 1px solid;'>
                                     $contact
                                 </td>
                            </tr>
                         </table>
                         <br> 
                        <br><br>
                        <hr style='border: 0.7px solid grey; width:80%;'>
                        <span style='color:grey';>Thank you.</span>
                    </center>
                </div>
            </body>
            </html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            if(mail($to, $subject, $body, $headers))
            {
                $contact_error['clear']=true;
            }
            else{
                $contact_error['clear']=false;
            }
        }
    }
    echo json_encode($contact_error);

?>