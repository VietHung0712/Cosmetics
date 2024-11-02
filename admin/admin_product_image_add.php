<?php
require_once "../php/connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $image_url = $_POST['image_url'];

    $product = $_GET['product'];

    $sql = "INSERT INTO product_image VALUES ('', $product, '$image_url')";
    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);
    if ($result) {
        header("Location: ./admin_product_item.php?product=" . $product);
        exit();
    } else {
        echo "<script>alert('Đã có lỗi!')</script>";
    }
}