<?php
  include_once('../connection.php');
  if(isset($_SESSION['phoenix_user']) & !empty($_SESSION['phoenix_user']))
  {
    $current_trader_id=$_SESSION['phoenix_user'];
    $getUser= "SELECT * from mart_user where user_id=$current_trader_id";
    $parsedGetUser = oci_parse($connection, $getUser);
    oci_execute($parsedGetUser);
    while (($row = oci_fetch_assoc($parsedGetUser)) != false) {
        $email= $row['EMAIL'];
        $fullnames=$row['NAME'];
        $contact=$row['CONTACT'];
        $address=$row['ADDRESS'];
        $profile_pic=$row['PROFILE_PIC'];
        $dob=date('d-F-Y', strtotime($row['DOB']));
    }
    oci_free_statement($parsedGetUser);
  }
  // else{
  //   //redirect later
  // }
?>

<div class="row" id="header">
    <div class="col-lg-2 col-md-3 d-flex justify-content-center align-items-center" id="logo-header">
        <div class=" col-sm-1 d-md-none mr-auto px-3">
            <i class='bx bx-menu-alt-left' id="small-toggle"></i>
            <i class='fa-solid fa-xmark d-none' id="close-toggle"></i>
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
            <span><img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>" alt="profile" id="profile-header" /></span>
        </div>
        <div class="col-9">
            <div class="h6 mt-1">Trader</div>
            <div class="mt-n2"><small class="text-muted"><?php  echo (isset($email)) ? $email : null;?></small></div>
        </div>
        </div>
    </div>
</div>