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