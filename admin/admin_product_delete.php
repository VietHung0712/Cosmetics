<?php
require_once "../php/connect.php";
if (isset($_GET['product'])) {
    $product = $_GET['product'];
    $sql = "DELETE FROM product WHERE id = ?";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("i", $product);
        if ($result->execute()) {
            header("Location: ./admin_product.php");
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
