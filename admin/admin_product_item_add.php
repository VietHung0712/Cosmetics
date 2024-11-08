<?php
require_once "../php/connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $attributes = $_POST['attributes'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $product = $_GET['product'];

    $sql = "INSERT INTO product_item VALUES ('', ?, ?, ?, ?)";
    $result = mysqli_prepare($connect, $sql);
    if ($result) {
        $result->bind_param("isdi", $product, $attributes, $price, $count);
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
