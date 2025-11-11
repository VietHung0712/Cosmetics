<?php
require_once "../php/connect.php";
if(isset($_GET['this_cart'])){
    $this_cart = $_GET['this_cart'];
    $sql = "DELETE FROM `user_cart` WHERE id = " . $this_cart;
    $result = $connect->query($sql);
    $result = mysqli_query($connect, $sql);
    if ($result) {
        header("Location: ../user_cart.php");
        exit();
    }
}
?>