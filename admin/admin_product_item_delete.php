<?php
require_once "../php/connect.php";
if (isset($_GET['id']) && isset($_GET['product'])) {
    $id = $_GET['id'];
    $product = $_GET['product'];
    $sql = "DELETE FROM product_item WHERE id = ?";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("i", $id);
        if ($result->execute()) {
            header("Location: ./admin_product_item.php?product=" . $product);
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
