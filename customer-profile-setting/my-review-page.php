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
    <title>My Review</title>
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
                    <a href="..\wishlist-page.php" class="list-group-item">
                        <i class='bx bx-heart' ></i>
                        <span> &nbsp; My WishList</span>
                    </a>
                    <a href="my-review-page.php" class="list-group-item active">
                        <i class='bx bx-message-rounded-dots'></i>
                        <span> &nbsp; My Reviews</span>
                    </a>
                    <a href="" class="list-group-item rounded-bottom">
                        <i class='bx bx-exit bx-rotate-180' ></i>
                        <span> &nbsp; Sign Out</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9 d-flex justify-content-center align-items-start">
                <div class="row w-100 justify-content-center align-items-start">
                    <div class="col-12 mt-2">
                        <div class="setting-nav align-items-center pb-4">
                            <div class="border-bottom pt-3 pb-2 d-flex justify-content-center text-center">
                                <div class="col-md-6 my-green-font reviewed-select"><b><i class="fa-solid fa-comment-dots"></i>&nbsp;
                                        Review History</b></div>
                                <div class="col-md-6 to-review-select"><b><i class="fa-solid fa-comment-medical"></i>&nbsp; To Review</b>
                                </div>
                            </div>
                            <?php
                                $query="SELECT REVIEW_COMMENT, STAR_RATING, REVIEW_DATE, P.PRODUCT_ID AS PRODUCT_ID, PRODUCT_NAME FROM REVIEW R JOIN PRODUCT P ON P.PRODUCT_ID=R.PRODUCT_ID WHERE USER_ID=$cust_id ORDER BY REVIEW_DATE DESC";
                                $parsed_query=oci_parse($connection, $query);
                                oci_execute($parsed_query);
                               
                                while (($row = oci_fetch_assoc($parsed_query)) != false) {

                            ?>
                            <div class="row justify-content-center align-items-center reviewed-container transition-effect px-4 my-5">
                                <div class="col-2">
                                    <div class="review-profile-container">
                                        <a href="..\product-detail-page.php?pid=<?php echo $row['PRODUCT_ID']?>">
                                            <img src="..\image\product\<?php echo(getProductImage($row['PRODUCT_ID'],$connection)[0]); ?>" class="review-profile img-fluid" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-10 d-block justify-content-start">
                                    <div class="row w-100 text-muted">
                                        <div class="col-6 justify-content-start align-items-start text-left px-0">
                                            <?php 
                                                for($i=1; $i<=$row['STAR_RATING']; $i++)
                                                {
                                                ?>
                                            <i class='bx bxs-star'></i>
                                            <?php
                                                }
                                                for($i=1; $i<=(5-$row['STAR_RATING']); $i++)
                                                {
                                                ?>
                                            <i class='bx bx-star'></i>
                                            <?php
                                                }
                                                ?>
                                        </div>
                                        <div class="col-6 text-right px-0">
                                            <small><?php echo $row['REVIEW_DATE']; ?></small>
                                        </div>
                                    </div>
                                    <div class="row w-100 verification">
                                        <small><a href="..\product-detail-page.php?pid=<?php echo $row['PRODUCT_ID']?>"><?php echo $row['PRODUCT_NAME']; ?></a></small>
                                    </div>
                                    <div class="row w-100 text-left mt-1">
                                        <?php echo $row['REVIEW_COMMENT']->load(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                                oci_free_statement($parsed_query);
                            ?>

                            <?php

                                $query="SELECT DISTINCT REVIEW_ID, CO.ORDER_ID, ORDER_ITEM_ID,ITEM_QUANTITY, OI.PRODUCT_ID FROM CUST_ORDER CO 
                                JOIN ORDER_ITEM OI 
                                ON CO.ORDER_ID=OI.ORDER_ID
                                LEFT JOIN (SELECT * FROM REVIEW WHERE USER_ID=$cust_id) R
                                ON R.PRODUCT_ID=OI.PRODUCT_ID
                                WHERE CO.USER_ID=$cust_id
                                AND REVIEW_ID IS NULL
                                GROUP BY CO.ORDER_ID, ORDER_ITEM_ID, ITEM_QUANTITY,OI.PRODUCT_ID, REVIEW_ID
                                ORDER BY ORDER_ID";
                            
                                $parsed=oci_parse($connection,$query);
                            
                                oci_execute($parsed);
                                $count=0;
                                while (($row = oci_fetch_assoc($parsed)) != false) 
                                {
                                    $count++;
                                    $query2="SELECT * FROM PRODUCT WHERE PRODUCT_ID=".$row['PRODUCT_ID'];
                                    $parsed_query=oci_parse($connection, $query2);
                                    oci_execute($parsed_query);
                                    while (($row2= oci_fetch_assoc($parsed_query)) != false) {
                            ?>
                            <div class="row justify-content-center d-none align-items-center to-review-container transition-effect px-4 my-5">
                                <div class="col-2 pl-5">
                                    <div class="review-profile-container">
                                        <a href="..\product-detail-page.php?pid=<?php echo $row2['PRODUCT_ID']?>">
                                            <img src="..\image\product\<?php echo(getProductImage($row2['PRODUCT_ID'],$connection)[0]); ?>" class="review-profile img-fluid" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4 d-block justify-content-start">
                                    <div class="row w-100 text-muted">
                                        <div class="col-6 justify-content-start align-items-start text-left px-0">
                                            ORDER #<?php echo $row['ORDER_ID']?>
                                        </div>
                                       
                                    </div>
                                    <div class="row w-100 verification">
                                        <small><a href="..\product-detail-page.php?pid=<?php echo $row2['PRODUCT_ID']?>"><?php echo $row2['PRODUCT_NAME']; ?></a></small>
                                    </div>
                                </div>
                                <div class="col-6 d-block justify-content-start my-green-font">
                                    <span class="add-review" value="<?php echo $row2['PRODUCT_ID']?>"><i class="fa-solid fa-plus"></i> <b>ADD REVIEW</b><span>
                                </div>
                            </div>
                            <?php
                                    } 
                                }
                                // oci_free_statement($parsed_query);  
                                // oci_free_statement($parsed);
                                if($count<1)
                                {
                                    ?>
                                    <div class="text-center pt-3">No product to review.</div>
                                    <?php
                                }
                            ?>
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