<?php
    include_once('../connection.php');
    include_once('../function.php');

    $add_shop_error=array();
    $add_shop_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='add-shop-form' && isset($_POST['trader-id'])){

        $trader_id=$_POST['trader-id'];

        // validate shop name
        if(isset($_POST['shop-name'])){
            if(!empty(trim($_POST['shop-name'])))
            {
                if(strlen($_POST['shop-name']) < 4)
                {
                    $add_shop_error['clear']=false;
                    $add_shop_error['#error-shop-name']="Enter valid shop name";
                    $add_shop_error['#shop-name']='is-invalid';
                }
                else{
                    $shop_name=$_POST['shop-name'];
                    if(!checkShopNameValid($shop_name, $connection))
                    {
                        $add_shop_error['clear']=false;
                        $add_shop_error['#error-shop-name']="Name already registered";
                        $add_shop_error['#shop-name']='is-invalid';
                    }
                    else{
                        $add_shop_error['#error-shop-name']="";
                        $add_shop_error['#shop-name']='valid';
                    }
                }
            }
            else{
                $add_shop_error['clear']=false;
                $add_shop_error['#error-shop-name']="Shop name is required";
                $add_shop_error['#shop-name']='is-invalid';
            }

        }

        //registration date validation
        if(isset($_POST['shop-date'])){
            if(!empty($_POST['shop-date']))
            {
                $current=date("d-m-Y");
                $shop_date=date("d-m-Y", strtotime($_POST['shop-date']));
                $add_shop_error['c']=$current;
                $add_shop_error['d']=$shop_date;
                if($current<$shop_date)
                {
                    $add_shop_error['clear']=false;
                    $add_shop_error['#error-reg-date']="Registration date can't be after today";
                    $add_shop_error['#shop-date']='is-invalid';
                }
                else{
                    $add_shop_error['#error-reg-date']="";
                    $add_shop_error['#shop-date']='valid'; 

                }
            }
            else{
                $add_shop_error['clear']=false;
                $add_shop_error['#error-reg-date']="Registration date is required";
                $add_shop_error['#shop-date']='is-invalid';
            }
        }

        //validate registration number for shop additon
        if(isset($_POST['reg-id']))
        {
            if(!empty(trim($_POST['reg-id'])))
            {
                if(strlen(trim($_POST['reg-id']))==8)
                {
                    $reg_id=$_POST['reg-id'];
                    if(checkRegistrationNumValid($reg_id, $connection))
                    {
                        $add_shop_error['#error-reg-id']="";
                        $add_shop_error['#reg-id']='valid';
                    }
                    else{
                        $add_shop_error['clear']=false;
                        $add_shop_error['#error-reg-id']="Registration ID already registered.";
                        $add_shop_error['#reg-id']='is-invalid';
                    }
                }
                else{
                    $add_shop_error['clear']=false;
                    $add_shop_error['#error-reg-id']="Registration ID needs to be 8 characters";
                    $add_shop_error['#reg-id']='is-invalid';
                }
            }
            else{
                $add_shop_error['clear']=false;
                $add_shop_error['#error-reg-id']="Registration ID is required";
                $add_shop_error['#reg-id']='is-invalid';
            }
        }

        //reason justificarion validation
        if(isset($_POST['reg-reason']))
        {
            if(!empty(trim($_POST['reg-reason'])))
            {
                if(strlen($_POST['reg-reason']) < 10)
                {
                    $add_shop_error['clear']=false;
                    $add_shop_error['#error-reg-reason']="Enter a valid justification";
                    $add_shop_error['#reg-reason']='is-invalid';
                }
                else{
                    $reason=$_POST['reg-reason'];
                    $add_shop_error['#error-reg-reason']="";
                    $add_shop_error['#reg-reason']='valid';
                }
            }
            else{
                $add_shop_error['clear']=false;
                $add_shop_error['#error-reg-reason']="Justification is required";
                $add_shop_error['#reg-reason']='is-invalid';
            }
        }

        if(isset($_FILES['shoplogo']['name']))
        {
            if(!empty($_FILES['shoplogo']['name']))
            {
                $filename=$_FILES['shoplogo']['name'];

                $extension=pathinfo($filename, PATHINFO_EXTENSION);

                $valid=array("jpg", "jpeg", "png", "gif");
                if(in_array($extension, $valid))
                {
                    $new_logo_name= rand().".".$extension;
                    $destination="../image/shop/".$new_logo_name;
                    if(move_uploaded_file($_FILES['shoplogo']['tmp_name'], $destination))
                    {
                        $add_shop_error['#error-shoplogo']="";
                        $add_shop_error['#shoplogo']='valid';
                    }
                    else{
                        $add_shop_error['clear']=false;
                        $add_shop_error['#error-shoplogo']="Unable to upload image";
                        $add_shop_error['#shoplogo']='is-invalid';
                    }
                }
                else{
                    $add_shop_error['clear']=false;
                    $add_shop_error['#error-shoplogo']="Invalid File format";
                    $add_shop_error['#shoplogo']='is-invalid';
                }
            }
            else{
                $new_logo_name="";
            }
        }

        //inserting data to database
        if($add_shop_error['clear']==true && ($_POST['run_query']=='t'))
        {
            //inserting shop details
            $statuss='I';
            $shopQuery="INSERT INTO shop(SHOP_NAME, REGISTATION_ID, RESGISTERED_DATE, ACTIVE_STATUS,SHOPLOGO, USER_ID) VALUES(:shopname, :register_no, to_date(:register_date,'DD/MM/YYYY'), :active_status, :shoplogo, :user_idd)";

            $parsedShopQuery=oci_parse($connection,$shopQuery);

            oci_bind_by_name($parsedShopQuery, ":shopname", $shop_name);
            oci_bind_by_name($parsedShopQuery, ":register_date", $shop_date);
            oci_bind_by_name($parsedShopQuery, ":register_no", $reg_id);
            oci_bind_by_name($parsedShopQuery, ":active_status", $statuss);
            oci_bind_by_name($parsedShopQuery, ":shoplogo", $new_logo_name);
            oci_bind_by_name($parsedShopQuery, ":user_idd", $trader_id);

            $email=getEmail($trader_id, $connection);

            // send mail to admin for activation request
            if(oci_execute($parsedShopQuery))
            {
                $to='phoenixmart123@gmail.com';
                $subject="New Trader Request";
                $image = '<img src="https://i.ibb.co/zhFv7GH/logo.png" alt=" " style="width:100px; height:60px;"/>';

                $body="
                <html>
                <head>
                    <title>Shop Addition Request</title>
                </head>
                <body>
                    <div style='background-color: #f9fcf7; width:80%; margin:10%; padding: 20px;'>
                        <center>
                            $image <br/>
                            A new registration request from trader <b>$email </b>has arrived!
                            Trader details are provided below <br> 
                            Shop Name : $shop_name <br> 
                            Shop Registration date : $shop_date<br> 
                            PAN : $reg_id <br> 
                            Trader's Message : $reason <br> 
                                <br> <b>Click button  to activate shop.</b> <br><br><a href= 'http://localhost/project_management/level5_project_management/code/activateTrader.php?regid=$reg_id&userid=$trader_id&name=$shop_name'><button style='background-color: #4CAF50;border: none;
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
                mail($to, $subject, $body, $headers);
            }

        }
        echo json_encode($add_shop_error);
    }


    //edit shop name
    $edit_shop_error=array();
    $edit_shop_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='edit-shop-form' && isset($_POST['shop_id'])){

    }
?>