<?php
    include_once('connection.php');
    include_once('function.php');
    
    if(isset($_GET['userid']))
    {
        $uid=$_GET['userid'];
        $query="UPDATE mart_user SET active_status='A' where USER_ID=$uid";
        $parsedQuery=oci_parse($connection,$query);

        if(oci_execute($parsedQuery)){
            oci_free_statement($parsedQuery);
            //update shop
            $shopQuery="UPDATE shop SET active_status='A' WHERE USER_ID=$uid";
            $parsedQuery2=oci_parse($connection,$shopQuery);
            if(oci_execute($parsedQuery2)){
                //extract email of the trader
                $email=getEmail($uid, $connection);
                //send update message to trader
                $to=$email;
                $subject="Registration Successfull";
                $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

                $body="
                <html>
                <head>
                    <title>Registration Successfull</title>
                </head>
                <body>
                    <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                        <center>
                            $image
                            <h2> Congratulations $email!</h2>  <br> You have been successfully registered as member of Phoenix Mart. <br/> You can start selling your product through us now.<br>  
                            <hr style='border: 0.7px solid grey; width:80%;'>
                            <span style='color:grey';>Thank you</span>
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
                        <title>Customer query</title>
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
                                <p><b>Activation success email sent to Trader!</b></p>
                            </center>
                        </div>
                    </body>
                    </html>";
                }
                else{
                    echo "looooollllll";
                }
            }
            else
            {
                echo "loooool";
            }
            oci_free_statement($parsedQuery2);
        }
        else{
            echo "lol";
        }
    }

    //activate shop added later
    if(isset($_GET['regid']) && isset($_GET['userid']))
    {
        if(!empty(trim($_GET['regid'])) && !empty(trim($_GET['userid'])))
        {
            $reg_id=$_GET['regid'];
            $userid=$_GET['userid'];
            $shopname=$_GET['name'];

            $shopQuery="UPDATE shop SET active_status='A' WHERE REGISTATION_ID='$reg_id' AND USER_ID=$userid";
            $parsedQuery=oci_parse($connection,$shopQuery);
            if(oci_execute($parsedQuery)){
                //extract email of the trader
                $email=getEmail($userid, $connection);

                //send update message to trader
                $to=$email;
                $subject="Registration Successfull";
                $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';
                $body="
                <html>
                <head>
                    <title>Registration Successfull</title>
                </head>
                <body>
                    <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                        <center>
                            $image
                            <h2> Congratulations $email!</h2>  <br> Your shop '$shopname' has been successfully added. <br/> You can start selling your product through new shop now.<br>  
                            <hr style='border: 0.7px solid grey; width:80%;'>
                            <span style='color:grey';>Thank you</span>
                        </center>
                    </div>
                </body>
                </html>";
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
                                <p><b>Shop addition success email sent to Trader!</b></p>
                            </center>
                        </div>
                    </body>
                    </html>";
                }
            } 
        }
    }
?>