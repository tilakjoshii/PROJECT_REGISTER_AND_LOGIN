<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset template</title>
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
    <div class="container">
        <h1>Reset Password</h1>
        <p>Enter your new password below:</p>
        <form class="reset-form" action="reset_password.php" method="post">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>

            <label for="confirmPassword">Confirm Password:</label>
       <input type='hidden' id='email' name='email' value='<?php echo $_GET['email']?>'>

            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <button type="submit">Reset Password</button>

            <?php
            if (isset($_GET['error'])) {
                echo '<div style="color:red; padding-top:5px;">' . $_GET['error'] . '</div>';
            } elseif (isset($_GET['success'])) {
                echo '<div style="color:green; padding-top:5px;">' . $_GET['success'] . '</div>';
            }
            ?>
        </form>
        <p>If you did not request a password reset, you can ignore this message.</p>
    </div>
   
</body>
</html>