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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login_Form</title>
    <style>
        .divpass {
            position: relative;

        }

        .spart {
            position: absolute;
            left: 320px;
            top: 13px;
            z-index: 1;


        }

        .open {
            display: none;
        }
    </style>

</head>

<body>
    <div class="row">
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
            if (isset($_GET['error'])) {
                echo '<div style="color:red; padding-bottom: .5rem;" >' . $_GET['error'] . '</div>';
            } elseif(isset($_GET['success'])) {
                echo '<div style="color:green;">' . $_GET['success'] . '</div>';
            }
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

    </div>
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