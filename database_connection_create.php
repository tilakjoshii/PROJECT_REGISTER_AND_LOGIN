<?php
$connect = new mysqli("localhost", "root", "");
if ($connect->connect_error) {
    die("server connection fail" . $connect->connect_error);
    exit();
} else {
    //  echo "server connection success"."<br>";
}
$sql="CREATE DATABASE IF NOT EXISTS registerinfo;";
if($connect->query($sql)==true){
    // echo "seccess create database"."<br>";
}else{
echo "error: ".$connect->error."<br>";
}
mysqli_select_db($connect, "registerinfo");

$sql="CREATE TABLE IF NOT EXISTS student(sn int(5) AUTO_INCREMENT primary key, firstname varchar(20),lastname varchar(20),email varchar(50),phonenumber varchar(20), website varchar(50),password varchar(100),repassword varchar(100) ,date_time timestamp,resettoken varchar(250),resettokenexpire DATE);";
if($connect->query($sql)==true){
    // echo "seccess create table"."<br>";
}else{
echo "error: ".$connect->error."<br>";
}

?>