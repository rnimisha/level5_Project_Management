<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="script/script.js"></script>
    <script src="../script/function.js"></script>
    <script src="script/form-valid.js"></script>
    <title>Trader</title>
  </head> 
  <body>
    <div class="container-fluid ">
      <!-- header logo and name -->
        <div class="row" id="header">
            <div class="col-lg-2 col-md-3 d-flex justify-content-center align-items-center" id="logo-header">
              <div class=" col-sm-1 d-md-none mr-auto px-3">
                <i class='bx bx-menu-alt-left'></i>
              </div>
                <div class="col-sm-11 col-md-12 d-flex justify-content-center align-items-center">
                  <img src="image/logo.png"  alt="logo" />
                </div>
            </div>
            <div class="col-md-1  d-none d-md-flex justify-content-start align-items-center " >
              <i class='bx bx-menu d-none' id="right-toggle" ></i>
              <i class='bx bx-menu-alt-left d-block' id="left-toggle"></i>
            </div>
            <div class="col-lg-2 col-md-4 ml-auto d-none d-md-flex justify-content-center align-items-center">
              <div class="row ">
                <div class="col-3 pt-1">
                  <span><img src="image/profile.jpg" alt="profile" id="profile-header" /></span>
                </div>
                <div class="col-9">
                  <div class="h6 mt-1">Trader</div>
                  <div class="mt-n2"><small class="text-muted">kjennie@gmail.com</small></div>
                </div>
              </div>
            </div>
        </div>
        <!-- main body with nav and main container -->
        <div class="row" id="main-body">
          <!-- navigation -->
            <div class="col-lg-2 col-md-3 d-none d-md-flex justify-content-center align-items-center nav-side" id="nav1">
              <div class="list-group list-group-flush my-3 nav-list">
                <div class="d-flex justify-content-center">
                  <img src="image/profile.jpg"  alt="profile"  id="profile-picture"/>
                </div>
                <!-- <a href="#" class="list-group-item text-decoration-none active" >
                  <i class='bx bxs-dashboard'></i></i>
                  Dashboard
                </a> -->
                <a href="#" class="list-group-item text-decoration-none active " >
                  <i class="fa-solid fa-user"></i>
                  <span class="hide-text">Profile</span>
                </a>
                <a href="#" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-cart-shopping"></i>
                  <span class="hide-text">Order</span>
                </a>
                <a href="#" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-basket-shopping"></i>
                  <span class="hide-text">Product</span>
                </a>
                <a href="#" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-store"></i>
                  <span class="hide-text">Shop</span>
                </a>
                <a href="#" class="list-group-item text-decoration-none" >
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  <span class="hide-text">Sign out</span>
                </a>
              </div>
            </div>
            <!-- main trader interface -->
            <div class="col-lg-10 col-md-9 main-container">
              <!-- breadcrumb -->
              <div class="col-11 mx-auto mt-4">
                <div class="row w-100 h6 pl-1 d-flex align-items-center">
                  <span class="h5 mt-1" ><b>My Profile</b></span>
                  <i class='bx bx-chevron-right align-self-center'></i>
                  <span class="pb-1">Setting</span>
                  <i class='bx bx-chevron-right align-self-center'></i>
                  <span class="pb-1" id="page-link">Personal</span>
              </div>
              <!-- profile-->
              <div class="row">
                <div class="col-12 form-container w-100 py-3">
                  <div class="row border-bottom d-flex justify-content-around align-items-center mt-1">
                    <div class="col-4 h5">
                      <i class="fa-solid fa-address-card"></i>
                      About Me
                    </div>
                    <div class="col-4 h5 active-form">
                      <i class="fa-solid fa-gear"></i>
                      Settings
                    </div>
                  </div>
                  <!-- profile setting category -->
                  <div class="row w-100">
                    <div class="col-lg-2 col-md-3 border-right">
                      <ul class="list-group list-group-flush my-1">
                        <li class="list-group-item" id="picture">Picture</li>
                        <li class="list-group-item active-list" id="personal">Personal</li>
                        <li class="list-group-item" id="pass-change">Password</li>
                      </ul>
                    </div>
                    <!-- profile picture change -->
                    <div class="col-lg-10 col-md-9 d">
                      <form class="w-75 mx-auto py-4 d-none needs-validation"  novalidate id="picture-form" action="form-valid.php" method="POST" enctype="multipart/form-data">
                        <div class="alert alert-success mt-4 mb-n2 w-75 mx-auto" id="profile-sucess-msg">
                          <strong>Success!</strong>Changes has been saved.
                        </div>
                        <div id="error-trad-pic">
                        </div>
                        <div class="form-group">
                          <!-- <label for="trad-pic" class="text-muted"></label> -->
                          <input type="file" class="form-control" id="trad-pic" name="trad-pic"/>
                        </div>
                        <div class="row justify-content-end mx-auto pr-1">
                          <button type="submit" class="btn" name="profile-button" id="profile-button">Save Changes</button>
                        </div>  
                      </form>
                      <!-- personal information change -->
                      <form class=" w-75 mx-auto py-4" id="personal-form" action="form-valid.php" method="POST">
                        <div class="alert alert-success mt-4 mb-n2 w-75 mx-auto" id="personal-sucess-msg">
                          <strong>Success!</strong>Changes has been saved.
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="trad-id"/>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="trad-fullname" class="text-muted">Full Name</label>
                            <input type="text" class="form-control" id="trad-fullname"/>
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
                            <input type="text" class="form-control" id="trad-email"/>
                            <div class="invalid-feedback" id="error-trad-email"></div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="trad-contact" class="text-muted">Contact</label>
                            <input type="text" class="form-control" id="trad-contact"/>
                            <div class="invalid-feedback" id="error-trad-contact"></div>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="trad-dob" class="text-muted">Address</label>
                            <input type="text" class="form-control" id="trad-address"/>
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
                            <input type="hidden" value="4" class="form-control" id="trader-id"/>
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

</html>