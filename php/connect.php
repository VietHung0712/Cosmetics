<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_mypham";

$connect = mysqli_connect($servername, $username, $password, $dbname);

if ($connect->connect_error) {
    die("Kết nối thất bại: " . $connect->connect_error);
}
?>