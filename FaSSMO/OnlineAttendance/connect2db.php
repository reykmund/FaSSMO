<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "cit";

$conn = new mysqli($host,$username,$password,$dbname);

if (mysqli_connect_error()){
    die('Cannot connect to the database('.mysqli_connect_error().')'.mysqli_connect_error());}
?>