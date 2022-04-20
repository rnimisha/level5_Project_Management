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
            <span><img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>" alt="profile" id="profile-header" /></span>
        </div>
        <div class="col-9">
            <div class="h6 mt-1">Trader</div>
            <div class="mt-n2"><small class="text-muted"><?php  echo (isset($email)) ? $email : null;?></small></div>
        </div>
        </div>
    </div>
</div>