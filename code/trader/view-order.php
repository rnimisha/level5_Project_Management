<?php
include_once('../connection.php');
include_once('../function.php');
if(!isset($_SESSION['phoenix_user']) & empty($_SESSION['phoenix_user']))
  {
    header('Location: ../loginform.php');
  }
if(isset($_POST['order_id']))
{
  $od_id=$_POST['order_id'];
  $getUser= "SELECT DISTINCT ORDER_DATE, NAME,EMAIL, ORDER_STATUS FROM mart_user mu JOIN cust_order co ON mu.user_id=co.user_id JOIN order_item ot ON co.order_id=ot.order_id JOIN PRODUCT p ON ot.product_id=p.product_id WHERE co.order_id=$od_id";
  // echo $getUser;
  $parsedGetUser = oci_parse($connection, $getUser);
  oci_execute($parsedGetUser);
  while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
    $od_date=$row['ORDER_DATE'];
    $name=$row['NAME'];
    $od_date=$row['ORDER_DATE'];
    $status=$row['ORDER_STATUS'];
  }
  oci_free_statement($parsedGetUser);

  $getDetail= "SELECT SLOT_DAY, TIME_RANGE FROM SLOT WHERE SLOT_ID=(SELECT SLOT_ID FROM CUST_ORDER WHERE ORDER_ID=$od_id)";
  $parsed=oci_parse($connection, $getDetail);
  oci_execute($parsed);
  while (($row = oci_fetch_assoc($parsed)) != false) {
    $slot_day=$row['SLOT_DAY'];
    $time_range=$row['TIME_RANGE'];
  }
  oci_free_statement($parsed);

  $query="SELECT  P.PRODUCT_ID AS PRODUCT_ID, PRODUCT_NAME, PRICE, ITEM_QUANTITY FROM PRODUCT P JOIN ORDER_ITEM OI ON P.PRODUCT_ID=OI.PRODUCT_ID WHERE ORDER_ID=$od_id";
  $parsed2=oci_parse($connection, $query);
}

echo '<div class="row">
          <div class="col-12 d-flex justify-content-center border-bottom ">
            <div class="h4 font-weight-bold">Order #'.$od_id.'</div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-9 col-md-8 ">
            <br><br>
            Customer : '.$name.'<br>
            Order Date : '.$od_date.'<br>
          </div>
          <div class="col-lg-3 col-md-4 float-right">
            <br><br>
            Status : '.$status.'<br>
            Slot : '.$slot_day.' '.$time_range.'<br>
          </div>
      </div>
      <div class="card mt-3">
      <div class="row table-responsive w-100  mx-auto">
        <table class="table">
          <thead class="bg-light">
            <tr class="mygreen">
              <th>PRODUCT NAME</th>
              <th>QUANTITY</th>
              <th>PRICE PER UNIT</th>
              <th>DISCOUNT(%)</th>
              <th>AMOUNT</th>
            </tr>
          </thead>
          <tbody>';

            oci_execute($parsed2);
            while (($row = oci_fetch_assoc($parsed2)) != false) {
              $discount=floatval(getProductDiscount($row['PRODUCT_ID'], $od_id, $connection));
              $amount=floatval($row['PRICE'] * $row['ITEM_QUANTITY']);
              $total=$amount-(($discount/100)*$amount);
              echo '
              <tr>
                <td>'.$row['PRODUCT_NAME'].'</td>
                <td> '.$row['ITEM_QUANTITY'].'</td>
                <td> <span>&#163;</span>'.$row['PRICE'].'</td>
                <td> '.$discount.'</td>
                <td> <span>&#163;</span>'.$total.'</td>
              </tr>';
            }
            echo'
          </tbody>
        </table>
        </div></div>';

?>
