<?php
    include_once('../connection.php');

    $add_dis_error=array();
    $add_dis_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='discount-form' && isset($_POST['prod_id'])){
        $prod_id=$_POST['prod_id'];

        // validate discount name
        if(isset($_POST['dis_name'])){
            if(!empty(trim($_POST['dis_name'])))
            {
                $name=$_POST['dis_name'];
                $add_dis_error['#error-dis-name']="";
                $add_dis_error['#dis-name']='valid';
            }
            else{
                $add_dis_error['clear']=false;
                $add_dis_error['#error-dis-name']="Product name is required";
                $add_dis_error['#dis-name']='is-invalid';
            }

        }

        //validate discount rate
        if(isset($_POST['dis_rate']))
        {
            if(!empty(trim($_POST['dis_rate'])))
            {
                $rate=$_POST['dis_rate'];
                if($rate>100){
                    $add_dis_error['clear']=false;
                    $add_dis_error['#error-dis-rate']="Rate can't be greater than 100%";
                    $add_dis_error['#dis-rate']='is-invalid';
                }
                else{
                    $add_dis_error['#error-dis-rate']="";
                    $add_dis_error['#dis-rate']='valid';
                }
            }
            else{
                $add_dis_error['clear']=false;
                $add_dis_error['#error-dis-rate']="Rate is required";
                $add_dis_error['#dis-rate']='is-invalid';
            }
        }

        //validate discount start
        if(isset($_POST['dis_start']))
        {
            if(!empty($_POST['dis_start']))
            {
                $start=date("d-m-Y", strtotime($_POST['dis_start']));
                $add_dis_error['#error-dis-start']="";
                $add_dis_error['#dis-start']='valid';
            }
            else{
                $add_dis_error['clear']=false;
                $add_dis_error['#error-dis-start']="Start date is required";
                $add_dis_error['#dis-start']='is-invalid';
            }
            
        }

        //validate discount end
        if(isset($_POST['dis_end']))
        {
            if(!empty($_POST['dis_end']))
            {
                $end=date("d-m-Y", strtotime($_POST['dis_end']));
                // $add_dis_error['e']=$end;
                $add_dis_error['#error-dis-end']="";
                        $add_dis_error['#dis-end']='valid'; 
                   
            }
            else{
                $add_dis_error['clear']=false;
                $add_dis_error['#error-dis-end']="Start date is required";
                $add_dis_error['#dis-end']='is-invalid';
            }
        }
        if($add_dis_error['clear'])
        {
            $query="INSERT INTO DISCOUNT(DISCOUNT_NAME, DISCOUNT_RATE, START_DATE, EXPIRY_DATE, PRODUCT_ID) VALUES(:names, :rate, to_date(:starts,'DD/MM/YYYY'), to_date(:ends,'DD/MM/YYYY'), :prod_id)";
            // $query="INSERT INTO DISCOUNT(DISCOUNT_NAME, DISCOUNT_RATE, START_DATE, EXPIRY_DATE, PRODUCT_ID) VALUES('$name', $rate, $start, $end, $prod_id)";
            // $add_dis_error['c']=$query;
            $parsed=oci_parse($connection,$query);

            oci_bind_by_name($parsed, ":names", $name);
            oci_bind_by_name($parsed, ":rate", $rate);
            oci_bind_by_name($parsed, ":starts", $start);
            oci_bind_by_name($parsed, ":ends", $end);
            oci_bind_by_name($parsed, ":prod_id", $prod_id);

            oci_execute($parsed);
        }
        echo json_encode($add_dis_error);
    }
?>