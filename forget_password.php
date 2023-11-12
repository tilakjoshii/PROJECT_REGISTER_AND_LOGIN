<?php
require_once 'database_connection_create.php';
require_once 'PHPmailer/PHPMailer.php';
require_once 'PHPmailer/SMTP.php';
require_once 'PHPmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $resetToken)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'developertapin@gmail.com';
        $mail->Password = 'kpft odlk jhij pmlh';
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('developertapin@gmail.com', 'Developer');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Password Reset';
        $mail->Body = "We got a request from you to reset the password! <br>
        Click The Link Below for reset Password <br>
        <a href='http://localhost/PROJECT_REGISTER_AND_LOGIN/reset_password.php?email=$email&&resetToken=$resetToken'>'>Click Here for Reset Password </a>";

        if ($mail->send()) {
            header('Location: forget_password.php?success=Password reset link sent to your email.');
            exit();
        } else {
            header('Location: forget_password.php?error=Error sending email. Please try again later. Error: ' . $mail->ErrorInfo);
            exit();
        }
    } catch (Exception $e) {
        header('Location: forget_password.php?error=Error sending email. Please try again later. Exception: ' . $e->getMessage());
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $connect->prepare("SELECT * FROM student WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $resetToken = bin2hex(random_bytes(32));
        date_default_timezone_set('Asia/Kathmandu');
        $date = date("y-m-d");

        $query = "UPDATE `student` SET resettoken=?, `resettokenexpire`=? WHERE `email`=?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sss", $resetToken, $date, $email);

        if ($stmt->execute()) {
            sendMail($email, $resetToken);
        } else {
            header('Location: forget_password.php?error=Error updating database. Please try again later.');
            exit();
        }
    } else {
        header('Location: forget_password.php?error=Email not found. Please try again.');
        exit();
    }
}

// Close the database connection
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
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

        .email-box {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Password Reset</h1>
        <p>Enter your email address below to receive a password reset link:</p>
        <form class="reset-form" action="#" method="post">
            <label for="userEmail">Email:</label>
            <input type="email" id="userEmail" name="email" required>
            <button type="submit">Send Reset Link</button>
            <?php
            if (isset($_GET['error'])) {
                echo '<div style="color:red"; >' . $_GET['error'] . '</div>';
            } elseif (isset($_GET['success'])) {
                echo '<div style="color:green";>' . $_GET['success'] . '</div>';
            }
            ?>
        </form>
        <p>If you did not request a password reset, you can ignore this message.</p>
    </div>
</body>

</html>