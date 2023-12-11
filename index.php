<?php
require_once 'database_connection_create.php';
session_start();

if (isset($_POST['user'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = " SELECT * FROM student WHERE email='{$_POST['user']}'";
    $result = $connect->query($sql);
    $count = $result->num_rows;
    if ($count > 0) {
        $data = $result->fetch_assoc();
        $verify = password_verify($pass, $data['password']);
        // echo "error: " . $verify;
        if ($verify == 1) {
            $_SESSION['username'] = $data;
            // echo "correct password";
            header('location:table.php?success="you login successfully"');
            exit();
        } else {
            // echo "enter correct password";
            header('location:index.php?error=enter correct password');
        }
    } else {
        // echo "enter correct email address";
        header('location:index.php?error=enter correct email address');
    }

    $connect->close();
}
?>
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
 }
}
 if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style1.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style11.css">
    <title>Login_Form</title>
    <style>
        .divpass {
            position: relative;

        }

        .spart {
            position: absolute;
            right: 38px;
            top: 15px;
            z-index: 100;


        }

        .spart i {
            font-size: 1.2rem;
        }

        .open {
            display: none;
        }
    </style>
    <style>
        a{
            text-decoration: none;
            color: white;
        }
        .google-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #00ff00;
            color: #ffffff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            justify-content: center;
        }

        .google-btn:hover {
            background-color: #00cc00;
            /* Darker shade of green on hover */
        }

        .google-icon-wrapper {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .google-icon {
            width: 100%;
            height: 100%;
        }

        .btn-text {
            font-size: 14px;
        }
    </style>


</head>

<body>
    
    <!-- <div class="row">
        <div class="facebook-text">
            <h1>SNSC Student</h1>
            <p>Connect with our group or the college <br> around you on campus.</p>
        </div>
        <div class="box">
            <form class="form-box" action="#" method="post">
                <input type="username" name="user" placeholder="Email or phone number">
                <div class="divpass">
                    <input id="pass" type="password" name="pass" placeholder="Password">
                    <span class="spart" onclick="funclick1()"><i id="hide1" class="fa-regular fa-eye open"></i>
                        <i id="hide2" class="fa-regular fa-eye-slash close"></i></span>
                </div>
                <button class="button" type="submit">log in</button> <br>
                <?php
                // if (isset($_GET['error'])) {
                //     echo '<div style="color:red; padding-bottom: .5rem;" >' . $_GET['error'] . '</div>';
                // } elseif(isset($_GET['success'])) {
                //     echo '<div style="color:green;">' . $_GET['success'] . '</div>';
                // }
                ?>
                <a href="forget_password.php">forget password?</a>
            </form>
            <div class="create">
                <button>
                <a style="text-decoration: none; color:aliceblue;" href="form_sample_for_new_user.php"> Create new account</a>
                </button>
            </div>
            <div class="faltu">
                <p><a href="#">Create a page</a> for a celebrity, brand or business.</p>
            </div>
        </div>

    </div> -->
    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span>

        <form action="#" method="post" class="signin">

            <div class="content">

                <h2>Sign In</h2>

                <div class="form">

                    <div class="inputBox">

                        <input name="user" type="username" required> <i class="i">Username</i>

                    </div>

                    <div class="inputBox">

                        <input id="pass" name="pass" type="password" required> <i class="i">Password</i>
                        <small class="spart" onclick="funclick1()"><i id="hide1" class="fa-regular fa-eye open"></i>
                            <i id="hide2" class="fa-regular fa-eye-slash close"></i></small>
                    </div>
                    <?php
                    if (isset($_GET['error'])) {
                        echo '<div style="color:red; padding-bottom: .5rem;" >' . $_GET['error'] . '</div>';
                    } elseif (isset($_GET['success'])) {
                        echo '<div style="color:green;">' . $_GET['success'] . '</div>';
                    }
                    ?>
                    <div class="links"> <a href="forget_password.php">Forgot Password</a> <a href="form_sample_for_new_user.php">Signup</a>

                    </div>

                    <div class="inputBox">

                        <input type="submit" value="Login">

                    </div>
                    <div class="google-btn">
                        <div class="google-icon-wrapper">
                            <img class="google-icon" src="https://fonts.gstatic.com/s/i/productlogos/googleg/v6/24px.svg" alt="Google logo">
                        </div>
                       <?php
            
                        echo '<p class="btn-text">'.'<b>'.$login_button.'</b></p>'; 
                         ?>
                    </div>
                </div>

            </div>

        </form>

    </section> <!-- partial -->

</body>
<script>
    function funclick1() {
        var pass = document.getElementById('pass');
        var open = document.getElementById('hide1');
        var close = document.getElementById('hide2');
        if (pass.type === 'password') {
            pass.type = "text";
            open.style.display = "block";
            close.style.display = "none";
        } else {
            pass.type = "password";
            open.style.display = "none";
            close.style.display = "block";
        }
    }
</script>

</html>