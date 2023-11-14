<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sign In</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .google-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #00cc00;
            color: #ffffff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .google-btn:hover {
            background-color: #00ff00; /* Darker shade of green on hover */
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
    <a href="#" class="google-btn">
        <div class="google-icon-wrapper">
            <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google logo">
        </div>
        <p class="btn-text"><b>Sign in with Google</b></p>
    </a>
</body>
</html>
