<?php
 require_once 'database_connection_create.php';
$id=$_GET['sn'];

$sql="DELETE FROM student WHERE sn=$id";
$connect->query($sql);
header('location:table.php?success="delete data successfully"');
?>