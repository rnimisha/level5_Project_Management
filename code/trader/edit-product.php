<?php
    include_once('../connection.php');

    $edit_prod_error=array();
    $edit_prod_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='edit-product-form' && isset($_POST['product_id']))
    {
        $product_id=$_POST['product_id'];
        if(isset($_POST['name']))
        {
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
                $edit_prod_error['#error-product-name']="Product name cannot be empty";
                $edit_prod_error['#product-name']='is-invalid';
            }
        }

        echo json_encode($edit_prod_error);
    }
    else{
        $edit_prod_error['clear']=false;
        echo json_encode($edit_prod_error);
    }

    
?>