<?php
    include_once('../connection.php');

    $edit_trader_error=array();
    $edit_trader_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='personal-form')
    {
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
                }
                else{
                    $edit_trader_error['#error-trad-fullname']="";
                    $fullnames= $_POST['fullname'];
                }
            }
            else{
                $edit_trader_error['#error-trad-fullname']="Name cannot be empty";
                $edit_trader_error['clear']=false;
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
                    if($number_of_rows>0){
                        $edit_trader_error['#error-trad-email']="Email already registered";
                        $edit_trader_error['clear']=false;
                        oci_free_statement($result); 
                    }
                    else{
                        $edit_trader_error['#error-trad-email']="";
                        $email=$_POST['traderemail'];
                    
                    }
                    
                }
                else{
                    $edit_trader_error['#error-trad-email']="Enter a valid email";
                    $edit_trader_error['clear']=false;
                }

            }
            else{
                $edit_trader_error['#error-trad-email']="Email cannot be empty";
                $edit_trader_error['clear']=false;
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
                        if($number_of_rows>0){
                            $edit_trader_error['#error-trad-contact']="Contact already registered";
                            $edit_trader_error['clear']=false;
                            oci_free_statement($result); 
                        }
                        else{
                            $edit_trader_error['#error-trad-contact']="";
                            $contact=$_POST['contact'];
                        
                        }
                    }
                    else
                    {
                        $edit_trader_error['#error-trad-contact']="contact can't be less than 10 digits";
                        $edit_trader_error['clear']=false;
                    }
                }
                else
                {
                        $edit_trader_error['#error-trad-contact']="Enter valid digits";
                        $edit_trader_error['clear']=false;
                }

            }
            else{
                $edit_trader_error['#error-trad-contact']="contact cannot be empty";
                $edit_trader_error['clear']=false;
            }
        }

        //t_dob validation
        if(isset($_POST['dob'])){
            if(!empty($_POST['t_dob']))
            {
                $edit_trader_error['#error-trad-dob']="";
                $t_dob=date("d-m-Y", strtotime($_POST['t_dob']));
                
            }
            else{
                $edit_trader_error['#error-trad-dob']="dob cannot be empty";
                $edit_trader_error['clear']=false;
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
                }
                else{
                    $edit_trader_error['#error-trad-address']="";
                    $address=$_POST['address'];
                }

            }
            else{
                $edit_trader_error['#error-trad-address']="address cannot be empty";
                $edit_trader_error['clear']=false;
            }
        }

       echo json_encode($edit_trader_error);
    }
?>