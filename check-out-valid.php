<?php
    include_once('connection.php');
    include_once('function.php');

    $collection=array();
    $collection['clear']=true;

    if(isset($_POST['action']) && $_POST['action']=='apply-coupon' && isset($_SESSION['phoenix_user']))
    {
        if(isset($_POST['coupon']))
        {
            if(!empty(trim($_POST['coupon'])))
            {
                $coupon=trim($_POST['coupon']);
                $query="SELECT * FROM COUPON WHERE COUPON_CODE='$coupon' AND START_DATE<=SYSDATE AND EXPIRY_DATE>=SYSDATE";
                $parsed=oci_parse($connection, $query);
                oci_execute($parsed);
                $count=0;
                while (($row = oci_fetch_assoc($parsed)) != false) {
                    $count++;
                    $no_of_use=$row['NUMBER_OF_USE'];
                    $coupon_id=$row['COUPON_ID'];
                }

                if($count<1)
                {
                    $collection['clear']=false;
                    $collection['#error-coupon']="Invalid Coupon Code";
                    $collection['#coupon-code']='is-invalid';
                }
                else
                {
                    $checkQuery="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM CUST_ORDER CO JOIN ORDER_COUPON OC ON OC.ORDER_ID=CO.ORDER_ID WHERE COUPON_ID=$coupon_id AND USER_ID=".$_SESSION['phoenix_user'];
                    $result=oci_parse($connection,$checkQuery);

                    oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                    oci_execute($result);
                    oci_fetch($result);
                    if($number_of_rows<$no_of_use){
                        $_SESSION['COUPON']=$coupon_id;
                        $collection['#error-coupon']="";
                        $collection['#coupon-code']='valid';
                        if(isset($_POST['subtotal_coupon']))
                        {
                            $collection['total']= calculateSubtotalAfterCoupon($coupon_id, $_POST['subtotal_coupon'], $connection);
                        }
                    
                    }
                    else{
                        $collection['clear']=false;
                        $collection['#error-coupon']="Coupon use already exceeded";
                        $collection['#coupon-code']='is-invalid';
                    }   
                }
            }
        }
        echo json_encode($collection);
    }

    if(isset($_POST['action']) && $_POST['action']=='save-detail')
    {
        if(isset($_POST['day_selected']) && isset($_POST['time_selected']) && !empty(trim($_POST['time_selected'])) && !empty($_POST['day_selected']))
        {
            $day=$_POST['day_selected'];
            $time=$_POST['time_selected'];

            $query="SELECT * FROM SLOT WHERE SLOT_DAY='$day' AND TIME_RANGE='$time'";
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
            $row=oci_fetch_assoc($parsed);
            $_SESSION['collection-id']=$row['SLOT_ID'];
            oci_free_statement($parsed);

            if(isset($_POST['buynow']))
            {
            if(!empty($_POST['buynow']))
            {
                $_SESSION['buynow']=$_POST['buynow'];
            }
            }

            echo json_encode(1);   
        }

    }
?>