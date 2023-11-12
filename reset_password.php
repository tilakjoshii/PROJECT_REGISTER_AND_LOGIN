
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset password</title>
    <style>

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        .reset-form {
            margin-bottom: 20px;
        }

        .reset-form label {
            display: block;
            margin-bottom: 5px;
        }

        .reset-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border-radius: 4px;
        }

        .reset-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .reset-form button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>

</head>
<body>
<?php
require_once 'database_connection_create.php';
if (isset($_GET['email']) && isset($_GET['resetToken'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $date = date("y-m-d");
    $email = $_GET['email'];
    $resetToken = $_GET['resetToken'];
   
    $query = "SELECT * FROM student WHERE email = '$email' AND resettoken = '$resetToken' AND resettokenexpire = '$date'";
    $result =mysqli_query($connect,$query);
    if (mysqli_num_rows($result)==1) {
    //     echo "<div class='container'>
    //     <h1>Reset Password</h1>
    //     <p>Enter your new password below:</p>
    //     <form class='reset-form' action='reset_password.php' method='post'>
    //         <label for='newPassword'>New Password:</label>
    //         <input type='password' id='newPassword' name='newPassword' required>

    //         <label for='confirmPassword'>Confirm Password:</label>
    //         <input type='password' id='confirmPassword' name='confirmPassword' required>
    //         <input type='hidden' id='email' name='email' value='$_GET[email]'>
            
    //         <button type='submit'>Reset Password</button>
    //     </form>
    //     <p>If you did not request a password reset, you can ignore this message.</p>
    // </div>";
    header("location:reset_template.php?email=$email");
exit();
    }
    else{
        header('location:invalid_passwordphp.php');
exit();
    }
 
}
?>
<?php
if (isset($_POST['newPassword'])) {
    $password = $_POST['newPassword'];
    $repassword = $_POST['confirmPassword'];
   $email=$_POST['email'];
    if ($password === $repassword && strlen($password) >= 8) {
        $h_password = password_hash($password, PASSWORD_DEFAULT);
        $h_repassword = password_hash($repassword, PASSWORD_DEFAULT);
        // Use prepared statements to prevent SQL injection
        $updateQuery = "UPDATE `student` SET `password`='$h_password',`repassword`='$h_repassword',`resettoken`=NULL,`resettokenexpire`=NULL WHERE `email`= '$_POST[email]'";
        if ($connect->query($updateQuery)) {
            echo"<script>
            alert('Reset successfully');
           window.location.href='index.php';
            </script>";
            // header("location:reset_template.php?success=Reset successfully");
            exit();
        } else {
            $error = "Error: " . $connect->error;
            header("location:reset_template.php?error=$error&email=$email");
            exit();
        }
    } else {
        header("location:reset_template.php?error=Passwords do not match or length is less than 8 characters&email=$email");
        exit();
    }
}
else{
    // echo "error fromm reset";
}
?>
</body>
</html>