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
  if(isset($_SESSION['phoenix_user']) && !empty(($_SESSION['phoenix_user'])) && $_SESSION['user_role']=='C')
  {
      $cust_id=$_SESSION['phoenix_user'];
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
    <title>Track My Order</title>
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
                    <a href="my-account-page.php" class="list-group-item">
                        <i class='bx bx-user' ></i>
                        <span> &nbsp; My Profile</span>
                    </a>
                    <a href="my-orders-page.php" class="list-group-item">
                        <i class='bx bx-package'></i>
                        <span> &nbsp; My Orders</span>
                    </a>
                    <a href="track-order-page.php" class="list-group-item active">
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
                    <a href="..\logout.php" class="list-group-item rounded-bottom">
                        <i class='bx bx-exit bx-rotate-180' ></i>
                        <span> &nbsp; Sign Out</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9 d-flex justify-content-center align-items-start">
                <div class="row w-100 justify-content-center align-items-start">
                    <div class="col-12 mt-2">
                        <div class="setting-nav align-items-center pb-4 order-cust-container">
                            <div class="border-bottom text-center pt-3 pb-2 my-green-font"><b>Track My Order</b></div>
                            <div class="justify-content-center align-items-center row track-order-container mt-5">
                                <div class="col-2 text-right track-icons">
                                    <i class="fa-solid fa-clock-rotate-left mb-2 grey-bg"></i>
                                    Pending
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 line-grey">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-box-open mb-2 grey-bg"></i>
                                    Processing
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 line-grey">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-truck-ramp-box mb-2 grey-bg"></i>
                                    Completed
                                </div>
                            </div>

                            <div class="d-none justify-content-center align-items-center row pending-container mt-5">
                                <div class="col-2 text-right track-icons">
                                    <i class="fa-solid fa-clock-rotate-left mb-2 light-green-font"></i>
                                    Pending
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 line-grey">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-box-open mb-2 grey-bg"></i>
                                    Processing
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 line-grey">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-truck-ramp-box mb-2 grey-bg"></i>
                                    Completed
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <b>Order is pending. Please wait for next update</b>
                                </div>
                            </div>

                            <div class="d-none justify-content-center align-items-center row processing-container mt-5">
                                <div class="col-2 text-right track-icons">
                                    <i class="fa-solid fa-clock-rotate-left mb-2 light-green-font"></i>
                                    Pending
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 light-green-bg">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-box-open mb-2 light-green-font"></i>
                                    Processing
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 line-grey">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-truck-ramp-box mb-2 grey-bg"></i>
                                    Completed
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <b>Your order is currently being proccessed.</b>
                                </div>
                            </div>

                            <div class="d-none justify-content-center align-items-center row completed-container mt-5">
                                <div class="col-2 text-right track-icons">
                                    <i class="fa-solid fa-clock-rotate-left mb-2 light-green-font"></i>
                                    Pending
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 light-green-bg">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-box-open mb-2 light-green-font"></i>
                                    Processing
                                </div>
                                <div class="col-2">
                                    <hr class="w-100 light-green-bg">
                                </div>
                                <div class="col-2 track-icons">
                                    <i class="fa-solid fa-truck-ramp-box mb-2 light-green-font"></i>
                                    Completed
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <b>Your order has been completed.</b>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center row track-order-container mt-5">
                                <form class=" w-75 mx-auto py-4" novalidate id="track-order-form" action="validate-profile.php" method="POST">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="customer-id" value="<?php echo $cust_id;?>"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="track-order-no" placeholder="Order Number"/>
                                        <div class="invalid-feedback" id="error-track-order-no"></div>
                                    </div>
                                    <div class="row justify-content-end mx-auto pr-1">
                                    <button type="submit" class="btn" id="track-order-btn">Track</button>
                                    </div>  
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" id="show-review-form-btn" class="btn btn-primary d-none" data-toggle="modal" data-target="#ReviewFormContainer">
      Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="ReviewFormContainer" tabindex="-1" role="dialog" aria-labelledby="ReviewFormContainerTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center mx-auto" id="popConfirmTitle">Write Your Review</h5>
            <button type="button" class="close  close-review" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center align-item-center">
          <form id="review-form" action="submit-review.php" method="POST" class="w-75 text-center mt-4">
            <div class="form-group">
                <input type="hidden" class="form-control" id="review_prod_id"/>
                <input type="hidden" class="form-control" id="u_id" value="<?php echo $cust_id;?>"/>
                    <div>
                        <i class="fa-solid fa-star rate-star" data-index="0"></i>
                        <i class="fa-solid fa-star rate-star" data-index="1"></i>
                        <i class="fa-solid fa-star rate-star" data-index="2"></i>
                        <i class="fa-solid fa-star rate-star" data-index="3"></i>
                        <i class="fa-solid fa-star rate-star" data-index="4"></i>
                    </div>
                    <input type="hidden" class="form-control" id="star-rating"/>
                    <div class="invalid-feedback" id="error-star"></div>
                </div>
                <div class="form-group">
                    <textarea name="prod-review" class="form-control" id="prod-review" placeholder="Comment"></textarea>
                    <span id="error_prod-review" style="color: red"></span><br/>
                </div>
                <div class="row d-none w-100 justify-content-end submit-contact">
                    <input type="submit" class="btn py-2 px-4" id="submit-my-review" name="contactus" value="Send"/>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="submit-review-btn">Submit</button>
          </div>
        </div>
      </div>
    </div>


</body>
<!-- external script -->
<script src="https://kit.fontawesome.com/d24fa4b820.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<!-- custom script -->
<script src="../script/function.js"></script>
<script src="script/script.js"></script>
</html>