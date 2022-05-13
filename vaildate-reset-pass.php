<?php
    include_once('connection.php');

    $error=array();
    $error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='forgot-pass')
    {
        if(isset($_POST['email']))
        {
            if(!empty(trim($_POST['email'])))
            {
                $email=$_POST['email'];
                $query="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM MART_USER WHERE EMAIL='$email'";
                $result=oci_parse($connection,$query);

                    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                    oci_execute($result);
                    oci_fetch($result);
                    if($number_of_rows<1){
                        $error['clear']=false;
                        $error['#forgot-pass-error']="Email is not registered";
                        $error['#forgot-email']='is-invalid';
                    }
                    else{
                        $error['#forgot-pass-error']="";
                        $error['#forgot-email']='valid';
                    }

            }
            else{
                $error['clear']=false;
                $error['#forgot-pass-error']="Enter your email first";
                $error['#forgot-email']='is-invalid';
            }
        }
        echo json_encode($error);
    }
?>