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

                        oci_free_statement($result);

                        $token=bin2hex(random_bytes(15));
                        $query="INSERT INTO RESET_PASSWORD VALUES('$email', '$token')";
                        $parsed2=oci_parse($connection, $query);
                        oci_execute($parsed2);
                        oci_free_statement($parsed2);
                        $to=$email;
                        $subject="Reset Password";
                        $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

                        $body="
                        <html>
                        <head>
                            <title>Reset Password</title>
                        </head>
                        <body>
                            <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                                <center>
                                    $image
                                    <h2> Hello,</h2> <br> <b>Password Reset Link has arrived</b>.  <br> Click button  to reset your password. <br><br><a href= 'http://localhost/project_management/level5_project_management/validate-reset-pass?token=$token&email=$email'><button style='background-color: #a4bfa7;border: none;
                                    color: white;
                                    padding: 15px 32px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                    border-radius: 25px;'>Reset</button></a>
                                    <br><br><br>  
                                    <hr style='border: 0.7px solid grey; width:80%;'>
                                    <span style='color:grey';>Please ignore if you did not request for a password updation.</span>
                                </center>
                            </div>
                        </body>
                        </html>";
                        // $headers="From: phoenixmart123@gmail.com";
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        if(mail($to, $subject, $body, $headers))
                        {
                            $error['clear']=true;
                        }
                        else{
                            $error['clear']=false;
                        }
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