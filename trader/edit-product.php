<?php
    include_once('../connection.php');

    $edit_prod_error=array();
    $edit_prod_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='edit-product-form' && isset($_POST['product_id']))
    {
        $product_id=$_POST['product_id'];
        if(isset($_POST['name']))
        {
            //validate product
            if(!empty(trim($_POST['name'])))
            {
                $name=$_POST['name'];
                $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM PRODUCT WHERE UPPER(PRODUCT_NAME)=upper('$name')";
                $parsed=oci_parse($connection, $checkQuery);
                oci_define_by_name($parsed, 'NUMBER_OF_ROWS', $number_of_rows);
                oci_execute($parsed);
                oci_fetch($parsed);
                oci_free_statement($parsed);
                if($number_of_rows>0){
                    $getName="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$product_id";
                    $result=oci_parse($connection, $getName);
                    oci_execute($result);
                    while(($row= oci_fetch_assoc($result)) != false)
                    {
                        $old_name=$row['PRODUCT_NAME'];
                    }
                    if(strtoupper($old_name) == strtoupper($name))
                    {
                        $edit_prod_error['#error-product-name']="";
                        $edit_prod_error['#product-name']='valid';
                        
                    }
                    else{
                        $edit_prod_error['clear']=false;
                        $edit_prod_error['#error-product-name']="Product already exists";
                        $edit_prod_error['#product-name']='is-invalid';
                    } 
                    oci_free_statement($result);
                }
                else{
                    $edit_prod_error['#error-product-name']="";
                    $edit_prod_error['#product-name']='valid';
                }
            }
            else
            {
                $edit_prod_error['clear']=false;
                $edit_prod_error['#error-product-name']="Product name is required";
                $edit_prod_error['#product-name']='is-invalid';
            }
        }

        if(isset($_POST['stock']))
        {
            if(!empty(trim($_POST['stock'])))
            {
                $stock=trim($_POST['stock']);
                if (filter_var($stock, FILTER_VALIDATE_INT))
                {
                    $edit_prod_error['#error-product-stock']="";
                    $edit_prod_error['#product-stock']='valid';
                }
                else{
                    $edit_prod_error['clear']=false;
                    $edit_prod_error['#error-product-stock']="Enter valid integer.";
                    $edit_prod_error['#product-stock']='is-invalid';
                }
            }
            else{
                $edit_prod_error['clear']=false;
                $edit_prod_error['#error-product-stock']="Stock is required.";
                $edit_prod_error['#product-stock']='is-invalid';
            }
        }

        //check price
        if(isset($_POST['price']))
        {
            if(!empty(trim($_POST['price'])))
            {
                $price=trim($_POST['price']);
                if($price<=0)
                {
                    $edit_prod_error['clear']=false;
                    $edit_prod_error['#error-product-price']="Price can't be less than zero.";
                    $edit_prod_error['#product-price']='is-invalid';
                }
                else
                {
                    $query="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$product_id";
                    $parsed= oci_parse($connection, $query);
                    oci_execute($parsed);
                    while(($row= oci_fetch_assoc($parsed)) != false)
                    {
                        $old_price=$row['PRICE'];
                    }
                    oci_free_statement($parsed);
                    if($old_price==$price)
                    {
                        $price_change=false;
                    }
                    else{
                        $price_change=true;
                    }
                    $edit_prod_error['#error-product-price']="";
                    $edit_prod_error['#product-price']='valid';
                }
            }
            else{
                $edit_prod_error['clear']=false;
                $edit_prod_error['#error-product-price']="Price is required.";
                $edit_prod_error['#product-price']='is-invalid';
            }
        }

        //check unit
        if(isset($_POST['unit']))
        {
            if(!empty(trim($_POST['unit'])))
            {
                $unit=$_POST['unit'];
                $edit_prod_error['#error-product-unit']="";
                $edit_prod_error['#product-unit']='valid';
            }
            else{
                $edit_prod_error['clear']=false;
                $edit_prod_error['#error-product-unit']="Unit field is required.";
                $edit_prod_error['#product-unit']='is-invalid';
            }
        }

        if(isset($_POST['min']))
        {
            if(!empty(trim($_POST['min'])))
            {
                $min=trim($_POST['min']);
                if (filter_var($min, FILTER_VALIDATE_INT))
                {
                    $edit_prod_error['#error-product-min']="";
                    $edit_prod_error['#product-min']='valid';
                }
                else{
                    $edit_prod_error['clear']=false;
                    $edit_prod_error['#error-product-min']="Enter valid integer.";
                    $edit_prod_error['#product-min']='is-invalid';
                }
            }
            else{
                $edit_prod_error['clear']=false;
                $edit_prod_error['#error-product-min']="Minimum order is required.";
                $edit_prod_error['#product-min']='is-invalid';
            }
        }
        if(isset($_POST['max']))
        {
            if(!empty(trim($_POST['max'])))
            {
                $max=trim($_POST['max']);
                if (filter_var($max, FILTER_VALIDATE_INT))
                {
                    if(isset($_POST['min']))
                    {
                        if($_POST['min']>$max)
                        {
                            $edit_prod_error['clear']=false;
                            $edit_prod_error['#error-product-max']="Maximum order can't be less than minimum order.";
                            $edit_prod_error['#product-max']='is-invalid';
                        }
                    }
                    $edit_prod_error['#error-product-max']="";
                    $edit_prod_error['#product-max']='valid';
                }
                else{
                    $edit_prod_error['clear']=false;
                    $edit_prod_error['#error-product-max']="Enter valid integer.";
                    $edit_prod_error['#product-max']='is-invalid';
                }
            }
            else{
                $edit_prod_error['clear']=false;
                $edit_prod_error['#error-product-max']="Maximum order is required.";
                $edit_prod_error['#product-max']='is-invalid';
            }
        }

        $allergy=$descp='';
        if(isset($_POST['descp']) || isset($_POST['allergy']))
        {
            $descp=$_POST['descp'];
            $allergy=$_POST['allergy'];
        }
        if(isset($_POST['cat_id']))
        {
            if(!empty($_POST['cat_id']))
            {
                $cat_id=trim($_POST['cat_id']);
            }
            else
            {
                $edit_prod_error['clear']=false;
            }
        }

        //if all validations pass
        if( $edit_prod_error['clear'])
        {
            if($price_change==true)
            {
                $query="UPDATE PRODUCT SET PRODUCT_NAME='$name', STOCK_QUANTITY=$stock, PRICE=$price, PRICING_UNIT='$unit', MIN_ORDER=$min, MAX_ORDER=$max, DESCRIPTION='$descp', ALLERGY_INFO='$allergy', CATEGORY_ID=$cat_id WHERE PRODUCT_ID=$product_id";
                $parsed=oci_parse($connection, $query);
                if(oci_execute($parsed))
                {
                    $edit_prod_error['clear']=true;
                }
                else{
                    $edit_prod_error['clear']=false;
                }
                oci_free_statement($parsed);
            }
            if($price_change==false)
            {
                $query="UPDATE PRODUCT SET PRODUCT_NAME='$name', STOCK_QUANTITY=$stock, PRICING_UNIT='$unit', MIN_ORDER=$min, MAX_ORDER=$max, DESCRIPTION='$descp', ALLERGY_INFO='$allergy', CATEGORY_ID=$cat_id WHERE PRODUCT_ID=$product_id";
                $parsed=oci_parse($connection, $query);
                if(oci_execute($parsed))
                {
                    $edit_prod_error['clear']=true;
                }
                else{
                    $edit_prod_error['clear']=false;
                }
            }
            
            

        }

        echo json_encode($edit_prod_error);
    }


    
    $edit_img_error=array();
    $edit_img_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='new-prod-pic-form' && isset($_POST['p_id']))
    {

        if(isset($_FILES['new-prod-pic']['name']))
        {
            if(!empty($_FILES['new-prod-pic']['name']))
            {
                $filename=$_FILES['new-prod-pic']['name'];

                $extension=pathinfo($filename, PATHINFO_EXTENSION);

                $valid=array("jpg", "jpeg", "png", "gif");
                if(in_array($extension, $valid))
                {
                    $new_pic_name= rand().".".$extension;
                    $destination="../image/product/".$new_pic_name;
                    if(move_uploaded_file($_FILES['new-prod-pic']['tmp_name'], $destination))
                    {
                        $edit_img_error['#error-new-prod-pic']="";
                        $edit_img_error['#new-prod-pic']='valid';
                    }
                    else{
                        $edit_img_error['clear']=false;
                        $edit_img_error['#error-new-prod-pic']="File extension is not supported";
                        $edit_img_error['#new-prod-pic']='is-invalid';
                    }
                }
                else{
                    $edit_img_error['clear']=false;
                    $edit_img_error['#error-new-prod-pic']="Unable to upload image";
                    $edit_img_error['#new-prod-pic']='is-invalid';
                }
            }

        }


        if($edit_img_error['clear']==true)
        {
            $p_id=$_POST['p_id'];
            $query="INSERT INTO PRODUCT_IMAGE(IMAGE_DETAIL, PRODUCT_ID) VALUES('$new_pic_name', $p_id)";
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
            oci_free_statement($parsed);
        }
        echo json_encode($edit_img_error);

    }
?>