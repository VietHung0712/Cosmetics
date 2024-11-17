<?php
require_once "../php/connect.php";
if(isset($_GET['this_cart'])){
    $this_cart = $_GET['this_cart'];
    $sql = "DELETE FROM `user_cart` WHERE id = ?";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("i", $this_cart);
        if ($result->execute()) {
            header("Location: ../user_cart.php");
            exit();
        } else {
            echo "<script>alert('Đã có lỗi!')</script>";
        }
        $result->close();
    } else {
        echo "<script>alert('Không thể chuẩn bị truy vấn!')</script>";
    }
}
mysqli_close($connect);
?>