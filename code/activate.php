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

            // $body="Hi $name, \n Click here to activate  http://localhost/project_management/level5_project_management/code/activate.php?token=$token ";
            $body="
            <html>
            <head>
                <title>Trader Registration Request</title>
            </head>
            <body>
                <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                    <center>
                        $image <br/>
                         A new registration request from trader <b>$fullnames </b>has arrived!
                        Trader details are provided below <br> 
                        Email : $email<br> 
                        Shop Name : $shopname <br> 
                        Shop Registration date : $register_date<br> 
                        PAN : $register_no <br> 
                        Trader's Message : $reason <br> 
                            <br> <b>Click button  to activate trader $fullnames.</b> <br><br><a href= 'http://localhost/project_management/level5_project_management/code/activateTrader.php?userid=$user_id'><button style='background-color: #4CAF50;border: none;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
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
                echo "doneeee";
            }
            else{
                echo "looooollll";
            }
        }
        else{
            echo "lol again";
        }
    }
    else{
        echo 'hhhhh';
    }
?>