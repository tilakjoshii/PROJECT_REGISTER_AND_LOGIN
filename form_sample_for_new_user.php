<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forms_for_register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .divpass {
            position: relative;

        }

        .spart {

            position: absolute;
            right: 20px;
            z-index: 1;

        }

        .open {
            display: none;
            margin-top: 7px;
        }
        .close {
            margin-top: 7px;
        }
            .button {
    width: 80PX;
    height: 33px;
    margin-top: 7px;
    border-radius: 5px;
    background-color: rgb(23, 125, 59);
    border: none;
    box-shadow: 0px 0px 1px 1px rgb(193, 173, 173);
    cursor: pointer;
    margin-left: 350px;
    color: white;
    text-decoration: none;
    padding: 6px 10px;
}

    </style>
</head>

<body>
    <div class="body">
        <h2> Student Register In College</h2>
        <p class="fontsize">Enter The Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
        <form action="register_user.php" id="forms" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">

            <div id="for_flex">
                <div>
                    <label for="firstname">First Name</label><br>
                    <input type="text" class="width" name="firstname" placeholder="e.g tilak" required>
                </div>
                <div>
                    <label for="lastname">Last Name</label><br>
                    <input type="text" class="width" name="lastname" placeholder="e.g joshi" required>
                </div>
            </div>

            <label for="email Address">Email Address</label><br>
            <input type="email" class="height" name="email" placeholder="e.g tilakjoshibaitadi@gmail.com" required>
            <div id="for_flex">
                <div>
                    <label for="PhoneNumber">PhoneNumber</label><br>
                    <input type="text" class="width" name="phone" placeholder="+9779863172583" required>
                </div>
                <div>
                    <label for="Website">Website</label><br>
                    <input type="text" class="width" name="website" placeholder="www.tilakjoshi.com.np" required>
                </div>
            </div>
            <div id="for_flex">
                <div class="divpass">
                    <label for="Passpword">Passpword</label><br>
                    <input id="pass" type="password" class="width" name="password" placeholder="" required>
                    <span class="spart" onclick="funclick1()"><i id="hide1" class="fa-regular fa-eye open"></i>
                        <i id="hide2" class="fa-regular fa-eye-slash close"></i></span>
                </div>
                <div class="divpass">
                    <label for="re type Passpword">Re-type Passpword</label><br>
                    <input id="pass1" type="password" class="width" name="repassword" placeholder="" required>
                    <span class="spart" onclick="funclick2()"><i id="hide11" class="fa-regular fa-eye open"></i>
                        <i id="hide22" class="fa-regular fa-eye-slash close"></i></span>
                </div>
            </div>
            <div id="for_flex">
                <div class="divpass">
                    <label for="uploadfile">Upload Profile Picture</label><br>
                    <input style="padding-top: 6px;" id="pass" type="file" class="width" accept=".jpg, .png, .jpeg" name="uploadfile" placeholder="" required>
                </div>
            </div>

            <label class="fontsize" for="checkbox"><input type="checkbox" id="termsCheckbox" class="check">Creating an account means you're
                okey with<a href="#">Terms and conditions</a> and <a href="#">Privacy Policy</a></label><br>
            <button class="button1">Register</button>
            <a class="button" href="index.php" >log in</a><br>
            <?php
            if (isset($_GET['error'])) {
                echo '<div style="color:red"; >' . $_GET['error'] . '</div>';
            } elseif(isset($_GET['success'])) {
                echo '<div class="echo">' . $_GET['success'] . '</div>';
            }
            ?>
        </form>
    </div>
    <script src="bjs.js">
    </script>
</body>

</html>