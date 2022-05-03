<?php
    include_once('../connection.php');

    $add_prod_error=array();
    $add_prod_error['clear']=true;
    if(isset($_POST['form_name']) && $_POST['form_name']=='add-product-form' && isset($_POST['add-product-shop']))
    {
        if(isset($_POST['add-product-name']))
        {
            //validate product
            if(!empty(trim($_POST['add-product-name'])))
            {
                $name=$_POST['add-product-name'];
                $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM PRODUCT WHERE UPPER(PRODUCT_NAME)=upper('$name')";
                $parsed=oci_parse($connection, $checkQuery);
                oci_define_by_name($parsed, 'NUMBER_OF_ROWS', $number_of_rows);
                oci_execute($parsed);
                oci_fetch($parsed);
                oci_free_statement($parsed);
                if($number_of_rows>0){
                        $add_prod_error['clear']=false;
                        $add_prod_error['#error-add-product-name']="Product already exists";
                        $add_prod_error['#add-product-name']='is-invalid';
                } 
                else{
                    $add_prod_error['#error-add-product-name']="";
                    $add_prod_error['#add-product-name']='valid';
                }
            }
            else
            {
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-name']="Product name is required";
                $add_prod_error['#add-product-name']='is-invalid';
            }
        }

        if(isset($_POST['add-product-stock']))
        {
            if(!empty(trim($_POST['add-product-stock'])))
            {
                $stock=trim($_POST['add-product-stock']);
                $add_prod_error['#error-add-product-stock']="";
                $add_prod_error['#add-product-stock']='valid';
            }
            else{
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-stock']="Stock is required.";
                $add_prod_error['#add-product-stock']='is-invalid';
            }
        }

        //check price
        if(isset($_POST['add-product-price']))
        {
            if(!empty(trim($_POST['add-product-price'])))
            {
                $price=trim($_POST['add-product-price']);
                if($price<=0)
                {
                    $add_prod_error['clear']=false;
                    $add_prod_error['#error-add-product-price']="Price can't be less than zero.";
                    $add_prod_error['#add-product-price']='is-invalid';
                }
                else
                {
                    $add_prod_error['#error-add-product-price']="";
                    $add_prod_error['#add-product-price']='valid';
                }
            }
            else{
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-price']="Price is required.";
                $add_prod_error['#add-product-price']='is-invalid';
            }
        }

        //check unit
        if(isset($_POST['add-product-unit']))
        {
            if(!empty(trim($_POST['add-product-unit'])))
            {
                $unit=$_POST['add-product-unit'];
                $add_prod_error['#error-add-product-unit']="";
                $add_prod_error['#add-product-unit']='valid';
            }
            else{
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-unit']="Unit field is required.";
                $add_prod_error['#add-product-unit']='is-invalid';
            }
        }

        //check minimum order
        if(isset($_POST['add-product-min']))
        {
            if(!empty(trim($_POST['add-product-min'])))
            {
                $min=trim($_POST['add-product-min']);
                if (filter_var($min, FILTER_VALIDATE_INT))
                {
                    $add_prod_error['#error-add-product-min']="";
                    $add_prod_error['#add-product-min']='valid';
                }
                else{
                    $add_prod_error['clear']=false;
                    $add_prod_error['#error-add-product-min']="Enter valid integer.";
                    $add_prod_error['#add-product-min']='is-invalid';
                }
            }
            else{
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-min']="Minimum order is required.";
                $add_prod_error['#add-product-min']='is-invalid';
            }
        }

        //check maximum order
        if(isset($_POST['add-product-max']))
        {
            if(!empty(trim($_POST['add-product-max'])))
            {
                $max=trim($_POST['add-product-max']);
                if (filter_var($max, FILTER_VALIDATE_INT))
                {
                    if(isset($_POST['add-product-min']))
                    {
                        if($_POST['add-product-min']>$max)
                        {
                            $add_prod_error['clear']=false;
                            $add_prod_error['#error-add-product-max']="Maximum order can't be less than minimum order.";
                            $add_prod_error['#add-product-max']='is-invalid';
                        }
                    }
                    $add_prod_error['#error-add-product-max']="";
                    $add_prod_error['#add-product-max']='valid';
                }
                else{
                    $add_prod_error['clear']=false;
                    $add_prod_error['#error-add-product-max']="Enter valid integer.";
                    $add_prod_error['#add-product-max']='is-invalid';
                }
            }
            else{
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-max']="Maximum order is required.";
                $add_prod_error['#add-product-max']='is-invalid';
            }
        }

        //check category_id
        if(isset($_POST['add-product-category']))
        {
            if(!empty($_POST['add-product-category']) && ($_POST['add-product-category']!='null'))
            {
                $category=$_POST['add-product-category'];
            }
            else{
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-category']="Select product category.";
                $add_prod_error['#add-product-category']='is-invalid';
            }
        }

        if(isset($_POST['add-product-descp']))
        {
            if(!empty(trim($_POST['add-product-descp'])))
            {
                $descp=$_POST['add-product-descp'];
                $add_prod_error['#error-add-product-descp']="";
                $add_prod_error['#add-product-descp']='valid';
            }
            else
            {
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-descp']="Please enter a short description.";
                $add_prod_error['#add-product-descp']='is-invalid';
            }
        }
        $allergy='';
        if(isset($_POST['add-product-descp']) || isset($_POST['add-product-allergy']))
        {
            $allergy=$_POST['add-product-allergy'];
        }
       

        // //if all validations pass
        // if( $add_prod_error['clear'])
        // {
        //     $shop=$_POST['add-product-shop'];
        //     $query="INSERT INTO PRODUCT(PRODUCT_NAME, PRICE, STOCK_QUANTITY, CATEGORY_ID, PRICING_UNIT, MIN_ORDER, MAX_ORDER, DESCRIPTION, ALLERGY_INFO, DISABLED, SHOP_ID) VALUES('$name', $price, $stock, $category, '$unit', $min, $max, '$descp', '$allergy', 'F', $shop)";
        //     // $add_prod_error['q']=$query;
        //     $parsed=oci_parse($connection, $query);
        //     oci_execute($parsed);
        // }

        echo json_encode($add_prod_error);
    }
    
?>