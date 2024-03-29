<?php
  include_once('../connection.php');
  include_once('../function.php');
  if(!isset($_SESSION['phoenix_user']) && empty($_SESSION['phoenix_user']))
  {
    header('Location: ../loginform.php');
  }
  if(isset($_SESSION['user_role']) && $_SESSION['user_role']!='T')
  {
    header('Location: ../loginform.php');
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <title>My Shop</title>
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
            <img
              src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>"
              alt="profile" id="profile-picture" />
          </div>
          <!-- <a href="#" class="list-group-item text-decoration-none active" >
                  <i class='bx bxs-dashboard'></i></i>
                  Dashboard
                </a> -->
          <a href="trader-index.php" class="list-group-item text-decoration-none">
            <i class="fa-solid fa-user"></i>
            <span class="hide-text">Profile</span>
          </a>
          <a href="trader-order.php" class="list-group-item text-decoration-none">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="hide-text">Order</span>
          </a>
          <a href="trader-product.php" class="list-group-item text-decoration-none">
            <i class="fa-solid fa-apple-whole"></i>
            <span class="hide-text">Product</span>
          </a>
          <a href="trader-shop.php" class="list-group-item text-decoration-none active">
            <i class="fa-solid fa-store"></i>
            <span class="hide-text">Shop</span>
          </a>
          <a href="#" class="list-group-item text-decoration-none confirm-dashboard"  >
                  <!-- <i class="fa-solid fa-chart-column"></i> -->
                  <i class="fa-solid fa-chart-pie confirm-dashboard"></i>
                  <span class="hide-text">Dashboard</span>
                </a>
          <a href="#" class="list-group-item text-decoration-none confirm-logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="hide-text">Sign out</span>
          </a>
        </div>
      </div>

      <!-- main trader shop interface -->
      <div class="col-lg-10 col-md-9 main-container">

        <!-- breadcrumb -->
        <div class="col-11 mx-auto mt-4">
          <div class="row h6 d-flex align-items-center">
            <nav class="col-12 w-100 px-0 mb-3">
              <ol class="breadcrumb h4" id="trad-breadcrumb">
                <li class="breadcrumb-item"><a href="trader-index.php"><b><i
                        class="fa-solid fa-house-chimney"></i></b></a></li>
                <li class="breadcrumb-item active"><a href="trader-shop.php"><b>Shop</b></a></li>
              </ol>
            </nav>
          </div>

          <!-- shop table view container-->
          <div class="row" id="detail-container">
            <div class="col-12 form-container w-100 py-3" id="shop-detail-table">
            <?php 
                  $shop_quota_exist=true;
                  $uid=$_SESSION['phoenix_user'];
                  $check_query="SELECT COUNT(*) AS NUMBER_OF_ROWS FROM SHOP WHERE USER_ID=$uid";
                  $result=oci_parse($connection,$check_query);
                  
                  oci_define_by_name($result, 'NUMBER_OF_ROWS', $number_of_rows);
                  oci_execute($result);
                  oci_fetch($result);
                  if($number_of_rows>=2)
                  {
                      $shop_quota_exist=false;
                  }
                  else
                  {
                      $shop_quota_exist=true;
                  }
                  oci_free_statement($result);
                  if($shop_quota_exist==true)
                  {
                ?>
              <div class="row" id="add-shop-row">
                <div class="col-lg-2 offset-lg-10 add-shop">
                  <button class="btn ml-lg-n2" value="<?php echo checkShopExceed($current_trader_id, $connection);?>"id="add-shop-btn"><i class="fa-solid fa-plus"></i>Add Shop</button>
                </div>
              </div>
              <?php 
                  }
                ?>
              <div class="col-12 table-responsive mt-3" id="shop-table">
                <table class="table table-hover">
                  <thead class="mygreen">
                    <tr>
                      <th>NAME</th>
                      <th>LOGO</th>
                      <th>REGISTRATION ID</th>
                      <th>REGISTERED DATE</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $getShop= "SELECT * FROM SHOP WHERE USER_ID=$current_trader_id AND UPPER(ACTIVE_STATUS)='A'";
                        $parsedgetShop = oci_parse($connection, $getShop);
                        oci_execute($parsedgetShop);
                        while (($row = oci_fetch_assoc($parsedgetShop)) != false) {
                        ?>
                    <tr>
                      <td><?php echo $row['SHOP_NAME']; ?></td>
                      <?php
                          $img='../image/product/productplaceholder.png';
                          if(!empty(trim($row['SHOPLOGO'])))
                          {
                            $temp=$row['SHOPLOGO'];
                            $img='../image/shop/'.$temp;
                          }
                        ?>
                      <td><img class="prod-view-img" src="<?php echo $img;?>" alt="shoplogo" /></td>
                      <td class="text-uppercase"><?php echo '#'.$row['REGISTATION_ID']; ?></td>
                      <td class="text-uppercase"><?php echo $row['RESGISTERED_DATE']; ?></td>
                      <td>
                        <span>
                          <i class="fa-solid fa-pen-to-square edit-shop" value="<?php echo $row['SHOP_ID'];?>"></i>
                          &nbsp;
                          <i class="fa-solid fa-trash-can delete-shop"
                            value="<?php echo $row['SHOP_ID'];?>"></i>
                        </span>
                      </td>
                    </tr>
                    <?php 
                        }
                        oci_free_statement($parsedgetShop);
                      ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- add shop form container -->
            <div class="col-12 form-container w-100 py-3 d-none" id="add-shop-container">
              <div class="row ">
                  <div class="col-12 d-flex justify-content-center border-bottom">
                    <div class="h4 font-weight-bold">Add Shop</div>
                  </div>
                <div class="col-12">
                  <!-- add shop form -->
                  <form class="w-75 mx-auto py-4" id="add-shop-form" action="add-shop.php" method="POST">
                  <div class="alert alert-success mt-4 mb-2 w-75 mx-auto" id="add-shop-sucess-msg">
                    <strong>Success! </strong>Changes has been saved.
                  </div>
                    <input type="hidden" name="trader-id" id="trader-id" value="<?php echo $current_trader_id;?>" />
                    <div class="form-group">
                      <label for="shop-name" class="text-muted">Shop Name</label>
                      <input type="text" class="form-control" name="shop-name" id="shop-name" />
                      <div class="invalid-feedback" id="error-shop-name"></div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="reg-id" class="text-muted">Registration ID</label>
                        <input type="text" class="form-control" name="reg-id" id="reg-id" />
                        <div class="invalid-feedback" id="error-reg-id"></div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="shop-date" class="text-muted">Registration Date</label>
                        <input type="date" class="form-control" name="shop-date" id="shop-date" />
                        <div class="invalid-feedback" id="error-reg-date"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="reg-reason" class="text-muted">What you want to sell?</label>
                      <textarea class="form-control" name="reg-reason" id="reg-reason"></textarea>
                      <div class="invalid-feedback" id="error-reg-reason"></div>
                    </div>
                    <div class="form-group">
                      <label for="shop-logo" class="text-muted ">Shop Logo</label><br>
                      <input type="file" name="shoplogo" id="shoplogo">
                      <div class="invalid-feedback" id="error-shoplogo"></div>
                    </div>
                    <div class="row justify-content-end pr-1">
                      <button type="submit" class="btn" id="add-shop-button">Add Shop</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- edit shop category -->
            <div class="col-12 form-container w-100 py-3 d-none" id="shop-edit-form">
              <div class="row w-100" id="settings">
                <div class="col-lg-2 col-md-3 border-right h-75">
                  <ul class="list-group list-group-flush my-1">
                  <li class="list-group-item hover-cat" id="shop-general">Shop Name</li>
                    <li class="list-group-item hover-cat" id="shop-photo">Logo</li>
                  </ul>
                </div>

                <!-- edit product form -->
                <form class=" w-75 mx-auto py-4" id="edit-shop-form" action="edit-shop.php" method="POST">
                  <div class="alert alert-success mt-4 mb-2 w-75 mx-auto" id="shop-edit-sucess-msg">
                      <strong>Success! </strong>Changes has been saved.
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="edit_shop_id" value="" />
                  </div>
                  <div class="form-group">
                    <label for="new-shop-name" class="text-muted">Shop Name</label>
                    <input type="text" class="form-control" id="new-shop-name" />
                    <div class="invalid-feedback" id="error-new-shop-name"></div>
                  </div>
                  <div class="form-group">
                    <label for="check-pass" class="text-muted">Your Password</label>
                    <input type="password" class="form-control" id="check-pass"/>
                    <div class="invalid-feedback" id="error-check-pass"></div>
                  </div>
                  <div class="row justify-content-end pr-1">
                    <button type="submit" class="btn" id="edit-shop-button">Save Changes</button>
                  </div>
                </form>

                <!-- change shop logo containere-->
                <div id="shop-pic-form"  class="col-lg-10 col-md-9 py-4 d-none">
                  <div class="alert alert-success mt-4 mb-2 w-75 mx-auto" id="shop-logo-sucess-msg">
                    <strong>Success! </strong>Changes has been saved.
                  </div>
                  <div class="row d-flex justify-content-center align-items-center w-100 ">
                    <form action="edit-shop.php" method="POST" id="new-shop-logo-form">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="logo_shop_id" name="logo_shop_id" value="" />
                      </div>
                      <div class="preview-img mb-5">
                        <img src="..\image\product\productplaceholder.png" id="preview-logo"/>
                      </div>
                      <div class="form-group">
                        <label for="new-shop-logo" class="text-muted">Upload new logo</label><br>
                        <input type="file" id="new-shop-logo" name="new-shop-logo">
                        <div class="invalid-feedback" id="error-new-shop-logo"></div>
                      </div>
                      <div class="row justify-content-end pr-1">
                        <button type="submit" class="btn" id="add-shop-logo">Upload Image</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php
      include_once('confirm-logout.php');
    ?>
</body>
<!-- external script -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- custom script -->
<script src="script/script.js"></script>
<script src="../script/function.js"></script>
<script src="script/form-valid.js"></script>

</html>