<?php
    include_once('connection.php');

    $l_error=array();
    $l_error['clear']=true;
    
    //email validation
    if(isset($_POST['l_useremail'])){
        if(!empty(trim($_POST['l_useremail']))){
            if(filter_var($_POST['l_useremail'], FILTER_VALIDATE_EMAIL)){

                $l_useremail=$_POST['l_useremail'];
                // // $checkQuery="SELECT * FROM `mart_user` WHERE email='$l_useremail'";
                $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM mart_user WHERE upper(email)=upper(:email) AND upper(ACTIVE_STATUS)='A'";
                $result=oci_parse($connection,$checkQuery);

                oci_bind_by_name($result, ":email", $l_useremail);
                oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                oci_execute($result);
                oci_fetch($result);
                if($number_of_rows<=0){
                    $l_error['#l_email_error']="Email not registered yet";
                    $l_error['clear']=false;
                    oci_free_statement($result); 
                }
                else{
                    $l_error['#l_email_error']="";
                    $email=$_POST['l_useremail'];
                   
                }
                  
            }
            else{
                $l_error['#l_email_error']="Enter a valid email";
                $l_error['clear']=false;
            }

        }
        else{
            $l_error['#l_email_error']="Email cannot be empty";
            $l_error['clear']=false;
        }

            //password validation
        if(isset($_POST['l_pword'])){
            if(!empty(trim($_POST['l_pword'])))
            {
                $encrypted=md5($_POST['l_pword']);
                $checkQuery2="SELECT COUNT(*) AS NUMBER_OF_ROWS  FROM mart_user WHERE upper(email)=upper(:email) AND upper(PASSWORD)=upper(:pass) AND upper(USER_ROLE)<>'A' AND upper(ACTIVE_STATUS)='A'";
                $result2=oci_parse($connection,$checkQuery2);

                oci_bind_by_name($result2, ":email", $l_useremail);
                oci_bind_by_name($result2, ":pass", $encrypted);
                oci_define_by_name($result2, 'NUMBER_OF_ROWS', $number_of_rows2);
                oci_execute($result2);
                oci_fetch($result2);
                if($number_of_rows2<=0){
                    $l_error['#l_pass_error']="Password does not match";
                    $l_error['clear']=false;
                    oci_free_statement($result2); 
                }
                else{
                    $getUserRole= "SELECT * from mart_user WHERE upper(email)=upper(:email) AND upper(PASSWORD)=upper(:pass) AND upper(USER_ROLE)<>'A'";
                    $parsedGetUser = oci_parse($connection, $getUserRole);

                    oci_bind_by_name($parsedGetUser, ":email", $l_useremail);
                    oci_bind_by_name($parsedGetUser, ":pass", $encrypted);

                    if(oci_execute($parsedGetUser))
                    {
                        while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
                            $user_id= $row['USER_ID'];
                            $user_role= $row['USER_ROLE'];
                        }
                        oci_free_statement($parsedGetUser);
                        $l_error['#l_pass_error']="";
                        $pass=$_POST['l_pword'];
                    }
                    else
                    {
                        $l_error['clear']=false;
                    }
                }
            }
            else
            {
                $l_error['#l_pass_error']="Password cannot be empty";
                $l_error['clear']=false;
            }
        }
    }

   
    if($l_error['clear']==true && isset($_POST['loginuser']))
    {
        $_SESSION['phoenix_user']=$email;
        if(strtoupper($user_role)=='C')
        {
            $l_error['role']='C';
        }
        elseif (strtoupper($user_role)=='T')
        {
            $l_error['role']='T';
        }
        echo json_encode($l_error);
    }
    else
    {
        // //response
        echo json_encode($l_error);
    }

    // echo json_encode($l_error);

?>