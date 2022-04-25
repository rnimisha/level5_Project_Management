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
    <title>My Product</title>
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
                <a href="trader-product.php" class="list-group-item text-decoration-none active" >
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
                    <ol class="breadcrumb h4" id="trad-breadcrumb">
                      <li class="breadcrumb-item"><a href="trader-index.php" ><b><i class="fa-solid fa-house-chimney"></i></b></a></li>
                      <li class="breadcrumb-item active"><a href="trader-product.php" ><b>Product</b></a></li>
                    </ol>
                  </nav>
              </div>
              <!-- product detail table-->
              <div class="row" id="detail-container">
                <div class="col-12 form-container w-100 py-3" id="product-detail-table">
                <div class="row" id="add-prod-row">
                  <div class="col-2 offset-10 add-product">
                    <button class="btn" id="add-prod-btn">Add Product</button>
                  </div>
                </div>
                  <div class="col-12 table-responsive mt-3" id="product-table">
                    <table class="table table-hover">
                      <thead class="mygreen text-center">
                        <tr>
                          <th> </th>
                          <th>NAME</th>
                          <th>IMAGE</th>
                          <th>DESCRIPTION</th>
                          <th>STOCK</th>
                          <th>PRICE</th>
                          <th>DISCOUNT</th>
                          <th>MIN</th>
                          <th>MAX</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $getProduct= "SELECT PRODUCT_ID, PRODUCT_NAME, DESCRIPTION AS DESCRIP,STOCK_QUANTITY,PRICE, PRICING_UNIT, MIN_ORDER, MAX_ORDER, ALLERGY_INFO FROM PRODUCT P JOIN SHOP S ON S.SHOP_ID=P.SHOP_ID WHERE S.USER_ID=$current_trader_id AND DISABLED='F' ORDER BY PRODUCT_NAME";
                        // echo $getProduct;
                        $parsedgetProduct = oci_parse($connection, $getProduct);
                        oci_execute($parsedgetProduct);
                        while (($row = oci_fetch_assoc($parsedgetProduct)) != false) {
                        ?>
                          <tr>
                            <td><i class="fa-solid fa-magnifying-glass view-product-detail" value="<?php echo $row['PRODUCT_ID'];?>"></i></td>
                            <td><?php echo $row['PRODUCT_NAME']; ?></td>
                            <?php
                             $getImg ="SELECT IMAGE_DETAIL FROM PRODUCT_IMAGE WHERE PRODUCT_ID=".$row['PRODUCT_ID']." AND ROWNUM<=1";
                            //  echo $getImg;
                             $parsedgetImg = oci_parse($connection, $getImg);
                             $img='../image/product/productplaceholder.png';
                             if(oci_execute($parsedgetImg))
                             {
                                while (oci_fetch($parsedgetImg)) {
                                  if(!empty(trim(oci_result($parsedgetImg, 'IMAGE_DETAIL'))))
                                  {
                                    $temp=oci_result($parsedgetImg, 'IMAGE_DETAIL');
                                    $img='../image/product/'.$temp;
                                  }
                                  break;
                                }
                              }
                              oci_free_statement($parsedgetImg);
                            ?>
                            <td><img class="prod-view-img" src="<?php echo $img;?>" alt="product-img"/></td>
                            <td><?php echo $row['DESCRIP']->load(); ?></td>
                            <td><?php echo $row['STOCK_QUANTITY']; ?></td>
                            <td><span>&#163;</span><?php echo $row['PRICE'].'/'. $row['PRICING_UNIT'];?></td>
                            <?php
                               $query="SELECT * FROM ACTIVE_PRODUCT WHERE PRODUCT_ID=".$row['PRODUCT_ID'];
                               $parsed=oci_parse($connection, $query);
                               oci_execute($parsed);
                               while (oci_fetch($parsed)) {
                                if(!empty(trim(oci_result($parsed, 'DISCOUNT_RATE'))))
                                {
                                  $discount=oci_result($parsed, 'DISCOUNT_RATE');
                                  ?>
                                  <td><?php echo $discount.'%';?></td>
                                  <?php
                                }
                                else{
                                  $discount='0';
                                  ?>
                                  <td><button class="btn add-discount" value="<?php echo $row['PRODUCT_ID'];?>">Add</button></td>
                                  <?php
                                }
                               }
                               oci_free_statement($parsed);
                            ?>
                            <td><?php echo $row['MIN_ORDER']; ?></td>
                            <td><?php echo $row['MAX_ORDER']; ?></td>
                            <td>
                              <span>
                                <i class="fa-solid fa-pen-to-square edit-product" value="<?php echo $row['PRODUCT_ID'];?>"></i>
                                &nbsp;<i class="fa-solid fa-trash-can delete-product" value="<?php echo $row['PRODUCT_ID'];?>"></i>
                              </span>
                            </td>
                          </tr>
                      <?php
                        }
                        oci_free_statement($parsedgetProduct);
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-12 d-none" id="product-detail-table">
                  </div>
                </div>
                <!-- add discount container -->
              <div class="col-12 form-container w-100 py-3 d-none" id="add-discount-form">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-center border-bottom">
                      <div class="h4 font-weight-bold"> Add Discount</div>
                    </div>
                    <div class="col-12">
                      <!-- add discount form -->
                      <form class="w-75 mx-auto py-4" id="add-discount-form" action="add-discount.php" method="POST">
                        <input type="hidden" class="form-control" id="prod-id" value=""/>
                        <div class="form-group">
                          <label for="dis-name" class="text-muted">Discount Name</label>
                          <input type="text" class="form-control" id="dis-name"/>
                          <div class="invalid-feedback" id="error-dis-name"></div>
                        </div>
                        <div class="form-group">
                          <label for="dis-rate" class="text-muted">Discount Rate</label>
                          <input type="number" step="0.1" class="form-control" id="dis-rate"/>
                          <div class="invalid-feedback" id="error-dis-rate"></div>
                        </div>
                        <div class="form-group">
                          <label for="dis-start" class="text-muted">Start Date</label>
                          <input type="date" class="form-control" id="dis-start"/>
                          <div class="invalid-feedback" id="error-dis-start"></div>
                        </div>
                        <div class="form-group">
                          <label for="dis-end" class="text-muted">End Date</label>
                          <input type="date" class="form-control" id="dis-end"/>
                          <div class="invalid-feedback" id="error-dis-end"></div>
                        </div>
                        <div class="row justify-content-end pr-1">
                          <button type="submit" class="btn" id="add-discount-btn">Add Discount</button>
                        </div>  
                      </form>
                    </div>
                  </div>
                </div>
                <!-- add product container -->
                <div class="col-12 form-container w-100 py-3 d-none" id="product-detail-form">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-center border-bottom">
                      <div class="h4 font-weight-bold"> Add Product</div>
                    </div>
                    <div class="col-12">
                      <!-- add product form -->
                      <form class="w-75 mx-auto py-4" id="add-product-form" action="add-product.php" method="POST">
                        <?php
                          $getShopId="SELECT * FROM SHOP WHERE USER_ID=".$_SESSION['phoenix_user'];
                          $parsedShop=oci_parse($connection, $getShopId);
                          oci_execute($parsedShop);
                          while(($row = oci_fetch_assoc($parsedShop)) != false) {
                              $shop_id=$row['SHOP_ID'];
                          }
                          oci_free_statement($parsedShop);
                        ?>
                        <input type="hidden" class="form-control" id="add-product-shop" value="<?php echo $shop_id;?>"/> 
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="add-product-name" class="text-muted">Product Name</label>
                            <input type="text" class="form-control" id="add-product-name"/>
                            <div class="invalid-feedback" id="error-add-product-name"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="add-product-stock" class="text-muted">Stock Quantity</label>
                            <input type="number" class="form-control" id="add-product-stock"/>
                            <div class="invalid-feedback" id="error-add-product-stock"></div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="add-product-name" class="text-muted">Product Name</label>
                            <input type="text" class="form-control" id="add-product-name"/>
                            <div class="invalid-feedback" id="error-add-product-name"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="add-product-stock" class="text-muted">Stock Quantity</label>
                            <input type="number" class="form-control" id="add-product-stock"/>
                            <div class="invalid-feedback" id="error-add-product-stock"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="add-product-category" class="text-muted">Category</label>
                          <select class="custom-select form-control" id="add-product-category">
                            <?php
                            $query="SELECT * FROM PRODUCT_CATEGORY";
                            $parsed = oci_parse($connection, $query);
                            oci_execute($parsed);
                            while (($row = oci_fetch_assoc($parsed)) != false) {
                            ?>
                              <option value="<?php echo $row['CATEGORY_ID'];?>"><?php echo $row['CATEGORY_NAME']?></option>
                            <?php
                            }
                            oci_free_statement($parsed);
                            ?>
                          </select>
                            <!-- <div class="invalid-feedback" id="error-add-product-category"></div> -->
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                          <label for="add-product-price" class="text-muted">Price</label>
                            <input type="number" step="0.1" class="form-control" id="add-product-price"/>
                            <div class="invalid-feedback" id="error-add-product-price"></div>
                          </div>
                          <div class="form-group col-md-6">
                          <label for="add-product-unit" class="text-muted">Pricing Unit</label>
                            <input type="text" class="form-control" id="add-product-unit"/>
                            <div class="invalid-feedback" id="error-add-product-unit"></div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="add-product-min" class="text-muted">Minimum Order</label>
                            <input type="number" class="form-control" id="add-product-min"/>
                            <div class="invalid-feedback" id="error-add-product-min"></div>
                          </div>
                          <div class="form-group col-md-6">
                          <label for="add-product-max" class="text-muted">Maximum Order</label>
                            <input type="number" class="form-control" id="add-product-max"/>
                            <div class="invalid-feedback" id="error=add-product-max"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="add-product-descp" class="text-muted">Description</label>
                            <textarea class="form-control" id="add-product-descp"></textarea>
                            <div class="invalid-feedback" id="error-add-product-descp"></div>
                        </div>
                        <div class="form-group">
                          <label for="add-product-allergy" class="text-muted">Allergy Information</label>
                            <textarea class="form-control" id="add-product-allergy"></textarea>
                            <div class="invalid-feedback" id="error-add-product-allergy"></div>
                        </div>
                        <div class="row justify-content-end pr-1">
                          <button type="submit" class="btn" id="add-prod-button">Add Product</button>
                        </div>  
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
 <!-- modal for editing product -->
  <div class="d-none">
    <button type="hidden" id="product-modal" data-toggle="modal" data-target="#editProductForm">
    </button>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="editProductForm" tabindex="-1" role="dialog" aria-labelledby="editProductFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header mygreen">
          <h5 class="modal-title ">Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body edit-product-form">
          <!-- edit product form -->
          <form class=" w-75 mx-auto py-4" id="edit-product-form" action="edit-product.php" method="POST">
            <div class="form-group d-none">
                <input type="hidden" class="form-control" id="product_id" value=""/>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="product-name" class="text-muted">Product Name</label>
                <input type="text" class="form-control" id="product-name" value=""/>
                <div class="invalid-feedback" id="error-product-name"></div>
              </div>
              <div class="form-group col-md-6">
                <label for="product-stock" class="text-muted">Stock Quantity</label>
                <input type="number" class="form-control" id="product-stock"/>
                <div class="invalid-feedback" id="error-product-stock"></div>
              </div>
            </div>
            <div class="form-group">
                <label for="product-category" class="text-muted">Category</label>
                <select class="custom-select form-control" id="product-category">
                  <?php
                  $query="SELECT * FROM PRODUCT_CATEGORY";
                  $parsed = oci_parse($connection, $query);
                  oci_execute($parsed);
                  while (($row = oci_fetch_assoc($parsed)) != false) {
                  ?>
                    <option value="<?php echo $row['CATEGORY_ID'];?>"><?php echo $row['CATEGORY_NAME']?></option>
                  <?php
                  }
                  ?>
                </select>
                <div class="invalid-feedback" id="error-product-category"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
              <label for="product-price" class="text-muted">Price</label>
                <input type="number" step="0.1" class="form-control" id="product-price" value=""/>
                <div class="invalid-feedback" id="error-product-price"></div>
              </div>
              <div class="form-group col-md-6">
              <label for="product-unit" class="text-muted">Pricing Unit</label>
                <input type="text" class="form-control" id="product-unit" value=""/>
                <div class="invalid-feedback" id="error-product-unit"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="product-min" class="text-muted">Minimum Order</label>
                <input type="number" class="form-control" id="product-min" value=""/>
                <div class="invalid-feedback" id="error-product-min"></div>
              </div>
              <div class="form-group col-md-6">
              <label for="product-max" class="text-muted">Maximum Order</label>
                <input type="number" class="form-control" id="product-max" value=""/>
                <div class="invalid-feedback" id="error-product-max"></div>
              </div>
            </div>
            <div class="form-group">
              <label for="product-descp" class="text-muted">Description</label>
                <textarea class="form-control" id="product-descp" value=""></textarea>
                <div class="invalid-feedback" id="error-product-descp"></div>
            </div>
            <div class="form-group">
              <label for="product-allergy" class="text-muted">Allergy Information</label>
                <textarea class="form-control" id="product-allergy" value=""></textarea>
                <div class="invalid-feedback" id="error-product-allergy"></div>
            </div>
            <div class="row justify-content-end pr-1">
              <button type="submit" class="btn" id="edit-prod-button">Save Changes</button>
            </div>  
          </form>
        </div>
      </div>
    </div>
  </div>
  </body>
  <script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="script/script.js"></script>
  <script src="../script/function.js"></script>
  <script src="script/form-valid.js"></script>
</html>