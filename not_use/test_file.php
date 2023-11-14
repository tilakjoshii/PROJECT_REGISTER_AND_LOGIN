<?php
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter']++;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];

    $custom_name="user_upload_image";
    // Get the file extension using pathinfo
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    // Output the file extension
    echo "File Extension: $extension <br>";

    // Move uploaded file to the destination folder with an incremented name
    move_uploaded_file($temp_name, "C:/xampp/htdocs/PROJECT_REGISTER_AND_LOGIN/images/".$custom_name. $_SESSION['counter'] . "." . $extension);

    $image=$custom_name.$_SESSION['counter'].".".$extension;
    echo $image;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="#" method="POST" enctype="multipart/form-data">
   <input type="file" name="file">
   <input type="submit" value="submit">
</form>
</body>
</html>
