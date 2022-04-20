<?php
    include_once('../connection.php');

    $edit_trader_error=array();
    $edit_trader_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='personal-form' && isset($_POST['trader_id']))
    {
        $trader_id=$_POST['trader_id'];
        // validation
        if(isset($_POST['fullname']))
        {
            //name validation
            if(!empty(trim($_POST['fullname'])))
            {
                if(strlen($_POST['fullname']) < 4)
                {
                    $edit_trader_error['#error-trad-fullname']="Please enter a valid name.";
                    $edit_trader_error['clear']=false;
                    $edit_trader_error['#trad-fullname']='is-invalid';
                }
                else{
                    $edit_trader_error['#error-trad-fullname']="";
                    $fullnames= $_POST['fullname'];
                    $edit_trader_error['#trad-fullname']='valid';
                }
            }
            else{
                $edit_trader_error['#error-trad-fullname']="Name is required.";
                $edit_trader_error['clear']=false;
                $edit_trader_error['#trad-fullname']='is-invalid';
            }
        }

        //email validation
        if(isset($_POST['traderemail'])){
            if(!empty(trim($_POST['traderemail']))){
                if(filter_var($_POST['traderemail'], FILTER_VALIDATE_EMAIL)){

                    $traderemail=$_POST['traderemail'];
                    $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM mart_user WHERE upper(email)=upper(:email)";
                    $result=oci_parse($connection,$checkQuery);

                    $rows=oci_bind_by_name($result, ":email", $traderemail);
                    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                    oci_execute($result);
                    oci_fetch($result);
                    oci_free_statement($result); 
                    if($number_of_rows>0){
                        $getEmail= "SELECT * from mart_user where USER_ID=$trader_id";
                        $edit_trader_error['q']=$getEmail;
                        $parsedGetEmail = oci_parse($connection, $getEmail);
                        oci_execute($parsedGetEmail);
                        while (($row = oci_fetch_assoc($parsedGetEmail)) != false) {
                            $email= $row['EMAIL'];
                        }
                        if(strtoupper($email) == strtoupper($traderemail))
                        {
                            $edit_trader_error['#error-trad-email']="";
                            $email=$_POST['traderemail'];
                            $edit_trader_error['#trad-email']='valid';
                        }
                        else{
                            $edit_trader_error['#error-trad-email']="Email already registered.";
                            $edit_trader_error['clear']=false;
                            $edit_trader_error['#trad-email']='is-invalid';
                        }
                        oci_free_statement($parsedGetEmail); 
                    }
                    else{
                        $edit_trader_error['#error-trad-email']="";
                        $email=$_POST['traderemail'];
                        $edit_trader_error['#trad-email']='valid';
                    }
                }
                else{
                    $edit_trader_error['#error-trad-email']="Please enter a valid email.";
                    $edit_trader_error['clear']=false;
                    $edit_trader_error['#trad-email']='is-invalid';
                }

            }
            else{
                $edit_trader_error['#error-trad-email']="Email is required.";
                $edit_trader_error['clear']=false;
                $edit_trader_error['#trad-email']='is-invalid';
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
                            $getContact= "SELECT * from mart_user where USER_ID=$trader_id";
                            $parsedGetContact = oci_parse($connection, $getContact);
                            oci_execute($parsedGetContact);
                            while (($row = oci_fetch_assoc( $parsedGetContact)) != false) {
                                $contact= $row['CONTACT'];
                            }
                            if($contact == $t_usercontact)
                            {
                                $edit_trader_error['#error-trad-contact']="";
                                $contact=$_POST['contact'];
                                $edit_trader_error['#trad-contact']='valid';
                            }
                            else{
                                $edit_trader_error['#error-trad-contact']="Contact already registered.";
                                $edit_trader_error['clear']=false;
                                $edit_trader_error['#trad-contact']='is-invalid';
                            }
                            oci_free_statement($parsedGetContact); 
                        }
                        else{
                            $edit_trader_error['#error-trad-contact']="";
                            $contact=$_POST['contact'];
                            $edit_trader_error['#trad-contact']='valid';
                        
                        }
                    }
                    else
                    {
                        $edit_trader_error['#error-trad-contact']="Contact can't be less than 10 digits.";
                        $edit_trader_error['clear']=false;
                        $edit_trader_error['#trad-contact']='is-invalid';
                    }
                }
                else
                {
                        $edit_trader_error['#error-trad-contact']="Please enter valid digits.";
                        $edit_trader_error['clear']=false;
                        $edit_trader_error['#trad-contact']='is-invalid';
                }

            }
            else{
                $edit_trader_error['#error-trad-contact']="Contact is required.";
                $edit_trader_error['clear']=false;
                $edit_trader_error['#trad-contact']='is-invalid';
            }
        }

        //dob validation
        if(isset($_POST['dob'])){
            if(!empty($_POST['dob']))
            {
                $edit_trader_error['#error-trad-dob']="";
                $t_dob=date("d-m-Y", strtotime($_POST['dob']));
                $edit_trader_error['#trad-dob']='valid';
                
            }
            else{
                $edit_trader_error['#error-trad-dob']="DOB is required.";
                $edit_trader_error['clear']=false;
                $edit_trader_error['#trad-dob']='is-invalid';
            }
        }

        //address validation
        if(isset($_POST['address'])){
            if(!empty($_POST['address']))
            {
                if(strlen($_POST['address']) < 4)
                {
                    $edit_trader_error['#error-trad-address']="Please enter a valid address.";
                    $edit_trader_error['clear']=false;
                    $edit_trader_error['#trad-address']='is-invalid';
                }
                else{
                    $edit_trader_error['#error-trad-address']="";
                    $address=$_POST['address'];
                    $edit_trader_error['#trad-address']='valid';
                }

            }
            else{
                $edit_trader_error['#error-trad-address']="Address is required.";
                $edit_trader_error['clear']=false;
                $edit_trader_error['#trad-address']='is-invalid';
            }
        }

        //updating to database
        if($edit_trader_error['clear']==true)
        {
            $updateQuery="UPDATE MART_USER SET NAME=:fullname, EMAIL=:email, CONTACT=:contact, ADDRESS=:addr, DOB=to_date(:dob,'DD/MM/YYYY') WHERE USER_ID=:trader_id";
            $parsedQuery=oci_parse($connection, $updateQuery);

            oci_bind_by_name($parsedQuery, ":fullname", $fullnames);
            oci_bind_by_name($parsedQuery, ":email", $email);
            oci_bind_by_name($parsedQuery, ":contact", $contact);
            oci_bind_by_name($parsedQuery, ":addr", $address);
            oci_bind_by_name($parsedQuery, ":dob", $t_dob);
            oci_bind_by_name($parsedQuery, ":trader_id", $trader_id);

            // $edit_trader_error['query']=$updateQuery;
            oci_execute($parsedQuery);
            oci_free_statement($parsedQuery);
        }

        // $edit_trader_error['id']=$trader_id;
        echo json_encode($edit_trader_error);
    }

    //validate password update
    $edit_pass_error=array();
    $edit_pass_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='pass-form' && isset($_POST['trader_id']))
    {
        //check old password
        $trader_id=$_POST['trader_id'];
        if(isset($_POST['old_pass']))
        {
            if(!empty(trim($_POST['old_pass'])))
            {
                $pass=trim(md5($_POST['old_pass']));
                $getPass= "SELECT * from mart_user where USER_ID=$trader_id";
                $parsedGetPass = oci_parse($connection, $getPass);
                // $edit_pass_error['query']=$getPass;
                oci_execute($parsedGetPass);
                while (($row = oci_fetch_assoc( $parsedGetPass)) != false) {
                    $actual_pass= trim($row['PASSWORD']);
                }
                if($actual_pass == $pass)
                {
                    $edit_pass_error['#error-trad-old-pass']="";
                    $edit_pass_error['#trad-old-pass']='valid';
                }
                else{
                    $edit_pass_error['#error-trad-old-pass']="Password incorrect.";
                    $edit_pass_error['clear']=false;
                    $edit_pass_error['#trad-old-pass']='is-invalid';
                }
            }
            else{
                $edit_pass_error['#error-trad-old-pass']="Old password is required.";
                $edit_pass_error['clear']=false;
                $edit_pass_error['#trad-old-pass']='is-invalid';
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
                    $edit_pass_error['#error-trad-new-pass']="";
                    $encrypted=md5($new_pass);
                    $edit_pass_error['#trad-new-pass']='valid';
                }
                else
                {
                    $edit_pass_error['#error-trad-new-pass']="Atleast 7 alphanumeric character consiting: <br/> Upper character </br> Lower character </br> Digit </br> Special char!";
                    $edit_pass_error['clear']=false;
                    $edit_pass_error['#trad-new-pass']='is-invalid';
                }
            }
            else{
                $edit_pass_error['#error-trad-new-pass']="Password is required.";
                $edit_pass_error['clear']=false;
                $edit_pass_error['#trad-new-pass']='is-invalid';
            }
        }
        //confirm password check
        if(isset($_POST['re_pass']))
        {
            if(!empty(trim($_POST['re_pass'])))
            {
                $re_pass=trim($_POST['re_pass']);
                if(isset( $_POST['new_pass']) )
                {
                    if( $_POST['re_pass'] == $_POST['new_pass'])
                    {
                        $edit_pass_error['#error-trad-re-pass']="";
                        $edit_pass_error['#trad-re-pass']='valid';
                    }
                    else
                    {
                        $edit_pass_error['#error-trad-re-pass']="Password does not match.";
                        $edit_pass_error['clear']=false;
                        $edit_pass_error['#trad-re-pass']='is-invalid';
                    }
                }
            }
            else{
                $edit_pass_error['#error-trad-re-pass']="Confirm your password.";
                $edit_pass_error['clear']=false;
                $edit_pass_error['#trad-re-pass']='is-invalid';
            }
        }

        //updating password to database
        if($edit_pass_error['clear']==true)
        {
            $updateQuery="UPDATE MART_USER SET PASSWORD=:pass WHERE USER_ID=:trader_id";
            $parsedQuery=oci_parse($connection, $updateQuery);

            oci_bind_by_name($parsedQuery, ":pass", $encrypted);
            oci_bind_by_name($parsedQuery, ":trader_id", $trader_id);

            oci_execute($parsedQuery);
            oci_free_statement($parsedQuery);
        }
        echo json_encode($edit_pass_error);
    }

    //validate profile picture
    $edit_pic_error=array();
    $edit_pic_error['clear']=true;
    if(isset($_FILES['trad-pic']['name']))
    {
        if(!empty($_FILES['trad-pic']['name']))
        {
            $filename=$_FILES['trad-pic']['name'];
            //extract extension only
            $extension=pathinfo($filename, PATHINFO_EXTENSION);

            $valid=array("jpg", "jpeg", "png", "gif");
            if(in_array($extension, $valid))
            {
                // avoid same name
                $new_name= rand().".".$extension;
                $destination="../image/profile/".$new_name;

                if(move_uploaded_file($_FILES['trad-pic']['tmp_name'], $destination))
                {
                    $edit_pic_error['error']="";
                    $trader_id=$_POST['trader-id-profile2'];
                    $edit_pic_error['pic_name']='..\\image\\profile\\'.$new_name;

                    $updateQuery="UPDATE MART_USER SET PROFILE_PIC=:pp WHERE USER_ID=:trader_id";
                    $parsedQuery=oci_parse($connection, $updateQuery);
        
                    oci_bind_by_name($parsedQuery, ":pp", $new_name);
                    oci_bind_by_name($parsedQuery, "trader_id", $trader_id);
        
                    oci_execute($parsedQuery);
                    oci_free_statement($parsedQuery);
                }
            }
            else{
                 $edit_pic_error['error']='Invalid file';
                 $edit_pic_error['clear']=false;
            }
        }  
        else{
            $edit_pic_error['error']='Upload image first';
            $edit_pic_error['clear']=false;
        }
        echo json_encode($edit_pic_error);
    }

    //validate delete picture
    if(isset($_POST['edit_type']) && ($_POST['edit_type'])=='delete_pic' )
    {
        $del_pic_error=array();
        $del_pic_error['clear']=false;
        $new_name='';

        
        if(isset($_POST['trader_id']) && !empty(($_POST['trader_id'])))
        {
            $trader_id=$_POST['trader_id'];
            
            $updateQuery="UPDATE MART_USER SET PROFILE_PIC=:pp WHERE USER_ID=:trader_id";
            $parsedQuery=oci_parse($connection, $updateQuery);

            oci_bind_by_name($parsedQuery, ":pp", $new_name);
            oci_bind_by_name($parsedQuery, ":trader_id", $trader_id);

           if( oci_execute($parsedQuery))
           {
            $del_pic_error['clear']=true;
            $del_pic_error['pic_name']='..\\image\\profile\\default_profile.jpg';
           }
            oci_free_statement($parsedQuery);
        }
        echo json_encode($del_pic_error);
    }
 
    
?>