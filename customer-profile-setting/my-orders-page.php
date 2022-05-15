<?php
  include_once('../connection.php');
  include_once('../function.php');
  if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']))
  {
    header('Location: ../loginform.php');
  }
  if(isset($_SESSION['user_role']) && $_SESSION['user_role']!='C')
  {
    header('Location: ../loginform.php');
  }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- customized css -->
    <link rel="stylesheet" type="text/css" href="../style/header.css" />
    <link rel="stylesheet" type="text/css" href="../trader/style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/cust-style.css" />
    <title>My Profile</title>
</head>

<body>
    <?php include_once('header.php');?>
    <?php include_once('include-header.php');?>
    <div class="container setting-container mb-5">
        <div class="row w-100 mt-5">
            <div class="col-md-3 d-flex justify-content-start align-items-start pr-0 mt-2">
                <div class="list-group list-group-flush setting-nav w-100 setting-nav">
                    <a href="cust-setting-index.php" class="list-group-item rounded-top">
                        <i class='bx bx-grid-alt'></i>
                        <span> &nbsp; Dashboard</span>
                    </a>
                    <a href="my-account-page.php" class="list-group-item">
                        <i class='bx bx-user'></i>
                        <span> &nbsp; My Profile</span>
                    </a>
                    <a href="my-orders-page.php" class="list-group-item active">
                        <i class='bx bx-package'></i>
                        <span> &nbsp; My Orders</span>
                    </a>
                    <a href="track-order-page.php" class="list-group-item">
                        <i class='bx bx-notepad'></i>
                        <span> &nbsp; Track My Order</span>
                    </a>
                    <a href="..\wishlist-page.php" class="list-group-item">
                        <!-- <i class='bx bx-heart' ></i> -->
                        <i class='bx bx-book-heart' ></i>
                        <!-- <i class='bx bx-bookmark-heart' ></i> -->
                        <span> &nbsp; My WishList</span>
                    </a>
                    <a href="my-review-page.php" class="list-group-item">
                        <i class='bx bx-message-rounded-dots'></i>
                        <span> &nbsp; My Reviews</span>
                    </a>
                    <a href="deactivate-account-page.php" class="list-group-item">
                        <i class='bx bx-user-x'></i>
                        <span> &nbsp; Deactivate</span>
                    </a>
                    <a href="cust-logout.php" class="list-group-item rounded-bottom">
                        <i class='bx bx-exit bx-rotate-180'></i>
                        <span> &nbsp; Sign Out</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9 d-flex justify-content-center align-items-start">
                <div class="row w-100 justify-content-center align-items-start">
                    <div class="col-12 mt-2">
                        <div class="setting-nav align-items-center pb-4 order-cust-container">
                            <div class="border-bottom pt-3 pb-2 d-flex justify-content-center text-center">
                                <div class="col-md-4 all-order-select my-green-font"><b><i class="fa-solid fa-basket-shopping"></i>&nbsp;
                                        All Orders</b></div>
                                <div class="col-md-4 to-recieve-select"><b><i class="fa-solid fa-truck-fast"></i>&nbsp; To Recieve</b>
                                </div>
                                <div class="col-md-4 recieved-select"><i class="fa-solid fa-truck-ramp-box"></i>&nbsp; <b>Received</b>
                                </div>
                            </div>
                            <div
                                class="row justify-content-center align-items-center all-orders-container transition-effect px-4">
                                <div class="col-12 table-responsive mt-5 px-3 mx-auto">
                                    <table class="table">
                                        <thead class="light-green">
                                            <tr>
                                                <th> </th>
                                                <th>ORDER</th>
                                                <th>ORDER DATE</th>
                                                <th>STATUS</th>
                                                <th>QUANTITY</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $getOrder= "SELECT DISTINCT CO.ORDER_ID, ORDER_DATE, ORDER_STATUS FROM mart_user mu JOIN cust_order co ON mu.user_id=co.user_id JOIN order_item ot ON co.order_id=ot.order_id JOIN PRODUCT p ON ot.product_id=p.product_id WHERE mu.USER_ID=$cust_id ORDER BY ORDER_DATE DESC";
                                        // echo $getUser;
                                        $parsedOrder = oci_parse($connection, $getOrder);
                                        oci_execute($parsedOrder);
                                        while (($row = oci_fetch_assoc($parsedOrder)) != false) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <span>
                                                        <i class="fa-solid fa-magnifying-glass pl-1 view-cust-order-detail"
                                                            value="<?php echo $row['ORDER_ID'];?>"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    #<?php echo $row['ORDER_ID'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['ORDER_DATE'] ?>
                                                </td>
                                                <?php
                                                if(strtoupper( $row['ORDER_STATUS']) == 'COMPLETED')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-completed">
                                                    <?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                else if(strtoupper($row['ORDER_STATUS']) == 'PENDING')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-pending">
                                                    <span>&nbsp;&nbsp;&nbsp;</span><?php echo $row['ORDER_STATUS']; ?><span>&nbsp;&nbsp;
                                                    </span></td>
                                                <?php
                                                }
                                                else if(strtoupper($row['ORDER_STATUS']) == 'PROCESSING')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-processing">
                                                    <?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                <td><?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <?php echo getOrderItemQuantity($row['ORDER_ID'], $connection); ?>
                                                </td>
                                                <td>
                                                    <span>&#163;</span><?php echo getSubtotalforOrder($row['ORDER_ID'], $connection); ?>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                oci_free_statement($parsedOrder);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div
                                class="row d-none justify-content-center d-none align-items-center to-recieve-container transition-effect px-4">
                                <div class="col-12 table-responsive mt-5 px-3 mx-auto">
                                    <table class="table">
                                        <thead class="light-green">
                                            <tr>
                                                <th> </th>
                                                <th>ORDER</th>
                                                <th>ORDER DATE</th>
                                                <th>STATUS</th>
                                                <th>QUANTITY</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $getOrder= "SELECT DISTINCT CO.ORDER_ID, ORDER_DATE, ORDER_STATUS FROM mart_user mu JOIN cust_order co ON mu.user_id=co.user_id JOIN order_item ot ON co.order_id=ot.order_id JOIN PRODUCT p ON ot.product_id=p.product_id WHERE mu.USER_ID=$cust_id AND UPPER(ORDER_STATUS)<>'COMPLETED' ORDER BY ORDER_DATE DESC";
                                        // echo $getUser;
                                        $parsedOrder = oci_parse($connection, $getOrder);
                                        oci_execute($parsedOrder);
                                        $count=0;
                                        while (($row = oci_fetch_assoc($parsedOrder)) != false) {
                                            $count++;
                                        ?>
                                            <tr>
                                                <td>
                                                    <span>
                                                        <i class="fa-solid fa-magnifying-glass pl-1 view-cust-order-detail"
                                                            value="<?php echo $row['ORDER_ID'];?>"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    #<?php echo $row['ORDER_ID'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['ORDER_DATE'] ?>
                                                </td>
                                                <?php
                                                if(strtoupper( $row['ORDER_STATUS']) == 'COMPLETED')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-completed">
                                                    <?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                else if(strtoupper($row['ORDER_STATUS']) == 'PENDING')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-pending">
                                                    <span>&nbsp;&nbsp;&nbsp;</span><?php echo $row['ORDER_STATUS']; ?><span>&nbsp;&nbsp;
                                                    </span></td>
                                                <?php
                                                }
                                                else if(strtoupper($row['ORDER_STATUS']) == 'PROCESSING')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-processing">
                                                    <?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                <td><?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <?php echo getOrderItemQuantity($row['ORDER_ID'], $connection); ?>
                                                </td>
                                                <td>
                                                    <span>&#163;</span><?php echo getSubtotalforOrder($row['ORDER_ID'], $connection); ?>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                oci_free_statement($parsedOrder);
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php  
                                        if($count==0)
                                        {
                                            echo 'No orders to receive';
                                        }
                                      ?>
                                </div>
                            </div>

                            <div
                                class="row d-none justify-content-center align-items-center recieved-container transition-effect px-4">
                                <div class="col-12 table-responsive mt-5 px-3 mx-auto">
                                    <table class="table">
                                        <thead class="light-green">
                                            <tr>
                                                <th> </th>
                                                <th>ORDER</th>
                                                <th>ORDER DATE</th>
                                                <th>STATUS</th>
                                                <th>QUANTITY</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $getOrder= "SELECT DISTINCT CO.ORDER_ID, ORDER_DATE, ORDER_STATUS FROM mart_user mu JOIN cust_order co ON mu.user_id=co.user_id JOIN order_item ot ON co.order_id=ot.order_id JOIN PRODUCT p ON ot.product_id=p.product_id WHERE mu.USER_ID=$cust_id AND UPPER(ORDER_STATUS)='COMPLETED' ORDER BY ORDER_DATE DESC";
                                        // echo $getUser;
                                        $parsedOrder = oci_parse($connection, $getOrder);
                                        oci_execute($parsedOrder);
                                        $count2=0;
                                        while (($row = oci_fetch_assoc($parsedOrder)) != false) {
                                            $count2++;
                                        ?>
                                            <tr>
                                                <td>
                                                    <span>
                                                        <i class="fa-solid fa-magnifying-glass pl-1 view-cust-order-detail"
                                                            value="<?php echo $row['ORDER_ID'];?>"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    #<?php echo $row['ORDER_ID'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['ORDER_DATE'] ?>
                                                </td>
                                                <?php
                                                if(strtoupper( $row['ORDER_STATUS']) == 'COMPLETED')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-completed">
                                                    <?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                else if(strtoupper($row['ORDER_STATUS']) == 'PENDING')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-pending">
                                                    <span>&nbsp;&nbsp;&nbsp;</span><?php echo $row['ORDER_STATUS']; ?><span>&nbsp;&nbsp;
                                                    </span></td>
                                                <?php
                                                }
                                                else if(strtoupper($row['ORDER_STATUS']) == 'PROCESSING')
                                                {
                                                    ?>
                                                <td class="badge badge-pill badge-processing">
                                                    <?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                <td><?php echo $row['ORDER_STATUS']; ?></td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <?php echo getOrderItemQuantity($row['ORDER_ID'], $connection); ?>
                                                </td>
                                                <td>
                                                    <span>&#163;</span><?php echo getSubtotalforOrder($row['ORDER_ID'], $connection); ?>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                oci_free_statement($parsedOrder);
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php  
                                        if($count2==0)
                                        {
                                            echo 'No orders to receive';
                                        }
                                      ?>
                                </div>
                            </div>

                            <div class="one-detail-container transition-effecr">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 pt-5">
    <?php include_once('footer.php');?>
    </div>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom script -->
<script src="../script/function.js"></script>
<script src="script/script.js"></script>

</html>