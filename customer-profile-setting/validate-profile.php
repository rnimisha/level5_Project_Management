<?php 
    include_once('../connection.php');
    //validate password update
    $pass_update=array();
    $pass_update['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='update-password-form' && isset($_POST['customer_id']))
    {
        //check old password
        $customer_id=$_POST['customer_id'];
        if(isset($_POST['old_pass']))
        {
            if(!empty(trim($_POST['old_pass'])))
            {
                $pass=trim(md5($_POST['old_pass']));
                $getPass= "SELECT * from mart_user where USER_ID=$customer_id";
                $parsedGetPass = oci_parse($connection, $getPass);
           
                oci_execute($parsedGetPass);
                while (($row = oci_fetch_assoc( $parsedGetPass)) != false) {
                    $actual_pass= trim($row['PASSWORD']);
                }
                if($actual_pass == $pass)
                {
                    $pass_update['#error-cust-old-pass']="";
                    $pass_update['#cust-old-pass']='valid';
                }
                else{
                    $pass_update['#error-cust-old-pass']="Password incorrect.";
                    $pass_update['clear']=false;
                    $pass_update['#cust-old-pass']='is-invalid';
                }
            }
            else{
                $pass_update['#error-cust-old-pass']="Old password is required.";
                $pass_update['clear']=false;
                $pass_update['#cust-old-pass']='is-invalid';
            }
        }
        //check new password
        if(isset($_POST['new_pass']))
        {
            if(!empty(trim($_POST['new_pass'])))
            {
                $new_pass=trim($_POST['new_pass']);
                $pattern='/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&_])[a-zA-Z0-9@$!%*?&_]{7,}$/';
                if(preg_match($pattern,$new_pass))
                {
                    $pass_update['#error-cust-new-pass']="";
                    $encrypted=md5($new_pass);
                    $pass_update['#cust-new-pass']='valid';
                }
                else
                {
                    $pass_update['#error-cust-new-pass']="Atleast 7 alphanumeric character consiting: <br/> Upper character </br> Lower character </br> Digit </br> Special char!";
                    $pass_update['clear']=false;
                    $pass_update['#cust-new-pass']='is-invalid';
                }
            }
            else{
                $pass_update['#error-cust-new-pass']="Password is required.";
                $pass_update['clear']=false;
                $pass_update['#cust-new-pass']='is-invalid';
            }
        }
        //confirm password check
        if(isset($_POST['re_pass']))
        {
            if(!empty(trim($_POST['re_pass'])))
            {
                $re_pass=trim($_POST['re_pass']);
                if(isset( $_POST['new_pass']) && !empty( $_POST['new_pass']))
                {
                    if( $_POST['re_pass'] == $_POST['new_pass'])
                    {
                        $pass_update['#error-cust-re-pass']="";
                        $pass_update['#cust-re-pass']='valid';
                    }
                    else
                    {
                        $pass_update['#error-cust-re-pass']="Password does not match.";
                        $pass_update['clear']=false;
                        $pass_update['#cust-re-pass']='is-invalid';
                    }
                }
            }
            else{
                $pass_update['#error-cust-re-pass']="Confirm your password.";
                $pass_update['clear']=false;
                $pass_update['#cust-re-pass']='is-invalid';
            }
        }

        //updating password to database
        if($pass_update['clear']==true && ($_POST['run_query']=='t'))
        {
            $updateQuery="UPDATE MART_USER SET PASSWORD=:pass WHERE USER_ID=:custer_id";
            $parsedQuery=oci_parse($connection, $updateQuery);

            oci_bind_by_name($parsedQuery, ":pass", $encrypted);
            oci_bind_by_name($parsedQuery, ":custer_id", $customer_id);

            oci_execute($parsedQuery);
            oci_free_statement($parsedQuery);
        }
        echo json_encode($pass_update);
    }


    $edit_cust_error=array();
    $edit_cust_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='cust-personal-form' && isset($_POST['customer_id']))
    {
        $customer_id=$_POST['customer_id'];
        // validation
        if(isset($_POST['fullname']))
        {
            //name validation
            if(!empty(trim($_POST['fullname'])))
            {
                if(strlen($_POST['fullname']) < 4)
                {
                    $edit_cust_error['#error-cust-fullname']="Please enter a valid name.";
                    $edit_cust_error['clear']=false;
                    $edit_cust_error['#cust-fullname']='is-invalid';
                }
                else{
                    $edit_cust_error['#error-cust-fullname']="";
                    $fullnames= $_POST['fullname'];
                    $edit_cust_error['#cust-fullname']='valid';
                }
            }
            else{
                $edit_cust_error['#error-cust-fullname']="Name is required.";
                $edit_cust_error['clear']=false;
                $edit_cust_error['#cust-fullname']='is-invalid';
            }
        }

        //email validation
        if(isset($_POST['customeremail'])){
            if(!empty(trim($_POST['customeremail']))){
                if(filter_var($_POST['customeremail'], FILTER_VALIDATE_EMAIL)){

                    $customeremail=$_POST['customeremail'];
                    $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM mart_user WHERE upper(email)=upper(:email)";
                    $result=oci_parse($connection,$checkQuery);

                    $rows=oci_bind_by_name($result, ":email", $customeremail);
                    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                    oci_execute($result);
                    oci_fetch($result);
                    oci_free_statement($result); 
                    if($number_of_rows>0){
                        $getEmail= "SELECT * from mart_user where USER_ID=$customer_id";
                
                        $parsedGetEmail = oci_parse($connection, $getEmail);
                        oci_execute($parsedGetEmail);
                        while (($row = oci_fetch_assoc($parsedGetEmail)) != false) {
                            $email= $row['EMAIL'];
                        }
                        if(strtoupper($email) == strtoupper($customeremail))
                        {
                            $email_changed=false;
                            $edit_cust_error['#error-cust-email']="";
                            $email=$_POST['customeremail'];
                            $edit_cust_error['#cust-email']='valid';
                        }
                        else{
                            $edit_cust_error['#error-cust-email']="Email already registered.";
                            $edit_cust_error['clear']=false;
                            $edit_cust_error['#cust-email']='is-invalid';
                        }
                        oci_free_statement($parsedGetEmail); 
                    }
                    else{
                        $email_changed=true;
                        $edit_cust_error['#error-cust-email']="";
                        $email=$_POST['customeremail'];
                        $edit_cust_error['#cust-email']='valid';
                    }
                }
                else{
                    $edit_cust_error['#error-cust-email']="Please enter a valid email.";
                    $edit_cust_error['clear']=false;
                    $edit_cust_error['#cust-email']='is-invalid';
                }

            }
            else{
                $edit_cust_error['#error-cust-email']="Email is required.";
                $edit_cust_error['clear']=false;
                $edit_cust_error['#cust-email']='is-invalid';
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
                        $t_usercontact=$_POST['contact'];
                        $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM mart_user WHERE upper(contact)=upper(:contact)";
                        $result=oci_parse($connection,$checkQuery);
    
                        $rows=oci_bind_by_name($result, ":contact", $t_usercontact);
                        oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                        oci_execute($result);
                        oci_fetch($result);
                        oci_free_statement($result); 
                        if($number_of_rows>0){
                            $getContact= "SELECT * from mart_user where USER_ID=$customer_id";
                            $parsedGetContact = oci_parse($connection, $getContact);
                            oci_execute($parsedGetContact);
                            while (($row = oci_fetch_assoc( $parsedGetContact)) != false) {
                                $contact= $row['CONTACT'];
                            }
                            if($contact == $t_usercontact)
                            {
                                $edit_cust_error['#error-cust-contact']="";
                                $contact=$_POST['contact'];
                                $edit_cust_error['#cust-contact']='valid';
                            }
                            else{
                                $edit_cust_error['#error-cust-contact']="Contact already registered.";
                                $edit_cust_error['clear']=false;
                                $edit_cust_error['#cust-contact']='is-invalid';
                            }
                            oci_free_statement($parsedGetContact); 
                        }
                        else{
                            $edit_cust_error['#error-cust-contact']="";
                            $contact=$_POST['contact'];
                            $edit_cust_error['#cust-contact']='valid';
                        
                        }
                    }
                    else
                    {
                        $edit_cust_error['#error-cust-contact']="Contact can't be less than 10 digits.";
                        $edit_cust_error['clear']=false;
                        $edit_cust_error['#cust-contact']='is-invalid';
                    }
                }
                else
                {
                        $edit_cust_error['#error-cust-contact']="Please enter valid digits.";
                        $edit_cust_error['clear']=false;
                        $edit_cust_error['#cust-contact']='is-invalid';
                }

            }
            else{
                $edit_cust_error['#error-cust-contact']="Contact is required.";
                $edit_cust_error['clear']=false;
                $edit_cust_error['#cust-contact']='is-invalid';
            }
        }

        //dob validation
        if(isset($_POST['dob'])){
            if(!empty($_POST['dob']))
            {
                $edit_cust_error['#error-cust-dob']="";
                $t_dob=date("d-m-Y", strtotime($_POST['dob']));
                $edit_cust_error['#cust-dob']='valid';
                
            }
            else{
                $edit_cust_error['#error-cust-dob']="DOB is required.";
                $edit_cust_error['clear']=false;
                $edit_cust_error['#cust-dob']='is-invalid';
            }
        }

        //address validation
        if(isset($_POST['address'])){
            if(!empty($_POST['address']))
            {
                if(strlen($_POST['address']) < 4)
                {
                    $edit_cust_error['#error-cust-address']="Please enter a valid address.";
                    $edit_cust_error['clear']=false;
                    $edit_cust_error['#cust-address']='is-invalid';
                }
                else{
                    $edit_cust_error['#error-cust-address']="";
                    $address=$_POST['address'];
                    $edit_cust_error['#cust-address']='valid';
                }

            }
            else{
                $edit_cust_error['#error-cust-address']="Address is required.";
                $edit_cust_error['clear']=false;
                $edit_cust_error['#cust-address']='is-invalid';
            }
        }
     
        //updating to database
        if(($edit_cust_error['clear']==true) && ($_POST['run_query']=='t'))
        {
            $edit_cust_error['d']=$_POST['run_query'];
            if($email_changed==false)
            {
                $updateQuery="UPDATE MART_USER SET NAME=:fullname, CONTACT=:contact, ADDRESS=:addr, DOB=to_date(:dob,'DD/MM/YYYY') WHERE USER_ID=:custer_id";
                $parsedQuery=oci_parse($connection, $updateQuery);

                oci_bind_by_name($parsedQuery, ":fullname", $fullnames);
                oci_bind_by_name($parsedQuery, ":contact", $contact);
                oci_bind_by_name($parsedQuery, ":addr", $address);
                oci_bind_by_name($parsedQuery, ":dob", $t_dob);
                oci_bind_by_name($parsedQuery, ":custer_id", $customer_id);

                // $edit_cust_error['query']=$updateQuery;
                oci_execute($parsedQuery);
                oci_free_statement($parsedQuery);
                $edit_cust_error['emailchange']=false;

            }

            //email change requires validation
            if($email_changed==true)
            {
                $updateQuery="UPDATE MART_USER SET NAME=:fullname, CONTACT=:contact, ADDRESS=:addr, DOB=to_date(:dob,'DD/MM/YYYY') WHERE USER_ID=:custer_id";
                $parsedQuery=oci_parse($connection, $updateQuery);

                oci_bind_by_name($parsedQuery, ":fullname", $fullnames);
                oci_bind_by_name($parsedQuery, ":contact", $contact);
                oci_bind_by_name($parsedQuery, ":addr", $address);
                oci_bind_by_name($parsedQuery, ":dob", $t_dob);
                oci_bind_by_name($parsedQuery, ":custer_id", $customer_id);

                // $edit_cust_error['query']=$updateQuery;
                if(oci_execute($parsedQuery))
                {
                    $to=$email;
                    $subject="Verify Your New Details";
                    $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

                    $body="
                    <html>
                    <head>
                        <title>Verify Details Change</title>
                    </head>
                    <body>
                        <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                            <center>
                                $image 
                                <h2> Hi $fullnames,</h2> <br> <b>Welcome to Phoenix Mart</b>.  <br> Click button to verify new email address. <br><br><a href= 'http://localhost/project_management/level5_project_management/activate.php?email=$email&userid=$customer_id&type=emailchange'><button style='background-color: #a4bfa7;border: none;
                                color: white;
                                padding: 15px 32px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 16px;
                                border-radius: 25px;'>Activate</button></a>
                                <br><br><br>  
                                <hr style='border: 0.7px solid grey; width:80%;'>
                                <span style='color:grey';>Please ignore if you did not use this email in Phoenix Mart.</span>
                            </center>
                        </div>
                    </body>
                    </html>";
                
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    if(mail($to, $subject, $body, $headers))
                    {
                        $edit_cust_error['clear']=true;
                        $edit_cust_error['emailchange']=true;
                    }
                    else{
                        $edit_cust_errorr['clear']=false;
                    }
                }
                oci_free_statement($parsedQuery);

            }
            
        }
        echo json_encode($edit_cust_error);
    }

    //validate profile picture
    $change_profile_pic=array();
    $change_profile_pic['clear']=true;
    if(isset($_FILES['new-profile-pic']['name']))
    {
        if(!empty($_FILES['new-profile-pic']['name']))
        {
            $filename=$_FILES['new-profile-pic']['name'];
            $extension=pathinfo($filename, PATHINFO_EXTENSION);

            $valid=array("jpg", "jpeg", "png", "gif");
            if(in_array($extension, $valid))
            {
                $new_name= rand().".".$extension;
                $destination="../image/profile/".$new_name;

                if(move_uploaded_file($_FILES['new-profile-pic']['tmp_name'], $destination))
                {
                    $change_profile_pic['error']="";
                    $cust_id=$_POST['c_id'];
                    $change_profile_pic['pic_name']='..\\image\\profile\\'.$new_name;

                    $updateQuery="UPDATE MART_USER SET PROFILE_PIC=:pp WHERE USER_ID=:cust_id";
                    $parsedQuery=oci_parse($connection, $updateQuery);
        
                    oci_bind_by_name($parsedQuery, ":pp", $new_name);
                    oci_bind_by_name($parsedQuery, "cust_id", $cust_id);
        
                    oci_execute($parsedQuery);
                    oci_free_statement($parsedQuery);
                }
            }
            else{
                 $change_profile_pic['error']='Invalid file';
                 $change_profile_pic['clear']=false;
            }
        }  
        else{
            $change_profile_pic['error']='Upload image first';
            $change_profile_pic['clear']=false;
        }
        echo json_encode($change_profile_pic);
    }


    $track_order=array();
    $track_order['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='track-order-form' && isset($_POST['cust_id']))
    {
        if(isset($_POST['order_id']))
        {
            if(!empty($_POST['order_id']))
            {
                $user_id=$_POST['cust_id'];
                $order_id=$_POST['order_id'];
                $query="SELECT ORDER_STATUS FROM CUST_ORDER WHERE USER_ID=$user_id AND ORDER_ID=$order_id";
                $parsed=oci_parse($connection, $query);
                oci_execute($parsed);
                $count=0;
                while (($row = oci_fetch_assoc($parsed)) != false) 
                {
                    $count++;
                    $status=$row['ORDER_STATUS'];
                }
                // $track_order['cr']=$count;
                if($count==0)
                {
                    $track_order['#error-track-order-no']="Please provide your valid order number.";
                    $track_order['clear']=false;
                    $track_order['#track-order-no']='is-invalid';
                }
                else{
                    $track_order['#error-track-order-no']="";
                    $track_order['#track-order-no']='valid';
                    $track_order['status']=$status;
                }
            }
            else{
                $track_order['#error-track-order-no']="Enter your order number.";
                $track_order['clear']=false;
                $track_order['#track-order-no']='is-invalid';
            }

        }
        echo json_encode($track_order);
    }
?>