<?php
$host = "db4free.net";
$username = "reykmund";
$password = "123qwerty";
$dbname = "mmsucit";

$conn = new mysqli($host,$username,$password,$dbname);

if (mysqli_connect_error()){
    die('Cannot connect to the database('.mysqli_connect_error().')'.mysqli_connect_error());}
?>
