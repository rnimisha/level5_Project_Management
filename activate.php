<?php
    include_once('connection.php');
    
    if(isset($_GET['token']) && isset($_GET['role']) && strtolower($_GET['role'])=='c')
    {
        $token=$_GET['token'];
        $query="UPDATE mart_user SET active_status='A' where upper(token)=upper('$token')";
        $parsedQuery=oci_parse($connection,$query);

        if(oci_execute($parsedQuery)){
            echo "sucess";
        }
        else{
            echo "lol";
        }
        oci_free_statement($parsedQuery);
    }

    if(isset($_GET['token']) && isset($_GET['reason']) && isset($_GET['role']) && strtolower($_GET['role'])=='t')
    {
        $token=$_GET['token'];
        $reason=$_GET['reason'];
        //extract user id of the trader
        $getUser= "SELECT * from mart_user where upper(token)=upper('$token')";
        $parsedGetUser = oci_parse($connection, $getUser);
        oci_execute($parsedGetUser);
        while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
            $user_id= $row['USER_ID'];
            $email= $row['EMAIL'];
            $fullnames=$row['NAME'];
        }
        oci_free_statement($parsedGetUser);

        //extract shop info
        $getShop= "SELECT * from shop where user_id=$user_id";
        $parsedGetShop = oci_parse($connection, $getShop);
        oci_execute($parsedGetShop);
        while (($row = oci_fetch_assoc($parsedGetShop)) != false) {
            $shopname= $row['SHOP_NAME'];
            $register_no= $row['REGISTATION_ID'];
            $register_date=$row['RESGISTERED_DATE'];
        }
        oci_free_statement($parsedGetShop);

        // $shopQuery="UPDATE shop SET active_status='A' WHERE USER_ID=$user_id";
        // $parsedQuery2=oci_parse($connection,$shopQuery);

        if(!empty($email))
        {
            $to='phoenixmart123@gmail.com';
            $subject="New Trader Request";
            $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

            // $body="Hi $name, \n Click here to activate  http://localhost/project_management/level5_project_management/activate.php?token=$token ";
            $body="
            <html>
            <head>
                <title>Trader Registration Request</title>
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
                        $image <br/>
                         A new registration request from trader <b>$fullnames </b>has arrived!
                        Trader details are provided below <br> 
                        <br> 

                        <table style='width:80%;  border-collapse: collapse;'>
                           <tr style='border: 1px solid; background-color: #dabeae; '>
                               <th style='border: 1px solid;'> Email</th>
                               <th style='border: 1px solid;'> Shop Name</th>
                               <th style='border: 1px solid;'> Registration No</th>
                               <th style='border: 1px solid;'> Registration Date</th>
                           </tr>
                           <tr style='border: 1px solid; text-align: center;'>
                                <td style='border: 1px solid;'>
                                    $email
                                </td>
                                <td style='border: 1px solid;'>
                                    $shopname
                                </td>
                                <td style='border: 1px solid;'>
                                    $register_no
                                </td>
                                <td style='border: 1px solid;'>
                                    $register_date
                                </td>
                           </tr>
                        </table>
                        <br> 
                        <table style='width:80%;  border-collapse: collapse;'>
                            <tr  style='border: 1px solid; background-color: #dabeae; '>
                                <th>
                                    Trader's Message
                                </th>
                            </tr>
                            <tr  style='border: 1px solid; padding-left: 10px;'>
                                <td>
                                    $reason
                                </td>
                            </tr>
                        </table>
                            <br> <b>Click button  to activate trader $fullnames.</b> <br><br><a href= 'http://localhost/project_management/level5_project_management/activateTrader.php?userid=$user_id'><button style='background-color: #a4bfa7;border: none;
                        color: #ffffff;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
                        font-size: 16px;
                        border-radius: 25px;'>Activate</button></a>
                        <br><br><br>  
                        <hr style='border: 0.7px solid grey; width:80%;'>
                        <span style='color:grey';>Thank You</span>
                    </center>
                </div>
            </body>
            </html>";
            // $headers="From: phoenixmart123@gmail.com";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            if(mail($to, $subject, $body, $headers))
            {
                echo "<html>
                <head>
                    <title>Success</title>
                    <style>
                        th, td {
                          padding: 10px;
                          border-color: grey;
                        }
                    </style>
                </head>
                <body>
                    <div style=' width:80%; margin:10%; padding: 20px;'>
                        <center>
                            <img src='image/successpic.gif'/>
                            <p><b>Email Validation Successfull!</b></p>
                            Please wait for account confirmation and activation from company.
                        </center>
                    </div>
                </body>
                </html>";
            }
            else{
                echo "some error during verification";
            }
        }
        else{
            echo "Some errors";
        }
    }

    if(isset($_GET['email']) && isset($_GET['userid']) && isset($_GET['type']))
    {
        $email=$_GET['email'];
        $userid=$_GET['userid'];
        $query="UPDATE MART_USER SET EMAIL='$email' where USER_ID=$userid";
        $parsedQuery=oci_parse($connection,$query);

        if(oci_execute($parsedQuery)){
            echo "<html>
            <head>
                <title>Success</title>
                <style>
                    th, td {
                      padding: 10px;
                      border-color: grey;
                    }
                </style>
            </head>
            <body>
                <div style=' width:80%; margin:10%; padding: 20px;'>
                    <center>
                        <img src='image/successpic.gif'/>
                        <p><b>Email Validation Successfull!</b></p>
                    </center>
                </div>
            </body>
            </html>";
        }
        else{
            echo "lol";
        }
        oci_free_statement($parsedQuery);
    }
?>