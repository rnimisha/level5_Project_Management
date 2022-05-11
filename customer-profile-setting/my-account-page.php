<?php
  include_once('../connection.php');
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
    <link rel="stylesheet" type="text/css" href="style/cust-style.css" />
    <title>My Profile</title>
</head>
<body>
    <?php include_once('include-header.php');?>
    <div class="container setting-container mb-5">
        <div class="row w-100 mt-5">
            <div class="col-md-3 d-flex justify-content-start align-items-start pr-0 mt-2">
                <div class="list-group list-group-flush setting-nav w-100 setting-nav" id="sticky-nav">
                    <a href="cust-setting-index.php" class="list-group-item rounded-top">
                        <i class='bx bx-grid-alt' ></i>
                        <span> &nbsp; Dashboard</span>
                    </a>
                    <a href="my-account-page.php" class="list-group-item active">
                        <i class='bx bx-user' ></i>
                        <span> &nbsp; My Profile</span>
                    </a>
                    <a href="my-orders-page.php" class="list-group-item">
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
                        <i class='bx bx-exit bx-rotate-180' ></i>
                        <span> &nbsp; Sign Out</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9 d-flex justify-content-center align-items-start">
                <div class="row w-100 justify-content-center align-items-start">
                    <!-- change profile picture -->
                    <div class="col-lg-6 pr-3 mt-2">
                        <div class="setting-nav d-block justify-content-center align-items-center my-profile-container profile-row">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>Update Avatar</b></div>
                              <form action="validate-profile.php" method="POST" id="change-cust-pp-form" class="row justify-content-center align-itemms-center">
                                <div class="form-group">
                                  <input type="hidden" class="form-control" id="c_id" name="c_id" value="<?php echo $cust_id;?>" />
                                </div>
                                <div class="preview-img mb-1 mt-5 mx-auto">
                                  <img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>" class="img-fluid changing-profile"/>
                                </div>
                                <div class="form-group col-12 text-center">
                                  <label for="new-profile-pic" class="btn">Upload new picture</label><br>
                                  <input type="file" id="new-profile-pic" name="new-profile-pic" class="d-none">
                                  <div class="invalid-feedback" id="error-new-prod-pic"></div>
                                </div>
                                <div class="row d-none">
                                  <button type="submit" class="btn" id="change-profile-pic-btn">Change Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- change password -->
                    <div class="col-lg-6 mt-2">
                        <div class="setting-nav profile-row">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>Update Password</b></div>
                            <form class=" w-75 mx-auto py-4" novalidate id="update-password-form" action="validate-profile.php" method="POST">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="customer-id" value="<?php echo $cust_id;?>"/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="cust-old-pass" placeholder="Old Password"/>
                                    <div class="invalid-feedback" id="error-cust-old-pass"></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="cust-new-pass" placeholder="New Password"/>
                                    <div class="invalid-feedback" id="error-cust-new-pass"></div>
                                  </div>
                                  <div class="form-group">
                                    <input type="password" class="form-control" id="cust-re-pass" placeholder="Confirm New Password"/>
                                    <div class="invalid-feedback" id="error-cust-re-pass"></div>
                                  </div>
                                <div class="row justify-content-end mx-auto pr-1">
                                  <button type="submit" class="btn" id="change-pass-btn">Save Changes</button>
                                </div>  
                              </form>
                        </div>
                    </div>
                    <!-- change personal information -->
                    <div class="col-12 mt-4">
                        <div class="setting-nav align-items-center pb-4">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>Update Personal Information</b></div>
                            <form class=" w-75 mx-auto py-4" id="cust-personal-form" action="validate-profile.php" method="POST">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="cust-id" value="<?php echo $cust_id;?>"/>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="cust-fullname" class="text-muted">Full Name</label>
                                    <input type="text" class="form-control" id="cust-fullname" value="<?php  echo (isset($fullnames)) ? $fullnames : null;?>"/>
                                    <div class="invalid-feedback" id="error-cust-fullname"></div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="cust-dob" class="text-muted">Date Of Birth</label>
                                    <input type="date" class="form-control" id="cust-dob"/>
                                    <div class="invalid-feedback" id="error-cust-dob"></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="cust-email" class="text-muted">Email</label>
                                    <input type="text" class="form-control" id="cust-email" value="<?php  echo (isset($email)) ? $email : null;?>"/>
                                    <div class="invalid-feedback" id="error-cust-email"></div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="cust-contact" class="text-muted">Contact</label>
                                    <input type="text" class="form-control" id="cust-contact" value="<?php  echo (isset($contact)) ? $contact : null;?>"/>
                                    <div class="invalid-feedback" id="error-cust-contact"></div>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="cust-dob" class="text-muted">Address</label>
                                    <input type="text" class="form-control" id="cust-address" value="<?php  echo (isset($address)) ? $address : null;?>"/>
                                    <div class="invalid-feedback" id="error-cust-address"></div>
                                  </div>
                                </div>
                                <div class="row justify-content-end pr-1">
                                  <button type="submit" class="btn" id="cust-personal-button">Save Changes</button>
                                </div>  
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" id="preview-cust-pp" class="btn btn-primary d-none" data-toggle="modal" data-target="#popConfirm">
      Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="popConfirm" tabindex="-1" role="dialog" aria-labelledby="popConfirmTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="popConfirmTitle">Confirm Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center align-item-center">
            <img src="" id="cust-preview">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="upload-profile-confirm">Upload Image</button>
          </div>
        </div>
      </div>
    </div>
</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- custom script -->
<script src="../script/function.js"></script>
<script src="script/script.js"></script>
</html>