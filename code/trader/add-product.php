<?php
    include_once('../connection.php');

    $add_prod_error=array();
    $add_prod_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='add-product-form' && isset($_POST['shop_id']))
    {
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

        if(isset($_POST['stock']))
        {
            if(!empty(trim($_POST['stock'])))
            {
                $stock=trim($_POST['stock']);
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
        if(isset($_POST['price']))
        {
            if(!empty(trim($_POST['price'])))
            {
                $price=trim($_POST['price']);
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
        if(isset($_POST['unit']))
        {
            if(!empty(trim($_POST['unit'])))
            {
                $unit=$_POST['unit'];
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
        if(isset($_POST['min']))
        {
            if(!empty(trim($_POST['min'])))
            {
                $min=trim($_POST['min']);
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
        if(isset($_POST['cat_id']))
        {
            if(!empty($_POST['cat_id']) && ($_POST['cat_id']!='null'))
            {
                $category=$_POST['cat_id'];
            }
            else{
                $add_prod_error['clear']=false;
                $add_prod_error['#error-add-product-category']="Select product category.";
                $add_prod_error['#add-product-category']='is-invalid';
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
                $add_prod_error['clear']=false;
            }
        }

        //if all validations pass
        if( $add_prod_error['clear'])
        {
            $shop=$_POST['shop_id'];
            $query="INSERT INTO PRODUCT(PRODUCT_NAME, PRICE, STOCK_QUANTITY, CATEGORY_ID, PRICING_UNIT, MIN_ORDER, MAX_ORDER, DESCRIPTION, ALLERGY_INFO, DISABLED, SHOP_ID) VALUES('$name', $price, $stock, $category, '$unit', $min, $max, '$descp', '$allergy', 'F', $shop)";
            // $add_prod_error['q']=$query;
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
        }

        echo json_encode($add_prod_error);
    }

    
?>