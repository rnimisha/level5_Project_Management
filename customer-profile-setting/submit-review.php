<?php 
    include_once('../connection.php');

    $rating_error=array();
    $rating_error['clear']=true;

    if(isset($_POST['form_name']) && $_POST['form_name']=='review-form' && isset($_POST['cust_id']) && isset($_POST['prod_id']))
    {
        $prod_id=$_POST['prod_id'];
        $cust_id=$_POST['cust_id'];

        if(isset($_POST['star']))
        {
            if(!empty($_POST['star']))
            {
                $rating_error['#error-star']="";
                $rating_error['#star-rating']='valid';
                $star=$_POST['star'];
            }
            else{
                $rating_error['#error-star']="Please give star review.";
                $rating_error['clear']=false;
                $rating_error['#star-rating']='is-invalid';
            }
        }

        if(isset($_POST['comment']))
        {
            if(!empty($_POST['comment']))
            {
                $rating_error['#error-prod-review']="";
                $rating_error['#prod-review']='valid';
                $comment=$_POST['comment'];
            }
            else{
                $rating_error['#error-prod-review']="Enter a review message.";
                $rating_error['clear']=false;
                $rating_error['#prod-review']='is-invalid';
            }
        }

        if($rating_error['clear']){

            $query="INSERT INTO REVIEW(REVIEW_COMMENT, STAR_RATING, PRODUCT_ID, USER_ID, VERIFIED) VALUES('$comment', $star, $prod_id, $cust_id, 'T')";
            $parsed=oci_parse($connection, $query);
            oci_execute($parsed);
            oci_free_statement($parsed);
        }

        echo json_encode($rating_error);
    }
?>