<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "HousePred";
$conn = mysqli_connect($host,$user,$password,$db);
if(!$conn){
    die("connection error").mysqli_connect_error();
}

?>