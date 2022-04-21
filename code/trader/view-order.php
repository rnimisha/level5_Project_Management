<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Welcome Trader</title>
  </head> 
  <body>
    <?php
      if(isset($_POST['order_id']) && !empty($_POST['order_id']) && isset($_POST['view_order'])){
        $getUser= "SELECT ORDER_DATE, NAME, EMAIL FROM mart_user mu JOIN cust_order co ON mu.user_id=co.user_id JOIN order_item ot ON co.order_id=ot.order_id JOIN PRODUCT p ON ot.product_id=p.product_id WHERE";
        // echo $getUser;
        $parsedGetUser = oci_parse($connection, $getUser);
        oci_execute($parsedGetUser);
        while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
        }

      }
      

    ?>
    <p> heloooooo</p>
  <ul class="list-group list-group-flush my-1 text-uppercase">
        <li class="list-group-item">
          <span>
           &nbsp;&nbsp;<?php  echo 'hello';?>
          </span>
        </li>
  </ul>
</body>
  <script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="script/script.js"></script>
  <script src="../script/function.js"></script>
  <script src="script/form-valid.js"></script>
</html>

