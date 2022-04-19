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
                    $edit_trader_error['#error-trad-fullname']="Enter a valid name";
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
                $edit_trader_error['#error-trad-fullname']="Name cannot be empty";
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
                        $getEmail= "SELECT * from mart_user where upper(USER_ID)=upper($trader_id)";
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
                            $edit_trader_error['#error-trad-email']="Email already registered";
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
                    $edit_trader_error['#error-trad-email']="Enter a valid email";
                    $edit_trader_error['clear']=false;
                    $edit_trader_error['#trad-email']='is-invalid';
                }

            }
            else{
                $edit_trader_error['#error-trad-email']="Email cannot be empty";
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
                                $edit_trader_error['#error-trad-contact']="Contact already registered";
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
                        $edit_trader_error['#error-trad-contact']="contact can't be less than 10 digits";
                        $edit_trader_error['clear']=false;
                        $edit_trader_error['#trad-contact']='is-invalid';
                    }
                }
                else
                {
                        $edit_trader_error['#error-trad-contact']="Enter valid digits";
                        $edit_trader_error['clear']=false;
                        $edit_trader_error['#trad-contact']='is-invalid';
                }

            }
            else{
                $edit_trader_error['#error-trad-contact']="contact cannot be empty";
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
                $edit_trader_error['#error-trad-dob']="dob cannot be empty";
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
                    $edit_trader_error['#error-trad-address']="Enter a valid address";
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
                $edit_trader_error['#error-trad-address']="address cannot be empty";
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
            oci_bind_by_name($parsedQuery, "trader_id", $trader_id);

            $edit_trader_error['query']=$updateQuery;
            oci_execute($parsedQuery);
            oci_free_statement($parsedQuery);
        }

        // $edit_trader_error['id']=$trader_id;
        echo json_encode($edit_trader_error);
    }
?>