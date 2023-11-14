<?php
require_once 'database_connection_create.php';
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter']++;
}
if (isset($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    // ******file details*****************
    $file_name = $_FILES['uploadfile']['name'];
    $type = $_FILES['uploadfile']['type'];
    $size = $_FILES['uploadfile']['size'];
    $temp_name = $_FILES['uploadfile']['tmp_name'];
    $error = $_FILES['uploadfile']['error'];
   $custom_name="user_upload_image";
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    // move_uploaded_file($temp_name,"C:/xampp/htdocs/PROJECT_REGISTER_AND_LOGIN/images/".$file_name);
    move_uploaded_file($temp_name, "C:/xampp/htdocs/PROJECT_REGISTER_AND_LOGIN/images/".$custom_name. $_SESSION['counter'] . "." . $extension);
    $image="images/".$custom_name.$_SESSION['counter'].".".$extension;

    // ******file details end*****************

    $h_password = password_hash($password, PASSWORD_DEFAULT);
    $h_repassword = password_hash($repassword, PASSWORD_DEFAULT);
    // require_once 'Database_table_create.php';

    $sql = "SELECT * FROM student WHERE email= '{$_POST['email']}' ";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        header('location:form_sample_for_new_user.php?error="email address is already exits"');
        // echo '<div style="color:red;">'."email address is already exits"."</div";
        exit();
    }
    if ($password == $repassword && strlen($password) >= 8) {
        $sql = "INSERT INTO `student` (`firstname`, `lastname`, `email`, `phonenumber`, `website`,`images`, `password`, `repassword`, `date_time`) VALUES ('$firstname', '$lastname', '$email', '$phone', '$website','$image', '$h_password', '$h_repassword', current_timestamp());";
    } else {
        // echo '<div style="color:red;">' . "Don't Match Re-wite Password OR You enter less than 8 character password" . " </div>" . "<br>";
        header('location:form_sample_for_new_user.php?error="Not Match Re-write Password OR You enter less than 8 character"');
        exit();
    }
    if ($connect->query($sql) == true) {
        echo "success" . "<br>";
        header('location:form_sample_for_new_user.php?success="Register successfully"');
        exit();
    } else {
        $error = "error:" . $connect->error;
        header('location:form_sample_for_new_user.php?error=error');
    }
    // echo "Success Data Entry"."<br>";
} else {
    echo "No found any data" . "<br>";
}
$connect->close();
?>