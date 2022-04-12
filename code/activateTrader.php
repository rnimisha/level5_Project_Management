<?php
    include_once('connection.php');
    
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
                $getUser= "SELECT * from mart_user where USER_ID=$uid";
                $parsedGetUser = oci_parse($connection, $getUser);
                oci_execute($parsedGetUser);
                while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
                    $email= $row['EMAIL'];
                    $fullnames=$row['NAME'];
                }
                oci_free_statement($parsedGetUser);

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
                            <h2> Congratulations $fullnames!</h2>  <br> You have been successfully registered as member of Phoenix Mart. You can start selling your product through us now.<br>  
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
                    echo "Done";
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
?>