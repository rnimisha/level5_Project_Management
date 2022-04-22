<?php
  include_once('../connection.php');
  if(isset($_SESSION['phoenix_user']) & !empty($_SESSION['phoenix_user']))
  {
  }
  // else{
  //   //redirect later
  // }
  
?>
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
                <a href="trader-index.php" class="list-group-item text-decoration-none active " >
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
                      <li class="breadcrumb-item"><a href="trader-index.php" ><b>My Profile</b></a></li>
                      <li class="breadcrumb-item active"><a href="#">About Me</a></li>
                      <li class="breadcrumb-item" aria-current="page"></li>
                    </ol>
                  </nav>
              </div>
              <!-- profile-->
              <div class="row" id="detail-container">
                <div class="col-12 form-container w-100 py-3">
                  <div class="row border-bottom d-flex justify-content-around align-items-center mt-1">
                    <div class="col-4 h5 active-form" id="about-me-div">
                      <i class="fa-solid fa-address-card"></i>
                      <span class="d-none d-sm-inline">About Me</span>
                    </div>
                    <div class="col-4 h5" id="setting-div">
                      <i class="fa-solid fa-gear"></i>
                      <span class="d-none d-sm-inline">Settings</span>
                    </div>
                  </div>

                  <!-- about me -->
                  <div class="row w-100 p-4 d-flex justify-content-center align-items-center" id="about-me">
                    <div class="col-lg-5">
                      <div class="col w-100 mb-3 d-flex justify-content-center align-items-center">
                        <div class="row w-75 mx-auto">
                          <img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>" alt="profile" id="about-profile"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <ul class="list-group list-group-flush my-1 text-uppercase">
                        <li class="list-group-item">
                          <span>
                            <i class="fa-solid fa-user-tag"></i> &nbsp;&nbsp;<?php  echo (isset($fullnames)) ? $fullnames : null;?>
                          </span>
                        </li>
                        <li class="list-group-item">
                          <span >
                            <i class="fa-solid fa-envelope-open-text"> &nbsp;&nbsp;</i> <?php  echo (isset($email)) ? $email : null;?>
                          </span>
                        </li>
                        <li class="list-group-item">
                          <span>
                            <i class="fa-solid fa-cake-candles"></i> &nbsp; &nbsp; <?php  echo (isset($dob)) ? $dob : null;?>
                          </span>
                        </li>
                        <li class="list-group-item">
                          <span>
                             <i class="fa-solid fa-location-dot"></i> &nbsp;  &nbsp; <?php  echo (isset($address)) ? $address : null;?>
                          </span>
                        </li>
                        <li class="list-group-item"><span><i class="fa-solid fa-phone"></i> &nbsp; &nbsp; <?php  echo (isset($contact)) ? $contact : null;?></span></li>
                      </ul>
                    </div>
                  </div>
                  <!-- profile setting category -->
                  <div class="row w-100 d-none" id="settings">
                    <div class="col-lg-2 col-md-3 border-right h-75">
                      <ul class="list-group list-group-flush my-1">
                        <li class="list-group-item" id="picture">Avatar</li>
                        <li class="list-group-item" id="personal">Personal</li>
                        <li class="list-group-item" id="pass-change">Password</li>
                      </ul>
                    </div>

                    <!-- profile picture change -->
                      <div id="picture-form"  class="col-lg-10 col-md-9 py-4  d-none">
                        <div class="alert alert-success mt-4 mb-2 w-75 mx-auto" id="profile-sucess-msg">
                          <strong>Success!</strong>Changes has been saved.
                        </div>
                        <div id="error-trad-pic" class="w-100">
                        </div>
                        <div class="row d-flex justify-content-center align-items-center w-100 ">
                          <!-- display pic -->
                          <div class=" col-lg-8 w-100 mb-3 d-flex justify-content-center align-items-center">
                            <div class="row w-50">
                              <img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>" alt="profile" id="changing-profile"/>
                            </div>
                          </div>
                          <div class="col-4 w-100">
                            <div class="row justify-content-center">
                              <form class="col-md-12" id="picture-form-del" action="form-valid.php" method="POST">
                                <input type="hidden" id="trader-id-profile" value="<?php  echo (isset($current_trader_id)) ? $current_trader_id : null;?>"/>
                                <!-- submit delete -->
                                <div class="row form-group prof-delete ">
                                  <button type="submit" class="btn w-100" id="profile-del-button"><i class="fa-solid fa-trash-can"></i><span class="d-none d-sm-inline">&nbsp; Delete Image</span></button>
                                </div> 
                              </form>
                              <form class="col-12" id="picture-form-up" action="form-valid.php" method="POST">
                                <input type="hidden" id="trader-id-profile2" name="trader-id-profile2" value="<?php  echo (isset($current_trader_id)) ? $current_trader_id : null;?>"/>
                                <div class="row form-group prof-upload ">
                                  <label for="trad-pic" class="btn w-100"><i class="fa-solid fa-upload"></i><span class="d-none d-sm-inline">&nbsp; Change Image</span></label>
                                  <input type="file" id="trad-pic" name="trad-pic" hidden/>
                                </div>
                                <!-- submit upload  -->
                                <div class="row justify-content-end mx-auto pr-1">
                                <button type="submit" class="btn" name="profile-button" id="profile-button" hidden>Save Changes</button>
                                </div>  
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                        
                      <!-- personal information change -->
                      <form class=" w-75 mx-auto py-4 d-none" id="personal-form" action="form-valid.php" method="POST">
                        <div class="alert alert-success mt-4 mb-n2 w-75 mx-auto" id="personal-sucess-msg">
                          <strong>Success!</strong>Changes has been saved.
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="trad-id" value="<?php  echo (isset($current_trader_id)) ? $current_trader_id : null;?>"/>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="trad-fullname" class="text-muted">Full Name</label>
                            <input type="text" class="form-control" id="trad-fullname" value="<?php  echo (isset($fullnames)) ? $fullnames : null;?>"/>
                            <div class="invalid-feedback" id="error-trad-fullname"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="trad-dob" class="text-muted">Date Of Birth</label>
                            <input type="date" class="form-control" id="trad-dob"/>
                            <div class="invalid-feedback" id="error-trad-dob"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="trad-email" class="text-muted">Email</label>
                            <input type="text" class="form-control" id="trad-email" value="<?php  echo (isset($email)) ? $email : null;?>"/>
                            <div class="invalid-feedback" id="error-trad-email"></div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="trad-contact" class="text-muted">Contact</label>
                            <input type="text" class="form-control" id="trad-contact" value="<?php  echo (isset($contact)) ? $contact : null;?>"/>
                            <div class="invalid-feedback" id="error-trad-contact"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="trad-dob" class="text-muted">Address</label>
                            <input type="text" class="form-control" id="trad-address" value="<?php  echo (isset($address)) ? $address : null;?>"/>
                            <div class="invalid-feedback" id="error-trad-address"></div>
                          </div>
                        </div>
                        <div class="row justify-content-end pr-1">
                          <button type="submit" class="btn" id="personal-button">Save Changes</button>
                        </div>  
                      </form>
                      <!-- password updation  -->
                      <form class=" w-75 mx-auto py-4 d-none" novalidate id="password-form" action="form-valid.php" method="POST">
                        <div class="alert alert-success mt-4 mb-n1 w-100 mx-auto" id="pass-sucess-msg">
                          <strong>Success!</strong>Changes has been saved.
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="trader-id" value="<?php  echo (isset($current_trader_id)) ? $current_trader_id : null;?>"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="trad-old-pass" placeholder="Old Password"/>
                            <div class="invalid-feedback" id="error-trad-old-pass"></div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <input type="password" class="form-control" id="trad-new-pass" placeholder="New Password"/>
                            <div class="invalid-feedback" id="error-trad-new-pass"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <input type="password" class="form-control" id="trad-re-pass" placeholder="Confirm New Password"/>
                            <div class="invalid-feedback" id="error-trad-re-pass"></div>
                          </div>
                        </div>
                        <div class="row justify-content-end mx-auto pr-1">
                          <button type="submit" class="btn" id="pass-button">Save Changes</button>
                        </div>  
                      </form>
                    </div>
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