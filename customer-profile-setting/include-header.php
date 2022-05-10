<?php
  include_once('../connection.php');
  if(isset($_SESSION['phoenix_user']) && !empty(($_SESSION['phoenix_user'])))
  {
        $cust_id=$_SESSION['phoenix_user'];
        $getUser= "SELECT * from mart_user where user_id=$cust_id";
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
?>

<div class="container-fluid p-0">
        <div class="row p-0 m-0 w-100 mt-5 cust-profile-img-container">
            <div class="col-2 mx-auto text-center">
                <img src="..\image\profile\<?php  echo (isset($profile_pic) && !empty($profile_pic)) ? $profile_pic: 'default_profile.jpg';?>"  alt="profile" class="img-fluid cust-profile-img"/>
                <div class="mb-4"><?php  echo (isset($fullnames)) ? $fullnames : null;?> </div>
            </div>
        </div>
</div>