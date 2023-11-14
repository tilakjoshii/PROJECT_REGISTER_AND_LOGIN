<?php

//index.php

//Include Configuration File
include('sign_in_with_google.php');

$login_button = '';


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
   echo $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   echo $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}

?>
<?php
if ($login_button == '') {
    require_once 'database_connection_create.php';
    $firstname = $_SESSION['user_first_name'];
    $lastname = $_SESSION['user_last_name'];
    $email = $_SESSION['user_email_address'];
    // require_once 'Database_table_create.php';
    $sql = "SELECT * FROM student WHERE email= '{$_SESSION['user_email_address']}' ";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        header('location:index.php?error="email address is already exits"');
        // echo '<div style="color:red;">'."email address is already exits"."</div";
        exit();
    }
    
        $sql = "INSERT INTO `student` (`firstname`, `lastname`, `email`, `phonenumber`, `website`, `password`, `repassword`, `date_time`) VALUES ('$firstname', '$lastname', '$email', NULL, NULL, NULL, NULL, current_timestamp());";
   
    if ($connect->query($sql) == true) {
        header('location:table.php?success="login successfully with google api"');
        exit();
    } else {
        $error = "error:" . $connect->error;
        header("location:index.php?error=$error");
    }
    // echo "Success Data Entry"."<br>";
} 
else{


}
$connect->close();
?>