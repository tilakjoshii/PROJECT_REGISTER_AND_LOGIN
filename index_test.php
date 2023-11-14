<?php

//index.php

//Include Configuration File
include('sign_in_with_google.php');

$login_button = '';
session_start();
$google_client->addScope('https://www.googleapis.com/auth/user.phonenumbers.read');

if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
  if (!empty($data['phone_number'])) {
    $_SESSION['user_phone_number'] = $data['phone_number'];
 }
 }
}
?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">PHP Login using Google Account</h2>
   <br />
   <div class="panel panel-default">
   <?php
   if(isset($_SESSION['user_email_address']))
   {
       require_once 'database_connection_create.php';
    $firstname = $_SESSION['user_first_name'];
    $lastname = $_SESSION['user_last_name'];
    $email = $_SESSION['user_email_address'];
    $phonenumber = $_SESSION['user_phone_number'];
    $images = $_SESSION['user_image'];
    // require_once 'Database_table_create.php';
    $sql = "SELECT * FROM student WHERE email= '{$_SESSION['user_email_address']}' ";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $firstname;
        header('location:table.php?success="login successfully with google already registered gmail"');
        // echo '<div style="color:red;">'."email address is already exits"."</div";
        exit();
    }
    
        $sql = "INSERT INTO `student` (`firstname`, `lastname`, `email`, `phonenumber`, `website`,`images`, `password`, `repassword`, `date_time`) VALUES ('$firstname', '$lastname', '$email', '$phonenumber', NULL,'$images', NULL, NULL, current_timestamp());";
   
    if ($connect->query($sql) == true) {
        $_SESSION['username'] = $firstname;
        header('location:table.php?success="login successfully with google"');
        exit();
    } else {
        $error = "error:" . $connect->error;
        header("location:index.php?error=$error");
    }
   }
   else
   {
    header('location:index.php?error= not set user_email_address');
   }
   ?>
   </div>
  </div>
 </body>
</html>

