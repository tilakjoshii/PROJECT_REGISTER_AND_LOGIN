<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "registerinfo";

$connect = new mysqli($server, $username, $password,$database);
if ($connect->connect_error) {
    die("server connection fail" . $connect->connect_error);
    exit();
} else {
    //  echo "server connection success"."<br>";
}
?>