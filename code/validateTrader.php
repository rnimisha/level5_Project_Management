<?php
    include_once('connection.php');

    $trader_error=array();
    $trader_error['clear']=true;
    
    if(isset($_POST['validatetrader']) && $_POST['validatetrader']=='yes')
    {
        // validation
        if(isset($_POST['t_fullname']))
        {
            //name validation
            if(!empty(trim($_POST['t_fullname'])))
            {
                if(strlen($_POST['t_fullname']) < 4)
                {
                    $trader_error['#t_name_error']="Enter a valid name";
                    $trader_error['clear']=false;
                }
                else{
                    $trader_error['#t_name_error']="";
                    $t_fullnames= $_POST['t_fullname'];
                }
            }
            else{
                $trader_error['#t_name_error']="Name cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //email validation
        if(isset($_POST['t_useremail'])){
            if(!empty(trim($_POST['t_useremail']))){
                if(filter_var($_POST['t_useremail'], FILTER_VALIDATE_EMAIL)){

                    $t_useremail=$_POST['t_useremail'];
                    $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM mart_user WHERE upper(email)=upper(:email)";
                    $result=oci_parse($connection,$checkQuery);

                    $rows=oci_bind_by_name($result, ":email", $t_useremail);
                    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                    oci_execute($result);
                    oci_fetch($result);
                    if($number_of_rows>0){
                        $trader_error['#t_email_error']="Enter already registered";
                        $trader_error['clear']=false;
                        oci_free_statement($result); 
                    }
                    else{
                        $trader_error['#t_email_error']="";
                        $email=$_POST['t_useremail'];
                    
                    }
                    
                }
                else{
                    $trader_error['#t_email_error']="Enter a valid email";
                    $trader_error['clear']=false;
                }

            }
            else{
                $trader_error['#t_email_error']="Email cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //password validation
        if(isset($_POST['t_pword'])){
            if(!empty(trim($_POST['t_pword'])))
            {
                $pattern='/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{7,}$/';
                if(preg_match($pattern,$_POST['t_pword']))
                {
                    //encrypt password before
                    $trader_error['#t_pass_error']="";
                    $password=md5($_POST['t_pword']);
                
                }
                else
                {
                    $trader_error['clear']=false;
                    $trader_error['#t_pass_error']="Atleast 7 alphanumeric character <br/> atleast one upper one lower and one digit!<br/>";
                }

            }
            else
            {
                $trader_error['#t_pass_error']="Password cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //re enter password validaion
        if(isset($_POST['t_repass'])){
            if(!empty(trim($_POST['t_repass'])))
            {
                if($_POST['t_repass'] == $_POST['t_pword'])
                {
                    $trader_error['#t_repass_error']="";
                }
                else
                {
                    $trader_error['#t_repass_error']="Password does not match";
                    $trader_error['clear']=false; 
                }
            }
            else
            {
                $trader_error['#t_repass_error']="Re-enter password";
                $trader_error['clear']=false;
                
            }
        }

        //t_contact validation 
        if(isset($_POST['t_contact'])){
            if(!empty(trim($_POST['t_contact'])))
            {
                if(is_numeric(trim($_POST['t_contact'])))
                {
                    if(strlen(trim($_POST['t_contact']))>=10)
                    {
                        $trader_error['#t_contact_error']="";
                        $t_contact=$_POST['t_contact'];
                    }
                    else
                    {
                        $trader_error['#t_contact_error']="t_contact can't be less than 10 digits";
                        $trader_error['clear']=false;
                    }
                }
                else
                {
                        $trader_error['#t_contact_error']="Enter valid digits";
                        $trader_error['clear']=false;
                }

            }
            else{
                $trader_error['#t_contact_error']="t_contact cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //t_dob validation
        if(isset($_POST['t_dob'])){
            if(!empty($_POST['t_dob']))
            {
                $trader_error['#t_dob_error']="";
                $t_dob=date("d-m-Y", strtotime($_POST['t_dob']));
                
            }
            else{
                $trader_error['#t_dob_error']="t_dob cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //t_address validation
        if(isset($_POST['t_address'])){
            if(!empty($_POST['t_address']))
            {
                if(strlen($_POST['t_address']) < 4)
                {
                    $trader_error['#t_address_error']="Enter a valid t_address";
                    $trader_error['clear']=false;
                }
                else{
                    $trader_error['#t_address_error']="";
                    $t_address=$_POST['t_address'];
                }

            }
            else{
                $trader_error['#t_address_error']="t_address cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //reason justificarion validation
        if(isset($_POST['reason']))
        {
            if(!empty(trim($_POST['reason'])))
            {
                if(strlen($_POST['reason']) < 10)
                {
                    $trader_error['#reason_error']="Enter a valid justification";
                    $trader_error['clear']=false;
                }
                else{
                    $trader_error['#reason_error']="";
                    $reason= $_POST['reason'];
                }
            }
            else{
                $trader_error['#reason_error']="Enter your reason";
                $trader_error['clear']=false;
            }
        }
    }

    if(isset($_POST['registertrader']))
    {
        //shop name validation
        if(isset($_POST['shopname']))
        {
            if(!empty(trim($_POST['shopname'])))
            {
                if(strlen($_POST['shopname']) < 4)
                {
                    $trader_error['#shopname_error']="Enter a valid shop name";
                    $trader_error['clear']=false;
                }
                else{
                    $trader_error['#shopname_error']="";
                    $shopname= $_POST['shopname'];
                }
            }
            else{
                $trader_error['#shopname_error']="Shop name cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //registration date validation
        if(isset($_POST['register_date'])){
            if(!empty($_POST['register_date']))
            {
                $trader_error['#register_date_error']="";
                $register_date=date("d-m-Y", strtotime($_POST['register_date']));
                
            }
            else{
                $trader_error['#register_date_error']="Registration date cannot be empty";
                $trader_error['clear']=false;
            }
        }

        //registration number validation 
        if(isset($_POST['register_no'])){
            if(!empty(trim($_POST['register_no'])))
            {
                if(strlen(trim($_POST['register_no']))==12)
                {
                    $trader_error['#register_no_error']="";
                    $register_no=$_POST['register_no'];
                }
                else
                {
                    $trader_error['#register_no_error']="Registration number needs to be 12 characters";
                    $trader_error['clear']=false;
                }
            }
            else{
                $trader_error['#register_no_error']="PAN cannot be empty";
                $trader_error['clear']=false;
            }
        }

        if($trader_error['clear']==true)
        {
            $t_fullnames= $_POST['t_fullname'];
            $email=$_POST['t_useremail'];
            $password=md5($_POST['t_pword']);
            $t_contact=$_POST['t_contact'];
            $t_address=$_POST['t_address'];
            $t_dob=date("d-m-Y", strtotime($_POST['t_dob']));
            $shopname=$_POST['shopname'];
            $register_date=date("d-m-Y", strtotime($_POST['register_date']));
            $register_no=$_POST['register_no'];
            $reason=$_POST['reason'];
            $statuss='I';
            $role='T';
            $token=bin2hex(random_bytes(15));

            //inserting trader details
            $insertQuery="INSERT INTO mart_user(NAME, EMAIL, PASSWORD, t_contact, t_address, USER_ROLE, ACTIVE_STATUS, t_dob, TOKEN) VALUES(:t_fullname, :email, :pass,:t_contact, :addr, :roles, :statuss, to_date(:t_dob,'DD/MM/YYYY'), :token)";

            $parsedQuery=oci_parse($connection,$insertQuery);

            oci_bind_by_name($parsedQuery, ":t_fullname", $t_fullnames);
            oci_bind_by_name($parsedQuery, ":email", $email);
            oci_bind_by_name($parsedQuery, ":pass", $password);
            oci_bind_by_name($parsedQuery, ":t_contact", $t_contact);
            oci_bind_by_name($parsedQuery, ":addr", $t_address);
            oci_bind_by_name($parsedQuery, ":roles", $role);
            oci_bind_by_name($parsedQuery, ":statuss", $statuss);
            oci_bind_by_name($parsedQuery, ":t_dob", $t_dob);
            oci_bind_by_name($parsedQuery, ":token", $token);

            oci_execute($parsedQuery);
            oci_free_statement($parsedQuery);

            //extract user id of the trader
            $getUser= "SELECT * from mart_user where upper(email)=upper('$email')";
            $parsedGetUser = oci_parse($connection, $getUser);
            oci_execute($parsedGetUser);
            while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
                $user_id= $row['USER_ID'];
            }
            oci_free_statement($parsedGetUser);

            //inserting shop details
            $shopQuery="INSERT INTO shop(SHOP_NAME, REGISTATION_ID, RESGISTERED_DATE, ACTIVE_STATUS, USER_ID) VALUES(:shopname, :register_no, to_date(:register_date,'DD/MM/YYYY'), :active_status, :user_idd)";

            $parsedShopQuery=oci_parse($connection,$shopQuery);

            oci_bind_by_name($parsedShopQuery, ":shopname", $shopname);
            oci_bind_by_name($parsedShopQuery, ":register_date", $register_date);
            oci_bind_by_name($parsedShopQuery, ":register_no", $register_no);
            oci_bind_by_name($parsedShopQuery, ":active_status", $statuss);
            oci_bind_by_name($parsedShopQuery, ":user_idd", $user_id);

            // oci_execute($parsedShopQuery);
            if(oci_execute($parsedShopQuery))
            {
                $to=$email;
                $subject="Verify Your Account";
                $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

                $body="
                <html>
                <head>
                    <title>Verify Your Account</title>
                </head>
                <body>
                    <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                        <center>
                            $image
                            <h2> Hi $t_fullnames,</h2> <br> <b>Welcome to Phoenix Mart</b>.  <br> Click button  to verify your email t_address.You will be shortly notified if your request gets accepted. <br><br><a href= 'http://localhost/project_management/level5_project_management/code/activate.php?token=$token&reason=$reason&role=t'><button style='background-color: #4CAF50;border: none;
                            color: white;
                            padding: 15px 32px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            border-radius: 25px;'>Activate</button></a>
                            <br><br><br>  
                            <hr style='border: 0.7px solid grey; width:80%;'>
                            <span style='color:grey';>Please ignore if you did not create an account in Phoenix Mart.</span>
                        </center>
                    </div>
                </body>
                </html>";
                // $headers="From: phoenixmart123@gmail.com";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                if(mail($to, $subject, $body, $headers))
                {
                    $trader_error['clear']=true;
                }
                else{
                    $trader_error['clear']=false;
                }
            }
            oci_free_statement($parsedShopQuery);

            

        }
    }
    

    

    echo json_encode($trader_error);
    // print_r($trader_error) ;
?>