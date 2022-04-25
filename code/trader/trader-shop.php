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
    <title>My shop</title>
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
                <a href="trader-order.php" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-cart-shopping"></i>
                  <span class="hide-text">Order</span>
                </a>
                <a href="trader-product.php" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-basket-shopping"></i>
                  <span class="hide-text">Product</span>
                </a>
                <a href="trader-shop.php" class="list-group-item text-decoration-none active" >
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
                    <ol class="breadcrumb h4" id="trad-breadcrumb">
                      <li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li>
                      <li class="breadcrumb-item active"><a href="trader-shop.php" ><b>Shop</b></a></li>
                    </ol>
                  </nav>
              </div>
              <!-- profile-->
              <div class="row" id="detail-container">
                <div class="col-12 form-container w-100 py-3">
                <div class="row" id="add-shop-row">
                    <div class="col-2 offset-lg-10 add-shop">
                      <button class="btn ml-lg-n2" id="add-shop-btn"><i class="fa-solid fa-plus"></i>Add Shop</button>
                    </div>
                  </div>
                  <div class="col-12 table-responsive mt-3" id="shop-table">
                    <table class="table table-hover">
                      <thead class="mygreen">
                        <tr>
                          <th> </th>
                          <th>NAME</th>
                          <th>LOGO</th>
                          <th>REGISTRATION ID</th>
                          <th>REGISTERED DATE</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $getShop= "SELECT * FROM SHOP WHERE USER_ID=$current_trader_id";
                        $parsedgetShop = oci_parse($connection, $getShop);
                        oci_execute($parsedgetShop);
                        while (($row = oci_fetch_assoc($parsedgetShop)) != false) {
                        ?>
                          <tr>
                            <td><i class="fa-solid fa-magnifying-glass view-product-detail" value="<?php echo $row['SHOP_ID'];?>"></i></td>
                            <td><?php echo $row['SHOP_NAME']; ?></td>
                            <?php
                             $img='../image/product/productplaceholder.png';
                            if(!empty(trim($row['SHOPLOGO'])))
                            {
                              $temp=$row['SHOPLOGO'];
                              $img='../image/shop/'.$temp;
                            }
                            ?>
                            <td><img class="prod-view-img" src="<?php echo $img;?>" alt="shoplogo"/></td>
                            <td><?php echo '#'.$row['REGISTATION_ID']; ?></td>
                            <td><?php echo $row['RESGISTERED_DATE']; ?></td>
                            <td>
                              <span>
                                <i class="fa-solid fa-pen-to-square edit-product" value="<?php echo $row['SHOP_ID'];?>"></i>
                                &nbsp;<i class="fa-solid fa-trash-can delete-product" value="<?php echo $row['SHOP_ID'];?>"></i>
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