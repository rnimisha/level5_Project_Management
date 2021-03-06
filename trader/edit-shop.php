<?php
    include_once('../connection.php');
    include_once('../function.php');

    $shop_name_error=array();
    $shop_name_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='edit-shop-form' && isset($_POST['shop_id']))
    {
        $shop_id=$_POST['shop_id'];

        if(isset($_POST['new_name'])){
            if(!empty(trim($_POST['new_name'])))
            {
                if(strlen($_POST['new_name']) < 4)
                {
                    $shop_name_error['clear']=false;
                    $shop_name_error['#error-new-shop-name']="Enter valid shop name";
                    $shop_name_error['#new-shop-name']='is-invalid';
                }
                else{
                    $shop_name=$_POST['new_name'];
                    if(!checkShopNameValid($shop_name, $connection))
                    {
                        $shop_name_error['clear']=false;
                        $shop_name_error['#error-new-shop-name']="Name already registered";
                        $shop_name_error['#new-shop-name']='is-invalid';
                    }
                    else{
                        $shop_name_error['#error-new_name']="";
                        $shop_name_error['#new-shop-name']='valid';
                    }
                }
            }
            else{
                $shop_name_error['clear']=false;
                $shop_name_error['#error-new-shop-name']="Enter shop name";
                $shop_name_error['#new-shop-name']='is-invalid';
            }

        }

        if(isset($_POST['check_pass']))
        {
            if(!empty(trim($_POST['check_pass'])))
            {
                $query="SELECT * FROM MART_USER WHERE USER_ID=(SELECT USER_ID FROM SHOP WHERE SHOP_ID=$shop_id)";
                $parsed=oci_parse($connection,$query);
                oci_execute($parsed);
                while(($row = oci_fetch_assoc($parsed)) != false)
                {
                    $pass=$row['PASSWORD'];
                }
                oci_free_statement($parsed);

                if(md5($_POST['check_pass']) == $pass)
                {
                    $shop_name_error['#error-check-pass']="";
                    $shop_name_error['#check-pass']='valid';
                }
                else{
                    $shop_name_error['clear']=false;
                    $shop_name_error['#error-check-pass']="Password does not match.";
                    $shop_name_error['#check-pass']='is-invalid';
                }
            }
            else
            {
                $shop_name_error['clear']=false;
                $shop_name_error['#error-check-pass']="Enter your password.";
                $shop_name_error['#check-pass']='is-invalid';
            }
        }

        if($shop_name_error['clear']==true)
        {
            $query="UPDATE SHOP SET SHOP_NAME='$shop_name' WHERE SHOP_ID=$shop_id";
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
        }

        echo json_encode($shop_name_error);
    }


    //upload changed logo for shop 
    $shop_logo_error=array();
    $shop_logo_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='new-shop-logo-form' && isset($_POST['logo_shop_id']))
    {
        $shop_id=$_POST['logo_shop_id'];
        if(isset($_FILES['new-shop-logo']['name']))
        {
            if(!empty($_FILES['new-shop-logo']['name']))
            {
                $filename=$_FILES['new-shop-logo']['name'];

                $extension=pathinfo($filename, PATHINFO_EXTENSION);

                $valid=array("jpg", "jpeg", "png", "gif");
                if(in_array($extension, $valid))
                {
                    $new_pic_name= rand().".".$extension;
                    $destination="../image/shop/".$new_pic_name;
                    if(move_uploaded_file($_FILES['new-shop-logo']['tmp_name'], $destination))
                    {
                        $shop_logo_error['#error-new-shop-logo']="";
                        $shop_logo_error['#new-shop-logo']='valid';
                    }
                    else{
                        $shop_logo_error['clear']=false;
                        $shop_logo_error['#error-new-shop-logo']="File extension is not supported";
                        $shop_logo_error['#new-shop-logo']='is-invalid';
                    }
                }
                else{
                    $shop_logo_error['clear']=false;
                    $shop_logo_error['#error-new-shop-logo']="Unable to upload image";
                    $shop_logo_error['#new-shop-logo']='is-invalid';
                }
            }
        }

        if($shop_logo_error['clear']==true)
        {
            $query="UPDATE SHOP SET SHOPLOGO='$new_pic_name' WHERE SHOP_ID=$shop_id";
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
            oci_free_statement($parsed);
        }

        echo json_encode($shop_logo_error);
    }

  
?>