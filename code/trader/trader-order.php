<?php
  include_once('../connection.php');
  if(!isset($_SESSION['phoenix_user']) & empty($_SESSION['phoenix_user']))
  {
    header('Location: ../loginform.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <title>Trader Order</title>
  </head> 
  <body>
    <div class="container-fluid ">
      <!-- header logo and name -->
      <?php include 'header.php'?>
        <!-- main body with nav and main container -->
        <div class="row" id="main-body">
          <!-- navigation -->
            <div class="col-lg-2 col-md-3 d-none d-md-flex justify-content-center align-items-center nav-side" id="nav1">
              <div class="list-group list-group-flush my-3 nav-list">
                <div class="d-flex justify-content-center">
                  <img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>"  alt="profile"  id="profile-picture"/>
                </div>
                <!-- <a href="#" class="list-group-item text-decoration-none active" >
                  <i class='bx bxs-dashboard'></i></i>
                  Dashboard
                </a> -->
                <a href="trader-index.php" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-user"></i>
                  <span class="hide-text">Profile</span>
                </a>
                <a href="trader-order.php" class="list-group-item text-decoration-none active" >
                  <i class="fa-solid fa-cart-shopping"></i>
                  <span class="hide-text">Order</span>
                </a>
                <a href="trader-product.php" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-basket-shopping"></i>
                  <span class="hide-text">Product</span>
                </a>
                <a href="trader-shop.php" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-store"></i>
                  <span class="hide-text">Shop</span>
                </a>
                <a href="../logout.php" class="list-group-item text-decoration-none confirm-logout"  >
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  <span class="hide-text">Sign out</span>
                </a>
              </div>
            </div>
            <!-- main trader interface -->
            <div class="col-lg-10 col-md-9 main-container">
              <!-- breadcrumb -->
              <div class="col-11 mx-auto mt-4">
                <div class="row h6 d-flex align-items-center">
                  <nav class="col-12 w-100 px-0 mb-3">
                    <ol class="breadcrumb" id="trad-breadcrumb">
                    <li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li>
                      <li class="breadcrumb-item active"><a href="trader-order.php" ><b>Order</b></a></li>
                      <!-- <li class="breadcrumb-item active d-none" id="ord-detail-crumb">Details</li> -->
                      <!-- <li class="breadcrumb-item" aria-current="page"></li> -->
                    </ol>
                  </nav>
              </div>
              <div class="row" id="detail-container">
                <div class="col-12 form-container  w-100 py-3">
                  <div class="col-12">
                  </div>
                  <div class="col-12 table-responsive mt-3" id="order-table">
                    <table class="table table-hover">
                      <thead class="mygreen">
                        <tr>
                          <th> </th>
                          <th>ORDER</th>
                          <th>CUSTOMER</th>
                          <th>ORDER DATE</th>
                          <th>STATUS</th>
                          <th>QUANTITY</th>
                          <!-- <th>ACTION</th> -->
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $getUser= "SELECT DISTINCT CO.ORDER_ID, ORDER_DATE, ORDER_STATUS, NAME FROM mart_user mu JOIN cust_order co ON mu.user_id=co.user_id JOIN order_item ot ON co.order_id=ot.order_id JOIN PRODUCT p ON ot.product_id=p.product_id WHERE p.shop_id IN(SELECT SHOP_ID FROM SHOP WHERE USER_ID=5) ORDER BY ORDER_DATE DESC";
                        // echo $getUser;
                        $parsedGetUser = oci_parse($connection, $getUser);
                        oci_execute($parsedGetUser);
                        while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
                        ?>
                          <tr>
                            <?php
                              $getQuantity= "SELECT COUNT(*) AS QUANTITY FROM ORDER_ITEM WHERE ORDER_ID=".$row['ORDER_ID'];
                              $parse=oci_parse($connection, $getQuantity);
                              oci_define_by_name($parse, 'QUANTITY', $QUANTITY);
                              oci_execute($parse);
                              oci_fetch($parse);
                            ?>
                            <td>
                              <span>
                                    <i class="fa-solid fa-magnifying-glass view-order-detail" value="<?php echo $row['ORDER_ID'];?>"></i>
                              </span>
                            </td>
                            <td><?php echo '#'.$row['ORDER_ID'] ?></td>
                            <td><?php echo $row['NAME'] ?></td>
                            <td><?php echo $row['ORDER_DATE'] ?></td>
                            <?php
                              if(strtoupper( $row['ORDER_STATUS']) == 'COMPLETED')
                              {
                                ?>
                                <td class="badge badge-pill badge-completed"><?php echo $row['ORDER_STATUS']; ?></td>
                                <?php
                              }
                              else if(strtoupper($row['ORDER_STATUS']) == 'PENDING')
                              {
                                ?>
                                <td class="badge badge-pill badge-pending"><span>&nbsp;&nbsp;&nbsp;</span><?php echo $row['ORDER_STATUS']; ?><span>&nbsp;&nbsp; </span></td>
                                <?php
                              }
                              else if(strtoupper($row['ORDER_STATUS']) == 'PROCESSING')
                              {
                                ?>
                                <td class="badge badge-pill badge-processing"><?php echo $row['ORDER_STATUS']; ?></td>
                                <?php
                              }
                              else
                              {
                                ?>
                                <td><?php echo $row['ORDER_STATUS']; ?></td>
                                <?php
                              }
                            ?>
                            <td><?php echo $QUANTITY ?></td>
                            <!-- <td>
                              <span>
                                    <i class="fa-solid fa-magnifying-glass view-order-detail" value="<?php echo $row['ORDER_ID'];?>"></i>
                              </span>
                            </td> -->
                            <?php
                              oci_free_statement($parse);
                            ?>
                          </tr>
                      <?php
                        }
                        oci_free_statement($parsedGetUser);
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-12 d-none" id="order-detail-table">
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </body>
  <script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="script/script.js"></script>
  <script src="../script/function.js"></script>
  <script src="script/form-valid.js"></script>
</html>